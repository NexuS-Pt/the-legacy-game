<form method="post">
	<button type="submit" class="edit" name="extra-submit" style="width: 200px;">Oferecer presente de Natal</button>
</form>
<?php
if (isset($_POST["extra-submit"]))
{
	$count = 1;
	$query = "SELECT user_id_ass,name FROM g_char";
	$source = mysql_query($query);
	while ($data = mysql_fetch_array($source)) {
		echo "<div><p>".$count." : CHAR : ".$data["name"]." DE : ".return_username($data["user_id_ass"])."</p>";
				if (mysql_query("UPDATE users SET coin = coin + 50 WHERE id = '".$data["user_id_ass"]."'"))
					{echo "<div> + 50</div>";
					if (mysql_query("INSERT INTO coins (quant,type,user_id_ass,why,date,orderid) VALUES('50','1','".$data["user_id_ass"]."','Prenda de Natal NexuSystem','2011-12-24','0')"))
						{echo "<div>Registo de Entrada!</div>";
						$userdata = mysql_fetch_array(mysql_query("SELECT username,email FROM users WHERE id = '".$data["user_id_ass"]."'"));
						if (send_mail_to($userdata["username"],$userdata["email"],"NexuSystem : Presente de Natal","Porque todos merecem prendas por serem bem comportados, os jogadores de NexuS : O Legado não são diferentes. Decidimos por isso, oferecer a todos os jogadores um bonús em jogo como prenda de Natal, que é nada mais nada menos que 50 moedas de ouro. Espero que seja um ótimo incentivo a nos ajudares a tornar este o melhor jogo em Portugal.<br>Esperamos que tenhas tudo de bom e um Feliz Natal para ti, para a tua familia e para todos os teus amigos!"))
							{echo "<div>Email enviado</div>";}
						else
							{echo "<div>ERRO!!</div>";}}
					else
						{echo "<div>ERRO!!!</div>";}}
				else
					{echo "<div>ERRO!!!</div>";}
		echo "</div>";
		$count++;
	}
	echo "<div style=\"background: orange;\">Trabalho Completo</div>";
}
?>
