<?php
	// Alteração da descrição da equipa
	print("<code><h3>Alterar Descrição</h3>
		<p>".$data["description"]."</p></code>");

	// Membros da equipa de combate
	print("<code><h3>Equipa de Combate</h3>
		<p>".$data["description"]."</p></code>");

	// Membros de Equipa
	print("<code><h3>Membros de Equipa</h3>
		<h4>Númear novo chefe</h4>
		<p>* Esta opção não poderá ser cancelada, esta fará com que outro jogador da Equipa passe a ter os teus poderes, e só essa pessoa te poderá os devolver utilizando o mesmo processo</p>");
	if (count($aux["members"]) > 1)
	{
		if (!isset($_POST["003-save"]))
		{
			echo "<form method=\"post\">
				<p>Seleccione novo Chefe:<br>
				<select name=\"char\">
					<option value=\"null\">Selecciona um jogador</option>";
					for ($i = 0; $i < count($aux["members"]);$i++)
					{
						if ($aux["members"][$i] != $conta["game"]["id"])
						{echo "<option value=\"".$aux["members"][$i]."\">(".($i + 1).") ".return_charname($aux["members"][$i])."</option>";}
					}
				echo "</select>
				<button type=\"submit\" name=\"003-save\">Guardar</button>
				</form>";
		}
		else
		{
			if ($_POST["char"] == null) {echo "Para esta opção tens de escolher um jogador.";}
			else{
				$query = "UPDATE g_team SET owner_id_ass = '".$_POST["char"]."' WHERE id = '".$data["id"]."'";
				if (mysql_query($query) && $data["owner_id_ass"] == $conta["game"]["id"])
				{echo "<p style=\"boder: 1px solid green;background: green-light;width: 95%;\">Operação efectuada com Sucesso!</p>";}
				else {echo "<p style=\"boder: 1px solid red;background: red-light;width: 95%;\">Operação não efectuada!</p>";}
			}
		}
	}
	else{print("<p>Necessita de ter mais um jogador na equipa, para que esta opção seja desbloqueada.</p>");}

	print("</code>");
?>
