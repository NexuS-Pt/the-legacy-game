<p style="text-align: center;;"><img src="./templates/onebiplogo.png" width="300"><br>
Para puderes obter as tuas moedas de ouro terás de usar o saldo do teu telemovel.</p>
<?php
	if ($config["coinsExtraBuy"] > 0 && $conta["previlegios"] <= 5)
	{echo "<h2 style=\"text-align: center;\">ExtraSeason, mais ".$config["coinsExtraBuy"]." Moedas de Ouro em cada Compra!</h2>";}
?>

<div class="onebipbuy" onClick="goTo('https://www.onebip.com/tinyurl/91b9b3a49bda81f96d39560964278098')">Pacote de 200 Mo  por apenas 2 €</div>
<div class="onebipbuy" onClick="goTo('https://www.onebip.com/tinyurl/db25ccb8c8ca227d758f11ed1abedadd')">Pacote de 500 Mo  por apenas 4 €</div>
<div class="onebipbuy" onClick="goTo('https://www.onebip.com/tinyurl/22b2ff320550176b50f3d21e2773a87f')">Pacote de 750 Mo  por apenas 6 €</div>
<div class="onebipbuy" onClick="goTo('https://www.onebip.com/tinyurl/b3bbc6436379c44c6b067e1ef0659bfb')">Pacote de 1000 Mo  por apenas 8 €</div>
<div class="onebipbuy" onClick="goTo('https://www.onebip.com/tinyurl/9eda63d4bc437a1af40e8d23929977ec')">Pacote de 1500 Mo  por apenas 11 €</div>
