<?php

if(isset($_POST['orderidbutton']) && !empty($_POST['orderid']))
{
    $query = "SELECT * FROM coins_order WHERE orderid = '$_POST[orderid]'";
    $result = mysql_query($query);

    if(mysql_num_rows($result) > 0)
    {echo "<p>Confira o ORDER ID, pois o inserido já se encontra registado.<br>Código Inserido: $_POST[orderid]</p>";}
    else
    {
        $query = "INSERT INTO coins_order (user_id_ass,orderid) VALUES ('$conta[0]','$_POST[orderid]')";
        if(mysql_query($query))
        {echo "<p>A sua compra foi registada com sucesso, irá obter as suas Moedas de Ouro em no máximo 24h!</p>";
			send_mail_to("Sistema",$config["systemmail"],"Compra Registada","<p>Vimos por este meio informar que foi registada uma compra no sistema e se encontra a espera de verificação.</p>");}
        else
        {echo "<p>ERROR</p>";}
    }
}
 else
     {
?>

<p>Registe o seu pagamento para que possa receber as suas moedas!</p>
<form method="post">
    <p style="text-align: center;">Order ID da compra:<br>
    <input type="text" maxlength="11" size="20" name="orderid" style="text-align: center;"><br><br>
    <button type="submit" name="orderidbutton" class="edit">Registar compra</button></p>
</form>
<p>*O ORDER ID é obtido por e-mail após a compra, por favor caso ainda não o tenha, verifique o seu e-mail.</p>
<?php
     }
?>
