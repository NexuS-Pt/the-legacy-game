<?php
if ($conta["game"]["team_id_ass"] != 0)
{
	// indicar a página ao qual quer aceder
	if (!isset($_GET["option"])) {$option = null;}else{$option = $_GET["option"];}

	$query = "SELECT * FROM g_team WHERE id = '".$conta["game"]["team_id_ass"]."' LIMIT 1";
	$source = mysql_query($query);
	$data = mysql_fetch_array($source);

	if($data["win"] != 0 && $data["lose"] != 0){$aux["racio"] = $data["win"]/$data["lose"];}else{$aux["racio"] = 0;}
	$aux["combat"] = $data["win"] + $data["lose"];

	// DESMEMBRAR OS MEMBROS DA STRING
	$aux["members"] = explode(",",$data["member_id_ass"]);
	// RETIRAR OS CHARS <> DAS STRINGS DE MEMBROS
	for ($i = 0; $i < count($aux["members"]); $i++)
	{$aux["members"][$i] = str_replace(array("<", ">"), "", $aux["members"][$i]);}

	// MENU
	print("<p align=\"center\"><a href=\"./?do=team\">Inicial</a> | <a href=\"./?do=team&option=wall\">Wall</a> | <a href=\"./?do=team&option=lista-equipas\">Lista</a>");
	if ($conta["game"]["id"] == $data["owner_id_ass"]) {print(" | <a href=\"./?do=team&option=adm\">Adm</a>");}
	print("</p>");
	
	if ($option == null)
	{
		// Aqui pagina principal
		include($path."game/team-home.php");
	}
	elseif ($option == "wall")
	{
		// Aqui WALL
		include($path."game/team-wall.php");
	}
	elseif ($option == "lista-equipas")
	{
		// Aqui Lista de Equipas
		include($path."game/team-list.php");
	}
	elseif ($option == "adm" && $conta["game"]["id"] == $data["owner_id_ass"])
	{
		// Aqui ADM
		include($path."game/team-adm.php");
	}
	else {return_error();}
}
else
{
	return_error();
}
?>
