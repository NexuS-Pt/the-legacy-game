<?php

$coins_add = 5; // IGUALAR AO VALOR PRETENDIDO A OFERECER

$query = "SELECT id FROM g_char WHERE user_id_ass = ".$conta['0'];
$result = mysql_query($query);

 if (mysql_num_rows($result) == 1)
 {
    echo "<p>Já se econtra registado em jogo!<br> Clica <a href='./?page=game'>Aqui</a> para jogar!</p>
		<p>Precisa de ajuda para começar? Clique <a href=\"./?page=topic&id=89\">Aqui</a> para ler as instruções dadas pelos criadores.</p>";
 }
 elseif (isset($_POST['game_button']))
 {
     $query = "SELECT id FROM g_char WHERE name = '".$_POST['name']."'";
     $result = mysql_query($query);

     if(mysql_num_rows($result) == 1 OR empty($_POST['name']))
     {
         echo "<p>O nome pretendido, já se encontra registado ou é incompativel!<br>Por favor esolha um diferente!</p>";
     }
     else
     {

         //MOEDAS REFERIDAS ... coins_add MOEDAS
        if (isset($_POST['refeer']))
        {
            $query = "SELECT id,coin FROM users WHERE email = '".$_POST['refeer']."'";
            $result = mysql_query($query);

            if(mysql_num_rows($result)== 1)
            {
                $deposit_new_coins = mysql_fetch_array($result);
                $coin = $deposit_new_coins['coin'] + $coins_add;

                //INSERCAO DAS MOEDAS NA CONTA
                $query = "UPDATE users SET coin = '".$coin."' WHERE email = '".$_POST['refeer']."'";
                mysql_query($query);

                //REGISTO NAS COINS DA ENTRADA DE MOEDAS DE OURO E QUAL A RAZAO
				$frase_registo = 'Referido em NexuS O Legado. Jogador :'.$_POST['name'];
                $query = "INSERT INTO coins (quant,type,user_id_ass,why,date) VALUES('".$coins_add."','1','".$deposit_new_coins['id']."','".$frase_registo."','".date('Y-m-d')."')";
                mysql_query($query);
            }
        }
			$type_char = $_POST['type_char'];

             switch($type_char)
            {
                case 1:
                    $img = "./media/imagens/character/p-char-agua.jpg";
                    break;
                case 2:
                    $img = "./media/imagens/character/p-char-fogo.jpg";
                    break;
                case 3:
                    $img = "./media/imagens/character/p-char-erva.jpg";
                    break;
                case 4:
                    $img = "./media/imagens/character/p-char-vento.jpg";
                    break;
                case 5:
                    $img = "./media/imagens/character/p-char-psiquico.jpg";
                    break;
                case 6:
                    $img = "./media/imagens/character/p-char-luz.jpg";
                    break;
                case 7:
                    $img = "./media/imagens/character/p-char-escuridao.jpg";
                    break;
                case 8:
                    $img = "./media/imagens/character/p-char-electricidade.jpg";
                    break;
                case 9:
                    $img = "./media/imagens/character/p-char-normal.jpg";
                    break;
    }
         $query = "INSERT INTO g_char (user_id_ass,name,img,type,register_since) VALUE ('".$conta['0']."','".$_POST['name']."','".$img."','".$type_char."','".time()."')";
         if (mysql_query($query)){echo "<p>Registo efectuado com sucesso!<br> Clica <a href='./game'>Aqui</a> para jogar!</p><p>Precisa de ajuda para começar? Clique <a href=\"http://nexusystem.com/index.php?page=topic&id=89\">Aqui</a> para ler as instruções dadas pelos criadores.</p>";}
     }
 }
 else
 {


     echo "<form method='post'>
         <p><b>Nome:</b><br>
         <input type='text' name='name' maxlength='15'><br>
         <i>*No máximo 15 caracteres.</i></p>
         <p><b>Tipo:</b><br>
         <select name='type_char'>
            <option value='1'>Água</option>
            <option value='2'>Fogo</option>
            <option value='3'>Erva</option>
            <option value='4'>Vento</option>
            <option value='5'>Psiquico</option>
            <option value='6'>Luz</option>
            <option value='7'>Escuridão</option>
            <option value='8'>Electricidade</option>
            <option value='9'>Normal</option>
         </select><br>
         <i>*A escolha será o tipo da tua personagem.</i></p>";



     if (isset($_GET['ref'])){$ref = $_GET['ref'];echo "<p><b>Referido:</b><br><input type='text' disableb='disableb' value='".$ref."' name='refeer'></p>";}

     echo "<p align='center'><input type='submit' class='button' value='Registar' name='game_button'></p>
         </form>";
 }



?>
