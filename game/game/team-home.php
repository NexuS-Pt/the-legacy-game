<?php
	// crachas
	// COMBATE
	if ($aux["combat"] < 100) {$cracha["img-C"] = "./img/team/cc0.png";}
	elseif ($aux["combat"] < 200) {$cracha["img-C"] = "./img/team/cc1.png";}
	elseif ($aux["combat"] < 500) {$cracha["img-C"] = "./img/team/cc2.png";}
	elseif ($aux["combat"] < 1000) {$cracha["img-C"] = "./img/team/cc3.png";}
	else{$cracha["img-C"] = "./img/team/cc4.png";}
	// DERROTAS
	if ($data["win"] == 0 || $data["lose"] == 0) {$cracha["img-D"] = "./img/team/cc0.png";}
	elseif ($aux["racio"] >= 1) {$cracha["img-D"] = "./img/team/cc0.png";}
	elseif ($aux["racio"] > 0.7) {$cracha["img-D"] = "./img/team/cc1.png";}
	elseif ($aux["racio"] > 0.5) {$cracha["img-D"] = "./img/team/cc2.png";}
	elseif ($aux["racio"] > 0.2) {$cracha["img-D"] = "./img/team/cc3.png";}
	else{$cracha["img-D"] = "./img/cc4.png";}
	// MEMBROS
	if (count($aux["members"]) < 10) {$cracha["img-M"] = "./img/team/cc0.png";}
	elseif (count($aux["members"]) < 15) {$cracha["img-M"] = "./img/team/cc2.png";}
	elseif (count($aux["members"]) < 25) {$cracha["img-M"] = "./img/team/cc3.png";}
	else{$cracha["img-M"] = "./img/team/cc4.png";}


	print("<table width=\"100%\">
		<tr>
		 <th colspan=\"4\">".$data["name"]."</th>
		</tr>
		<tr>
		 <td rowspan=\"8\" style=\"width: 160; text-align: center;\"><img src=\"./img/team/".$data["logo"].".jpg\" style=\"width: 150;height: 235;\"></td>
		 <th class=\"game\" width=\"150\">Criado</th>
		 <td colspan=\"2\" class=\"game\">".return_charname($data["user_id_ass"])."</td>
		</tr>
		<tr>
		 <th class=\"game\">Chefe</th>
		 <td colspan=\"2\" class=\"game\">".return_charname($data["owner_id_ass"])."</td>
		</tr>
		<tr>
		 <th class=\"game\" colspan=\"3\">
		  Descrição
		 </th>
		</tr>
		<tr>
		  <td class=\"game\">".$data["description"]."</td>
		</tr>
		<tr>
		 <th class=\"game\">Expiriência</th>
		 <td colspan=\"2\" class=\"game\">".$data["expirience"]."</td>
		</tr>
		<tr>
		 <th class=\"game\">Victorias</th><th class=\"game\" width=\"150\">Derrotas</th><th class=\"game\">Rácio</th>
		</tr>
		<tr>
		 <td class=\"game\">".$data["win"]."</td><td class=\"game\">".$data["lose"]."</td><td class=\"game\">".$aux["racio"]."</td>
		</tr>
		<tr></tr>");

	print("<tr height=\"50\"></tr>
		<tr><th class=\"game\" colspan=\"4\">Lista de Membros</th></tr>
		<tr><td  colspan=\"4\" class=\"game\">");
		for ($i = 0; $i < count($aux["members"]);$i++)
		{print("(".($i+1).")".return_charname($aux["members"][$i])." ");}
	print("</td></tr>
		<tr></tr>
		<tr><th class=\"game\" colspan=\"4\">Crácha de Membros</th></tr>
		<tr class=\"row-b\"><td colspan=\"4\" style=\"text-align: center;\"><img title=\"Encontra os melhores membros para a tua equipa!\n*10\n*15\n*20\n*25\"src=\"".$cracha["img-M"]."\" style=\"width: 396;height: 96;\"></td></tr>
		<tr><th class=\"game\" colspan=\"4\">Crácha de Combates</th></tr>
		<tr class=\"row-a\"><td colspan=\"4\" style=\"text-align: center;\"><img title=\"Tantas pessoas que podes desafiar, esperamos que ganhes estes\nCráchas só com vitórias\n*100\n*200\n*500\n*1000\"src=\"".$cracha["img-C"]."\" style=\"width: 396;height: 96;text-align:\"></td></tr>
		<tr><th class=\"game\" colspan=\"4\">Crácha de Derrotas</th></tr>
		<tr class=\"row-b\"><td colspan=\"4\" style=\"text-align: center;\"><img title=\"Este Crácha é para os maus jogadores\nAchas que consegues ficar longe dele?\" src=\"".$cracha["img-D"]."\" style=\"width: 396;height: 96;\"></td></tr>
		</table>");
?>
