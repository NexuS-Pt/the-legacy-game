<?php
if($_GET['to'] == $conta['0'])
{
	echo "<p align='center'><img src='./media/imagens/i_stop.png' class='decorationone'><br>Não é permitido enviar mensagens para ti próprio.</p>";
}
else
{
	if (empty($_GET['to']))
	{		echo "<p>Por favor antes de tudo, deverá escolher a quem enviar uma mensagem!</p>";}
	elseif (!empty($_GET['to']))
	{
		echo '<form action="index.php?page=mp&par=send" method="post">';
		$query = mysql_query("SELECT username FROM users WHERE id ='".intval($_GET["to"])."'");
		$data = mysql_fetch_array($query);
		//ID
		
		echo "
			<div id=\"lm-header\">
				Enviar Mensagem privada
				<div id=\"lm-header-2\"><a style=\"color: #FFF;\" href=\"?page=mp&par=ent\">« Caixa de Entrada</a></div>
			</div>
			<div id=\"lm-titles\" style=\"height: 27px; padding-left: 5px; width: 853px;\">
				<input type=\"hidden\" value=\"".$_GET['to']."\" name=\"to\" />
				Para : <input type=\"text\" value=\"".$data["username"]."\" name=\"para\"> Assunto : <input type=\"text\" name=\"subject\" size=\"20\">
			</div>
			<div style=\"width: 858px; border-left: 1px solid #CCC; border-right: 1px solid #CCC;\">
		";
			return_editor($conta['previlegios'],"");
		echo "
			</div>
			<div id=\"lm-footer\"><button class=\"site\" type=\"submit\">Enviar</button></div>";
	}
}
?>
