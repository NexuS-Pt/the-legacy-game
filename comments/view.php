<h3>Comentários</h3>
<?php
// GRAVAR COMENTÁRIO
	if(isset($_POST['publicar']))
{
    if(empty($_POST['editor']))
    {echo "<p>Não pode inserir comentários vazios</p>";}
    else
    {
		$message = str_replace($blocked_words, "**ERRO!**", $_POST["editor"]);
        $query = "INSERT INTO comments (writer,text,content_id) VALUES('".$conta[0]."','".$message."','".$_GET['noti']."')";
        mysql_query($query);
    }
}

// APRESENTAÇÃO DE COMENTÁRIOS
$content_id = $_GET['noti'];

$query = "SELECT * FROM comments WHERE content_id = '".$content_id."' ORDER BY id DESC LIMIT 20";
$comment_source = mysql_query($query);

$count = 0;
while ($comment = mysql_fetch_array($comment_source))
{
	$query_2 = "SELECT username FROM users WHERE id = '".$comment['writer']."'";
	$username_source = mysql_query($query_2);
	$username = mysql_fetch_array($username_source);
	
	echo "<div class=\"forumotherpost\">";
	echo "<div class=\"topictreplytitle\"><span style=\"padding-left: 4px; color:#000000;\">R:</span> ... <span style=\"color:#000000; font-size: 12px;\">ecrito por ".$username['username']."</span></div>";
	echo "<div class=\"post\">".$comment['text']."</div>";
	echo "</div>";
}

// FORMULARIO PARA NOVOS COMENTÁRIOS
if (isset($_COOKIE[$cookie]))
{
    include("./comments/write.php");
}
else
{
    echo "<hr>";
    include("login.php");
}
?>
