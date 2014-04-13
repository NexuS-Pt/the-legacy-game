<?php

$id = intval($_GET['id']);
if (!isset($_POST['botao-submit']))
{

    $query = "SELECT
	`coins_order`.`id`,
	`users`.`id` AS 'user_id',
	`users`.`username`,
	`users`.`type`,
	`coins_order`.`orderid`,
	`coins_order`.`active`
	FROM ((`coins_order` join `users` on((`coins_order`.`user_id_ass` = `users`.`id`))))
	WHERE `coins_order`.`id` = ".$id;

    $result = mysql_query($query);
    $row = mysql_fetch_array($result);

if ($config["coinsExtraBuy"] > 0 && $row["type"] <= 5)
{echo "<p>AVISO! Está activa a ExtraSeason, o comprador deste pacote irá receber um extra de ".$config["coinsExtraBuy"]." Moedas de Ouro!</p>";}
?>
<blockquote>

    <h3>Compra nº <?php echo $id; ?></h3>
    <p><b>Utilizador ID:</b> <?php echo $row['user_id']; ?></p>
    <p><b>Utilizador:</b> <?php echo $row['username']; ?></p>
    <p><b>Order ID:</b> <?php echo $row['orderid']; ?></p>

</blockquote>
<form method="post">

    <input type="hidden" name="user-id" value="<?php echo $row['user_id']; ?>">
    <input type="hidden" name="orderid" value="<?php echo $row['orderid']; ?>">

    <p>
        <b>Validade:</b><br>
        <select name="validade">
            <option value="0">Escolher opção</option>
            <option value="1">Válido</option>
            <option value="2">Inválido</option>
        </select>
    </p>

    <p>
        <b>Pacote escolhido:</b><br>
        <select name="pacote">
            <option value="0">Escolher opção</option>
            <option value="2">Pacote 2 €</option>
            <option value="4">Pacote 4 €</option>
            <option value="6">Pacote 6 €</option>
            <option value="8">Pacote 8 €</option>
            <option value="11">Pacote 11 €</option>
        </select>
    </p>
    <p><input type="submit" name="botao-submit" value="Enviar"></p>

</form>
<?php

}
elseif (isset($_POST['botao-submit']))
{
        // CASO A VALIDADE NAO TENHA SIDO ESCOLHIDA
    if      ($_POST['validade'] == 0)
        {echo "<p align='center'><img src='./media/imagens/i_false.png' class='decorationone'><br>Deve escolher a validade do ORDER ID!</p>";}

        // CASO A VALIDADE SEJA INVALIDA
    elseif  ($_POST['validade'] == 2)
        {
            $query = "UPDATE coins_order SET active = 2 WHERE id = ".$id;
            if(mysql_query($query)){echo "<p align='center'><img src='./media/imagens/i_true.png' class='decorationone'><br>Esta compra pareceu-lhe inválida e foi desactivada com sucesso!</p>";}else{echo "<p align='center'><img src='./media/imagens/i_false.png' class='decorationone'><br>ERRO! Por algum motivo a acção foi comprometida, tente mais tarde!</p>";}
        }
        // CASO UM PACOTE NAO TENHA SIDO ESCOLHIDO
    elseif  ($_POST['pacote'] == 0)
        {echo "<p align='center'><img src='./media/imagens/i_false.png' class='decorationone'><br>Deve escolher o pacote referente à compra!</p>";}
        // CASO ESTEJA TUDO OK AVANÇA PARA O REGISTO
    elseif  ($_POST['validade'] == 1)
        {
            switch ($_POST['pacote'])
            {
                case 2: $quant = 200; break;
                case 4: $quant = 500; break;
                case 6: $quant = 750; break;
                case 8: $quant = 1000; break;
                case 11: $quant = 1500; break;
            }

            // BUSCAR A QUANTIDADE DE MOEDAS QUE A PESSOA TEM ACTUALMENTE NA SUA CONTA
            $query = "SELECT username,email,coin,type FROM users WHERE id = ".$_POST['user-id']." LIMIT 1";
            $result = mysql_query($query);
            $row = mysql_fetch_array($result);

            // QUANTIDADE DE MOEDAS QUE A PESSOA EM QUESTAO, VAI POSSUIR NA CONTA
            $coin = $row['coin'] + $quant;
            // CASO O COMPRADOR SEJA NO MINIMO UTILIZADOR MAIS, SERA ADICIONADO O BONUES EXTRA SEASON
			if ($config["coinsExtraBuy"] > 0 && $row["type"] <= 5) {$coin += $config["coinsExtraBuy"];}
			
            $query_1 = "UPDATE users SET coin = ".$coin." WHERE id = ".$_POST['user-id'];

            $query_2 = "UPDATE coins_order SET active = 1 WHERE id = ".$id;

            $why = "Pagamento de ".$_POST['pacote']." €";
			if ($config["coinsExtraBuy"] > 0 && $row["type"] <= 5) {$why .= ", mais ".$config["coinsExtraBuy"]." Moedas de Ouro por comprar em ExtraSeason";}
						
            $date = date("Y-m-d");

            $query_3 = "INSERT INTO coins (quant,type,user_id_ass,why,date,orderid) VALUES ('".$quant."','1','".$_POST['user-id']."','".$why."','".$date."','".$_POST['orderid']."')";

            if(mysql_query($query_1) && mysql_query($query_2) && mysql_query($query_3))
            {
		 		send_mail_to($row['username'],$row['email'],"Mensagem de Aviso","Vimos por este meio avisar que o seu ORDER ID : ".$_POST['orderid']." foi aceite, e as Moedas de Ouro foram depositadas com sucesso na sua conta.");
		 			echo "<p align='center'><img src='./media/imagens/i_true.png' class='decorationone'><br>
                    Operações efectuadas com sucesso!<br>
                    <b>Dados</b><br>
                    Utilizador :".$row['username']."<br>
                    Moedas de Ouro : ".$coin."<br>
                    Pacote : ".$_POST['pacote']." €<br>
                    ORDER ID : ".$_POST['orderid']."<br></p>";}
                    else
                    {send_mail_to($row['username'],$row['email'],"Mensagem de Aviso","Vimos por este meio avisar que o seu ORDER ID : ".$_POST['orderid']." foi rejeitado, caso não concorde com a situação contacte a administração pelo e-mail : geral@nexusystem.com .");echo "<p align='center'><img src='./media/imagens/i_false.png' class='decorationone'><br>ERRO: Algo aconteceu, verifique na base de dados!</p>";}
        	}
}
?>
