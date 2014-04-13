<style type="text/css">
	div#profile-title {
		background: url(templates/jpeg.jpg);
		font-size: 22pt;
		color: #FFF;
		padding-left: 5px;
		border: 1px solid #000;
		border-radius: 5px 5px 0 0;
	}
	
	div#profile-footer {
		background: url(templates/topbanner.jpg);
		border-left: 1px solid #F60;
		border-right: 1px solid #F60;
		padding: 3px;
		text-align: center;
		margin-bottom: 5px;
		border-radius: 0 0 5px 5px;
	}
</style>
<?php
	
	if (isset($_POST["submit"]))
	{
		$avatar		= $_POST['avatar'];
		$username 	= name_checker($_POST['name']);
		$dia		= $_POST['dia'];
		$mes		= $_POST['mes'];
		$ano		= $_POST['ano'];
		$message 	= str_replace($blocked_words, $blocked_words_replace, $_POST["editor"]); // SOBRE MIM
		
		$query 		= "UPDATE users 
                SET avatar = '".$avatar."', 
                username = '".$username."', 
                dia = '".$dia."', 
                mes = '".$mes."', 
                ano = '".$ano."', 
                sobremim = '".$message."' 
                    WHERE id = '".$conta[0]."'";

		if (mysql_query($query))
		{echo "<div class=\"green-warning\" style=\"line-height: 45px;\">Os seus dados foram actualizados com sucesso!</div>";}
		else
		{echo "<div class=\"red-warning\" style=\"line-height: 45px;\">ERRO! Houve um problema!</div>";}
	}
	
	
	//receber informação de dados da conta
	$buscar_info 	= mysql_query("SELECT * FROM users WHERE id = '".$conta[0]."'");
	$buscar_info_2 	= mysql_fetch_array($buscar_info);

	if (empty($buscar_info_2['avatar']))
	{
		$avatar = "./images/no_avatar_m.jpg";
	}
	else
	{
		$avatar = $buscar_info_2['avatar'];
	}
?>
<form method="post">
<div id="profile-title">
	Avatar
</div>
<div style="background: url(templates/topbanner.jpg); border-left: 1px solid #F60; border-right: 1px solid #F60; padding: 3px; text-align: center;">
	Coloque o link aqui <input type="text" name="avatar" size="50" style="width: 700px; text-align:center;" value="<?php echo $avatar; ?>">
</div>
<div id="profile-footer">
	<img src="<?php echo $avatar; ?>" style="width: 120px; height: 120px; border: 1px solid #FFF;">
</div>
<div id="profile-title">
	Nome
</div>
<div id="profile-footer">
	<input readonly="readonly" type="text" name="name" size="50" style="width: 700px; text-align:center;"value="<?php echo $buscar_info_2['username']; ?>">
</div>
<div id="profile-title">
	Data de Nascimento
</div>
<div id="profile-footer">
	Dia: <input type="text" name="dia" size="2" value="<?php echo $buscar_info_2['dia']; ?>"> Mês: 
    <input type="text" name="mes" size="2" value="<?php echo $buscar_info_2['mes']; ?>"> Ano: 
    <input type="text" name="ano" size="4" value="<?php echo $buscar_info_2['ano']; ?>">
</div>
<div id="profile-title">
	Endereço de Mail
</div>
<div id="profile-footer">
	<input readonly="readonly" type="text" name="email" size="50" style="width: 700px; text-align:center;"value="<?php echo $buscar_info_2['email']; ?>">
</div>
<div id="profile-title">
	Sobre Mim
</div>
<div style="border-left: 1px solid #F60; border-right: 1px solid #F60; padding: 3px; text-align: center;">
	<?php return_editor($conta['previlegios'],str_replace($blocked_words, $blocked_words_replace, $buscar_info_2['sobremim'])); ?>
</div>
<div id="profile-footer">
	<button class="site" type="submit" name="submit"/><img src="./images/b-accept.png" width="12px"> Guardar</button>
</div>
</form>


