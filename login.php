<style type="text/css">
  div#logindiv {
  	width: 300px;
  	margin-left: auto;
  	margin-right: auto;
  	text-align: center;
  	margin-top: 20px;
  	margin-bottom: 20px;
  }
  
  div#logindiv input {
  	border: 1px solid orange;
  	border-radius: 4px;
  	text-align: center;
  	width: 280px;
  }
  
  div#logindiv select {
  	boder: 1px solid orange;
  	border-radius: 4px;
  	text-align: center;
  	width: 280px;
  }
</style>
<?php

if (!isset($_POST["validar"]))
{ 
?>
	<form method="post" action="?page=login">
		<div id="logindiv">
			Endereço de E-mail:<br />
			<input type="text" size="40" name="email" />
		</div>
		<div id="logindiv">
			Palavra-Passe:<br />
			<input type="password" size="40" name="password" />
		</div>
		<div id="logindiv">
			Tempo de Sessão:<br>
			<select name="login_time">
				<option value="1800">30 min</option>
				<option value="3600">1 hora</option>
				<option value="43200">12 horas</option>
				<option value="86400">1 dia</option>
				<option value="604800">1 semana</option>
			</select>
		</div>
		<div id="logindiv">
			<button class="site" type="submit" name="validar">Validar</button> <button class="site" type="button" name="recover" onclick='javascript:window.location="?page=recover"'>Recuperar Palavra-Passe</button> <button class="site" type="button" name="register" onclick='javascript:window.location="?page=register"'>Registar</button>
		</div>
	</form>
<?php
}
elseif(isset($_POST["validar"]))
{
	echo $conta["login"];
}
