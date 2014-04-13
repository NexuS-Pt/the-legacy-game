<?php
$query = "SELECT * FROM g_history WHERE user_id_ass = '".$conta['game']['id']."' ORDER BY id DESC LIMIT 0,25";
$source = mysql_query($query);

while ($row = mysql_fetch_array($source))
{
	switch($row['type'])
	{
		case "W": $button = "<div id=\"hs-win\" class=\"hs-id\">W</div>"; break;
		case "L": $button = "<div id=\"hs-lose\" class=\"hs-id\">L</div>"; break;
		case "D": $button = "<div id=\"hs-duo\" class=\"hs-id\">D</div>"; break;
		case "M": $button = "<div id=\"hs-market\" class=\"hs-id\">M</div>"; break;
		case "S": $button = "<div id=\"hs-skill\" class=\"hs-id\">S</div>"; break;
		case "C": $button = "<div id=\"hs-converter\" class=\"hs-id\">C</div>"; break;
		default: $button = "<div  id=\"hs-unknown\" class=\"hs-id\">?</div>"; break;
	}
	
	echo "
	<div class=\"registry\">
		".$button."
		<div style=\"float: left; margin-left: 5px;\">".$row['frase']."</div>
	</div>";
}


?>
<?php $config["site_game_name"] .= " : Game : Histórico";  ?>