<?php

$query = "SELECT
`coins_order`.`id`,
`users`.`id` AS 'user_id',
`users`.`username`,
`coins_order`.`orderid`,
`coins_order`.`active`
FROM ((`coins_order` join `users` on((`coins_order`.`user_id_ass` = `users`.`id`))))
WHERE `coins_order`.`active` = 0";

$result = mysql_query($query);

echo "<table width='100%' align='center'>
    <tr>
        <th class=\"game\">ID</th>
        <th class=\"game\">Utilizador</th>
        <th class=\"game\">ORDER ID</th>
        <th class=\"game\"> </th>
    </tr>";

$position = 0;

while ($row = mysql_fetch_array($result))
{
	$position++;
    echo "<tr class=\"row-b\">";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['username']."</td>";
    echo "<td>".$row['orderid']."</td>";
    echo "<td width=\"100px\"><button class=\"button-green\" onclick=\"goTo('index.php?page=order-control&do=accept-order&id=".$row['id']."')\">Executar</button></td>";
    echo "</tr>";
}
if ($position == 0){echo "<tr class=\"row-a\"><td colspan=\"4\" align=\"center\">Não têm Registos de ORDERs ID</td></tr>";}
echo "</table>";

?>
