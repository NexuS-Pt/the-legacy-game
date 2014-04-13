 
<?php
if (isset($_POST['send']))
{
	$query = "SELECT username FROM users WHERE email = '".$_POST['email']."'";
	$source = mysql_query($query);
	$nr_rows = mysql_num_rows($source);
	$data = mysql_fetch_array($source);

	if ($nr_rows != 1)
	{echo "<p align=\"center\"><img src=\"./media/imagens/i_false.png\" class=\"decorationone\"><br>Endereço de e-mail indicado não associado a nenhuma conta, confirme o que indicou.</p>";}
	elseif ($nr_rows == 1)
	{
		$new_password = rand(0,9).rand(0,9).rand(0,9).rand(0,9);
		$new_password_coded = md5($new_password);
		$source = "UPDATE users SET password = '".$new_password_coded."' WHERE email = '".$_POST['email']."'";
		if (mysql_query($source))
		{
			if (send_mail_to($data["username"],$_POST['email'],"Recuperação de Palavra-passe","<p>Foi efectuado o pedido de recuperação de palavra-passe da tua conta.<br>A nova palavra-passe da tua conta é:</p><h2 align=\"center\">".$new_password."</h2><p>Já podes fazer login com esta palavra-passe.</p>"))
			{
				echo "<p align=\"center\"><img src=\"./media/imagens/i_true.png\" class=\"decorationone\"><br>Foi enviado um mensagem de e-mail para o endereço que indicaste com os dados da tua conta.<br>
			Caso não encontres o e-mail verifica a tua caixa de Spam.</p>";			
			}
		}
	}
}
else
{
echo "
	<form method=\"post\">
	<p align=\"center\">
		Indique o endereço de e-mail referente a sua conta:<br>
		<input type=\"text\" name=\"email\" size=\"40\">
        </p>
        <p align=\"center\">
		<button type=\"site\" name=\"send\" class=\"site\">Recuperar</button>
	</p>
	</form>
";
}

?>
