<div id="lm-header">
	Caça ao Coelho
	<div id="lm-header-2">Anda por ai muito boa gente bem valiosa, usa a tua perspicácia para as apanhares!</div>
</div>
<div id="lm-titles">
	<div style="width: 75px; float: left; text-align: center;">Pos.</div>
	<div style="margin-left: 8px; width: 625px; float: left; text-align: left;">Nome</div>
	<div style="width: 150px; float: left; text-align: center;">Gepys</div>
</div>
<?php

	$query = "SELECT user_id_ass,name,gepys FROM g_char WHERE gepys > '9' ORDER BY gepys DESC";
	$source = mysql_query($query);
	$position = 0;

	while ($data = mysql_fetch_array($source))
	{	
		$position++;
		if ($conta[0] == $data["user_id_ass"]) {echo "<div id=\"lm-data\" style=\"background: url(templates/hs-img.png) orange;\">";} else {echo "<div id=\"lm-data\">";}
		echo "
			<div style=\"width: 75px; float: left; text-align: center;\">".$position."º</div>
			<div style=\"margin-left: 8px; width: 625px; float: left; text-align: left;\">" .$data['name']."</div>
			<div style=\"width: 145px; float: left; text-align: right;\">".$data['gepys']." Gpys</div>
		</div>";
	}

?>
<div id="lm-footer"></div>
<?php $config["site_game_name"] .= " : Game : Caça ao Coelho";  ?>