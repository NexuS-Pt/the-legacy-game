<?php
	include("./funcoes.php");
	include("./language.php");
	// ---------------------------------- LOGIN ----------------------------------------------
	if(isset($_POST["validar"])){$conta = login($_POST['email'],$_POST['password'],$_POST["login_time"]);}
	// --------------------------------- LOGOUT ----------------------------------------------
	if(!empty($_GET['page'])) { switch($_GET['page']) { case 'logout': include('logout.php'); break; } }
   	include("./config.php");
	// -------------------- CONFIRMAR SE A CONTA EXISTE OU SE FOI ALTERADA -------------------------------
    if (isset($_COOKIE[$cookie]))
	{ $conta = conta_data($_COOKIE[$cookie]); $realuser = confirma_conta($_COOKIE[$cookie],$cookie);}
	
	if(ISSET($realuser) && $realuser) {return_user_data();}
?>

<head>
	<title>NexuSystem Devby NexuS-Pt</title>
	<meta name="Description" content="NexuS! O melhor de uma comunidade está aqui!" />
	<meta name="Keywords" content="nexus,nexusystem,comunity,comunidade,sistema,ligação" />
	<meta name="Distribution" content="Global" />
	<meta name="author" content="NexuS-PT , work team" />
	<meta name="Robots" content="index,follow" />
	
	<meta http-equiv="X-UA-Compatible" content="IE=9">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script type="text/javascript" src="./templates/javascript.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:300' rel='stylesheet' type='text/css'>
	<link href="./templates/nxs.css" rel="stylesheet" type="text/css" />
	<link href="./templates/game.css" rel="stylesheet" type="text/css" />
	<link href="./templates/menu.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-33754609-1']);
	  _gaq.push(['_setDomainName', 'nexusystem.com']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head>
<body id="body">
	<div id="top-space"></div>
	<div id="web-space">
		<div id="header-content">
        	<!-- -->
            <div style="width: 696px; height:130px; float: left; line-height: 130px; text-align: left; cursor: pointer;" onClick="goTo('http://<?php echo $_SERVER['SERVER_NAME']; ?>')">
            	<img style="height: 110px; margin: 10px; border-radius: 5px;" src="./templates/logov2.png">
            </div>
            <div style="width: 200px; height:130px; float: right; line-height: 130px; text-align: right;">
            	<img style="height: 130px;" src="./templates/imggif.gif">
            </div>
            <!-- -->
        </div>
		<div id="menu">
        	<!-- MENU -->
			<?php include("./menu/menu.php"); ?>
		</div>
		<!-- BANER PUBLICITARIO DE TOPO <div id="pub"><img style="border-radius: 5px;" src="./templates/banner-880x75.jpg"></div>-->
			<!-- -->
            <?php if (isset($_COOKIE[$cookie])){include("./warning.php");} ?>
            <!-- -->
		<div id="content">
			<!-- -->
			<?php include("./includes.php"); ?>
			<!-- -->
		</div>
		<div id="up-footer-content">
			<div id="up-footer-content-banner"><!-- --><img style="border-radius: 5px; cursor: pointer;" onClick="goTo('mailto:geral@nexusystem.com?subject=Publicidade-na-NexuSystem')" src="./templates/banner-286x75.jpg"><!-- --></div>
			<div id="up-footer-content-banner"><!-- --><img style="border-radius: 5px;" src="./images/banner/pcgaming.png"><!-- --></div>
			<div id="up-footer-content-banner"><!-- --><img style="border-radius: 5px; cursor: pointer;" onClick="goTo('mailto:geral@nexusystem.com?subject=Publicidade-na-NexuSystem')" src="./templates/banner-286x75.jpg"><!-- --></div>
		</div>
		<div id="footer-content">&copy; 2012 NexuS-PT | Project since 2001 | <a href="http://www.nexus-pt.eu/" target="_blank" style="color: #000;">Devby: NexuS-Pt , work team</a></div>
	</div>
	<div id="end-space" style="height: 25px;"></div>
</boby>
