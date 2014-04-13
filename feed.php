<?php include('config.php') ?>
<rss version="2.0">
<channel>
<title>NexuSystem feed</title>
<language>pt-pt</language>
<link>http://www.NexuSystem.com/</link>
<description>Últimas Noticias</description>

<?php 
$query = "SELECT * FROM content ORDER BY id ASC";
$data_source = mysql_query($query);
while($data = mysql_fetch_array($data_source))
{
echo '<item>
<title>'.$data['nome'].'</title>
<link>http://www.nexusystem.com/index.php?page=noticia&amp;noti='.$data['id'].'</link>
<description>'.$data['description'].'</description>
</item>
';
}

?>

</channel>
</rss>
