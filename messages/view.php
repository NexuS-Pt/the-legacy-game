<?php

	$msg = intval($_GET['msg']);
	
	$query = "SELECT * FROM private_messages WHERE id = '".$msg."'";
	$source =mysql_query($query);
	$data = mysql_fetch_array($source);
	
	if ($conta[0] == $data['sender_id'] || $conta[0] == $data['recep_id'])
	{
	echo "<div class=\"post\"><p><b>Assunto:</b> ".$data['subject']."</p>";
	echo "<p><b>Mensagem:</b><br>".$data['text']."</p></div>";
	}else{
		echo "<p>Não tem previlégios para ver esta mensagem!</p>";
	}
	
	if ($data['recep_id'] == $conta[0])
	{
        $query_2 ="SELECT username FROM users WHERE id = '".$data['sender_id']."'";
        $source_2 = mysql_query($query_2);
        $data_2 = mysql_fetch_array($source_2);
	
	$w = "RE: ".$data['subject'];


echo "
	<form action='index.php?page=mp&par=send' method='post'></p>
<p>
	Para: <input type='text' disabled='disabled' value='".$data_2['username']."'>
	Assunto: <input type='text' name='subject' value='".$w."' />


	<input type='hidden' value='".$data['sender_id']."' name='to' /></p>
";
		if (!mysql_query("UPDATE private_messages SET state = 0 WHERE id = ".$msg)){echo "<span style=\"color:red;\">Erro a Ler!</span>";}

        $buscar_info_2['sobremim'] = "";
		include("./editor/".$conta['previlegios'].".php");		
	
echo "
<p align='center'><input type='submit' value='Enviar' /></p>";

}

?>
