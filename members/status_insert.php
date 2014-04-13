<form method="post" name="status_insert">
<?php
	//SE CLICADO EXECUTA	
	if (isset($_POST['guardar']))
	{
		//ID DO PERFIL	
		$profile = intval($_GET['id']);
		//TEXTO DO ESTADO
		$message = str_replace($blocked_words, $blocked_words_replace, $_POST["status_value"]);
		if (empty($message)){echo "
		<div class=\"red-warning\" style=\"line-height: 45px;\">Não pode inserir mensagem em branco!</div>";}
		else
		{
			mysql_query("INSERT INTO status (user_id_ass,profile_id,text) VALUES ('$conta[0]','$profile','$message')");
			echo "
				<div class=\"green-warning\" style=\"line-height: 45px;\">Inserido com Sucesso!</div>";
		}
	}
?>
<?php
	if ($id == $conta[0]){echo"Diz o que pensas:<br>";}else{echo "Diz a ".$data["username"]." o que pensas:";}
?>
<br>
<input type="text" name="status_value" size="40" maxlength="160"><br>
<input type="submit" class="site" value="Guardar" name="guardar">
</form>
