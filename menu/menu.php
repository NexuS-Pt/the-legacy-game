<div style="float:left; color: #FFFFFF; padding-left: 5px;">
<?php
if (isset($_COOKIE[$cookie])) {
	//Verificar se tem Mensagens Privadas
	$query = "SELECT id FROM private_messages WHERE recep = 1 AND state = 1 AND recep_id = ".$conta[0];
	$source = mysql_query($query);
	$nr = mysql_num_rows($source);
	
	echo "Olá, <a id=\"especial\" href=\"?page=profile&id=".$conta[0]."\">".$conta['username']."</a>!"; if ($nr > 0){echo " Tem <a id=\"especial\" href=\"./?page=mp\"><strong>".$nr."</strong></a> Mensagens!";}
}
else
{
	echo "Para ver o nosso conteúdo, por favor faça Login!";	
}
?>
</div>
<!-- //dropdown menu config -->
<?php if (isset($_COOKIE[$cookie])) { ?>
<ul id="dropmenu">
        <li><a href="./">Inicio</a></li>
        <li><a href="#">Jogo</a>
                    <ul id="itemlist">
                        <li><a href="?page=game">Principal</a></li>
                        <li><a href="?page=game&do=selva">Explorar</a></li>
                        <?php if ($conta["previlegios"] <= 5) { ?><li><a href="?page=game&do=monster-list">Lista de Monstros</a></li><?php } ?>
                        <li><a href="?page=game&do=historico">Histórico</a></li>
                        <li><a href="?page=game&do=mala">Mala</a></li>
                        <li><a href="?page=game&do=loja">Loja</a></li>
                        <li><a href="?page=game&do=jogadores">Jogadores</a></li>
                        <li><a href="?page=game&do=classificacao">Classificação</a></li>
                        <?php if ($conta["previlegios"] <= 4) { ?><li><a href="?page=game&do=caca-ao-coelho">Caça ao Coelho</a></li><?php } ?>
                        <li><a href="?page=game&do=conversor">Conversor</a></li>
                        <li><a href="?page=game&do=sobre">Sobre</a></li>
                        <li id="end"></li>
                    </ul>
        </li>
        <li><a href="?page=forum">Forum</a>
        			<ul id="itemlist">
        <?php
			$query = "SELECT * FROM forum_categories WHERE publish = '1' AND acess >= '".$conta["previlegios"]."'";
			$source = mysql_query($query);
			while ($d = mysql_fetch_array($source)) {
				$query2 = "SELECT id,name FROM forum_sub_forum WHERE publish = '1' AND cat_id_ass = '".$d["id"]."'";
				$source2 = mysql_query($query2);
				while ($d2 = mysql_fetch_array($source2)) {
					echo "<li><a href=\"?page=sub-forum&forum=".$d2["id"]."\">".$d2["name"]."</a></li>";
				}
				
			}
		?>
                        <li id="end"></li>
                    </ul>
        </li>
        <li><a href="#">Conta</a>
                    <ul id="itemlist">
                        <li><a href="?page=my-comments">Meus Comentários</a></li>
                        <li><a href="?page=members">Membros</a></li>
                        <li><a href="?page=safe">Cofre</a></li>
                        <li><a href="?page=app">Aplicações</a></li>
                        <li><a href="?page=mp">Mensagens Privadas</a></li>
                        <li><a href="?page=account-config">Editar Dados</a></li>
                        <li><a href="?page=account-pass">Mudar Password</a></li>
                        <li><a href="?page=userinfo">Informações da Conta</a></li>
                        <li id="end"></li>
                    </ul>
        </li>
	<?php if ($conta["previlegios"] < 3) { ?>
        <li><a href="#">Admin</a>
        			<ul id="itemlist">
                    	<li><a href="?page=A-insert-noticia">Nova Noticia</a></li>
                        <li><a href="?page=admin-topic-and-posts">Posts</a></li>
                        <li><a href="?page=class">Classes</a></li>
                        <li><a href="?page=order-control">Compras</a></li>
                        <li><a href="?page=admin-extras">Extras</a></li>
                        <li id="end"></li>
                    </ul>
        </li>
	<?php } ?>
        <li><a href="?page=about">Sobre</a></li>
        <li><a href="?page=logout">Sair</a></li>
  </li>
</ul>
<?php } ?>
