<?php
if(!isset($_POST['button'])) {

			echo "
				<form method='post'>
					<p>Assunto: <input type='text' name='subject' size='50'></p>";
			return_editor($conta["previlegios"],"");
			echo "
					<p align=center><button type='submit' name='button' class='site'><img src=\"./images/b-accept.png\" width=\"12px\"> Guardar</button></p>
				</form>";
				
				
}elseif(isset($_POST['button'])) {
				
			if(empty($_POST['editor']) || empty($_POST['subject']))
			{
				echo "<p>Todos os campos devem ser preenchidos!</p>";
			}
			else
			{
				$sf 	    = intval($_GET['sf']);
				$name       = $_POST['subject'];
				$id 	    = intval($conta[0]);
				$message = str_replace($blocked_words, $blocked_words_replace, $_POST["editor"]);
				
				$query = "INSERT INTO forum_posts (name,sf_id_ass,user_id_ass,text,position,post_ass,date,edited)
					VALUES ('".$name."','".$sf."','".$id."','".$message."',1,1,'".time()."','".time()."')";
				
				mysql_query($query);
				
				Echo "<p align='center'>Tópico criado com sucesso!</p><p align='center'><button  class=\"site\" onclick='javascript:window.location=\"index.php?page=sub-forum&forum=".$sf."\"'><img src=\"./images/b-home.png\" width=\"12px\"> Voltar</button></p>";
			}
}
?>
