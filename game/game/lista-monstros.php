<div id="lm-header">
	Lista de Monstros
	<div id="lm-header-2">Achas que podes ganhar a todos?</div>
</div>
<div id="lm-titles">
	<div style="margin-left: 8px; width: 250px; float: left; text-align: center;">Nome</div>
	<div style="width: 150px; float: left; text-align: center;">ATK</div>
	<div style="width: 150px; float: left; text-align: center;">DEF</div>
	<div style="width: 150px; float: left; text-align: center;">VEL</div>
	<div style="width: 150px; float: left; text-align: center;">VID</div>
</div>

<?php
	$query = "SELECT name,atk,def,vida,velocidade FROM g_monsters WHERE expirience <= ".$conta['game']['expirience']." ORDER BY expirience DESC";
	$source = mysql_query($query);

	while ($data = mysql_fetch_array($source))
	{
		echo "
		<div id=\"lm-data\">
			<div style=\"margin-left: 8px; width: 250px; float: left; text-align: left;\">".$data['name']."</div>
			<div style=\"width: 150px; float: left; text-align: center;\">".$data['atk']."</div>
			<div style=\"width: 150px; float: left; text-align: center;\">".$data['def']."</div>
			<div style=\"width: 150px; float: left; text-align: center;\">".$data['velocidade']."</div>
			<div style=\"width: 150px; float: left; text-align: center;\">".$data['vida']."</div>
		</div>
		";
	}
	echo "</table>";

?>
<div id="lm-footer"></div>

<?php $config["site_game_name"] .= " : Game : Monstros";  ?>