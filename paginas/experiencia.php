<?php
$ex = new Experiencia(array('msg'));
$ex->msg = array();
$ex->link = array('1','2','3','');
$ex->label = array('Tabela de experiência do personagem.','Pontos de experiência dos inimigos.','Calcular diferença de Xp','<- Voltar.');
$ex->msg[0] = 'Consulte o nível em que seu personagem se encontra.';
$ex->msg[1] = 'Pontos de experiência dos inimigos.';



echo '<div class="label_link">';
	for($i=0; $i<=3; $i++):
		if(isset($_GET['t']) and $_GET['t'] == 4):
		else:
			echo '<a href="?p=experiencia&t='.$ex->link[$i].'" class="link_xp">
					<b>'.$ex->label[$i].'</b>
				  </a>';
		endif;
	endfor;
echo '</div>';

if(isset($_GET['t']) and $_GET['t'] == 1):
	$ex->exibir_xp($ex->msg[0]);
elseif(isset($_GET['t']) and $_GET['t'] == 2):
	$ex->calculo_ganho_xp(23, $ex->msg[1]);
elseif(isset($_GET['t']) and $_GET['t'] == 3):
	painel_xp(
		array('nivel_player','Insira o seu nível de personagem aqui!',55),
		array('nivel_enemy','Insira o nível do seu inimigo aqui!',55),
		array('Calcular Xp ganho','export_bt')
		);
	isset($_POST['nivel_player'])?$nivel_player=$_POST['nivel_player']:$nivel_player=null;
	isset($_POST['nivel_enemy'])?$nivel_enemy=$_POST['nivel_enemy']:$nivel_enemy=null;
	if($xp_calculado = $ex->calcular_ganho_de_xp_por_diferenca(is_numeric($nivel_player)?$nivel_player:null, is_numeric($nivel_enemy)?$nivel_enemy:null)):
		exibir_xp_calculado($xp_calculado);
	else:
		exibir_xp_calculado('Informe os níveis nos campos acima para caucular o Xp.');
	endif;
else:
	$file = new Arquivo();
	$file->open_file('arquivos/paginas/experiencia.txt','r');
	$file->read_file();
	$file->close_file();
endif;
?>