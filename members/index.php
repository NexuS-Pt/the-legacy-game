<div id="lm-header">
	Membros da Comunidade
	<div id="lm-header-2">Achas que estão cá todos?</div>
</div>
<div id="lm-titles">
	<div style="width: 100px;text-align: center; float: left;">.</div>
	<div style="width: 100px; text-align: center; float: left;">Avatar</div>
	<div style="margin-left: 8px; width: 550px; float: left; text-align: left;">Nome</div>
	<div style="width: 100px; float: left; text-align: center;">Estado</div>
</div>
<div id="lm-data">
</div>
<?php
	$search = mysql_query("SELECT * FROM users WHERE active = '1' ORDER BY id ASC");
	$position = 0;

	while ($data = mysql_fetch_array($search))
	{
		if (($position % 2) == 0){$tr = 'row-a';}else{$tr =  'row-b';}
		$position++;
		
		if (empty($data['avatar']))
		{$avatar = "./images/no_avatar_m.jpg";}
		else
		{$avatar = $data['avatar'];}
		
		if ($data["id"] == $conta[0])
		{echo "<div id=\"lm-data\" style=\"background: url(templates/hs-img.png) repeat-x orange;\" onClick=\"goTo('?page=profile&id=".$data['id']."')\">";}
		else
		{echo "<div id=\"lm-data\" onClick=\"goTo('?page=profile&id=".$data['id']."')\">";}
		
		echo "
			<div style=\"width: 100px;text-align: center; float: left;\">".$position."</div>
			<div style=\"width: 100px;text-align: center; float: left;\"><img src='".$avatar."' width='30' height='30'></div>
			<div style=\"margin-left: 8px; width: 550px; float: left; text-align: left;\">".$data["username"]."</div>
			<div style=\"width: 100px; float: left; text-align: center;\">
				<a href='index.php?page=mp&par=esc&to=".$data['id']."'><img src='./images/PM-Icon.png' width='20'></a>
				<img src='./images/previlegios/".$data['type'].".png' width='20' title='".user_type($data['type'])."'>
			</div>
		</div>";
	}
?>
<div id="lm-footer"></div>
