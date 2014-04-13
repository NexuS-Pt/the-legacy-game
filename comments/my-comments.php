<?php
	if(!isset($_GET['func'])){
        
		$query = "SELECT * FROM comments WHERE writer = '".$conta[0]."'";
		$data_source = mysql_query($query);
		while($data = mysql_fetch_array($data_source))
		{
			$query = "SELECT nome FROM content WHERE id = '".$data['content_id']."'";
			$nome_source = mysql_query($query);
			$nome = mysql_fetch_array($nome_source);
			
			echo "
			<div class=\"forumotherpost\">
				<div class=\"topictreplytitle\"><span style=\"padding-left: 4px; color:#000000;\">R:</span> ".$nome['nome']."</div>
				<div class=\"post\">
					".$data['text']."
					<div style=\"text.align: right;\"\><button class=\"site\" onclick=\"goTo('?page=noticia&noti=".$data['content_id']."')\"><img src=\"./images/b-home.png\" width=\"12px\"> Ver Noticia</button> <button class=\"site\" onclick=\"goTo('?page=my-comments&func=del&id=".$data['id']."')\"><img src=\"./images/b-reject.png\" width=\"12px\"> Eliminar</button></div>
				</div>
			</div>";
		}
	}
	elseif ($_GET["func"]== "del")
	{
		mysql_query("DELETE FROM comments WHERE id = '".$_GET['id']."' AND writer = '".$conta[0]."'");
		echo "<p align=\"center\"><img src=\"./media/imagens/i_true.png\" class=\"decorationone\"><br>Mensagem apagada!</p>";
		echo "<p align='center'><button class=\"site\" onclick='javascript:window.location=\"?page=my-comments\"'><img src=\"./images/b-home.png\" width=\"12px\"> Voltar</button></p>";
	}
?>
