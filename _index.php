<?php
	include("./funcoes.php");
	include("./language.php");

	// ---------------------------------- LOGIN ----------------------------------------------
	if(isset($_POST["validar"])){$p = login($_POST['email'],$_POST['password']);}

	// --------------------------------- LOGOUT ----------------------------------------------
	if(!empty($_GET['page'])) 
	{
		switch($_GET['page'])
		{
			case 'logout':
				include('logout.php');
				break;
		}
	}

   	include("./config.php");
	// -------------------- CONFIRMAR SE A CONTA EXISTE OU SE FOI ALTERADA -------------------------------
    if (isset($_COOKIE[$cookie]))
	{	

		$conta = conta_data($_COOKIE[$cookie]);
		confirma_conta($_COOKIE[$cookie],$cookie);
		
	}
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="shortcut" icon href="favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="./tpl_css.css" type="text/css" />

	<meta name="Description" content="NexuS! O melhor de uma comunidade está aqui!" />
	<meta name="Keywords" content="nexus,nexusystem,comunity,comunidade,sistema,ligação" />
	<meta name="Distribution" content="Global" />
	<meta name="author" content="NexuS-PT" />
	<meta name="Robots" content="index,follow" />

	<script type="text/javascript" src="./about/js/simpletabs_1.3.js"></script>
	<script src="./images/jquery.js" type="text/javascript"></script>
  	<script src="./images/javascript.js" type="text/javascript"></script>
</head>

<body bgcolor="black">
	
	<table align="center" width="900px" bgcolor="white" class="table_body">
		<!-- CABEÇALHO -->
		<tr>
			<td class="cabecalho"><h2><?php if ($config["site_name_on"]) {echo $config["site_name"];} ?></h2></td>
		</tr>
	<?php if(isset($_COOKIE[$cookie]))
	{ ?>
		<!-- MENU -->
		<tr>
			<td class="menu"><div class="buttons">

				<a href="./">
					<img src="./button-img.png" alt=""/> 
					Inicio
				</a>
				<a href="./game">
					<img src="./button-img.png" alt=""/> 
					Jogo
				</a>
				<a href="?page=forum">
					<img src="./button-img.png" alt=""/> 
					Forum
				</a>
				<a href="?page=account">
					<img src="./button-img.png" alt=""/> 
					Conta
				</a>
				<a href="?page=about">
					<img src="./button-img.png" alt=""/> 
					Sobre
				</a>
				<a href="?page=logout">
					<img src="./button-img.png" alt=""/> 
					Sair
				</a>
			</div></td>
		</tr>
	<?php } ?>
		<!-- CONTEUDO -->
		<tr>
			<td class="conteudo">
				
				<?php include("./includes.php"); ?>

			</td>
		</tr>

		<!-- RODAPE -->
		<tr>
			<td class="rodape">© 2008 <b>NexuS-PT</b> | <b>Project since 2001</b> | Design by: NexuS-PT</td>
		</tr>
	</table>
	<p align="center">
		<script id="_wauw33">var _wau = _wau || []; _wau.push(["small", "4dyoj6bkrwtw", "w33"]);(function() { var s=document.createElement("script"); s.async=true; s.src="http://widgets.amung.us/small.js";document.getElementsByTagName("head")[0].appendChild(s);})();</script>
	</p>
</body>
<head><title><?php echo $config["site_name"]; ?></title></head>
