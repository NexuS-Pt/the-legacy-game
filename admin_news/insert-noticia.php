<?php


if (isset($_POST["submit"])){
	$query = "INSERT INTO content (nome,description,content,writer) VALUES ('".$_POST['title']."','".$_POST['description']."','".$_POST['editor']."','".$conta[2]."')";
	if(mysql_query($query)){echo "<p align='center'><img src='./media/imagens/i_true.png' class='decorationone'><br>Artigo adicionado com sucesso!</p>";}else{echo "<p align='center'><img src='./media/imagens/i_false.png' class='decorationone'><br>ERRO! Por algum motivo a acção foi comprometida, tente mais tarde!</p>";}
}else{
	$editordataprint = "<p></p>";
	echo "<form method=post>
		<p>Titulo:<br><input type=text name=title size=50></p>
		<p>Descrição:<br><input type=text name=description size=50></p>";
	include("editor/".$conta['previlegios'].".php");
	echo "<p align=center><input type=submit name=submit value=Salvar></p>
		</form>";

}

include ("./admin_news/list-noticia.php");
?>
