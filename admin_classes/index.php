<!-- PÁGINA INICIAL DAS CLASSES -->
<p>
<input  value="Administradores" disabled="disable"> 			<?php echo "Existem ".utilizadores_quantidade(1)." utilizadores no grupo!"; ?>	</p>
<p>
<input  value="Gestores" disabled="disable"> 				<?php echo "Existem ".utilizadores_quantidade(2)." utilizadores no grupo!"; ?>	</p>
<p>
<input  value="Membros da Equipa" disabled="disable"> 			<?php echo "Existem ".utilizadores_quantidade(3)." utilizadores no grupo!"; ?>	</p>
<p>
<input  value="Vips" disabled="disable"> 					<?php echo "Existem ".utilizadores_quantidade(4)." utilizadores no grupo!"; ?>	</p>
<p>
<input  value="Utilizadores Mais" disabled="disable"> 			<?php echo "Existem ".utilizadores_quantidade(5)." utilizadores no grupo!"; ?>	</p>
<p>
<input  value="Utilizadores" disabled="disable"> 				<?php echo "Existem ".utilizadores_quantidade(6)." utilizadores no grupo!"; ?>	</p>
<p>
<input  value="Bloqueados" disabled="disable"> 				<?php echo "Existem ".utilizadores_bloqueados()." utilizadores no grupo!"; ?>
</p>
<p>
<input value="Jogadores" disabled="disable">				<?php echo "Existem ".mysql_num_rows(mysql_query("SELECT id FROM g_char"))." Jogadores!"; ?></p>
