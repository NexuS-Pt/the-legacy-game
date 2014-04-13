

<?php
	$warning_active = 1; // COLOCAR VALOR 0 PARA DESLIGAR, VALOR 1 PARA LIGAR
	$warning_message = "Versão 2.2 em vigor, clica em sobre do menú de jogo para saberes as novidades!<br>Esta semana referidos ganham 7 Moedas de Ouro e não 5!"; // MENSAGEM EM HTML A SER COLOCADA EM WARNING

	// --------- AVISO - WARNING ----------------------------------
	// ----- FUNCIONA SE A VARIAVEL warning_active FOR IGUAL A 1 ------
	// ------------------------------------------------------------

	if ($warning_active == 1)
	{
		echo "<blockquote class='warning'><p>".$warning_message."</p></blockquote>";
	}

	// --------- DADOS DE JOGO ----------------------------------
	// ----- CORPO INTEGRAL DO JOGO, CHAMAMENTO E MENU DE JOGO ------
	// ------------------------------------------------------------
	$query = "SELECT * FROM g_char WHERE user_id_ass = '$conta[0]'";
    $result = mysql_query($query);

	if (!isset($_COOKIE[$cookie]))
	{
		echo "<p align='center'>Necessita de uma conta para puder jogar!<br><a href='./../'><button><img src='./img/login.png'><br>Efectuar Login</button></a> <a href='./../index.php?page=register'><button><img src='./img/register.png'><br>Criar Conta</button></a></p>";
	}
    else if (mysql_num_rows($result) == 1)
    {

    	$conta['game'] = mysql_fetch_array($result);


    	if(isset($_GET['do'])){$do = $_GET['do'];}
    
    
		if (!isset($do))														{echo "<h3 class='game-char'>Principal</h3>"; 						include('./game/character.php');	}
		elseif ($do == 'selva')													{echo "<h3 class='game-wild'>Selva</h3>"; 							include('./game/selva.php');		}
		elseif ($do == 'loja')													{echo "<h3 class='game-market'>Loja</h3>"; 							include('./game/loja.php');		}
		elseif ($do == 'conversor')												{echo "<h3 class='game-converter'>Conversor</h3>"; 					include('./game/conversor.php');	}
		elseif ($do == 'mala')													{echo "<h3 class='game-bag'>Mala</h3>"; 							include('./game/mala.php');		}
		elseif ($do == 'jogadores')												{echo "<h3 class='game-players'>Jogadores</h3>"; 					include('./game/jogadores.php');	}
		elseif ($do == 'classificacao')											{echo "<h3 class='game-classification'>Classificação Geral</h3>"; 	include('./game/classificacao.php');	}
		elseif ($do == 'caca-ao-coelho' && $conta['previlegios'] <= 4)			{echo "<h3 class='game-bunny'>Caça ao Coelho</h3>"; 				include('./game/caca-ao-coelho.php');	}
		elseif ($do == 'historico')												{echo "<h3 class='game-history'>Histórico</h3>"; 					include('./game/historico.php');	}
		elseif ($do == 'sobre')													{echo "<h3 class='game-info'>Sobre O Legado</h3>"; 					include('./game/sobre.php');		}
		elseif ($do == 'combate')												{echo "<h3 class='game-fight'>Combate</h3>"; 						include('./game/combate.php');		}
		elseif ($do == 'teste' && $conta['previlegios'] <= 1)					{echo "<h3 class='game-monster'>Lista de Monstros</h3>";			include('./game/lista-monstros.php');	}
		elseif ($do == 'duo-combate' && $conta['previlegios'] <= 4)				{include('./game/duo-combate.php');	}
		elseif ($do == 'duo-combate-convites' && $conta['previlegios'] <= 4)	{include('./game/duo-combate.php');	}

	}
	else
	{
		echo "<p align='center'>Não foi encontrado um jogador associado à tua conta! Clica em Criar Nexar para criar uma personagem!<br><a href='./../index.php?page=app'><button><img src='./img/nexar.png'><br>Criar Nexar</button></a></p>";
	}

?>

