<div id="lm-header">
	Caixa de Entrada
	<div id="lm-header-2"><a style="color: #FFF;" href="?page=mp&par=sai">Caixa de Saida »</a></div>
</div>
<div id="lm-titles">
	<div style="margin-left: 8px; width: 50px; float: left; text-align: left;">Nº</div>
	<div style="width:220px; float: left; text-align: center;">De</div>
	<div style="width: 240px; float: left; text-align: center;">Assunto</div>
	<div style="width: 150px; float: left; text-align: center;">Data</div>
	<div style="width: 170px; float: left; text-align: center;">Acções</div>
</div>
<?php
	
	$query = mysql_query("SELECT * FROM private_messages WHERE recep_id = '$conta[0]' AND recep = '1' ORDER BY id DESC");
	
	$position = 0;
	while($data = mysql_fetch_array($query))
	{
		$nome = mysql_query ("SELECT username FROM users WHERE id = '$data[sender_id]'");
		$nome_2 = mysql_fetch_array($nome);

		$position++;
        echo "
			<div id=\"lm-data\" onClick=\"goTo('?page=mp&par=view&msg=".$data['id']."')\" style=\"line-height: 25px; padding-top: 1px; padding-bottom: 1px; cursor: pointer;\">
				<div style=\"margin-left: 8px; width: 50px; float: left; text-align: left;\">".$position."</div>
				<div style=\"width:220px; float: left;\">".$nome_2['username']."</div>
				<div style=\"width: 240px; float: left;\">".$data['subject']."</div>
				<div style=\"width: 150px; float: left; text-align: center;\">".$data['date']."</div>
				<div style=\"width: 170px; float: left; text-align: center;\">";
			if ($data['state'] == 1)
			{echo "<img src='./images/b-unread.png' width='25' title=\"Mensagem por ler\">";}
			elseif($data['state'] == 0)
			{echo "<img src='./images/b-read.png' width='25' title=\"Mensagem lida\">";}

			if ($data['state'] == 0)
			{echo "<a href='index.php?page=mp&par=del_r&msg=".$data['id']."'>
						<img src='./images/fire.png' width='25' title=\"Apagar\">
					</a>";}
		echo "		
				</div>
			</div>";
	}
	if ($position == 0){echo "<div id=\"lm-data\" style=\"text-align: center;\">Não têm mensagens</div>";}
?>
<div id="lm-footer"></div>