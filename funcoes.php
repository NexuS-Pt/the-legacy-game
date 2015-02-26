<?php
function conta_data($info){
    $data = explode(".",$info);
    return $data;
}

function login($email,$password,$time){
	

	$config["servidor"]			= "localhost";
	$config["utilizador"]			= "user";
	$config["palavrapasse"]			= "password";
	$config["basededados"]			= "basededados";
  	$cookie		               		= "nxs2011";

	//-----------------------------------------------------
	$con = mysql_connect ($config["servidor"],$config["utilizador"],$config["palavrapasse"]);
	
	if (!$con)
	{die ("Não foi possivel connectar:".mysql_error());}
	else
	{mysql_select_db($config["basededados"],$con); mysql_set_charset("utf8");}

	$password = MD5($password);
	
    	$query = "SELECT * FROM users WHERE email = '".$email."' && active = 1";
	$source = mysql_query($query);
	$search_2 = mysql_fetch_array($source);
	
	if ($password == $search_2["password"])
	{	
            $cook_id = $search_2['id'].'.'.$search_2['password'];
            $expira = time() + $time;
            setcookie($cookie,$cook_id,$expira);
			
			$p["real-user"] = true;
            $p["login"] = '<meta http-equiv="REFRESH" content="2;url=./">
		<p align="center"><img src="./media/imagens/i_true.png" class="decorationone"><br>Login Efectuado com sucesso!</p>';
	}
	elseif ($password != $search_2['password'])
	{
			$p["real-user"] = false;
        	$p["login"] = '
			<p align="center"><img src="./media/imagens/i_false.png" class="decorationone"><br>Erro, por favor verifique se os dados inseridos estão correctos, caso contrário, contacte a nossa administração!</p>';
	}

return $p;
}

function confirma_conta($data_cookie,$cookie){
    $conta = explode(".",$data_cookie);

    $query = "SELECT password FROM users WHERE id = '".$conta[0]."'";
    $source = mysql_query($query);
    while ($data = mysql_fetch_array($source)) { if ($conta[1] != $data["password"]) {echo "<meta http-equiv=\"REFRESH\" content=\"1;url=./?page=logout\">"; return false;} else {return true;}}	
}

function return_user_data() {
	global $conta;
	
	$query = "SELECT *,type AS previlegios FROM users WHERE id = '".$conta[0]."' LIMIT 1";
	$conta = mysql_fetch_array(mysql_query($query));
}

function utilizadores_quantidade($valor){
    $count = 0;
    $query = "SELECT type FROM users WHERE type = '$valor' AND active ='1'";
    $data_source = mysql_query($query);
    while($data = mysql_fetch_array($data_source))
    {
	$count++;
    }
	
    return $count;
}

