<?php
	// ------------- NUMERO DE TOPICOS CRIADOS
	$query = "SELECT id FROM forum_posts WHERE position = 1 AND user_id_ass = ".$conta[0];
	$source = mysql_query($query);
	$nr_topic = mysql_num_rows($source);
	//-------------- NUMERO DE RESPOSTAS ESCRITAS EM TOPICOS
	$query = "SELECT id FROM forum_posts WHERE position = 2 AND user_id_ass = ".$conta[0];
	$source = mysql_query($query);
	$nr_post = mysql_num_rows($source);
	//-------------- NUMERO DE POSTS TOTAL DO UTILIZADOR
	$nr_total = $nr_topic + $nr_post;
	
	// ------------- COFRE E SEUS MOVIMENTOS
	// ------------- MOVIMENTOS DE ENTRADA
	$query = "SELECT id FROM coins WHERE type = 1 AND user_id_ass = ".$conta[0];
	$source = mysql_query($query);
	$nr_mov_ent = mysql_num_rows($source);
	// ------------- MOVIMENTOS DE SAIDA
	$query = "SELECT id FROM coins WHERE type = 2 AND user_id_ass = ".$conta[0];
	$source = mysql_query($query);
	$nr_mov_sai = mysql_num_rows($source);

	$nr_mov_total = $nr_mov_ent + $nr_mov_sai;

	if (isset($_POST["upgrade"]))
	{
		if (mysql_query("UPDATE users SET type = 5 WHERE id =".$conta[0]))
		{echo "<h2 align=\"center\">Passou agora a ser um Utilizador Mais!</h2>";}
		else
		{echo "<h2 align=\"center\" style=\"color:red;\">Erro! Tente mais tarde!</h2> ";}
	}
	else if ($conta["previlegios"] == 6 && $nr_total >= 50)
	{
		echo "<p align=\"justify\">A tua conta tem os requisitos minimos para fazeres a actualização de <b>Utilizador</b> para <b>Utilizador Mais</b>. Para fazeres a actualização clica no botão abaixo!</p>
		<form method=\"post\">
			<p align=\"center\">
				<button type=\"submit\" class=\"site\" name=\"upgrade\">
					<img src=\"http://cdn2.iconfinder.com/data/icons/splashyIcons/arrow_large_up.png\" valign=\"middle\"> Upgrade para Utilizador Mais
				</button>
			</p>
		</form>";
	}

?>

<div id="lm-header">
	Informações
	<div id="lm-header-2">Tudo o que precisas de saber sobre a tua conta!</div>
</div>
<div style="display: inline-block; line-height: 22px; border-left: 1px solid #CCC; border-right: 1px solid #CCC; width: 858px;">
<!-- ID -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3px 3px;" title="*Número único que identifica o utilizador em todo o site. Representação [U:<?php echo $conta[0]; ?>]">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		ID
	</div>
	<div style="float: left;">
		<?php echo $conta[0]; ?>
	</div>
</div>
<!-- USERNMAE -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Número único que identifica o utilizador em todo o site. Representação [U:<?php echo $conta[0]; ?>]">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		Nome
	</div>
	<div style="float: left;">
		<?php echo $conta["username"]; ?>
	</div>
</div>
<!-- TIPO -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Classe em que se situa o utilizador e quais os previlegios que tem.">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		Tipo
	</div>
	<div style="float: left;">
		<?php echo user_type($conta["previlegios"]); ?>
	</div>
</div>
<!-- EMAIL -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Endereço que permite ao utilizador fazer login, e receber informações especiais da Comunidade.">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		E-mail
	</div>
	<div style="float: left;">
		<?php echo $conta["email"]; ?>
	</div>
</div>
<div id="lm-titles" style="padding-left: 5px; width: 853px;">
Informações sobre o Forum
</div>
<!-- topicos criados -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Número de tópicos criados no forum por esta conta.">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		Tópicos Criados
	</div>
	<div style="float: left;">
		<?php echo $nr_topic; ?>
	</div>
</div>
<!-- respostas -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Quantidade de mensagens escritas em tópicos próprios ou alheios.">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		Respostas a tópicos
	</div>
	<div style="float: left;">
		<?php echo $nr_post; ?>
	</div>
</div>
<!-- posts -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Número de Tópicos e Respostas a Tópicos somados, indicando o número de Posts, este fará subir de tipo de Conta.">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		Posts
	</div>
	<div style="float: left;">
		<?php echo $nr_total; ?>
	</div>
</div>
<div id="lm-titles" style="padding-left: 5px; width: 853px;">
Informações sobre o Cofre
</div>
<!-- entradas no cofre -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Quantidade de movimentos de entrada de moedas de ouro nesta conta.">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		Entradas no cofre
	</div>
	<div style="float: left;">
		<?php echo $nr_mov_ent; ?>
	</div>
</div>
<!-- saidas do cofre -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Quantidade de movimentos de saida de moedas de ouro nesta conta.">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		Saidas do Cofre
	</div>
	<div style="float: left;">
		<?php echo $nr_mov_sai; ?>
	</div>
</div>
<!--  -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Quantidade de movimentos de saida e entrada somados de moedas de ouro nesta conta.">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		Movimentos no Cofre
	</div>
	<div style="float: left;">
		<?php echo $nr_mov_total; ?>
	</div>
</div>
<div id="lm-titles" style="padding-left: 5px; width: 853px;">
Jogo NexuS : O Legado
</div>
<?php

	$query = "SELECT id,name,expirience,type,atk,def,vida,velocidade,register_since FROM g_char WHERE user_id_ass = ".$conta[0];
	$source = mysql_query($query);
	$true = mysql_num_rows($source);
	
if($true == 1)
{
	$game = mysql_fetch_array($source);
?>
<!--  -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Número único que identifica a personagem em todo o site. Representação [N:<?php echo $game["id"]; ?>">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		ID de char:
	</div>
	<div style="float: left;">
		<?php echo $game["id"]; ?>
	</div>
</div>
<!--  -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Nome que identifica o teu Nexar, este é único e inalteravel.">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		Nome de char:
	</div>
	<div style="float: left;">
		<?php echo $game["name"]; ?>
	</div>
</div>
<!--  -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Esta é a caracteristica principal do teu Nexar.">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		Tipo:
	</div>
	<div style="float: left;">
		<?php echo game_type_write($game["type"]); ?>
	</div>
</div>
<!--  -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Data em que o teu Nexar foi criado.">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		Data de Registo
	</div>
	<div style="float: left;">
		<?php echo date("Y-m-d",($game['register_since'])); ?>
	</div>
</div>
<!--  -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Capacidades de combate do teu Nexar. Representação Ataque.Defesa.Velocidade.Vida">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		Skills
	</div>
	<div style="float: left;">
		<?php echo $game["atk"].".".$game["def"].".".$game["velocidade"].".".$game["vida"]; ?>
	</div>
</div>
<!--  -->
<div id="lm-data" style="line-height: 22px;">
	<div style="float: left; width: 22px; background: url(templates/help_ico.png) no-repeat 3 3px;" title="*Pontuação que te posiciona na Classificação Geral.">&nbsp;</div>
	<div style="float: left; width:170px; padding-left: 15px;">
		Experiência
	</div>
	<div style="float: left;">
		<?php echo number_format($game["expirience"],0,""," "); ?>
	</div>
</div>

<?php } ?>
</div>
<div id="lm-footer"></div>

