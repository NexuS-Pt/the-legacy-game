<?php
	if ($config["warning_active"] == 1 AND $conta['previlegios'] <= $config["warning_acess"]) {echo "<div class=\"red-warning\" style=\"margin: 10px;\"><p>".$config["warning_message"]."</p></div>";}
?>
