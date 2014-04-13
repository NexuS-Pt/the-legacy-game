<?php

$query = "SELECT coin FROM users WHERE id = '".$conta[0]."'";
$data_source = mysql_query($query);
$data = mysql_fetch_array($data_source);

?>
<div style="border: 1px solid #FF3300; border-radius: 4px 4px 0 0; padding: 5px; background:url(./templates/topbanner.jpg);">
            <img class="float-left" src='./templates/gold_coin_single.png'><span  style="font-weight: bold;">O recheio da tua conta!</span>
            	<h2 style="text-align: left; color:#FFFFFF;"><?php echo $data['coin']; ?> Moedas de Ouro</h2>
            </div>
            <div id='container'>
              	<div class='simpleTabs'>
                    <ul class='simpleTabsNavigation'>
                      <li><a herf='#registos'>Registos</a></li>
                      <li><a href='#comprarmoedas'>Comprar moedas</a></li>
                      <li><a href='#registarcompra'>Registar compra</a></li>
                    </ul>
    <div class='simpleTabsContent'>
        <?php include("./safe/moves.php"); ?>
    </div>
    <div class='simpleTabsContent' style="background: #FF9900; color: #FFFFFF;">
        <?php include("./safe/buy.php"); ?>
    </div>
    <div class='simpleTabsContent'>
        <?php include("./safe/register.php"); ?>
    </div>
  </div>
</div>