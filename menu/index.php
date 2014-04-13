<?php
if ($conta["coin"] == 0){$icon_coin = "Strong-box-robbed-icon";}elseif($conta["coin"] > 0){$icon_coin = "Strong-box-money-icon";}

if($conta["previlegios"] == 1 OR $conta["previlegios"] == 2){
?>

<div id='container'>
  <div class='simpleTabs'>
    <ul class='simpleTabsNavigation'>
      <li><a herf='#'>Utilizador</a></li>
      <li><a href='#'>Administração</a></li>
    </ul>

    <div class='simpleTabsContent'>
        <?php include("./menu/account.php"); ?>
    </div>
    <div class='simpleTabsContent'>
        <?php  include("./menu/admin_m.php"); ?>
    </div>
  </div>
</div>

<?php } else {include("./menu/account.php");} ?>
