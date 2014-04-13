<?php

	if(!isset($_POST['button'])) {
		
		$sf = intval($_GET['sf']);
  		$p  = intval($_GET['p']);	
		
		$data_source = mysql_query("SELECT name FROM forum_posts WHERE id = '".$p."'");
		$data = mysql_fetch_array($data_source);
		
		$buscar_info_2['editor'] = "<p> </p>";
			echo "
				<form method='post'>
					<p>Assunto: <input type='text' name='subject' value='".$data['name']."' size=50></p>";
			include("editor/".$conta['previlegios'].".php");
			echo "<p align=center><button type='submit' name='button' class='site'><img src=\"./images/b-accept.png\" width=\"12px\"> Guardar</button></p>
				</form>";
				
        }
        elseif(isset($_POST['button']))
        {

            if(empty($_POST['editor']) || empty($_POST['subject']))
            {
                    echo "<p>Todos os campos devem ser preenchidos!</p>";
            }
            else
            {
                $sf 	= intval($_GET['sf']);
                $p  	= intval($_GET['p']);
                $name   = $_POST['subject']; 			
                $id 	= intval($conta[0]);
		$message = str_replace($blocked_words, $blocked_words_replace, $_POST["editor"]);
                $text   = $_POST['editor'];

                $query = "UPDATE forum_posts SET edited = '".time()."' WHERE id = '".$p."'";
                mysql_query($query);
                $query = "INSERT INTO forum_posts (name,sf_id_ass,user_id_ass,text,position,post_ass,date,edited)
                    VALUES ('".$name."','".$sf."','".$id."','".$message."','2','".$p."','".time()."','".time()."')";
                mysql_query($query);


                Echo "<p align='center'>Mensagem foi guardada com sucesso!</p><p align='center'><button class=\"site\" onclick='javascript:window.location=\"index.php?page=topic&id=".$p."\"'><img src=\"./images/b-home.png\" width=\"12px\"> Voltar</button></p>";
            }

        }
?>
