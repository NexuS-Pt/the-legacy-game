<?php
	//VER NOTICIA
	
	$noti_id = intval($_GET['noti']);
						
	$query = "SELECT * FROM content WHERE id = '".$noti_id."'";
	$data_source = mysql_query($query);
        if (mysql_num_rows($data_source) == 1) {
            $data = mysql_fetch_array($data_source);
			
			echo "
			<div class=\"article\">
				<div class=\"title\">".$data['nome']."</div>
				<div class=\"article-content\">
					".$data['content']."
				</div>
			</div>
			";
            //echo "<h2 class=\"noticia\">".$data['nome']."</h2><div class=\"noticia\">".$data['content'].socialNetwork()."</div>";
            $config["site_name"] .= " : ".$data['nome'];

            // CHAMAR FICHEIRO DE COMENTARIOS
            include "comments/view.php";
        } else {
            return_error();
        }
?>
