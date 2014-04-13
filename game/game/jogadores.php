<?php

if(!isset($_GET['jog']))
{
?>
<div id="lm-header">
	Jogadores
	<div id="lm-header-2">Pensas que são muitos só para ti? Ainda não viste nada!</div>
</div>
<div id="lm-titles">
	<div style="margin-left: 8px; width: 550px; float: left; text-align: left;">Nome</div>
	<div style="width: 150px; float: left; text-align: center;">Tipo</div>
	<div style="width: 150px; float: left; text-align: center;">Experiência</div>
</div>

<?php
        $min = $conta['game']['expirience'] / 10;
        $max = $conta['game']['expirience'] * 10;
        
	$query = "SELECT * FROM g_char WHERE expirience > '".$min."' AND expirience <= '".$max."' ORDER BY expirience DESC";
	$result = mysql_query($query);
		
	while($row = mysql_fetch_array($result))
	{
		if ($conta[0] == $row["user_id_ass"]) {echo "<div id=\"lm-data\" style=\"background: url(templates/hs-img.png) orange; padding-top: 1px; padding-bottom: 1px; cursor: pointer;\" onClick=\"goTo('?page=game&do=jogadores&jog=".$row['id']."')\">";} else {echo "<div id=\"lm-data\" onClick=\"goTo('?page=game&do=jogadores&jog=".$row['id']."')\" style=\"padding-top: 1px; padding-bottom: 1px; cursor: pointer;\">";}
		echo "
			<div style=\"margin-left: 8px; width: 550px; float: left; text-align: left;\">".$row['name']."</div>
			<div style=\"width: 150px; float: left; text-align: center;\">".game_type_write($row['type'])."</div>
			<div style=\"width: 145px; float: left; text-align: right;\">".number_format($row['expirience'],0,","," ")." pts</div>
		</div>";
	}
	?>
	<div id="lm-footer"></div>
	<?php
}
elseif(isset($_GET['jog']))
{

	$jog = intval($_GET['jog']);
	
	$query = "SELECT * FROM g_char WHERE id = '$jog'";

                if (mysql_num_rows(mysql_query($query)) == 0)
        {
            echo "<p align=center>Esta página não se dedica a nenhum jogador.</p>";
        }
        else
        {
            $jogadores = mysql_fetch_array(mysql_query($query));
        
            if ($jogadores['user_id_ass'] != $conta['0'])
            {
				echo "
				<div>
					<div style=\"background: url(templates/jpeg.jpg); padding-left: 5px; padding-right: 5px; font-size: 30pt; color: #FFF; border-radius: 5px 5px 0 0;\">
						".$jogadores['name']."
						<div style=\"float: right; font-size: 12pt;\">
							".number_format($jogadores['expirience'],0,","," ")." pts
						</div>
					</div>
					<div style=\"background: url(templates/topbanner.jpg); border: 1px solid #F60; padding-left: 5px; padding-right: 5px; text-align: right; color: #FFF;\">
						".game_type_write($jogadores['type'])."
					</div>
					<div style=\"text-align: center; background: #333;\">
						<img src='".$jogadores['img']." '>
					</div>
					<div style=\"display: inline-block; width: 858px; border: 1px solid #F60; background: url(templates/topbanner.jpg);\">
						<div style=\"float: left; width: 25%; text-align: center;\">ATK</div>
						<div style=\"float: left; width: 25%; text-align: center;\">DEF</div>
						<div style=\"float: left; width: 25%; text-align: center;\">VEL</div>
						<div style=\"float: left; width: 25%; text-align: center;\">VID</div>
					</div>
					<div style=\"display: inline-block; width: 858px; border-left: 1px solid #CCC; border-right: 1px solid #CCC;\">
						<div style=\"float: left; width: 25%; text-align: center;\">".$jogadores['atk']."</div>
						<div style=\"float: left; width: 25%; text-align: center;\">".$jogadores['def']."</div>
						<div style=\"float: left; width: 25%; text-align: center;\">".$jogadores['velocidade']."</div>
						<div style=\"float: left; width: 25%; text-align: center;\">".$jogadores['vida']."</div>
					</div>
					<div id=\"bag-equip-footer\">
							<div style=\"float: left; margin: auto;\" onClick=\"goTo('./?page=game&do=combate&adv=".$jogadores['id']."')\">Atacar</div>
							<div style=\"float: right;\" onClick=\"goTo('./?page=mp&par=esc&to=".$jogadores['user_id_ass']."')\">Mandar MP</div>
					</div>
				</div>
				";
            }
            elseif($jogadores['user_id_ass'] == $conta['0'])
            {
				echo "
				<div id=\"rlg-out\">
					<div id=\"rlg-time\" style=\"font-size: 15pt; color: #FFF;\">Este perfil é o teu, só pode ser visto por outros!</div>
					<div id=\"rlg-warning\">Sistema de Combate</div>
				</div>";
            }
        }
}

?>
<?php $config["site_game_name"] .= " : Game : Jogadores";  ?>