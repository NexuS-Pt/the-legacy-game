<?php
	// ---- SE TEM MOEDAS SERA MOSTRADO O FORMULARIO ----
	if($conta["coin"] != 0)
	{
		// ---- SE O BOTAO convert_button FOI CLICADO, SERA EXECUTADO O SCRIPT QUE IRÁ EFECTUAR A CONVERSÃO
		if(isset($_POST["convert_button"]))
		{
					// ---- SE O VALOR INTRODUZIDO FOR MAIOS QUE 0
			if ($_POST["convert_valor"] > 0)
			{
				// ---- SE O VALOR PRETENDIDO É SUPERIOR AO QUE PUSSUI
				if($_POST["convert_valor"] > $conta["coin"])
				{
					echo "<p>Não tens moedas suficientes para que possas converter tal quantidade!</p>";
				}
				else
				// ---- SE O VALOR PRETENDIDO É IGUAL O INFERIOR AO QUE POSSUI
				{
					// ---- CONVERSÃO DO VALOR PRETENDIDO EM GEPYS
					$converted_coins_gepys = intval(($_POST["convert_valor"] * 10) + $conta['game']['gepys']);
					$converted_coins_gold = intval($conta["coin"] - $_POST["convert_valor"]);
					
					// ---- GRAVAÇÃO DE GEPYS NOS DADOS DO JOGADOR
					$query = "UPDATE g_char SET gepys = '".$converted_coins_gepys."' WHERE user_id_ass = '".$conta[0]."'";
					if(mysql_query($query))
					{
						// ---- GRAVAÇÃO DE MOEDAS DE OURO NOS DADOS DO MEMBRO
						$query = "UPDATE users SET coin = '".$converted_coins_gold."' WHERE id = '".$conta[0]."'";
						if(mysql_query($query))
						{
							echo "<h3 align='center'>Conversão efectuada com sucesso!</h3>
								<p>
								<i>Gepys</i><br>
								<code>
									<b>Saldo Anterior</b>: ".$conta['game']['gepys']."<br>
									<b>Saldo Actual</b>: ".$converted_coins_gepys."<br>
								</code>
								<i>Moedas de Ouro</i><br>
								<code>							
									<b>Saldo Anteior</b>: ".$conta['coin']."<br>
									<b>Saldo Actual</b>: ".$converted_coins_gold."
								</code></p>";
							// ---- GRAVAR O USO DO CONVERSOR NO HISTORICO DO UTILIZADOR + QUANTIDADE CONVERTIDA
							$query = "INSERT INTO g_history (user_id_ass,frase,type) VALUES('".$conta['game']['id']."','Uso do conversor para ".$_POST["convert_valor"]." MOs','C')";
							if(!mysql_query($query)){echo "<code>Erro no registo da acção no historico!</code>";}

							// ---- GRAVAR O USO DO CONVERSOR NO COFRE
							$query = "INSERT INTO coins (quant,type,user_id_ass,why,date) VALUES('".$_POST["convert_valor"]."','2','".$conta[0]."','Uso do conversor de MOs de Jogo','".date('Y-m-d')."')";
							if(!mysql_query($query)){echo "<code>Erro no registo da acção no cofre!</code>";}

							$conta["coin"] = $converted_coins_gold;
						}
						else
						// ---- GRAVAÇÃO DE MOEDAS DE OURO MAL SUCEDIDA
						{
							echo "<p>ERRO no processo! Deverá fazer um PrintScreen do ecra e enviar à administração!<br>
								Código: ".time().".#.".$converted_coins_gepys.".#.1.#.".$converted_coins_gold.".#.0</p>";
						}
					}
					else
					// ---- GRAVAÇÃO DE GEPYS MAL SUCEDIDA
					{
						echo "<p>ERRO no processo! Deverá fazer um PrintScreen do ecra e enviar à administração!<br>
							Código: ".time().".#.".$converted_coins_gepys.".#.0.#.".$converted_coins_gold.".#.0</p>";
					}
				}
			}
			else
			{
				// SE O VALOR INTRODUZIDO SEJA INFERIOR A 0
				echo "<p>Não poderemos converter um valor como esse, valor inválido!</p>";
			}
		}
		else
		// ---- SE O BOTAO convert_button NAO FOR CLICADO SER MOSTRADO O FORMULARIO
		{
?>
<div id="lm-header">
	Conversor
	<div id="lm-header-2">Estás, apertado? Troca algumas Moedas de Ouro por Gepys, ajuda bastante!</div>
</div>
<div style="border-left: 1px solid #CCC; border-right: 1px solid #CCC;text-align: right; color: #FFF; font-size: 18pt; font-weight: bold; display: inline-block; width: 858px; background: url(templates/topbanner.jpg);">
	Apartir de agora é <span style="color: #FC0;">x10</span>, antigamente era x1,64!
</div>
<div style="border-left: 1px solid #CCC; border-right: 1px solid #CCC; display: inline-block; width: 858px;">
		<form method="post">
			<p align="center">Insira Moedas de Ouro a converter:</p>
			<p  align="center"><input style="width: 250px; color: #666; font-size: 15pt; text-align: center; border-radius: 4px; border: 1px solid #F60;" type="text" name="convert_valor" maxlength="10"></p>
			<p align="center"><button style="width: 250px; border: 1px solid #F60; background: url(templates/topbanner.jpg) 0 -50px #000; border-radius: 5px; color: white; font-size: 12pt;" type="submit" name="convert_button">Converter</button></p>
		</form>
</div>
<div id="lm-header" style="border-radius: 0 0 5px 5px;">
	<div id="lm-header-2">O ratio é de 1 MO para 10 Gepys.<br>Apenas é contada a parte inteira do resultado.<br>Ex.: 15 MO = 150,0 Gepys , o jogador recebe 150 Gepys.</div>
</div>
<?php
		}		
	}
	else
	// ---- SE NAO TEM MOEDAS NAO SERA MOSTRADO O FORMULARIO E SERA MOSTRADO UMA MENSAGEM ERRO!	
	{
		echo "<p>Não tens Moedas de Ouro de momento para que possas efectuar uma conversão!<br>
			Vai ao cofre e efectua a compra de algum pacote de Moedas de Ouro!</p>";
	}

?>
<?php $config["site_game_name"] .= " : Game : Conversor";  ?>