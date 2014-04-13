<?php
	// --------- DADOS DE JOGO ----------------------------------
	// ----- CORPO INTEGRAL DO JOGO, CHAMAMENTO E MENU DE JOGO ------
	// ------------------------------------------------------------
	$query = "SELECT * FROM g_char WHERE user_id_ass = '".$conta[0]."'";
    $result = mysql_query($query);

	if (!isset($_COOKIE[$cookie]))
	{
		echo "<p align='center'>Necessita de uma conta para poder jogar!<br><button onclick=\"goTo('./')\"><img src='./game/img/login.png'><br>Efectuar Login</button> <button onclick=\"goTo('./?page=register')\"><img src='".$path."img/register.png'><br>Criar Conta</button></p>";
	}
    else if (mysql_num_rows($result) == 1)
    {

    	$conta['game'] = mysql_fetch_array($result);
		$path = "./game/";

    	if(isset($_GET['do'])){$do = $_GET['do'];}
    
		if (!isset($do))								{include($path.'game/character.php');}
		elseif ($do == 'selva')							{include($path.'game/selva.php');}
		elseif ($do == 'loja')							{include($path.'game/loja.php');}
		elseif ($do == 'conversor')						{include($path.'game/conversor.php');}
		elseif ($do == 'mala')							{include($path.'game/mala.php');}
		elseif ($do == 'jogadores')						{include($path.'game/jogadores.php');}
		elseif ($do == 'classificacao')					{include($path.'game/classificacao.php');}
		elseif ($do == 'caca-ao-coelho' && $conta['previlegios'] <= 4)			{include($path.'game/caca-ao-coelho.php');	}
		elseif ($do == 'historico')						{include($path.'game/historico.php');}
		elseif ($do == 'sobre')							{include($path.'game/sobre.php');}
		elseif ($do == 'combate')						{include($path.'game/combate.php');}
		elseif ($do == 'monster-list' && $conta['previlegios'] <= 5)			{include($path.'game/lista-monstros.php');}
		elseif ($do == 'duo-combate' && $conta['previlegios'] <= 2)				{include($path.'game/duo-combate.php');}
		elseif ($do == 'duo-combate-convites' && $conta['previlegios'] <= 2)	{include($path.'game/duo-combate.php');}
		elseif ($do == 'team' && $conta['game']["team_id_ass"] != 0)			{include($path.'game/team.php');}
		else {return_error();}
	}
	else
	{ echo "<p align='center'>Não foi encontrado um jogador associado à tua conta! Clica em Criar Nexar para criar uma personagem!<br><a href='./?page=app'><button><img src='".$path."img/nexar.png'><br>Criar Nexar</button></a></p>"; }

?>
