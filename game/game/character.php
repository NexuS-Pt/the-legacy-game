<?php
if(isset($_GET['skill']))
{
	$skill = $_GET['skill'];
 	if($skill == 'add-atk')
	{
		if (($conta['game']['gepys']) >= game_skill_value(1,($conta['game']['atk'])))
		{
			$conta['game']['gepys'] = ($conta['game']['gepys']) - game_skill_value(1,($conta['game']['atk']));
			$conta['game']['atk'] = $conta['game']['atk'] + 1;
			$print_skill = "<div class=\"sucess\">Evoluido nivel de Ataque</div>";
			
			//ADICIONAR AO HISTORICO O AUMENTO DO SKILL
			$query = "INSERT INTO g_history(user_id_ass,frase,type) VALUES('".$conta['game']['id']."','Nivel de Ataque evoluido.','S')";
			mysql_query($query);
			//GRAVAR AUMENTO DO SKILL
			$query = "UPDATE g_char SET gepys = '".$conta['game']['gepys']."', atk = '".$conta['game']['atk']."' WHERE id = ".$conta['game']['id'];
			mysql_query($query);
		}
		else
		{$print_skill = "<div class=\"failure\">Não tem Gepys suficientes!</div>";}
	}
	elseif ($skill == 'add-def')
	{
		if (($conta['game']['gepys']) >= game_skill_value(2,($conta['game']['def'])))
		{
			$conta['game']['gepys'] = ($conta['game']['gepys']) - game_skill_value(2,($conta['game']['def']));
			$conta['game']['def'] = ($conta['game']['def']) + 1;
			$print_skill = "<div class=\"sucess\">Evoluido nivel de Defesa</div>";
			
			//ADICIONAR AO HISTORICO O AUMENTO DO SKILL
			$query = "INSERT INTO g_history(user_id_ass,frase,type) VALUES('".$conta['game']['id']."','Nivel de Defesa evoluido.','S')";
			mysql_query($query);
			//GRAVAR AUMENTO DO SKILL
			$query = "UPDATE g_char SET gepys = '".$conta['game']['gepys']."', def = '".$conta['game']['def']."' WHERE id = ".$conta['game']['id'];
			mysql_query($query);
		}
		else
		{$print_skill = "<div class=\"failure\">Não tem Gepys suficientes!</div>";}
	}
	elseif ($skill == 'add-vida')
	{
		if (($conta['game']['gepys']) >= game_skill_value(4,($conta['game']['vida'])))
		{
			$conta['game']['gepys'] = ($conta['game']['gepys']) - game_skill_value(4,($conta['game']['vida']));
			$conta['game']['vida'] = ($conta['game']['vida']) + 1;
			$print_skill = "<div class=\"sucess\">Evoluido nivel de Vida</div>";
			
			//ADICIONAR AO HISTORICO O AUMENTO DO SKILL
			$query = "INSERT INTO g_history(user_id_ass,frase,type) VALUES('".$conta['game']['id']."','Nivel de Vida evoluido.','S')";
			mysql_query($query);
			//GRAVAR AUMENTO DO SKILL
			$query = "UPDATE g_char SET gepys = '".$conta['game']['gepys']."', vida = '".$conta['game']['vida']."' WHERE id = ".$conta['game']['id'];
			mysql_query($query);
		}
		else
		{$print_skill = "<div class=\"failure\">Não tem Gepys suficientes!</div>";}
	}
	elseif ($skill == 'add-velocidade')
	{
		if (($conta['game']['gepys']) >= game_skill_value(3,($conta['game']['velocidade'])))
		{
			$conta['game']['gepys'] = ($conta['game']['gepys']) - game_skill_value(3,($conta['game']['velocidade']));
			$conta['game']['velocidade'] = ($conta['game']['velocidade']) + 1;
			$print_skill = "<div class=\"sucess\">Evoluido nivel de Velocidade</div>";
			
			//ADICIONAR AO HISTORICO O AUMENTO DO SKILL
			$query = "INSERT INTO g_history(user_id_ass,frase,type) VALUES('".$conta['game']['id']."','Nivel de Velocidade evoluido.','S')";
			mysql_query($query);
			//GRAVAR AUMENTO DO SKILL
			$query = "UPDATE g_char SET gepys = '".$conta['game']['gepys']."', velocidade = '".$conta['game']['velocidade']."' WHERE id = ".$conta['game']['id'];
			mysql_query($query);
		}
		else
		{$print_skill = "<div class=\"failure\">Não tem Gepys suficientes!</div>";}
	}
}


