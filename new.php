<div class="news">
	<div class="title">Noticias</div>
<?php
//--------------------NOTICIAS INSERIDAS-------------------------
$query 			= "SELECT * FROM content ORDER BY id DESC LIMIT 0,7";
$data_source 	= mysql_query($query);
while($data 	= mysql_fetch_array($data_source))
{
	echo "<div class=\"newsentry\">
                	<div class=\"newsentrytitle\">".$data['nome']."</div>
                    <div class=\"newsentrycomment\">".$data['description']."</div>
                    <div class=\"newsentrybutton\"><button class=\"edit\" onclick=goTo('?page=noticia&noti=".$data['id']."')><img src=\"./templates/arrow.png\" width=\"12\"> Ler Mais</button></div>
                </div>";
	}
?>
</div>

<div class="lastposts">
	<div class="title">Últimos Posts</div>
<?php
//--------------------ULTIMOS POSTS ESCRITOS-------------------------
$query 			= "SELECT * FROM forum_posts WHERE publish = 0 ORDER BY date DESC LIMIT 0,15";
$data_source 	= mysql_query($query);
while($data 	= mysql_fetch_array($data_source))
{
    switch ($data["position"])
    {
        case 1:
            echo "<div class=\"lastpostsentry\">
                	<div class=\"lastpostsentrytitle\"><img src=\"./templates/arrow.png\" width=\"12\"> <i>".$data['name']."</i></div>
                    <div class=\"lastpostsentryusername\"><img src=\"./templates/b_E-mail.png\" width=\"12\"> <b>".return_username($data['user_id_ass'])."</b></div>
					<div class=\"lastpostsentrybutton\"><button class=\"edit\" onclick=goTo('?page=topic&id=".$data["id"]."')><img src=\"./templates/arrow.png\" width=\"12\"> Ler Mais</button></div>
                </div>";
            break;
        case 2:
            echo "<div class=\"lastpostsentry\">
                	<div class=\"lastpostsentrytitle\"><img src=\"./templates/arrow.png\" width=\"12\"> <i>".$data['name']."</i></div>
                    <div class=\"lastpostsentryusername\"><img src=\"./templates/b_E-mail.png\" width=\"12\"> <b>".return_username($data['user_id_ass'])."</b></div>
					<div class=\"lastpostsentrybutton\"><button class=\"edit\" style=\"margin-top: 3px;\" onclick=goTo('?page=topic&id=".$data["post_ass"]."')><img src=\"./templates/arrow.png\" width=\"12\"> Ler Mais</button></div>
                </div>";
            break;
    }
}
?>
</div>

