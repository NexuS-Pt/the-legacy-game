<?php

function conta_data($info){
    $data = explode(".",$info);
    return $data;
}

function login($email,$password){

	$config["servidor"]		= "hostingmysql50.amen.pt";
	$config["utilizador"]		= "CS304_admin";
	$config["palavrapasse"]		= "Comunidade11_";
	$config["basededados"]		= "nexusystem_com_db";
    	$cookie		                = "nxs2011";



	//-----------------------------------------------------
	$con = mysql_connect ($config["servidor"],$config["utilizador"],$config["palavrapasse"]);
	
	if (!$con)
	{
		die ("Não foi possivel connectar:".mysql_error());
	}
	else
	{
		mysql_select_db($config["basededados"],$con);
		mysql_set_charset("utf8");
	}


	$password = MD5($password);
	
    $query = "SELECT id,email,password,template FROM users WHERE email = '".$email."' && active = 1";
	$source = mysql_query($query);
	$search_2 = mysql_fetch_array($source);
	
	
	if ($password == $search_2['password'])
	{	
        $cook_id = $search_2['id'].'.'.$search_2['password'].'.'.$search_2['template'];
		$expira = time() + 60 * 60 * 24;
		setcookie($cookie,$cook_id,$expira);
		
        $p = '<meta http-equiv="REFRESH" content="60;url=./">
		<p align="center"><img src="./media/imagens/i_true.png" class="decorationone"><br>Login Efectuado com sucesso!</p>';
	}
	elseif ($password != $search_2['password'])
	{
        	$p = '
			<p align="center"><img src="./media/imagens/i_false.png" class="decorationone"><br>Erro, por favor verifique se os dados inseridos estão correctos, caso contrário, contacte a nossa administração!!</p>';
	}

return $p;
}

function confirma_conta($data_cookie,$cookie){
	
	$conta = explode(".",$data_cookie);
	
	$id = $conta[0];
	$password = $conta[1];
	
	$query = "SELECT password FROM users WHERE id = '$id'";
	$source = mysql_query($query);
	while ($data = mysql_fetch_array($source)) { if ($password != $data["password"]) { setcookie("$cookie","",time() - 1);}}	
}

function utilizadores_quantidade($valor)
{
	$count = 0;
$query = "SELECT type FROM users WHERE type = '$valor' AND active ='1'";
$data_source = mysql_query($query);
while($data = mysql_fetch_array($data_source)) {
	$count++;
	}
	
	return $count;
}

function utilizadores_bloqueados() {
	$count = 0;
	$query = "SELECT type FROM users WHERE active ='0'";
	$data_source = mysql_query($query);
	while($data = mysql_fetch_array($data_source)) {
	$count++;
	}
	return $count;
}

function code_nexar($str){
    $valor = chunk_split($str,1,".");
    $array = explode(".", $valor);

        return $array;
}

function code_nexar_printer($array){
    for($i=sizeof($array)-2;$i>=0;$i--) {echo "<img src='./media/imagens/nxschars/".strtolower ( $array[$i]).".jpg' style='border:none;height:20px;'>";}
}

function name_checker($str){
    $valor = str_replace("."," ",$str);

    return $valor;
}

/*   -----------------------------------------GAME--------------------------------------    */
/*   -----------------------------------------------------------------------------------    */

function game_type_write($type)
{

    switch($type)
    {
        case 1:
            return "Água";
            break;
        case 2:
            return "Fogo";
            break;
        case 3:
            return "Erva";
            break;
        case 4:
            return "Vento";
            break;
        case 5:
            return "Psiquico";
            break;
        case 6:
            return "Luz";
            break;
        case 7:
            return "Escuridão";
            break;
        case 8:
            return "Electricidade";
            break;
        case 9:
            return "Normal";
            break;
        default:
            return "ERRO! Avisar administração deste erro!";
            break;
    }

}

function game_combat($jog1,$jog2,$i)
{
	$jog1['dif'] = 	abs(intval(($jog1['atk'] - $jog1['def']) / 2));
    $jog1['a-min'] = 	abs(intval($jog1['atk'] - $jog1['dif']));
    $jog1['a-max'] = 	abs(intval($jog1['atk'] + $jog1['dif']));

	$jog2['dif'] = 	abs(intval(($jog2['atk'] - $jog2['def']) / 2));
    $jog2['a-min'] = 	abs(intval($jog2['atk'] - $jog2['dif']));
    $jog2['a-max'] = 	abs(intval($jog2['atk'] + $jog2['dif']));
    $p = "";
    
    print "-- Vida Inicial --<br>";
    print $jog1['name']." : ".$jog1['vida']."<br>";
    print $jog2['name']." : ".$jog2['vida'];
    print "<br>------------------<br>";

    while($jog1['vida'] > 0 && $jog2['vida'] > 0)
    {
        if (($i % 2) == 0)
        {
            // PRIMEIRO JOGADOR
            if(rand(0,100) <= $jog1['critical'])
            {
                $retirar = (rand(($jog1['a-min']),($jog1['a-max'])) * 1.5) - $jog2['def'];

                if ($retirar <= 0)
                {
                    $p = $p.$jog1['name'].": Ataque Critical falhou.<br>";
                }
                else
                {
                    $jog2['vida'] = $jog2['vida'] - $retirar;
                    $p = $p.$jog1['name'].": Ataque Critical de ".$retirar.".\n";
                }
            }
            else
            {
                $retirar = rand(($jog1['a-min']),($jog1['a-max'])) - $jog2['def'];

                if ($retirar <= 0)
                {
                    $p = $p.$jog1['name'].": Ataque falhou.<br>";
                }
                else
                {
                    $jog2['vida'] = $jog2['vida'] - $retirar;
                    $p = $p.$jog1['name'].": Ataque de ".$retirar.".<br>";
                }
            }

            $i++;
        }
        elseif(($i % 2) != 0)
        {
            // SEGUNDO JOGADOR
            if(rand(0,100) <= $jog2['critical'])
            {
                $retirar = (rand(($jog2['a-min']),($jog2['a-max'])) * 1.5) - $jog1['def'];

                if ($retirar <= 0)
                {
                    $p = $p.$jog2['name'].": Ataque Critical falhou.<br>";
                }
                else
                {
                    $jog1['vida'] = $jog1['vida'] - $retirar;
                    $p = $p.$jog2['name'].": Ataque Critical de ".$retirar.".<br>";
                }
            }
            else
            {
                $retirar = rand(($jog2['a-min']),($jog2['a-max'])) - $jog1['def'];

                if ($retirar <= 0)
                {
                    $p = $p.$jog2['name'].": Ataque falhou.<br>";
                }
                else
                {
                    $jog1['vida'] = $jog1['vida'] - $retirar;
                    $p = $p.$jog2['name'].": Ataque de ".$retirar.".<br>";
                }
            }

            $i++;
    }
}
    print $p."<br><br>";
    print "-- Vida Final --<br>";
    print $jog1['name']." : ".$jog1['vida']."<br>";
    print $jog2['name']." : ".$jog2['vida'];
    
    if ($jog2['vida'] < 0){return 0;}
    elseif ($jog1['vida'] < 0){return 1;}
}
    
