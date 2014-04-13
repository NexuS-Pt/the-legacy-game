<?php
$query = "SELECT id FROM app_data WHERE data_2 = '$conta[0]' AND app = 'tl'";
$tl_source = mysql_query($query);
$count = 0;
while($tl_data = mysql_fetch_array($tl_source)){$count++;};

if ($count!=0){echo "<p>Já te encontras Registado!</p>";}
elseif (isset($_POST['tl']))
{
    if(empty($_POST["tl"])) {echo "<p>O campo do username deverá ser preenchido!</p>";}
    else{
        $tl_u = $_POST['username'];
        $app = 'TL';

        mysql_query("INSERT INTO app_data (data_1,data_2,app) VALUES('$tl_u','$conta[0]','$app')");
        echo "<p>Sucesso! O seu username foi inserido!</p>";
        }
}else{
echo "<p>És utilizador na TugasLeech?</p>
<form method='post'>
<p>Username TL:<br> <input type='text' name='username'> <input type='submit' name='tl'  class='button'></p>";
}


?>
