<?php

$id = intval($_GET["id"]);
$sf = intval($_GET["sf"]);

$query = "SELECT * FROM forum_posts WHERE id = '$id'";
$source = mysql_query($query);
$data = mysql_fetch_array($source);

if ($data["user_id_ass"] == $conta[0] || $conta["previlegios"] <= 2)
{
    if(!isset($_POST["button"]))
    {
        echo "<form method='post'>
            <p>Assunto: <input type='text' name='subject' value='".$data['name']."' size=50 disabled=\"disabled\"></p>";
        return_editor($conta["previlegios"],$data["text"]);
        echo "<p align=center><button type='submit' name='button' class='site'><img src=\"./images/b-accept.png\" width=\"12px\"> Guardar</button></p>";
        echo "</form>";
    }
    else
    {
	$message = str_replace($blocked_words, $blocked_words_replace, $_POST["editor"]);
        $query = "UPDATE forum_posts SET text = '".$message."' WHERE id = '".$id."' AND sf_id_ass = '".$sf."'";
        mysql_query($query);
        echo "<p align=center>Tópico alterado com sucesso!<br><a href='index.php?page=sub-forum&forum=".$sf."'>Voltar</a></p>";
    }
}
else
{
    return_error();
}
?>
