<?php


if (!isset($_POST["validar"]))
{
    echo '<form method="post"> 
    <p align="center">Endereço de E-mail:<br />
    <input type="text" name="email" />
    </p>
    <p align="center">Nome de Utilizador:<br />
    <input type="text" name="username" />
    </p>
    <p align="center">Palavra-Passe:<br />
    <input type="password" name="password" />
    </p>
    <p align="center">Confirmar Palavra-Passe:<br />
    <input type="password" name="password_conf" />
    </p>
    <p align="center"><button class="site" type="submit" value="Validar" name="validar"><img src="./images/b-accept.png" width="12px"> Validar</button> <button class="site" type="reset" value="Apagar"><img src="./images/b-reject.png" width="12px"> Apagar</button></p></form>';
}else{
	
	$email			= $_POST['email'];
	$username		= $_POST['username'];
	$password		= $_POST['password'];
	$password_conf	= $_POST['password_conf'];
	$password		= MD5($password);
	$password_conf	= MD5($password_conf);
	$date = date("Y-m-d");
	$valor = 0;
	
	if (empty($email) OR empty($username) OR empty($password) OR empty($password_conf))
	{
		
		echo "<p align=\"center\"><img src=\"./media/imagens/i_false.png\" class=\"decorationone\"><br>Todos os campos devem ser preenchidos!</p>";

	}
	else
	{
	$buscar_conf = mysql_query ("SELECT email FROM users WHERE email = '$email'");
	while ($buscar_conf_2 = mysql_fetch_array($buscar_conf))
	{
		$valor++;	
	}
	

	
	if ($valor == 0)
	{
		if ($password == $password_conf)
		{
			echo "<p align=\"center\"><img src=\"./media/imagens/i_true.png\" class=\"decorationone\"><br>Palavra-Passe Confirmada!<br>";
			
			mysql_query("INSERT INTO users (email,password,username,type,template,active,date) VALUES ('$email','$password','$username','6','1','1','$date')");

            send_mail_to($username,$email,"Dados de conta","<p>Obrigado por te teres registado na nossa comunidade, esperamos que gostes da tua estadia por cá.<br>Aqui estão os dados da tua conta:</p><p><b>Palavra-Passe:</b> ".$_POST['password']."<br>* Para fazer login é necessário endereço de e-mail e a palavra-passe indicada.</p><p>Já podes fazer login!");

            echo "<meta http-equiv=\"REFRESH\" content=\"12;url=./\">
			Registo efectuado com sucesso!<br>
			Foi enviado um mensagem de e-mail para o endereço que indicaste com os dados da tua conta.<br>
			Caso não encontres o e-mail, verifica a tua caixa de Spam.</p>";
		}
		else if ($password != $password_conf)
		{
			echo "<p align=\"center\"><img src=\"./media/imagens/i_false.png\" class=\"decorationone\"><br>Erro! Palavra-Passse não confirmada!</p>";
		}
	}
	else if ($valor > 0)
	{
		echo "<p align=\"center\"><img src=\"./media/imagens/i_false.png\" class=\"decorationone\"><br>Já existe uma conta com esse endereço de email!<br>Se acha que esta informação, está errada, contacte a administração!</p>";
	}
	}
}



?>
