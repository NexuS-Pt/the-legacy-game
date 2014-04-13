<?php
	//INCLUDES DE APLICAÇÕES
	//SERÃO INSERIDOS EM LISTA COM BLOCKQUOTES PARA FICAREM ORGANIZADOS


	$type = $conta['previlegios'];
	$position = 0;
	$tabs = "";

	$data_source		= mysql_query("SELECT * FROM aplication WHERE publish = '1' ORDER BY ordem ASC");

	while($data = mysql_fetch_array($data_source))
	{
		if ($data['type_asc'] >= $type)
		{
			
			$tabs .= "<li><a href='#'>".$data['name']."</a></li>";
			$descricao[$position] = "<div style=\"padding: 15px; background: url(templates/jpeg.jpg); color: #FFF; border: 1px solid #000; border-radius: 5px;\">".$data['descri']."</div>";
			$file_url[$position] = "./app/data/".$data['file_name'].".php";
			$position++;
		}
	}
	
?>

<div id='container'>
  <div class='simpleTabs'>
    <ul class='simpleTabsNavigation'style="border-radius: 5px 5px 0 0;">
    	<?php echo  $tabs; ?>
    </ul>
    	<?php	$size = $position; $position = 0;
				while($position < $size)
				{

					echo "<div class='simpleTabsContent'>";
					echo $descricao[$position]."<br>";
      				include($file_url[$position]);
					echo "</div>";
					$position++;
				} ?>
  </div>
</div>
