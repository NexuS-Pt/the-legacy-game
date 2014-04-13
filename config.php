<?php
  	$config["online"]           		= true;
  	$config["offline-msg"]      		= "De momento estamos a fazer actualizações ao sistema, esperamos que aguardem, e pedimos a nossas sinceras desculpas pelo incomudo.<br>Tentaremos ser o mais breves possiveis.";
	$config["site_name_on"]			= false;
	$config["site_name"]			= "NexuSystem";
	//$config["site_slogan"]		= "Community of NexuS";
	$config["site_game_name_on"]		= false;	
	$config["site_game_name"]		= "NexuS : O Legado";
	$config["servidor"]			= "127.0.0.1";
	$config["utilizador"]			= "user";
	$config["palavrapasse"]			= "password";
	$config["basededados"]			= "database";
	$config["systemmail"]			= "geral@nexus-pt.eu";
  	$cookie		               		= "nxs2011";
	$prefix					= "nxs_";
	$config["coinsExtraBuy"]		= 0;
	
	// CONFIGURAÇÕES DE MODULOS
	$config["warning_active"] 		= 0; // COLOCAR VALOR 0 PARA DESLIGAR, VALOR 1 PARA LIGAR
	$config["warning_acess"] 		= 6; /* NIVEL DE ACESSO A ESTE WARNING EX.: 1 - ADMIN, 2 - GESTORES, 3 - EQUIPA, 4 - VIP, 5 - UTILIZADORES MAIS, 6 - UTILIZADORES */
	$config["warning_message"]		= "EXTRA SEASON activa, aproveita serão mais 75 MOs"; // MENSAGEM EM HTML A SER COLOCADA EM WARNING

	//-----------------------------------------------------
	$con = mysql_connect ($config["servidor"],$config["utilizador"],$config["palavrapasse"]);
	
	if (!$con)
	{ die ("Não foi possivel connectar:".mysql_error()); }
	else
	{ mysql_select_db($config["basededados"],$con); mysql_set_charset("utf8"); }
	
?>
