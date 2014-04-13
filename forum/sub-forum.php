<?php
	$forum = intval($_GET['forum']);
	$nome = mysql_fetch_array(mysql_query("SELECT name FROM forum_sub_forum WHERE id = ".$forum));
		echo "<div class=\"forumcateory\">
				<div class=\"title\">".$nome["name"]."</div>
                <div class=\"forumcategorynames\">
                	<div class=\"forumcategoryname\">Nome</div>
                    <div class=\"forumcategorytopic\">Respostas</div>
                    <div class=\"forumcategorypost\">De</div>
                </div>";
			
	$sub_forum = mysql_query("SELECT * FROM `forum_posts` WHERE `sf_id_ass` ='$forum' AND `position` = 1 ORDER BY edited DESC LIMIT 30");

	$position = 0;

	while ($row = mysql_fetch_array($sub_forum))
	{

		$position++;
		
		$query = "SELECT user_id_ass FROM forum_posts WHERE post_ass = '".$row['id']."' AND position = '2'";
		$data_source = mysql_query($query);
		$countposts = 0;
		while($data = mysql_fetch_array($data_source)){$countposts++; $writer = $data["user_id_ass"];}
		if (isset($writer) && !empty($writer)) {$writer = return_username($writer);} else {$writer = "--";}
		  echo "<div class=\"forumcategorynamesentry\" onclick=\"goTo('?page=topic&id=".$row['id']."')\">
                	<div class=\"forumsubforumname\">".$row['name']."</div>
                    <div class=\"forumsubforumtopic\">".$countposts."</div>
                    <div class=\"forumsubforumpost\">".$writer."</div>
                </div>";
		unset($writer);
	}

	if ($position == 0){echo "<div style=\"text-align: center;\" class=\"forumcategorynamesentry\">Não existem tópicos</div>";}
	echo "</div>";
	//echo "<hr color='#CCCCCC'>";
	echo "<p align='center'><button class=\"edit\" onclick=\"goTo('?page=create-topic&sf=".$forum."')\">Criar Tópico</button></p>";
		
	

?>
