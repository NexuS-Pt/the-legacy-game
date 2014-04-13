<?php
	$msg_id	= intval($_GET['msg']);
	
	$query	= mysql_query("SELECT * FROM private_messages WHERE id = '$msg_id'");
	$data	= mysql_fetch_array($query);
	
	if ($data['sender'] == '1')
	{
		if(mysql_query("UPDATE private_messages SET sender = '0' WHERE id = '$msg_id' AND sender_id = '$conta[0]'"))
		{$p = "<p align=\"center\"><img src=\"./media/imagens/i_true.png\" class=\"decorationone\"><br>Mensagem apagada com sucesso!</p>";}else{$p = "<p align='center'><img src='./media/imagens/i_stop.png' class='decorationone'><br>ERRO ao apagar mensagem!</p>";}
	}
	else
	{
		$p = "<p align='center'><img src='./media/imagens/i_stop.png' class='decorationone'><br>Erro! Tente de novo!<br>Caso o erro precista contacte o administrador de Sistema!</p>";
	}
	
	echo $p;

?>
