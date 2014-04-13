<?php
if(isset($_GET['equip']))
{
	$equip = intval($_GET['equip']);
	
	$query = "SELECT * FROM g_equips WHERE id = ".$equip;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);

	
	echo "
	<div>
		<div id=\"bag-equip-name\">
			".$row['name']."
			<div id=\"bag-equip-part\">".$row['part']."</div>
		</div>
		<div id=\"bag-equip-img\">
			<img src='./media/imagens/character/equips/".$row['id'].".jpg' style=\"width: 184px; height: 45px;\">
		</div>
		<div>
			<div id=\"bag-equip-titles\">
				<div style=\"float: left; width: 171px;\">ATK</div>
				<div style=\"float: left; width: 171px;\">DEF</div>
				<div style=\"float: left; width: 171px;\">VEL</div>
				<div style=\"float: left; width: 171px;\">VID</div>
				<div style=\"float: left; width: 171px;\">CRIT</div>
			</div>
			<div id=\"bag-equip-skills\">
				<div style=\"float: left; width: 171px;\">".$row['atk']."</div>
				<div style=\"float: left; width: 171px;\">".$row['def']."</div>
				<div style=\"float: left; width: 171px;\">".$row['velocidade']."</div>
				<div style=\"float: left; width: 171px;\">".$row['vida']."</div>
				<div style=\"float: left; width: 171px;\">".$row['critical']." %</div>
			</div>
		</div>
		<div style=\"width: 848px; border: 1px solid #000; background: url(templates/jpeg.jpg); text-align: right; color: #FFF; font-size: 13pt; padding-right: 10px;\">
			".$row['mo']." <img valign='middle' src='./media/imagens/character/gold_coin.png' class='decorationone' width='18' title='Moedas de Ouro'> ".$row['gepys']." <img valign='middle' src='./media/imagens/character/gepys_coin.png' class='decorationone' width='18'title='Moedas Gepys'>
		</div>
		<div id=\"bag-equip-footer\">";
			if($conta['coin'] >= $row['mo'] && ($conta['game']['gepys']) >= $row['gepys'])
			{echo "<div onClick=\"goTo('?page=game&do=loja&buy=".$row['id']."')\">Comprar</div>";}
			else
			{echo "<div>Não possuis o montante necessário para esta compra!</div>";}
		echo
		"
		</div>
	</div>
	";
}
elseif(isset($_GET['buy']))
{
	$buy = intval($_GET['buy']);

	$query = "SELECT * FROM g_equips WHERE id = ".$buy;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);

		if($conta['coin'] >= $row['mo'] && ($conta['game']['gepys']) >= $row['gepys'])
	{
		$conta['coin'] = $conta['coin'] - $row['mo'];
		$conta['game']['gepys'] = $conta['game']['gepys'] - $row['gepys'];
		
		$query = "UPDATE g_char SET gepys = ".($conta['game']['gepys'])." WHERE id = ".($conta['game']['id']);
		mysql_query($query);
		$query = "UPDATE users SET coin = ".($conta['coin'])." WHERE id = ".($conta['0']);
		mysql_query($query);
		$query = "INSERT INTO g_bag (user_id_ass,equip_id_ass,equiped) VALUES ('".$conta['game']['id']."','".$row['id']."','0')";
		mysql_query($query);
		$query = "INSERT INTO g_history (user_id_ass,frase,type) VALUES ('".$conta['game']['id']."','Efectuado com sucesso a compra de ".$row['name']."!','M')";
		mysql_query($query);

		echo "
			<div id=\"rlg-out\">
				<div id=\"rlg-time\" style=\"font-size: 15pt; color: #FFF;\"><img src=\"templates\buy.png\"><br>Compra efectuada com sucesso!<br>Por favor verifica a tua mala!</div>
				<div id=\"rlg-warning\">Sistema de Loja</div>
			</div>";
	}
	else
	{
		echo "
			<div id=\"rlg-out\">
				<div id=\"rlg-time\" style=\"font-size: 15pt; color: #FFF;\"><img src=\"templates\buy-not.png\"><br>Não tens fundos suficientes para efectuar tal compra!</div>
				<div id=\"rlg-warning\">Sistema de Loja</div>
			</div>";
	}
	
}
else
{
?>
<div id="lm-header">
	Loja
	<div id="lm-header-2">Temos do melhor que há para ganhares!</div>
</div>
<div id="lm-titles">
	<div style="margin-left: 8px; width: 550px; float: left; text-align: left;">Nome</div>
	<div style="width: 150px; float: left; text-align: center;">Posição</div>
	<div style="width: 150px; float: left; text-align: center;">Estado</div>
</div>

<?php

    $query = "SELECT * FROM g_equips WHERE type = ".($conta['game']['type'])." ORDER BY mo,gepys ASC";
    $result = mysql_query($query);

    while ($data = mysql_fetch_array($result))
    {
        $url = '"./index.php?page=game&do=loja&equip="';
        
        echo "
		<div id=\"lm-data\" onClick=\"goTo('?page=game&do=loja&equip=".$data['id']."')\" style=\"padding-top: 1px; padding-bottom: 1px; cursor: pointer;\">
			<div style=\"margin-left: 8px; width: 550px; float: left; text-align: left;\">".$data['name']."</div>
			<div style=\"width: 150px; float: left; text-align: center;\">".$data['part']."</div>
			<div style=\"width: 150px; float: left; text-align: right; display: inline-block;\">
				<div style=\"width: 75px; float: left;\">
					".$data['mo']." <img valign='middle' src='./media/imagens/character/gold_coin.png' class='decorationone' width='18' title='Moedas de Ouro'>
				</div>
				<div style=\"width: 70px; float: left;\">
					".$data['gepys']." <img valign='middle' src='./media/imagens/character/gepys_coin.png' class='decorationone' width='18'title='Moedas Gepys'>
				</div>
			</div>
		</div>";
    }
	?>
	<div id="lm-footer"></div>
	<?php
}

?>
<?php $config["site_game_name"] .= " : Game : Loja";  ?>