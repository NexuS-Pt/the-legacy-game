<?php
$query = "SELECT * FROM content ORDER BY id ASC";
$source = mysql_query($query);

echo "<table width=\"99%\"><tr><th class=\"game\" width=\"50px\">ID</th><th class=\"game\">Nome</th><th class=\"game\">Operações</th></tr>";

while ($row = mysql_fetch_array($source))
{
 printf("<tr class=\"%s\"><td>%s</td><td>%s</td><td align=\"center\">%s %s %s</td></tr>",
	"row-a",
	$row["id"],
	$row["nome"],
	"<button class=\"site\" onclick='javascript:window.location=\"./index.php?page=noticia&noti=".$row["id"]."\"'>Ver</button>",
	"<button class=\"site\">Editar</button>",
	"<button class=\"site\">Eliminar</button>");

}
echo "</table>";
?>
