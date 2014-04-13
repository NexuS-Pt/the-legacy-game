<blockquote>
<?php

	$data_source = mysql_query("SELECT * FROM status WHERE profile_id = '".$id."' ORDER BY id DESC");
	$count = 0;
	while($data = mysql_fetch_array($data_source) AND $count < 10)
	{	
		$count++;
		if(!empty($data['text']))
		/*{}
		else*/
		{
			echo "<p style=\"border-bottom: 1px solid #CCC;\">Escrito por: <b>".return_username($data['user_id_ass'])."</b>";
			echo "<br>&nbsp;&nbsp;&nbsp;".$data['text']."<br></p>";
		}
		

	}

?>
</blockquote>