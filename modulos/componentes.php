<?php
	function componente_menu_bar(array $menu){
		echo '<div class="menu_bar fixed-nav">';
			echo '<ul class="menu">';
				for($i=0; $i<=count($menu)-1; $i++):
					echo '<li>';
						echo '<a href="'.$menu[$i][0].'">';
							echo $menu[$i][1];
						echo '</a>';
					echo '</li>';
				endfor;
			echo '</ul>';
		echo '</div>';
	}

	function componente_logo_bar($img_logo){
		echo '<div class="logo_bar">';
			echo '<a href="index.php">';
				echo '<img src="'.$img_logo.'" class="logo"/>';
			echo '</a>';
		echo '</div>';
	}

	function componente_body_bar($body){
		echo '<div class="body_bar">';
			echo '<div class="body_bar_conteudo">';
				require_once $body;
			echo '</div>';	
		echo '</div>';
	}

	function componente_footer_bar(array $footer, $creditos){
		echo '<div class="footer_bar">';
			echo '<span class="footer_links">|';
				for($i=0; $i<=count($footer)-1; $i++):
					echo '<a href="'.$footer[$i][0].'" class="links">';
						echo $footer[$i][1];
					echo '</a> | ';
				endfor;

				echo $creditos;
			echo '</span>';
		echo '</div>';
	}

	function componente_botao($value, $name = 'botao', $class="botao"){
		echo '<input type="submit" value="'.$value.'" name="'.$name.'" class="'.$class.'" ">';	
	}

	function componente_text_field($name, $placeholder, $size = 50){
		echo '<input type="text" maxlength="2" size="'.$size.'" name="'.$name.'" placeholder="'.$placeholder.'" class="text_field">';
	}

	function painel_botoes($nivel,$qtd,$bt,$bt_txt,$pagina){
		echo '<div class="componentes_painel_arma">';
			echo '<form method="post" action="?p='.$pagina.'">';
				componente_text_field($nivel[0], $nivel[1]);
				componente_text_field($qtd[0], $qtd[1]);
				componente_botao($bt);
				componente_botao_exportar_txt($bt_txt[0],$bt_txt[1],$bt_txt[2]);
			echo "</form>";
		echo '</div>';
	}

	function componente_botao_exportar_txt($value, $name, $class="botao"){
		componente_botao($value, $name, $class);
	}

	function painel_xp($nivel_player,$nivel_enemy,$bt){
		echo '<form method="post" action="?p=experiencia&t=3">';
			echo '<div class="componentes_painel_arma">';
				componente_text_field($nivel_player[0], $nivel_player[1], $nivel_player[2]);
				componente_text_field($nivel_enemy[0], $nivel_enemy[1], $nivel_enemy[2]);
				componente_botao($bt[0], $bt[1], $bt[1]);
			echo '</div>';
		echo "</form>";
	}

	function exibir_xp_calculado($xp_ganho){
		echo '<div class="xp_claculado">';
			if(!is_numeric($xp_ganho)):
				echo $xp_ganho;
			else:
				echo 'Você recebeu <b class="font_xp">'.$xp_ganho.'Xp.</b> Parabéns jovem. :)';
			endif;
		echo '</div>';
	}	
?>