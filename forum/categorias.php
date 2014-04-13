<?php
	$nCat = 0;
	$nSfo = 0;
    $nTpc = 0;
    $nPst = 0;
	$categorias = mysql_query("SELECT * FROM forum_categories WHERE publish = 1");
	while ($row = mysql_fetch_array($categorias))
	{
            $nCat++; // CONTADOR DE CATEGORIAS
			echo "<div class=\"forumcateory\">
				<div class=\"title\">".$row['name']."</div>";
			echo "<div class=\"forumcategorynames\">
                	<div class=\"forumcategoryname\">Nome</div>
                    <div class=\"forumcategorytopic\">Tópicos</div>
                    <div class=\"forumcategorypost\">Posts</div>
                </div>";
            $sub_foruns = mysql_query("SELECT * FROM forum_sub_forum WHERE cat_id_ass = '".$row["id"]."' AND publish = 1");

            while ($row_2 = mysql_fetch_array($sub_foruns))
            {
                $nSfo++; // CONTADOR DE SUBFORUNS
                 $query = "SELECT position FROM forum_posts WHERE sf_id_ass = '".$row_2['id']."'";
                $top_source = mysql_query($query);
                $countop = 0;
                $countpost = 0;
                while($top = mysql_fetch_array($top_source)){if($top['position'] == 1){$countop++;} else {$countpost++;}}
				$nTpc += $countop; // CONTADOR DE TOPICOS
				$nPst += $countpost; // CONTADOR DE POSTS
				
                echo "<div class=\"forumcategorynamesentry\" onclick=\"goTo('./?page=sub-forum&forum=".$row_2['id']."')\">
                	<div class=\"forumsubforumname\">".$row_2['name']."</div>
                    <div class=\"forumsubforumtopic\">".$countop."</div>
                    <div class=\"forumsubforumpost\">".$countpost."</div>
                </div>";
            }
			echo "</div>
				";
		
	}
        
        $result = mysql_query("SELECT id FROM users WHERE active = 1");
        $nMmb = mysql_num_rows($result);
        // STATICS MODULE
		echo "
            <div class=\"forumstatistics\" >
            	<div class=\"forumstatisticsvalue\">Categorias: ".$nCat."</div>
                <div class=\"forumstatisticsvalue\">SubForuns: ".$nSfo."</div>
                <div class=\"forumstatisticsvalue\">Tópicos: ".$nTpc."</div>
                <div class=\"forumstatisticsvalue\">Respostas: ".$nPst."</div>
                <div class=\"forumstatisticsvalue\">Membros: ".$nMmb."</div>
            </div>";
        
		if ($conta["previlegios"] == 1)
		{
			echo "<div style=\"padding: 5px; text-align: right;\"><form action=\"./page=forum-search\" method=\"post\">Pesquisar: <input type=\"text\" name=\"field_text\"><button type=\"submit\" name=\"search_submit\" class=\"site\">></button></button></form></div>";
		}


?>
