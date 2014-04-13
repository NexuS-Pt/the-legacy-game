<div id="lm-header">
	Caixa de Saida
	<div id="lm-header-2"><a style="color: #FFF;" href="?page=mp&par=ent">« Caixa de Entrada</a></div>
</div>
<div id="lm-titles">
	<div style="margin-left: 8px; width: 550px; float: left; text-align: left;">Nome</div>
	<div style="width: 150px; float: left; text-align: center;">Posição</div>
	<div style="width: 150px; float: left; text-align: center;">Estado</div>
</div>
<?php
	
	$query = mysql_query("SELECT * FROM private_messages WHERE sender_id = '".$conta[0]."' AND sender = '1' ORDER BY id DESC");
	
	$position = 0;
	while($data = mysql_fetch_array($query))
	{
		$nome = mysql_query ("SELECT username FROM users WHERE id = '$data[recep_id]'");
		$nome_2 = mysql_fetch_array($nome);

		$position++;

		echo "
			<div id=\"lm-data\" onClick=\"goTo('?page=mp&par=view&msg=".$data['id']."')\" style=\"line-height: 25px; padding-top: 1px; padding-bottom: 1px; cursor: pointer;\">
				<div style=\"margin-left: 8px; width: 50px; float: left; text-align: left;\">".$position."</div>
				<div style=\"width:220px; float: left;\">".$nome_2['username']."</div>
				<div style=\"width: 240px; float: left;\">".$data['subject']."</div>
				<div style=\"width: 150px; float: left; text-align: center;\">".$data['date']."</div>
				<div style=\"width: 170px; float: left; text-align: center;\">
					<a href='index.php?page=mp&par=del_s&msg=".$data['id']."'>
						<img src='./images/fire.png' width='25' alt='Apagar' title=\"Apagar\">
					</a>
				</div>
			</div>";
	}
	if ($position == 0){echo "<div id=\"lm-data\" style=\"text-align: center;\">Não têm mensagens</div>";}
?>
<div id="lm-footer"></div>