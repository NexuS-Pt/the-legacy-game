<div id="lm-header">
	Classificação
	<div id="lm-header-2">Não sei se sabes, mas o objectivo é estar em 1º!</div>
</div>
<div id="lm-titles">
	<div style="width: 75px; float: left; text-align: center;">Pos.</div>
	<div style="margin-left: 8px; width: 625px; float: left; text-align: left;">Nome</div>
	<div style="width: 150px; float: left; text-align: center;">Experiência</div>
</div>

<?php
	$query = "SELECT user_id_ass,name,expirience FROM g_char ORDER BY expirience DESC";
	$source = mysql_query($query);
	$position = 0;

	while ($data = mysql_fetch_array($source))
	{	
		$position++;
		if ($conta[0] == $data["user_id_ass"]) {echo "<div id=\"lm-data\" style=\"background: url(templates/hs-img.png) orange;\">";} else {echo "<div id=\"lm-data\">";}
		echo "
			<div style=\"width: 75px; float: left; text-align: center;\">".$position."º</div>
			<div style=\"margin-left: 8px; width: 625px; float: left; text-align: left;\">" .$data['name']."</div>
			<div style=\"width: 145px; float: left; text-align: right;\">". number_format($data['expirience'],0,""," ")." pts</div>
		</div>";
	}

?>
<div id="lm-footer"></div>
<?php $config["site_game_name"] .= " : Game : Classificação";  ?>