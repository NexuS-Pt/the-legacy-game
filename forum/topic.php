<?php
	$id = intval($_GET['id']);	
	
	$result = mysql_query("SELECT * FROM forum_posts WHERE id = '".$id."' AND position = '1' LIMIT 1");
	$data = mysql_fetch_array ($result);

if (mysql_num_rows($result) == 1)
{
	// -----------------------------------------------
	//_---------------PRINT 1st POST -----------------
	//_-----------------------------------------------
	$sf_id     = $data['sf_id_ass'];
	$post_id   = $data['id'];
	
		$userdata = return_queryData("SELECT * FROM users WHERE id = ".$data['user_id_ass']);
		echo "
        	<div class=\"topic\">
        		<div class=\"forum1stpost\">
               	  <div class=\"topictitle\">
                        <span style=\"padding-left: 4px;\">".$data["name"]."</span>
                        <div id=\"userdetailsshow\"  onclick=\"spoiler_static(userdetails)\">Informaçoes de ".return_username($data['user_id_ass'])." <img style=\"width: 14px;\" src=\"./templates/arrow-show-user-info.png\"></div>
                        <!--IMAGEM E NOME DO USER -->
                        <div id=\"userdetails\">
                            <img src=\"".$userdata["avatar"]."\" style=\"width: 75px; height: 75px;\">
                            <p style=\"float: right; width: 750px; margin-top: 1px;\">".$userdata["username"]."<br>".$userdata["date"]."<br><span style=\"font-size: 9pt; cursor: pointer;\" onclick=\"goTo('?page=profile&id=".$data['user_id_ass']."')\">Ver Perfil</span></p>
                        </div>
                  </div>
				  <!--POST EM SI MESMO -->
                    <div class=\"post\">
						".$data['text'];
                        	if(isset($_COOKIE[$cookie]) && ($conta["0"] == $data["user_id_ass"])) {echo "<div class=\"endpost\"><button class=\"edit\" onclick=\"goTo('?page=post-editor&sf=".$sf_id."&id=".$post_id."')\">Editar</button></div>";}
            echo "</div>
                </div>
        	</div>
		";
        $config["site_name"] .= " : Forum : ".$data['name'];


	
	echo "<div class=\"postlist\">";
	// -----------------------------------------------
	//---------------PRINT OTHER POST ----------------
	//------------------------------------------------

	$search = mysql_query("SELECT * FROM forum_posts WHERE post_ass = '$id' AND position = 2 ORDER BY id");
	
	while($search_2 = mysql_fetch_array($search))
	{
		echo "
			<div class=\"topictreplytitle\"><span style=\"padding-left: 4px; color:#000000;\">R:</span> ".$search_2["name"]." <span style=\"color:#000000; font-size: 12px;\">escrito por ".return_username($search_2['user_id_ass'])."</span></div>
			<div class=\"post\">".$search_2['text'];
			if (isset($_COOKIE[$cookie]) && $conta["0"] == $search_2['user_id_ass'])
			{echo "<div class=\"endpost\"><button class=\"edit\" onclick=\"goTo('?page=post-editor&sf=".$sf_id."&id=".$search_2['id']."')\">Editar</button></div>";}

    	echo "</div>";
	}

	// -----------------------------------------------
	//---------------BUTTONS -------------------------
	//------------------------------------------------
	if (isset($_COOKIE[$cookie]))
        {
            echo "
			<div style=\"text-align: center; margin-top: 10px; line-hright: 25px;\">
                	<!--<button class=\"prev\"><img style=\"width: 14px;\" src=\"./templates/arrow-show-previous.png\"> Anterior</button> --><button class=\"center\" onclick=\"goTo('?page=create-post&sf=".$sf_id."&p=".$post_id."')\"><img style=\"width: 14px;\" src=\"./templates/blank.png\"> Responder <img style=\"width: 14px;\" src=\"./templates/blank.png\"></button> <!--<button class=\"next\">Próximo <img style=\"width: 14px;\" src=\"./templates/arrow-show-next.png\"></button>-->
                </div>
			";
        }
	
	echo "</div>";
}
else
{
    // Caso o tópico nao exista
    return_error();
}
?>
