<?php
if (isset($_GET['equip']))
{
	$equip = intval($_GET['equip']);

	$query = "SELECT
g_bag.id,
g_bag.equip_id_ass,
g_equips.atk,
g_equips.def,
g_equips.velocidade,
g_equips.vida,
g_equips.critical,
g_equips.img,
g_equips.part,
g_bag.equiped,
g_equips.`name`
FROM
g_bag
INNER JOIN g_equips ON g_bag.equip_id_ass = g_equips.id
WHERE
g_bag.id = ".$equip." ;" ;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);

	echo "
	<div>
		<div id=\"bag-equip-name\">
			".$row['name']."
			<div id=\"bag-equip-part\">".$row['part']."</div>
		</div>
		<div id=\"bag-equip-img\">
			<img src='./media/imagens/character/equips/".$row['equip_id_ass'].".jpg' style=\"width: 184px; height: 45px;\">
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
		<div id=\"bag-equip-footer\">";
		if ($row['equiped'] == 0) {
			echo 
			"<div onClick=\"goTo('?page=game&do=mala&equipar=".$row['id']."')\">Equipar</div>";
		} elseif($row['equiped'] == 1) {
			echo 
			"<div style=\"text-align: center; margin-left: auto; margin-right: auto; width: 200px; line-height: 25px; color: #FFF;\" onClick=\"goTo('?page=game&do=mala&desequipar=".$row['id']."')\">Desequipar</div>";
		}
		echo
		"</div>
	</div>
	";

}
elseif(isset($_GET['equipar']))
{
	$equipar = intval($_GET['equipar']);
	$query = "SELECT
g_bag.id,
g_bag.equip_id_ass,
g_equips.atk,
g_equips.def,
g_equips.velocidade,
g_equips.vida,
g_equips.critical,
g_equips.img,
g_equips.part,
g_bag.equiped,
g_equips.`name`
FROM
g_bag
INNER JOIN g_equips ON g_bag.equip_id_ass = g_equips.id
WHERE
g_bag.id = ".$equipar;

	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
		
	if ($row['equiped'] == 1)
	{ echo "
		<div id=\"rlg-out\">
			<div id=\"rlg-time\" style=\"font-size: 15pt; color: #FFF;\">Este equipamento ja se encontra equipado!</div>
			<div id=\"rlg-warning\">Sistema de Equipamento</div>
		</div>";}
	elseif($row['equiped'] == 0)
	{
		$query = "SELECT
g_bag.id,
g_bag.equip_id_ass,
g_equips.part,
g_bag.equiped,
g_equips.`name`
FROM
g_bag
INNER JOIN g_equips ON g_bag.equip_id_ass = g_equips.id
WHERE
g_equips.part = '".$row['part']."' AND
g_bag.equiped = '1' AND
g_bag.user_id_ass = ".$conta['game']['id'];

		$result = mysql_query($query);
		if (mysql_num_rows($result) > 0)
		{echo "<p align='center'>Por favor desequipe a Parte : ".$row['part']."</p>";}
		elseif(mysql_num_rows($result) == 0)
		{$query = "UPDATE g_bag SET equiped = 1 WHERE id = ".$row['id']; mysql_query($query);
			echo "
			<div id=\"rlg-out\">
				<div id=\"rlg-time\" style=\"font-size: 15pt; color: #FFF;\"><img src=\"templates\plug-in.png\"><br>Equipamento equipado com sucesso!</div>
				<div id=\"rlg-warning\">Sistema de Equipamento</div>
			</div>";}
	}

}
elseif(isset($_GET['desequipar']))
{	
	$desequipar = intval($_GET['desequipar']);
	$query = "SELECT equiped FROM g_bag WHERE id = ".$desequipar;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($row['equiped'] == 1)
	{$query = "UPDATE g_bag SET equiped = 0 WHERE id = ".$desequipar; mysql_query($query);
		echo "
			<div id=\"rlg-out\">
				<div id=\"rlg-time\" style=\"font-size: 15pt; color: #FFF;\"><img src=\"templates\plug-out.png\"><br>Equipamento desequipado com Sucesso!</div>
				<div id=\"rlg-warning\">Sistema de Equipamento</div>
			</div>";}
	elseif ($row['equiped'] == 0)
	{echo "
		<div id=\"rlg-out\">
			<div id=\"rlg-time\" style=\"font-size: 15pt; color: #FFF;\">Este equipamento não se encontra equipado!</div>
			<div id=\"rlg-warning\">Sistema de Equipamento</div>
		</div>";}

}
else
{
?>

<div id="lm-header">
	A minha Mala
	<div id="lm-header-2">Achas que as consegues comprar todas?</div>
</div>
<div id="lm-titles">
	<div style="margin-left: 8px; width: 700px; float: left; text-align: left;">Nome</div>
	<div style="width: 150px; float: left; text-align: center;">Estado</div>
</div>

<?php

	$query ="select 
`g_equips`.`name` AS `name`,
`g_equips`.`id` AS `id`,
`g_bag`.`equiped` AS `equiped`,
`g_equips`.`atk` AS `atk`,
`g_equips`.`def` AS `def`,
`g_equips`.`velocidade` AS `velocidade`,
`g_equips`.`critical` AS `critical`,
`g_equips`.`vida` AS `vida`,
`g_equips`.`img` AS `img`,
`g_bag`.`id` AS `equip-id`
from (`g_equips` join `g_bag` on((`g_bag`.`equip_id_ass` = `g_equips`.`id`)))
where ((`g_bag`.`user_id_ass` = ".($conta['game']['id']).") and (`g_bag`.`equip_id_ass` = `g_equips`.`id`))";

	$result = mysql_query($query);

	while($row = mysql_fetch_array($result))
	{
	
		echo "
		<div id=\"lm-data\" onClick=\"goTo('?page=game&do=mala&equip=".$row['equip-id']."')\" style=\"padding-top: 1px; padding-bottom: 1px; cursor: pointer;\">
			<div style=\"margin-left: 8px; width: 700px; float: left; text-align: left;\">".$row['name']."</div>
			";
		if($row['equiped']== 1)
		{echo "<div id=\"bag-equiped\" style=\"width: 150px; float: left; text-align: center;\">Equipado</div>";}
		else
		{echo "<div style=\"width: 150px; float: left; text-align: center;\">Guardado</div>";}
		echo "</div>";
	}
	?>
	<div id="lm-footer"></div>
	<?php
}
?>
<?php $config["site_game_name"] .= " : Game : Mala";  ?>