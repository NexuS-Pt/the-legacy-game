<!-- Lista de todas as mensagens do forum
*identificando cada mensagem como tópico ou resposta -->
<?php
if (isset($_GET["delid"]) && !empty($_GET["delid"]))
{
	$query = "DELETE FROM forum_posts WHERE id = '".$_GET["delid"]."'";
	if (mysql_query($query))
	{echo "<code class=\"sucess\">Mensagem de Forum Eliminada com Sucesso!</code>";}
	else
	{echo "<code class=\"failure\">Ocorreu um erro ao Eliminar a Mensagem de Forum!</code>";}
}
else
{
	$query = "SELECT * FROM forum_posts WHERE publish = 0 ORDER BY id DESC";
	$source = mysql_query($query);

	echo "<table width=\"100%\">
		<tr>
		 <th class=\"game\" width=\"40px\">ID</th>
		 <th class=\"game\">Nome</th>
		 <th class=\"game\">Utilizador</th>
		 <th class=\"game\">Tipo</th>
		</tr>";
	$count = 1;
	while ($row = mysql_fetch_array($source))
	{
		if ($row["position"] == 1) {$position = "T";} else {$position = "R";}
		$username = return_username($row["user_id_ass"]);
		printf("<tr class=\"row-a\">
		        <td>[%s] %s</td>
		        <td>%s</td>
		        <td>%s</td>
		        <td>
		            <button class='site'>%s</button> >> <button class='site' onclick='confirmation(\"Tem a certeza que pretende Editar?\",\"./index.php?page=post-editor&sf=%s&id=%s\")'>E</button> <button class='site' onclick='confirmation(\"Tem a certeza que pretende Eliminar?\",\"./?page=admin-topic-and-posts&delid=%s\")'>D</button>
		        </td>
		        </tr>",$count,$row["id"],$row["name"],$username,$position,$row["sf_id_ass"],$row["id"],$row["id"]);$count++;
	}
	echo"</table>";
}
?>

