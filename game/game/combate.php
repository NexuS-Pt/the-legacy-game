<?php

$adversario = intval($_GET['adv']);

//PARA VIPS E PARA NORMAIS
if($conta["previlegios"] <= 4){$tempo = 5;}
elseif ($conta["previlegios"] == 5) {$tempo = 8;}
else {$tempo = 10;}

if($conta['game']['last_fight_with'] != $adversario)
{
    if (($conta['game']['last_fight']) < ((time()) - (60 * $tempo)))
    {
        //JOGADOR 1------------------------------------------------------------------------------------------------------------------------
        $query = "SELECT * FROM g_char WHERE id = '".$conta['game']['id']."' LIMIT 1";
        $result = mysql_query($query);
        $jogador['1'] = mysql_fetch_array($result);

        if ($adversario == ($jogador['1']['id']))
        {
            echo "
			<div id=\"rlg-out\">
				<div id=\"rlg-time\" style=\"font-size: 15pt; color: #FFF;\">Não é possivel combateres contra ti mesmo!</div>
				<div id=\"rlg-warning\">Sistema de Equipamento</div>
			</div>";
        }
        else
        {	
            /* Iniciar variaveis de valor de combate do jogador n1, este calcula os valores sobre os niveis que o jogador possui.
            atk = (nvl de atk + 1) * 10.45  -- só conta o valor inteiro do mesmo
            def = (nvl de def + 1 ) * 5.7 -- só conta o valor inteiro do mesmo
            vida = ((nvl de vida * 1.3) + 1) * 50.7 -- só conta o valor inteiro do mesmo
            critical = iniciado a 0, pois só conta como percentagem */
            $jogador['1']['atk'] 			= 	intval((($jogador['1']['atk'] + 1) * 10.45) * (1 + ($jogador['1']['velocidade'] / $jogador['1']['def'])));
            $jogador['1']['def'] 			= 	intval((($jogador['1']['def'] + 1) * 5.7) * (1 + ($jogador['1']['velocidade'] / $jogador['1']['def'])));
            $jogador['1']['vida'] 			= 	intval((($jogador['1']['vida'] * 1.3) + 1) * 123.15);
            $jogador['1']['critical'] 			= 	0;

            /* Obter equips equipados no char do jogador n1, obtendo assim tambem o atk, a def, a vida, a velocidade e o critical
            Todos esses dados sao obtidos como VEC, não como nvl */
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
                /* Adicionar cada valor do equip ao VEC já iniciado nos calculos dos niveis do jogador */

                $jogador['1']['atk'] 		= 	$jogador['1']['atk'] 		+ $jogador['1']['equips']['atk'];
                $jogador['1']['def'] 		= 	$jogador['1']['def'] 		+ $jogador['1']['equips']['def'];
                $jogador['1']['velocidade']         = 	$jogador['1']['velocidade']     + $jogador['1']['equips']['velocidade'];
                $jogador['1']['vida'] 		= 	$jogador['1']['vida'] 		+ $jogador['1']['equips']['vida'];
                $jogador['1']['critical']           = 	$jogador['1']['critical'] 	+ $jogador['1']['equips']['critical'];
            }

            //JOGADOR 2 ------------------------------------------------------------------------------------------------------------------------------------
            $query = "SELECT * FROM g_char WHERE id = '$adversario' LIMIT 1";
            $result = mysql_query($query);
            $jogador['2'] = mysql_fetch_array($result);

            /* Iniciar variaveis de valor de combate do jogador n2, este calcula os valores sobre os niveis que o jogador possui.
            atk = (nvl de atk + 1) * 10.45  -- só conta o valor inteiro do mesmo
            def = (nvl de def + 1 ) * 5.7 -- só conta o valor inteiro do mesmo
            vida = ((nvl de vida * 1.3) + 1) * 50.7 -- só conta o valor inteiro do mesmo
            critical = iniciado a 0, pois só conta como percentagem */
            $jogador['2']['atk'] 			= 	intval((($jogador['2']['atk'] + 1) * 10.45) * (1 + ($jogador['2']['velocidade'] / $jogador['2']['def'])));
            $jogador['2']['def'] 			= 	intval((($jogador['2']['def'] + 1) * 5.7) * (1 + ($jogador['2']['velocidade'] / $jogador['2']['def'])));
            $jogador['2']['vida'] 			= 	intval((($jogador['2']['vida'] * 1.3) + 1) * 123.15);
            $jogador['2']['critical'] 		= 	0;

            /* Obter equips equipados no char do jogador n2, obtendo assim tambem o atk, a def, a vida, a velocidade e o critical
            Todos esses dados sao obtidos como VEC, não como nvl */
            $miniquery = "SELECT
                    `g_equips`.`atk` AS `atk`,
                    `g_equips`.`def` AS `def`,
                    `g_equips`.`velocidade` AS `velocidade`,
                    `g_equips`.`vida` AS `vida`,
                    `g_equips`.`critical` AS `critical`
                    FROM ((`g_equips` join `g_bag` on((`g_bag`.`equip_id_ass` = `g_equips`.`id`))) join `g_char` on((`g_char`.`id` = `g_bag`.`user_id_ass`)))
                    WHERE ((`g_bag`.`equiped` = 1) and (`g_char`.`id` = ".$jogador['2']['id']."))";

            $result = mysql_query($miniquery);

            while($jogador['2']['equips'] 	= mysql_fetch_array($result))
            {
                $jogador['2']['atk'] 		= 	$jogador['2']['atk'] 		+ $jogador['2']['equips']['atk'];
                $jogador['2']['def'] 		= 	$jogador['2']['def'] 		+ $jogador['2']['equips']['def'];
                $jogador['2']['velocidade']         = 	$jogador['2']['velocidade']     + $jogador['2']['equips']['velocidade'];
                $jogador['2']['vida'] 		= 	$jogador['2']['vida'] 		+ $jogador['2']['equips']['vida'];
                $jogador['2']['critical']           = 	$jogador['2']['critical'] 	+ $jogador['2']['equips']['critical'];
            }


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
            elseif($jogador['1']['velocidade'] < $jogador['2']['velocidade']){$iniciar = 1;}
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
		$result["save-1"] = "win = win + 1";
		$result["save-2"] = "lose = lose + 1"; 
                // EXP --------------------------------------------
                $jogador['1']['expirience'] = 	($jogador['1']['expirience']) + ($exp_1 = intval(($jogador['2']['expirience']) * 0.25 + 2));
                $jogador['2']['expirience'] = 	($jogador['2']['expirience']) - ($exp_2 = intval(($jogador['2']['expirience']) * 0.125));
                // GEPYS ----------------------------------------
                $jogador['1']['gepys'] 		= 	($jogador['1']['gepys']) + ($gepys_1 = intval(($jogador['2']['gepys']) * 0.25 + 2));
                $jogador['2']['gepys'] 		= 	($jogador['2']['gepys']) - ($gepys_2 = intval(($jogador['2']['gepys']) * 0.125));

                game_history_save($jogador['1'],$jogador['2'],$exp_1,$exp_2,$gepys_1,$gepys_2,$result["history"]);

                if(($jogador['2']['expirience']) < 0){ $jogador['2']['expirience'] = 0;}
                if(($jogador['2']['gepys']) < 0){ $jogador['2']['gepys'] = 0;}

               	echo "
					<div id=\"battle-result\">
						<div id=\"battle-result-value\"><span style=\"color: #000;\">V</span>encedor</div>
						<div  id=\"battle-result-value\"><span style=\"color: #000;\">D</span>errotado</div>
					</div>";

            }
            //CASO GANHE O JOGADOR 2
            elseif ($result["win"] == 1)
            {	// ACTULIZAR JOGO WIN/LOSE
		$result["save-1"] = "lose = lose + 1";
		$result["save-2"] = "win = win + 1"; 
                // EXP ------------------------------------------- 
                $jogador['2']['expirience'] = 	($jogador['2']['expirience']) + ($exp_2 = intval(($jogador['1']['expirience']) * 0.25 + 2));
                $jogador['1']['expirience'] =	($jogador['1']['expirience']) - ($exp_1 = intval(($jogador['1']['expirience']) * 0.125));
                // GEPYS --------------------------------------------- 
                $jogador['2']['gepys'] =	($jogador['2']['gepys']) + ($gepys_2 = intval(($jogador['1']['gepys']) * 0.25 + 2));
                $jogador['1']['gepys'] = 	($jogador['1']['gepys']) - ($gepys_1 = intval(($jogador['1']['gepys']) * 0.125));

                game_history_save($jogador['2'],$jogador['1'],$exp_2,$exp_1,$gepys_2,$gepys_1,$result["history"]);

                if(($jogador['1']['expirience']) < 0){ $jogador['1']['expirience'] = 0;}
                if(($jogador['1']['gepys']) < 0){ $jogador['1']['gepys'] = 0;}

                echo "
					<div id=\"battle-result\">
						<div id=\"battle-result-value\"><span style=\"color: #000;\">D</span>errotado</div>
						<div  id=\"battle-result-value\"><span style=\"color: #000;\">V</span>encedor</div>
					</div>";
            }

            // SALVAR O last_fight_with !				
            $query = "UPDATE g_char SET last_fight_with = '".$adversario."' WHERE id = '".$conta['game']['id']."'";
            if (mysql_query($query)){print("<input type=\"hidden\" value=\"true\">");}else{print("<input type=\"hidden\" value=\"false\">");}

            //GUARDA A EXP DOS 2 JOGADORES!
            $query = "UPDATE g_char SET expirience = ".($jogador['1']['expirience']).", gepys = ".($jogador['1']['gepys']).", ".$result["save-1"]." WHERE id = ".($jogador['1']['id']);
            mysql_query($query);
            $query = "UPDATE g_char SET expirience = ".($jogador['2']['expirience']).", gepys = ".($jogador['2']['gepys']).", ".$result["save-2"]." WHERE id = ".($jogador['2']['id']);
            mysql_query($query);
        }		
    }
    else
    {
        $multval = $tempo;include($path."game/timefunctionjs.php");
        echo "
		<div id=\"rlg-out\">
			<div id=\"rlg-time\">Faltam <span id='theTime' class='timeClass'></span> minutos</div>
			<div id=\"rlg-warning\">Só pode efectuar 1 combate a cada ".$tempo." min.</div>
		</div>";
    }
}
else
{
    echo "
		<div id=\"rlg-out\">
			<div id=\"rlg-time\" style=\"font-size: 15pt; color: #FFF;\">Não podes combater consecutivamente com 1 jogador.</div>
			<div id=\"rlg-warning\">Sistema de Protecção de Vitimas de Abuso</div>
		</div>";
}
		
?>
<?php $config["site_game_name"] .= " : Game : Combate";  ?>
