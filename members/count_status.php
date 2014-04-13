<?php
	$count_pro = 0;
	$count_od = 0;
	$count = 0;
    
	$query = "SELECT * FROM status WHERE profile_id = '$id'";
	$data_source = mysql_query($query);
	while($data = mysql_fetch_array($data_source)) {
		if($data['user_id_ass'] == $id) {
			$count_pro++;
			$count++;
			}elseif($data['user_id_ass'] != $id) {
				$count_od++;
				$count++;}
				}
				
				echo "<i>Total</i>: ".$count."<br>";
				echo "<i>Inseridos pelo proprietário</i>: ".$count_pro."<br>";
				echo "<i>Inseridos por visitantes</i>: ".$count_od;
?>
