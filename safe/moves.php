<?php
$coin[0] = "Participou numa aplicação";//PARTICIPAÇÃO NUMA APLICAÇÃO
$coin[1] = "Entrada de moedas na sua conta";//ENTRADA DE MOEDAS
$coin[2] = "Saida de moedas da sua conta";//SAIDA DE MOEDAS
$coin[3] = "Transferência de moedas";//TRANSFERENCIA DE MOEDAS

echo "<p>É apenas possivel apresentar os últimos 20 movimentos!<br>Entradas como saidas.</p>";

$query = "SELECT * FROM coins WHERE user_id_ass = '".$conta[0]."' ORDER BY id DESC LIMIT 20";
$data_source = mysql_query($query);
while($data = mysql_fetch_array($data_source))
{
    echo "<code><p align=justify>";
    echo "<b>".$coin[$data["type"]]."</b><br>";
    echo "<b>Quantidade</b>: ".$data["quant"]." Mo<br>";
    echo "<b>Descrição</b>: ".$data["why"]."<br>";
    echo "<b>Data</b>: ".$data["date"]."<br>";
    echo "<b>ORDER ID</b>:".$data["orderid"];
    echo "</p></code>";
}	

?>