$equip['head']	= game_equips_return($conta['game']['id'],'head');
$equip['left']	= game_equips_return($conta['game']['id'],'left');
$equip['right']	= game_equips_return($conta['game']['id'],'right');
$equip['legs']	= game_equips_return($conta['game']['id'],'legs');

// CALCULO DE VALOR EM COMBATE [VEC]
$vec["atk"] = intval(((($conta['game']['atk']) + 1) * 10.45) * (1 + ($conta['game']['velocidade'] / $conta['game']['def'])))
			+ $equip['head']['atk'] + $equip['right']['atk'] + $equip['left']['atk'] + $equip['legs']['atk'];
$vec["def"] = intval(((($conta['game']['def']) + 1) * 5.7) * (1 + ($conta['game']['velocidade'] / $conta['game']['def'])))
			+ $equip['head']['def'] + $equip['right']['def'] + $equip['left']['def'] + $equip['legs']['def'];
$vec["velocidade"] = (($conta['game']['velocidade'])
			+ $equip['head']['velocidade'] + $equip['right']['velocidade'] + $equip['left']['velocidade'] + $equip['legs']['velocidade']);
$vec["vida"] = intval(((($conta['game']['vida']) * 1.3) + 1) * 123.15)
			+ $equip['head']['vida'] + $equip['right']['vida'] + $equip['left']['vida'] + $equip['legs']['vida'];

?>
<?php if (isset($print_skill)) {echo $print_skill."<br>";} ?>

