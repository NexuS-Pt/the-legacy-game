<?php
$query = "SELECT id FROM app_data WHERE data_2 = '$conta[0]' AND app = 'redl'";
$redl_source = mysql_query($query);
$count = 0;
while($redl_data = mysql_fetch_array($redl_source)){$count++;};

if ($count!=0)
{
	echo "<p>Já te encontras Registado! ";
	$query2 = "SELECT id FROM app_data WHERE app = 'redl'";
	$nr = mysql_num_rows(mysql_query($query2));
	echo " Assim como mais ".($nr-1)." membros.</p>";
}
elseif (isset($_POST['redl']))
{
    if(empty($_POST["redl"])) {echo "<p>O campo do username deverá ser preenchido!</p>";}
    else{
        $redl_u = $_POST['username'];
        $app = 'redl';

        mysql_query("INSERT INTO app_data (data_1,data_2,app) VALUES('$redl_u','$conta[0]','$app')");
        echo "<p>Sucesso! O seu username foi inserido!</p>";
        }
}else{
echo "<p>És utilizador na Redline?</p>
<form method='post'>
<p>Username RedLine:<br> <input type='text' name='username'> <input type='submit' name='redl'  class='button'></p>";
}

?>
