<?php

if (!isset($_POST["save"]))
{
    echo "
    <form method='post'>
    <p align=\"center\">Palavra-Passe Actual<br>
    <input type='password' name='old_password' size='50' maxlength='20'></p>
    <p align=\"center\">Nova Palavra-Passe<br>
    <input type='password' name='new_password' size='50' maxlength='20'></p>
    <p align=\"center\">Confirmar Palavra-Passe Actual<br>
    <input type='password' name='conf_password' size='50' maxlength='20'></p>
    <p align=\"center\"><button type='submit' name='save' class='site'><img src=\"./images/b-accept.png\" width=\"12px\"> Guardar</button></p>
    </form>
";
    
}else{
    
	$old_password	= $_POST['old_password'];
	$new_password   = $_POST['new_password'];
	$conf_password  = $_POST['conf_password'];
	
	if (empty($old_password) || empty($new_password) || empty($conf_password))
	{echo "
		<div id=\"rlg-out\">
			<div id=\"rlg-time\" style=\"font-size: 15pt; color: #FFF;\">Todos os campos devem ser preenchidos!</div>
			<div id=\"rlg-warning\">Sistema de Site</div>
		</div>";}
    	elseif (MD5($old_password) != $conta[1])
	{ echo "
		<div id=\"rlg-out\">
			<div id=\"rlg-time\" style=\"font-size: 15pt; color: #FFF;\">A palavra-passe actual está incorrecta!</div>
			<div id=\"rlg-warning\">Sistema de Site</div>
		</div>"; }
    	elseif ($new_password != $conf_password)
	{echo "
		<div id=\"rlg-out\">
			<div id=\"rlg-time\" style=\"font-size: 15pt; color: #FFF;\">A confirmação de palavra-passe falhou!</div>
			<div id=\"rlg-warning\">Sistema de Site</div>
		</div>"; }
    	else
	{
		$password = MD5($new_password);
    		$query = "UPDATE users SET password = '$password' WHERE id = '".$conta[0]."'";
		mysql_query($query);
	
		echo "
			<div id=\"rlg-out\">
				<div id=\"rlg-time\" style=\"font-size: 15pt; color: #FFF;\">A sua palavra-passe foi actualizada!</div>
				<div id=\"rlg-warning\">Sistema de Site</div>
			</div>";
	}
}
?>