function utilizadores_bloqueados(){
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

function return_username($id){
    $query = "SELECT username FROM users WHERE id = ".$id." LIMIT 1";
    $source = mysql_query($query);
    $data = mysql_fetch_array($source);

    return $data["username"];
}

function return_queryData($query){
    $source = mysql_query($query);
    $data = mysql_fetch_array($source);
    
    return $data;
}

function user_type($type){
    /*
     * Esta funçao destina-se ao retorno de uma String com o nome do tipo de utilizador
     * segundo uma variavel numerica introduzida por argumento
     */
    switch($type)
    {
        case 1:return "Administrador";break;
        case 2:return "Gestor";break;
        case 3:return "Membro da Equipa";break;
        case 4:return "Vip";break;
        case 5:return "Utilizador Mais"; break;
        case 6:return "Utilizador";break;
        default:return "ERRO! Avisar administração deste erro!"; break;
    }
}

function return_editor($usertype,$editordataprint){
	include("./editor/".$usertype.".php");
}

function send_mail_to($username,$email,$title,$message){
    // multiple recipients
    $to  = $email . ', '; // note the comma

    // subject
    $subject = $title;

    // message
    $message = '<html>
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>'.$title.'</title>
    </head>
    <body>
    <table align="center" width="450px">
            <tr>
                    <td  style="   	border: 1px solid #a9a9a9;
            font-family: \'Trebuchet MS\', Tahoma, Sans-serif;
            color: white;
            background: #f88c00;" align="right">NexuSystem</td>
            </tr>
            <tr>
                    <td style="	padding: 10px 10px 10px 10px;
            font: 70%/1.5em Verdana, Tahoma, arial, sans-serif;
            border: 1px solid #a9a9a9;">Olá '.$username.'!</td>
            </tr>
            <tr>
                    <td style="	padding: 10px 10px 10px 10px;
            font: 70%/1.5em Verdana, Tahoma, arial, sans-serif;">'.$message.'</td>
            </tr>
            <tr>
                    <td style="	text-align: center;
            margin: 0px;
            padding: 5px 0 5px 5px;  
            border: 1px solid #a9a9a9;
            font: 70%/1.5em Verdana, Tahoma, arial, sans-serif;
            background: #eaeaea;">© 2008 <b>NexuS-PT</b> | <b>Project since 2001</b> | Design by: NexuS-Pt</td>
            </tr>
    </table>
    </body>
    </html>';

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
    $headers .= 'From: NexuSystem <geral@nexusystem.com>' . "\r\n";

    // Mail it
    if (mail($to, $subject, $message, $headers)) {return true;}else{return false;}
}

function socialNetwork (){
    return "<p style=\"text-align:right;border: 1px solid #D0D0D0;padding: 1px 1px 1px 1px;\">Partilha : <script type=\"text/javascript\">
                    var switchTo5x=true;</script><script type=\"text/javascript\" src=\"http://w.sharethis.com/button/buttons.js\"></script>
                    <script type=\"text/javascript\">stLight.options({publisher:'d349ec71-f5f4-4cab-913e-cbf37e86db04'});
                </script>
        <span  class='st_twitter' ></span><span  class='st_facebook' ></span><span  class='st_google' ></span><span  class='st_messenger' ></span><span  class='st_formspring' ></span><span  class='st_blogger' ></span><span  class='st_email' ></span><span  class='st_sharethis' ></span></p>
";
}

function return_smiles($string){
	$path 	= "./images/smiles/";
	$before = "<img style=\"height: 18px;\" src=\"";
	$after 	= "\">";
	$smiles = array(
					$before.$path."k0259.gif".$after,		//:$
					$before.$path."k0224.gif".$after,		//^^
					$before.$path."k0224.gif".$after,		//:D
					$before.$path."k0202.gif".$after,		//>:C
					$before.$path."k0277.gif".$after,		//<3<3
					$before.$path."k0226.gif".$after,		//--'
					$before.$path."k0227.gif".$after,		//0.0
					$before.$path."k0252.gif".$after,		//xD
					$before.$path."k0254.gif".$after,		//>:P
					$before.$path."k0220.gif".$after,		//:'C
					$before.$path."k0293.gif".$after,		//:|
					$before.$path."k0290.gif".$after,		//>:)
					$before.$path."k0280.gif".$after,		//:ninja:
					$before.$path."k0260.gif".$after,		//:censured:
					$before.$path."k0292.gif".$after,		//:music:
					$before.$path."k0269.gif".$after,		//:none:
					$before.$path."k0219.gif".$after);		//:boss:
	$texto 	= array(
					":$",
					"^^",
					":D",
					">:C",
					"<3<3",
					"--'",
					"0.0",
					"xD",
					">:P",
					":'C",
					":|",
					">:)",
					":ninja:",
					":censured:",
					":music:",
					":none:",
					":boss:");
					
	return str_replace($texto,$smiles,$string);
}

function return_error(){
    print("<p align='center'><img src='./media/imagens/i_stop.png' class='decorationone'><br>Estás a procura de uma página que não existe!</p>
        <p align='center'>Caso ache que isto seja um erro, contacte: <a href=\"mailto:geral@nexus-pt.eu\">geral@nexus-pt.eu</a></p>");
}
/*   -----------------------------------------GAME--------------------------------------    */
/*   -----------------------------------------------------------------------------------    */
function return_charname($id){
    $query = "SELECT name FROM g_char WHERE id = '".$id."' LIMIT 1";
    $source = mysql_query($query);
    $data = mysql_fetch_array($source);

    return $data["name"];
}

function game_type_write($type){
    /*
     * Esta funçao destina-se ao retorno de uma String com o nome do tipo de Nexar
     * segundo uma variavel numerica introduzida por argumento
     */
    switch($type)
    {
        case 1:return "Água";break;
        case 2:return "Fogo"; break;
        case 3:return "Erva";break;
        case 4:return "Vento";break;
        case 5:return "Psiquico";break;
        case 6:return "Luz";break;
        case 7:return "Escuridão";break;
        case 8:return "Electricidade";break;
        case 9:return "Normal";break;
        default:return "ERRO! Avisar administração deste erro!"; break;
    }

}

function game_combat($jog1,$jog2,$i){
    /* 
     * variavel jog1, é um array que tem todos os dados do jogador#1
     * tendo como subdados #atk #def #vida #velocidade #dif #a-min #a-max 
     */
    $jog1['dif'] = 	abs(intval(($jog1['atk'] - $jog1['def']) / 2));
    $jog1['a-min'] = 	abs(intval($jog1['atk'] - $jog1['dif']));
    $jog1['a-max'] = 	abs(intval($jog1['atk'] + $jog1['dif']));

    /*
     * variavel jog2, é um array que tem todos os dados do jogador#2
     * tendo como subdados #atk #def #vida #velocidade #dif #a-min #a-max 
     */
    $jog2['dif'] = 	abs(intval(($jog2['atk'] - $jog2['def']) / 2));
    $jog2['a-min'] = 	abs(intval($jog2['atk'] - $jog2['dif']));
    $jog2['a-max'] = 	abs(intval($jog2['atk'] + $jog2['dif']));
    $p = "";
    
    $vantagem = 1.4;
    //VANTAGENS DE JOG1
    switch($jog1["type"])
    {
        case 1: //AGUA
            if($jog2["type"] == 2) //FOGO
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
            elseif($jog2["type"] == 6) //LUZ
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
	    else{$rage[1] = "Nivel de raiva de ".$jog1["name"]." foi mantido!";}
            break;
        case 2: //FOGO
            if($jog2["type"] == 3) //ERVA
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
            elseif($jog2["type"] == 5) //PSIQUICO
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
	    else{$rage[1] = "Nivel de raiva de ".$jog1["name"]." foi mantido!";}
            break;
        case 3: //ERVA
            if($jog2["type"] == 1) //AGUA
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
            elseif($jog2["type"] == 8) //ELECTRICIDADE
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
	    else{$rage[1] = "Nivel de raiva de ".$jog1["name"]." foi mantido!";}
            break;
        case 4: //VENTO
            if($jog2["type"] == 2) //FOGO
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
            elseif($jog2["type"] == 3) //ERVA
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
	    else{$rage[1] = "Nivel de raiva de ".$jog1["name"]." foi mantido!";}
            break;
        case 5: //PSIQUICO
            if($jog2["type"] == 6) //LUZ
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
            elseif($jog2["type"] == 8) //ELECTRICIDADE
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
	    else{$rage[1] = "Nivel de raiva de ".$jog1["name"]." foi mantido!";}
            break;
        case 6: //LUZ
            if($jog2["type"] == 7) //ESCURIDAO
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
            elseif($jog2["type"] == 4) //VENTO
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
	    else{$rage[1] = "Nivel de raiva de ".$jog1["name"]." foi mantido!";}
            break;
        case 7: //ESCURIDAO
            if($jog2["type"] == 7) //ESCURIDAO
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
            elseif($jog2["type"] == 5) //PSIQUICO
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
	    else{$rage[1] = "Nivel de raiva de ".$jog1["name"]." foi mantido!";}
            break;
        case 8: //ELECTRICIDADE
            if($jog2["type"] == 1) //AGUA
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
            elseif($jog2["type"] == 4) //VENTO
            {$jog1["atk"] *= $vantagem;$jog1["def"] *= ($vantagem - 0.2);$rage[1] = $jog2["name"]." é um complementar de ".$jog1["name"].", nivel de raiva subiu!";}
	    else{$rage[1] = "Nivel de raiva de ".$jog1["name"]."foi mantido!";}
            break;
	default:
	    $rage[1] = "Nivel de raiva de ".$jog1["name"]." foi mantido!";
	    break;
    }
    
    //VANTAGENS DE JOG2
    switch($jog2["type"])
    {
        case 1: //AGUA
            if($jog1["type"] == 2) //FOGO
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
            elseif($jog1["type"] == 6) //LUZ
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
	    else{$rage[2] = "Nivel de raiva de ".$jog2["name"]." foi mantido!";}
            break;
        case 2: //FOGO
            if($jog1["type"] == 3) //ERVA
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
            elseif($jog1["type"] == 5) //PSIQUICO
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
	    else{$rage[2] = "Nivel de raiva de ".$jog2["name"]." foi mantido!";}
            break;
        case 3: //ERVA
            if($jog1["type"] == 1) //AGUA
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
            elseif($jog1["type"] == 8) //ELECTRICIDADE
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
	    else{$rage[2] = "Nivel de raiva de ".$jog2["name"]." foi mantido!";}
            break;
        case 4: //VENTO
            if($jog1["type"] == 2) //FOGO
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
            elseif($jog1["type"] == 3) //ERVA
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
	    else{$rage[2] = "Nivel de raiva de ".$jog2["name"]." foi mantido!";}
            break;
        case 5: //PSIQUICO
            if($jog1["type"] == 6) //LUZ
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
            elseif($jog1["type"] == 8) //ELECTRICIDADE
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
	    else{$rage[2] = "Nivel de raiva de ".$jog2["name"]." foi mantido!";}
            break;
        case 6: //LUZ
            if($jog1["type"] == 7) //ESCURIDAO
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
            elseif($jog1["type"] == 4) //VENTO
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
	    else{$rage[2] = "Nivel de raiva de ".$jog2["name"]." foi mantido!";}
            break;
        case 7: //ESCURIDAO
            if($jog1["type"] == 7) //ESCURIDAO
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
            elseif($jog1["type"] == 5) //PSIQUICO
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
	    else{$rage[2] = "Nivel de raiva de ".$jog2["name"]." foi mantido!";}
            break;
        case 8: //ELECTRICIDADE
            if($jog1["type"] == 1) //AGUA
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
            elseif($jog1["type"] == 4) //VENTO
            {$jog2["atk"] *= $vantagem;$jog2["def"] *= ($vantagem - 0.2);$rage[2] = $jog1["name"]." é um complementar de ".$jog2["name"].", nivel de raiva subiu!";}
	    else{$rage[2] = "Nivel de raiva de ".$jog2["name"]." foi mantido!";}
            break;
	default:
	    $rage[2] = "Nivel de raiva de ".$jog2["name"]." foi mantido!";
	    break;
    }
    
	/* Impressão das pontuações de vida, antes do combate iniciar */
	$p .= "
	<div style=\"height: 100px; margin-bottom: 20px; color: #FFF;\">
		<div style=\"height: 70px; background: url(./templates/jpeg.jpg) #FF6600; border-radius: 4px 4px 0 0;\">
			<div style=\"width: 50%; float: left; text-align: center; padding-top: 7px;\">
				Vida inicial de ".$jog1['name']."<br>
				<span style=\"font-size: 26pt;\">".number_format($jog1['vida'],0,","," ")."</span>
			</div>
			<div style=\"width: 50%; float: left; text-align: center; padding-top: 7px;\">
				Vida inicial de ".$jog2['name']."<br>
				<span style=\"font-size: 26pt;\">".number_format($jog2['vida'],0,","," ")."</span>
			</div>
		</div>
		<div style=\"height: 30px; background: url(./templates/topbanner.jpg) #FF6600;border-radius: 0 0 4px 4px;\">
			<div style=\"width: 50%; float: left; text-align: center; line-height: 30px;\">
				".$rage[1]."
			</div>
			<div style=\"width: 50%; float: left; text-align: center; line-height: 30px;\">
				".$rage[2]."
			</div>
		</div>
	</div>
	";

	$p .= "
			<div id=\"battle-history-top\">Histórico de Batalha</div>
		<div id=\"battle-history-content\">
	
	";
	
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
                    $p = $p."<div id=\"battle-history-me\"><img style=\"width: 14px;\" src=\"./templates/arrow-show-previous-white.png\">".$jog1['name'].": Ataque Critical falhou.</div>";
                }
                else
                {
                    $jog2['vida'] = $jog2['vida'] - $retirar;
                    $p = $p."<div id=\"battle-history-me\"><img style=\"width: 14px;\" src=\"./templates/arrow-show-previous-white.png\">".$jog1['name'].": Ataque Critical de ".number_format($retirar,0,","," ").".</div>";
                }
            }
            else
            {
                $retirar = rand(($jog1['a-min']),($jog1['a-max'])) - $jog2['def'];

                if ($retirar <= 0)
                {
                    $p = $p."<div id=\"battle-history-me\"><img style=\"width: 14px;\" src=\"./templates/arrow-show-previous-white.png\">".$jog1['name'].": Ataque falhou.</div>";
                }
                else
                {
                    $jog2['vida'] = $jog2['vida'] - $retirar;
                    $p = $p."<div id=\"battle-history-me\"><img style=\"width: 14px;\" src=\"./templates/arrow-show-previous-white.png\">".$jog1['name'].": Ataque de ".number_format($retirar,0,","," ").".</div>";
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
                    $p = $p."<div id=\"battle-history-nome\">".$jog2['name'].": Ataque Critical falhou.<img style=\"width: 14px;\" src=\"./templates/arrow-show-next-white.png\"></div>";
                }
                else
                {
                    $jog1['vida'] = $jog1['vida'] - $retirar;
                    $p = $p."<div id=\"battle-history-nome\">".$jog2['name'].": Ataque Critical de ".number_format($retirar,0,","," ").".<img style=\"width: 14px;\" src=\"./templates/arrow-show-next-white.png\"></div>";
                }
            }
            else
            {
                $retirar = rand(($jog2['a-min']),($jog2['a-max'])) - $jog1['def'];

                if ($retirar <= 0)
                {
                    $p = $p."<div id=\"battle-history-nome\">".$jog2['name'].": Ataque falhou.<img style=\"width: 14px;\" src=\"./templates/arrow-show-next-white.png\"></div>";
                }
                else
                {
                    $jog1['vida'] = $jog1['vida'] - $retirar;
                    $p = $p."<div id=\"battle-history-nome\">".$jog2['name'].": Ataque de ".number_format($retirar,0,","," ").".<img style=\"width: 14px;\" src=\"./templates/arrow-show-next-white.png\"></div>";
                }
            }

            $i++;
        }
    }
    

	$p .= "
			</div>
		<div id=\"battle-history-footer\"></div>
	";
	
	$p .= "
	<div style=\"height: 70px; background: url(./templates/jpeg.jpg) #FF6600; border-radius: 4px 4px 0 0; color: #FFF;\">
		<div style=\"width: 50%; float: left; text-align: center; padding-top: 7px;\">
			Vida final de ".$jog1['name']."<br>
			<span style=\"font-size: 26pt;\">".number_format($jog1['vida'],0,","," ")."</span>
		</div>
		<div style=\"width: 50%; float: left; text-align: center; padding-top: 7px;\">
			Vida  final de ".$jog2['name']."<br>
			<span style=\"font-size: 26pt;\">".number_format($jog2['vida'],0,","," ")."</span>
		</div>
	</div>
	";

	//impressao de todo o $p -- que contem todo o historico de combate
	print $p;    
	$result["history"] = $p;
    if ($jog2['vida'] < 0)
	{$result["win"] = 0;}
    elseif ($jog1['vida'] < 0)
	{$result["win"] = 1;}
	return $result;
}    
function game_skill_value($skill,$valor){
	/*
	 * Esta função retorna o valor a pagar em gepys por determinado SKILL
	 */
    switch ($skill)
    {
        case 1: /* ATK */ return intval((($valor + 1) * 1.25) + ($valor / 2));break;
        case 2: /* DEF */ return intval((($valor + 1) * 1.25) + ($valor / 2));break;
        case 3: /* VELOCIDADE */ return intval((($valor + 2) * 1.5) + ($valor / 1.8));break;
        case 4:/* VIDA */ return intval((($valor + 3) * 2) + ($valor / 1.5));break;
    }
}

