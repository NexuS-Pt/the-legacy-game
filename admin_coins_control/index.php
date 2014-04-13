<?php

if(!isset($_GET['do']) or empty($_GET['do']))       {include("./admin_coins_control/list.php");}
elseif($_GET['do'] == "accept-order")               {include("./admin_coins_control/accept-order.php");}




?>
