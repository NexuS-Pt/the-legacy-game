<?php
	if(isset($conta[0]))
	{

		echo "<form method='POST'>
			<p align='center'>";
		return_editor($conta['previlegios'],$editordataprint);
		echo"</p>
                    <p align='center'>
                        <button class=\"site\" type='submit' name='publicar'><img src=\"./images/b-accept.png\" width=\"12px\"> Guardar</button>
                    </p>
                    </form>";
	}


?>