function game_history_save($vencedor,$perdedor,$exp_ganha,$exp_perdida,$gepys_ganha,$gepys_perdida,$historico){
    // GRAVAR NO HISTORICO DE JOGO, O RESULTADO DO VENCEDOR
    $dados = "Ganhaste contra ".$perdedor['name'].", ".$exp_ganha." exp ganha, ".$gepys_ganha." Gepys ganhos!";
    $query = "INSERT INTO g_history (user_id_ass,frase,history,type,time) VALUES ('".$vencedor['id']."','".$dados."','".$historico."','W','".time()."')";	
    mysql_query($query);

    // GRAVAR NO HISTORICO DE JOGO, O RESULTADO DO PERDEDOR
    $dados = "Perdeste contra ".$vencedor['name'].", ".$exp_perdida." exp perdida, ".$gepys_perdida." Gepys perdidos!";
    $query = "INSERT INTO g_history (user_id_ass,frase,history,type,time) VALUES ('".$perdedor['id']."','".$dados."','".$historico."','L','".time()."')";	
    mysql_query($query);
}

function game_history_monster_save($player,$monster,$exp,$gepys,$valor,$historico){	
    if ($valor == 0)
    {
        // GRAVAR NO HISTORICO DE JOGO, O RESULTADO DO VENCEDOR
        $dados = "Ganhaste contra ".$monster['name'].", ".$exp." exp ganha, ".$gepys." Gepys ganhos!";
        $query = "INSERT INTO  g_history (user_id_ass,frase,history,type,time) VALUES ('".$player['id']."','".$dados."','".$historico."','W','".time()."')";	
        mysql_query($query);
    }
    elseif($valor == 1)
    {
        // GRAVAR NO HISTORICO DE JOGO, O RESULTADO DO PERDEDOR
        $dados = "Perdeste contra ".$monster['name'].", ".$exp." exp perdida, ".$gepys." Gepys perdidos!";
        $query = "INSERT INTO g_history (user_id_ass,frase,history,type,time) VALUES ('".$player['id']."','".$dados."','".$historico."','L','".time()."')";	
        mysql_query($query);
    }
}

function game_equips_return($player,$part){
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
