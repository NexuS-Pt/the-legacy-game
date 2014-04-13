<?php
	if (!empty($_GET['page'])){$page = $_GET["page"];}else {$page = NULL;}
	// INCLUDES
	if ($config["online"] == false)                                     {echo "<p align=center><img src=\"./images/b-update.png\"><br>".$config["offline-msg"]."</p>";}
	elseif (
		empty($_COOKIE["$cookie"])
		&& (($page != 'register')
		&& ($page != 'account_register')
		&& ($page != 'logout')
		&& ($page != "about")
		&& ($page != "topic")
		&& ($page != "recover")
		&& ($page != "teste")
		&& ($page != "ve_noti")))                   		{include("login.php");}

	elseif ($page == NULL)                                              {include("new.php");}
	elseif ($page == "logout")                                          {echo $p;}
	elseif ($page == "register" && empty($_COOKIE["$cookie"]))          {include("register.php");}
	elseif ($page == "about")                                           {include("./about/index.php");}
	elseif ($page == "recover")                                         {include("./recover.php");}
	// --------------------------------CONTA--------------------------------------------------
	elseif ($realuser && $page == "account")                                         {include("./menu/index.php");}
	elseif ($realuser && $page == "account-config")                                  {include("account-config.php");}
	elseif ($realuser && $page == "account-pass")                                    {include("account-change-pass.php");}
	elseif ($realuser && $page == "my-comments")                                     {include("comments/my-comments.php");}
	elseif ($realuser && $page == "safe")                                            {include("safe/index.php");}
	elseif ($realuser && $page == "members")                                         {include("members/index.php");}
	elseif ($realuser && $page == "mp")                                              {include("messages/index.php");}
	elseif ($realuser && $page == "app")                                             {include("app/index.php");}
	elseif ($realuser && $page == "profile")                                         {include("members/profile.php");}
	elseif ($realuser && $page == "userinfo")										{include("./userinfo.php");}
	// --------------------------------ADMIN--------------------------------------------------
	elseif ($realuser && $page == "config-server"  && $conta['previlegios'] <= 2)    {include("./admin_serverconfig/server-config.php");}
	elseif ($realuser && $page == "class" && $conta['previlegios'] <= 2)             {include("./admin_classes/index.php");}
	elseif ($realuser && $page == "A-insert-noticia" && $conta['previlegios'] <= 2)  {include("./admin_news/insert-noticia.php");}
	elseif ($realuser && $page == "order-control" && $conta['previlegios'] <= 2)     {include("./admin_coins_control/index.php");}
	elseif ($realuser && $page == "admin-topic-and-posts" && $conta['previlegios'] <= 2)     {include("./admin-forum/admin-topic-and-posts.php");}
	elseif ($realuser && $page == "admin-extras" && $conta["previlegios"] == 1)		{include("./admin-extras/index.php");}
	// --------------------------------FORUM--------------------------------------------------
	elseif ($realuser && $page == "forum")                                           {include("forum/categorias.php");}
	elseif ($realuser && $page == "sub-forum")                                       {include("forum/sub-forum.php");}
	elseif ($page == "topic")                                           {include("forum/topic.php");}
	elseif ($realuser && $page == "create-post")                                     {include("forum/create-post.php");}
	elseif ($realuser && $page == "create-topic")                                    {include("forum/create-topic.php");}
	elseif ($realuser && $page == "post-editor")                                     {include("forum/post-editor.php");}
	elseif ($realuser && $page == "noticia")                                         {include("ver-noticia.php");}
	//-----------------------------------------------------------------------------------------
	elseif ($realuser && $page == "game")						{include("./game/game/index.php");}
	// --------------------------------NENHUMA PAGINA--------------------------------------------------
	else{return_error();}
?>