<div style="height: 400px;">
	<div style="float: left; width: 150px;">
    	<img src="<?php echo $conta['game']['img']; ?>">
    </div>
    <div style="float: left; width: 700;">
    	<div id="container">
          <div class="simpleTabs" style="padding-left: 4px;">
            <ul class="simpleTabsNavigation" style="border-radius: 5px 5px 0 0;">
        		<li><a href="#inf">Informações</a></li>
              	<li><a herf="#habi">Habilidades</a></li>
              	<li><a href="#equip">Equipamentos</a></li>
              	<li><a href="#ref">Referir</a></li>
            </ul>
            <div class="simpleTabsContent">
            	<div style="margin-top:4px; padding-left: 5px; border: 1px solid #FF3300; border-radius: 5px 5px 0 0; background: #FF6600; font-size: 18px; color: #FFFFFF; font-weight: bold;">
                	Nome
                </div>
                <div style="text-align:right; padding-right: 5px; border: 1px solid #CCC; border-top: none; border-radius: 0px  0px 5px 5px; background: #FFF; font-size: 18px;">
					<?php echo ($conta['game']['name']); ?>
                </div>
                
                <div style="margin-top:4px; padding-left: 5px; border: 1px solid #FF3300; border-radius: 5px 5px 0 0; background: #FF6600; font-size: 18px; color: #FFFFFF; font-weight: bold;">
                	Data de Registo
                </div>
                <div style="text-align:right; padding-right: 5px; border: 1px solid #CCC; border-top: none; border-radius: 0px  0px 5px 5px; background: #FFF; font-size: 18px;">
					<?php echo date("Y-m-d",($conta['game']['register_since'])) ?>
                </div>
                
                <div style="margin-top:4px; padding-left: 5px; border: 1px solid #FF3300; border-radius: 5px 5px 0 0; background: #FF6600; font-size: 18px; color: #FFFFFF; font-weight: bold;">
                	Tipo
                </div>
                <div style="text-align:right; padding-right: 5px; border: 1px solid #CCC; border-top: none; border-radius: 0px  0px 5px 5px; background: #FFF; font-size: 18px;">
					<?php echo game_type_write(($conta['game']['type'])); ?>
                </div>
                
                <div style="margin-top:4px; padding-left: 5px; border: 1px solid #FF3300; border-radius: 5px 5px 0 0; background: #FF6600; font-size: 18px; color: #FFFFFF; font-weight: bold;">
                	Esperiência
                </div>
                <div style="text-align:right; padding-right: 5px; border: 1px solid #CCC; border-top: none; border-radius: 0px  0px 5px 5px; background: #FFF; font-size: 18px;">
					<?php echo number_format(($conta['game']['expirience']), 0, ',', ' '); ?> pts
                </div>
				
				<div style="margin-top:4px; padding-left: 5px; border: 1px solid #FF3300; border-radius: 5px 5px 0 0; background: #FF6600; font-size: 18px; color: #FFFFFF; font-weight: bold;">
                	Batalhas
                </div>
                <div style="text-align:right; padding-right: 5px; border: 1px solid #CCC; border-top: none; border-radius: 0px  0px 5px 5px; background: #FFF; font-size: 18px; display: inline-block;">
					<div style="width: 110px; float: left; text-align: center;">
						Victórias
					</div>
					<div style="width: 109px; float: left; text-align: center; border-right: 1px solid #CCC;">
						<?php echo number_format($conta['game']['win'],0,","," "); ?>
					</div>
					<div style="width: 109px; float: left; text-align: center;">
						Derrotas
					</div>
					<div style="width: 109px; float: left; text-align: center; border-right: 1px solid #CCC;">
						<?php echo number_format($conta['game']['lose'],0,","," "); ?>
					</div>
					<div style="width: 109px; float: left; text-align: center;">
					Rácio
					</div>
					<div style="width: 109px; float: left; text-align: left;">
						<?php echo number_format(intval($conta['game']['win']/$conta['game']['lose']),2,","," "); ?>
					</div>
                </div>
            </div>
            
            <div class="simpleTabsContent">
            	<div style="margin-top:4px; padding-left: 5px; border: 1px solid #FF3300; border-radius: 5px 5px 0 0; background: #FF6600; font-size: 18px; color: #FFFFFF; font-weight: bold;">
                	Dinheiro
                </div>
                <div style="text-align:right; padding-right: 5px; border: 1px solid #CCC; border-top: none; border-radius: 0px  0px 5px 5px; background: #FFF; font-size: 18px;">
					<span title="Clicar para Adicionar Moedas de Ouro" onclick="goTo('?page=safe#comprarmoedas')" style="cursor: pointer;"> + </span><?php echo number_format(($conta['coin']),'0',',',' '); ?> <img src="./media/imagens/character/gold_coin.png" width="18px" valign="middle" title="Moedas de Ouro"> <?php echo number_format(($conta['game']['gepys']),'0',',',' '); ?> <img src="./media/imagens/character/gepys_coin.png" width="18px" valign="middle" title="Gepys">
                </div>
                
                <div style="margin-top:4px; padding-left: 5px; border: 1px solid #FF3300; border-radius: 5px 5px 0 0; background: #FF6600; font-size: 18px; color: #FFFFFF; font-weight: bold;">
                	Ataque
                </div>
                <div style="text-align:right; padding-right: 5px; border: 1px solid #CCC; border-top: none; border-radius: 0px  0px 5px 5px; background: #FFF; font-size: 18px;">
					<button class='lvl'><?php echo $conta['game']['atk']; ?></button> <button class='vec'> VEC: <?php echo number_format($vec["atk"],'0',',',' '); ?></button> <button class='lvlup' title='<?php echo game_skill_value(1,($conta['game']['atk'])); ?> GPs' onclick="goTo('?page=game&skill=add-atk')">+</button>
                </div>
                
                <div style="margin-top:4px; padding-left: 5px; border: 1px solid #FF3300; border-radius: 5px 5px 0 0; background: #FF6600; font-size: 18px; color: #FFFFFF; font-weight: bold;">
                	Defesa
                </div>
                <div style="text-align:right; padding-right: 5px; border: 1px solid #CCC; border-top: none; border-radius: 0px  0px 5px 5px; background: #FFF; font-size: 18px;">
					<button class='lvl'><?php echo $conta['game']['def']; ?></button> <button class='vec'> VEC: <?php echo number_format($vec["def"],'0',',',' '); ?></button> <button class='lvlup' title='<?php echo game_skill_value(2,($conta['game']['def'])); ?> GPs' onclick="goTo('?page=game&skill=add-def')">+</button>
                </div>
                
                <div style="margin-top:4px; padding-left: 5px; border: 1px solid #FF3300; border-radius: 5px 5px 0 0; background: #FF6600; font-size: 18px; color: #FFFFFF; font-weight: bold;">
                	Velocidade
                </div>
                <div style="text-align:right; padding-right: 5px; border: 1px solid #CCC; border-top: none; border-radius: 0px  0px 5px 5px; background: #FFF; font-size: 18px;">
					<button class='lvl'><?php echo $conta['game']['velocidade']; ?></button> <button class='vec'> VEC: <?php echo number_format($vec["velocidade"],'0',',',' '); ?></button> <button class='lvlup' title='<?php echo game_skill_value(3,($conta['game']['velocidade'])); ?> GPs' onclick="goTo('?page=game&skill=add-velocidade')">+</button>
                </div>
                
                <div style="margin-top:4px; padding-left: 5px; border: 1px solid #FF3300; border-radius: 5px 5px 0 0; background: #FF6600; font-size: 18px; color: #FFFFFF; font-weight: bold;">
                	Vida
                </div>
                <div style="text-align:right; padding-right: 5px; border: 1px solid #CCC; border-top: none; border-radius: 0px  0px 5px 5px; background: #FFF; font-size: 18px;">
					<button class='lvl'><?php echo ($conta['game']['vida']); ?></button> <button class='vec'> VEC: <?php echo number_format($vec["vida"],'0',',',' '); ?></button> <button class='lvlup' title='<?php echo game_skill_value(4,($conta['game']['vida'])); ?> GPs' onclick="goTo('?page=game&skill=add-vida')">+</button>
                </div>
                
                <div style="margin-top:4px; padding-left: 5px; border: 1px solid #FF3300; border-radius: 5px 5px 0 0; background: #FF6600; font-size: 18px; color: #FFFFFF; font-weight: bold;">
                	Critical
                </div>
                <div style="text-align:right; padding-right: 5px; border: 1px solid #CCC; border-top: none; border-radius: 0px  0px 5px 5px; background: #FFF; font-size: 18px;">
					<button class='vec'>VEC: <?php echo ($equip['head']['critical'] + $equip['right']['critical'] + $equip['left']['critical'] + $equip['legs']['critical']) ?> %</button>
                </div>

            </div>
            <div class="simpleTabsContent" style="text-align: center;">
            	<img <?php if ($equip['head']['id'] != null)
				{ echo  "onclick=\"goTo('?page=game&do=mala&equip=".$equip['head']['id']."')\"";} ?> src="<?php echo ("./media/imagens/character/equips/".($equip['head']['equip_id']).".jpg"); ?>"><br />
    			<img <?php if ($equip['right']['id'] != null)
				{ echo  "onclick=\"goTo('?page=game&do=mala&equip=".$equip['right']['id']."')\"";} ?> src="<?php echo ("./media/imagens/character/equips/".($equip['right']['equip_id']).".jpg"); ?>"><br />
    			<img <?php if ($equip['left']['id'] != null)
				{ echo  "onclick=\"goTo('?page=game&do=mala&equip=".$equip['left']['id']."')\"";} ?> src="<?php echo ("./media/imagens/character/equips/".($equip['left']['equip_id']).".jpg"); ?>"><br />
    			<img <?php if ($equip['legs']['id'] != null)
				{ echo  "onclick=\"goTo('?page=game&do=mala&equip=".$equip['legs']['id']."')\"";} ?> src="<?php echo ("./media/imagens/character/equips/".($equip['legs']['equip_id']).".jpg"); ?>">
            </div>
            <div class="simpleTabsContent">
            	<p>
                Link de Referir:<br />
                http://www.nexusystem.com/?page=app&ref=<?php echo $conta['email']; ?> <br />
                <br />
            	* Ganhas 25 MO por cada pessoa que se registar no jogo com o teu Link.<br>
				* Já deve ter conta na Comunidade<br>
                </p>
            </div>
          </div>
    </div>
</div>
</div>



<?php $config["site_game_name"] .= " : Game : Principal";  ?>
