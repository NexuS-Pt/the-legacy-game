<?php
//PARA VIPS E PARA NORMAIS
if($conta["previlegios"] <= 4){$tempo = 3;}
elseif ($conta["previlegios"] == 5) {$tempo = 4;}
else {$tempo = 5;}

if (isset($_GET["accept"]) && $_GET['accept'] == 1)
{
	if (($conta['game']['last_fight']) < ((time()) - (60 * $tempo)))
	{
	
		//JOGADOR 1------------------------------------------------------------------------------------------------------------------------
		$query = "SELECT * FROM g_char WHERE user_id_ass = '$conta[0]'";
		$result = mysql_query($query);
		$jogador['1'] = mysql_fetch_array($result);

		$jogador['1']['atk'] 	= 	intval((($jogador['1']['atk'] + 1) * 10.45) * (1 + ($jogador['1']['velocidade'] / $jogador['1']['def'])));
		$jogador['1']['def'] 	= 	intval((($jogador['1']['def'] + 1) * 5.7) * (1 + ($jogador['1']['velocidade'] / $jogador['1']['def'])));
		$jogador['1']['vida'] 	= 	intval((($jogador['1']['vida']*1.3)+1)*123.15);
		$jogador['1']['critical'] 	= 	0;
	
			$miniquery = "SELECT
				`g_equips`.`atk` AS `atk`,
				`g_equips`.`def` AS `def`,
				`g_equips`.`velocidade` AS `velocidade`,
				`g_equips`.`vida` AS `vida`,
				`g_equips`.`critical` AS `critical`
				FROM ((`g_equips` join `g_bag` on((`g_bag`.`equip_id_ass` = `g_equips`.`id`))) join `g_char` on((`g_char`.`id` = `g_bag`.`user_id_ass`)))
				WHERE ((`g_bag`.`equiped` = 1) and (`g_char`.`id` = ".$jogador['1']['id']."))";
		
			$result = mysql_query($miniquery);
		
			while($jogador['1']['equips'] = mysql_fetch_array($result))
			{
				$jogador['1']['atk'] = 		$jogador['1']['atk'] + $jogador['1']['equips']['atk'];
				$jogador['1']['def'] = 		$jogador['1']['def'] + $jogador['1']['equips']['def'];
				$jogador['1']['velocidade'] = 	$jogador['1']['velocidade'] + $jogador['1']['equips']['velocidade'];
				$jogador['1']['vida'] = 		$jogador['1']['vida'] + $jogador['1']['equips']['vida'];
				$jogador['1']['critical'] = 	$jogador['1']['critical'] + $jogador['1']['equips']['critical'];
			}


		//JOGADOR 2----------------------------------------------------MONSTROS--------------------------------------------------------------------
		$query = "SELECT * FROM g_monsters WHERE exp_min <= ".$conta['game']['expirience']." ORDER BY RAND() LIMIT 1";
		$result = mysql_query($query);

		$row = mysql_fetch_array($result);
		
		// CALCULO DE VALORES PARA O MONSTRO
		$jogador['2']['name'] = 	$row['name'];
		$jogador['2']['atk'] = 		intval((($row['atk'] + 1) * 10.45) * (1 + ($row['velocidade'] / $row['def'])));
		$jogador['2']['def'] = 		intval((($row['def'] + 1) * 5.7) * (1 + ($row['velocidade'] / $row['def'])));
		$jogador['2']['vida'] = 	intval((($row['vida']*1.3)+1)*123.15);
		$jogador['2']['critical'] = 	$row['critical'];
		$jogador['2']['velocidade'] = 	$row['velocidade'];
		$jogador['2']['expirience'] = 	$row['expirience'];
		$jogador['2']['img'] = 		$row['img'];
		$jogador['2']['gepys'] = 	$row['gepys'];
		$jogador['2']['type']=		$row['type'];
	
	

			/*
			 * TOPO , MOSTRA IMAGEM, NOME, EXP
			 */
			echo "
			<div style=\"height: 50px; border-radius: 5px 5px  0 0; background: url(./templates/jpeg.jpg) #FF6600;\">
				<div style=\"width: 50%; float: left; text-align: center; font-size: 25pt; color: #FFF;\">".$jogador['1']['name']."</div>
				<div style=\"width: 50%; float: left; text-align: center; font-size: 25pt; color: #FFF;\">".$jogador['2']['name']."</div>
			</div>
			<div style=\"height: 235px; border-left: 1px solid #CCC; border-right: 1px solid #CCC; background: #333\">
				<div style=\"width: 50%; float: left; text-align: center\"><img src='./".$jogador['1']['img']."' width='150px' height='235px'></div>
				<div style=\"width: 50%; float: left; text-align: center\"><img src='./".$jogador['2']['img']."' width='150px' height='235px'></div>
			</div>
			<div style=\"height: 50px; margin-bottom: 10px; border: 1px solid #FF9900; border-radius: 0 0 5px 5px; background: url(./templates/topbanner.jpg) #FF6600;\">
				<div style=\"width: 50%; float: left; text-align: center; font-size: 30pt; color: #FFF;\">".number_format($jogador['1']['expirience'],0,","," ")."</div>
				<div style=\"width: 50%; float: left; text-align: center; font-size: 30pt; color: #FFF;\">".number_format($jogador['2']['expirience'],0,","," ")."</div>
			</div>
			";
		
			/*
			 * EXECUTA SCRIPT PARA SABER QUEM IRÁ ATACAR 1º , SERA AQUELE COM MAIOR VELOCIDADE, EM CASO DE IGUALDADE, EXECUTA UM RANDOM
			 */
			if($jogador['1']['velocidade'] > $jogador['2']['velocidade']){$iniciar = 0;}
			elseif($jogador['1']['velocidade'] < $jogador['1']['velocidade']){$iniciar = 1;}
			else{$iniciar = rand(0, 1);}
		
			$result = game_combat($jogador['1'],$jogador['2'],$iniciar);
		
				/*
				 * GRAVA A DATA EM QUE FOI O ULTIMO JOGO
				 */
		
				$time = time();
				$query = "UPDATE g_char
				SET last_fight=".$time."
				WHERE user_id_ass=".($conta['0']);
				mysql_query($query);
		
			//CASO GANHE O JOGADOR 1
			if($result["win"] == 0)
		    	{	// ACTULIZAR JOGO WIN/LOSE
				$result["save1"] = "win = win + 1";
				// EXP --------------------------------------------
				    $jogador['1']['expirience'] = ($jogador['1']['expirience']) + ($exp = intval(($jogador['2']['expirience']) * 0.10 + 2));
				// GEPYS ----------------------------------------
				$jogador['1']['gepys'] = ($jogador['1']['gepys']) + ($gepys = intval(($jogador['2']['gepys']) * 0.10) + 2);
		
				game_history_monster_save($jogador['1'],$jogador['2'],$exp,$gepys,0,$result["history"]);

				echo "
					<div id=\"battle-result\">
						<div id=\"battle-result-value\"><span style=\"color: #000;\">V</span>encedor</div>
						<div  id=\"battle-result-value\"><span style=\"color: #000;\">D</span>errotado</div>
					</div>";
	
			}
			//CASO PERCA O JOGADOR 1
			elseif ($result["win"] == 1)
			{	// ACTULIZAR JOGO WIN/LOSE
				$result["save1"] = "lose = lose + 1";
				// EXP ------------------------------------------- 
				$jogador['1']['expirience'] = ($jogador['1']['expirience']) - ($exp = intval(($jogador['1']['expirience']) * 0.05));
				// GEPYS ---------------------------------------------
				$jogador['1']['gepys'] = ($jogador['1']['gepys']) - ($gepys = intval(($jogador['1']['gepys']) * 0.05));

				game_history_monster_save($jogador['1'],$jogador['2'],$exp,$gepys,1,$result["history"]);
		
				    if(($jogador['1']['expirience']) < 0){ $jogador['1']['expirience'] = 0;}
				if(($jogador['1']['gepys']) < 0){ $jogador['1']['gepys'] = 0;}
	
				    echo "
					<div id=\"battle-result\">
						<div id=\"battle-result-value\"><span style=\"color: #000;\">D</span>errotado</div>
						<div  id=\"battle-result-value\"><span style=\"color: #000;\">V</span>encedor</div>
					</div>";
			}

				/*
				 * GUARDA A EXP DO JOGADOR!
				 */
				$query = "UPDATE g_char SET expirience = '".($jogador['1']['expirience'])."', gepys = '".($jogador['1']['gepys'])."',".$result["save1"]." WHERE id = ".($jogador['1']['id']);
				mysql_query($query);






	
	}
	else
	{
		$multval = $tempo;include($path."game/timefunctionjs.php");
		echo "
		<div id=\"rlg-out\">
			<div id=\"rlg-time\">Faltam <span id='theTime' class='timeClass'></span> minutos</div>
			<div id=\"rlg-warning\">Só pode efectuar 1 combate na Selva a cada ".$tempo." min.</div>
		</div>";
	}
}
else
{
	echo "
		<div style=\"width: 398px; height: 132px; margin-left: auto; margin-right: auto;\">
			<div id=\"forest\" onclick=\"goTo('./?page=game&do=selva&accept=1')\">Floresta</div> 
			<div id=\"desert\">Deserto</div> 
			<div id=\"ocean\">Oceano</div>
		</div>";
}
?>
<?php $config["site_game_name"] .= " : Game : Selva";  ?>
