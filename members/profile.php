
<?php
//$result

	$id = intval($_GET['id']);

	$data_source = mysql_query("SELECT * FROM users WHERE id = '$id'");
	$data = mysql_fetch_array($data_source);

	if (empty($data['avatar']))
	{$avatar = "./images/no_avatar_m.jpg";}
	else
	{$avatar = $data['avatar'];}
		
	$array = code_nexar($data["username"]);
	
	echo "
		<div style=\"background: url(templates/jpeg.jpg); font-size: 22pt; color: #FFF; border-radius: 5px 5px 0 0; padding-left: 5px; padding-right: 5px; border: 1px solid #000;\">
			".$data["username"]."
			<div style=\"float: right; margin-right: 5px; margin-top: 5px; font-size: 11pt; cursor: pointer;\" onClick=\"goTo('./index.php?page=mp&par=esc&to=".$data["id"]."')\">Enviar PM</div>
		</div>
		<div style=\"background: #333; display: inline-block; width: 860px; color: #FFF;\">
			<div style=\"width: 120px; height: 120px; margin: 5px; float: left;\">
				<img src=\"".$avatar."\" style=\"width: 120px; height: 120px;\">
			</div>
			<div style=\"width:730px; float: left;\">
				<div style=\"margin-bottom: 5px;\">
					<b>Aniversário</b> <br>
					".$data['dia']." - ".$data['mes']."
				</div>
				<div style=\"margin-bottom: 5px;\">
					<b>Nome em Nexar</b> <br>
					<div style=\"background: #FFF; padding: 5px; display: inline-block; border-radius: 5px;\">";
						code_nexar_printer($array);
	echo "
					</div>
				</div>
				<div style=\"margin-bottom: 5px;\">
					<b>Sobre Mim</b> <br>
					".$data['sobremim']."
				</div>
			</div>
		</div>
		<div style=\"background: url(templates/topbanner.jpg); padding: 5px; color: #FFF; border: 1px solid #F60; border-radius: 0 0 5px 5px;\">
			<b>Estados</b> <br>";
			include("./members/count_status.php");
	echo "
		</div>
		<br/>";
		
	echo "
		<div style=\"border: 1px solid #CCC; border-radius: 5px 5px 0 0; padding: 5px;\">";
			include("./members/status_insert.php");
	echo "
		</div>";
		
	echo "
		<div style=\"border: 1px solid #CCC; border-top: none; border-radius: 0 0 5px 5px; padding: 5px;\">";
			include("./members/status_list.php");
	echo "
		</div>";
?>