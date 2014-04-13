<?php
	$to				= intval($_POST['to']);
	$subject		= $_POST['subject'];
	$message		= $_POST['editor'];
	

	if (empty($subject))
	{
		echo "<p>Deve preencher o espaço assunto!</p>";
	}else if (empty($message))
	{
		echo "<p>Deve preencher o espaço dedicado à mensagem!</p>";
	}else if (empty($to))
	{
		echo "<p>O campo Para deve estar preenchido, por favor escolha para quem enviar a tua Mensagem Privada!</p>";
	}else
	{
		$message = str_replace($blocked_words, $blocked_words_replace, $message);
		$date = date("Y-m-d");
		
                // gravar mensagem na base de dados
		mysql_query("INSERT INTO private_messages
		(subject,text,state,sender,sender_id,recep,recep_id,date)
		VALUES
		('$subject','$message','1','1','$conta[0]','1','$to','$date')");
                
                // obter username e email para quem enviar o aviso de mensagem privada
                $aux = return_queryData("SELECT username,email FROM users WHERE id = '".$to."' LIMIT 1");
                
                // envio de email para o endereço associada à conta do utilizador
                send_mail_to($aux["username"],$aux["email"],"Mensagem de Aviso","<p>Vimos por este meio informar que recebeste uma <b>Mensagem Privada</b> na tua conta.</p>");
                
		echo "<p align=\"center\"><img src=\"./media/imagens/i_true.png\" class=\"decorationone\"><br>A sua mensagem foi enviada com sucesso!</p>";

		
	}


?>