function game_skill_value($skill,$valor)
{
    switch ($skill)
    {
        case 1:
            /*
             * ATK
             */
            return intval((($valor + 1) * 1.25) + ($valor / 2));
            break;
        case 2:
            /*
             * DEF
             */
            return intval((($valor + 1) * 1.25) + ($valor / 2));
            break;
        case 3:
            /*
             * VELOCIDADE
             */
            return intval((($valor + 2) * 1.5) + ($valor / 1.8));
            break;
        case 4:
            /*
             * VIDA
             */
            return intval((($valor + 3) * 2) + ($valor / 1.5));
            break;
    }
}

function game_history_save($vencedor,$perdedor,$exp_ganha,$exp_perdida,$gepys_ganha,$gepys_perdida)
{
	// GRAVAR NO HISTORICO DE JOGO, O RESULTADO DO VENCEDOR
	$dados = "Ganhas-te contra ".$perdedor['name'].", ".$exp_ganha." exp ganha, ".$gepys_ganha." Gepys ganhos!";
	$query = "INSERT INTO  g_history (user_id_ass,frase,type) VALUES ('".$vencedor['id']."','".$dados."','W')";	
	mysql_query($query);

	// GRAVAR NO HISTORICO DE JOGO, O RESULTADO DO PERDEDOR
	$dados = "Perdes-te contra ".$vencedor['name'].", ".$exp_perdida." exp perdida, ".$gepys_perdida." Gepys perdidos!";
	$query = "INSERT INTO  g_history (user_id_ass,frase,type) VALUES ('".$perdedor['id']."','".$dados."','L')";	
	mysql_query($query);
}

function game_history_monster_save($player,$monster,$exp,$gepys,$valor)
{
	if ($valor == 0)
	{
		// GRAVAR NO HISTORICO DE JOGO, O RESULTADO DO VENCEDOR
		$dados = "Ganhas-te contra ".$monster['name'].", ".$exp." exp ganha, ".$gepys." Gepys ganhos!";
		$query = "INSERT INTO  g_history (user_id_ass,frase,type) VALUES ('".$player['id']."','".$dados."','W')";	
		mysql_query($query);
	}
	elseif($valor == 1)
	{
		// GRAVAR NO HISTORICO DE JOGO, O RESULTADO DO PERDEDOR
		$dados = "Perdes-te contra ".$monster['name'].", ".$exp." exp perdida, ".$gepys." Gepys perdidos!";
		$query = "INSERT INTO  g_history (user_id_ass,frase,type) VALUES ('".$player['id']."','".$dados."','L')";	
		mysql_query($query);
	}
}

function game_equips_return($player,$part)
{
	$query = "SELECT
g_bag.id,
g_equips.id AS `equip_id`,
g_equips.`name`,
g_equips.atk,
g_equips.def,
g_equips.velocidade,
g_equips.vida,
g_equips.critical
FROM
g_bag
INNER JOIN g_equips ON g_bag.equip_id_ass = g_equips.id
WHERE
g_bag.equiped = 1 AND
g_bag.user_id_ass = ".$player." AND
g_equips.part = '".$part."'";

	$result = mysql_query($query);

	if (mysql_num_rows($result) == 1)
	{
		$row = mysql_fetch_array($result);
		
		$data['atk'] 		= $row['atk'];
		$data['def'] 		= $row['def'];
		$data['velocidade'] 	= $row['velocidade'];
		$data['vida'] 		= $row['vida'];
		$data['critical'] 	= $row['critical'];
		$data['equip_id'] 	= $row['equip_id'];
		$data['id'] 		= $row['id'];
	}
	else
	{
		$data['atk'] 		= 0;
		$data['def'] 		= 0;
		$data['velocidade'] 	= 0;
		$data['vida'] 		= 0;
		$data['critical'] 	= 0;
		$data['equip_id'] 	= "no-equip-".$part;
		$data['id'] 		= null;
	}
	return $data;
}

?>
