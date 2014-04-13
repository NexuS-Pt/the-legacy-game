<?php
		// MENSAGENS PRIVADAS			
			if (empty($_GET['par']) OR $_GET['par'] == "ent")
			{
				include('./messages/ent.php');
			}else if ($_GET['par'] == "sai")
			{
				include('./messages/sai.php');
			}else if ($_GET['par'] == "esc")
			{
				include('./messages/esc.php');
			}else if ($_GET['par'] == "send")
			{
				include('./messages/send.php');
			}else if ($_GET['par'] == "view")
			{
				include ('./messages/view.php');	
			}else if ($_GET['par'] == "del_r")
			{
				include('./messages/del_recep.php');
			}else if ($_GET['par'] == "del_s")
			{
				include('./messages/del_send.php');
			}else
			{
				Echo "<p align='center'><img src='./media/imagens/i_stop.png' class='decorationone'><br>Estás a procura de uma página que não existe!</p>";
			}

?>
