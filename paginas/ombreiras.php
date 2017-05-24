<?php
isset($_POST['nivel'])?$nivel=$_POST['nivel']:$nivel=1;
isset($_POST['qtd'])?$qtd=$_POST['qtd']:$qtd=3;

painel_botoes(
		array('nivel','Insira o nivel desejado aqui!'),
		array('qtd','Insira a qtd de Ombreiras desejado aqui!'),
		'Exibir Ombreiras',
		array('Exibir em Bloco de notas.','export_bt','export_bt'),
		'ombros');

$ombreiras_shop  = new LojaDeOmbreiras();
$ombreiras_shop->projatar_ombreiras(is_numeric($qtd)?$qtd:3,is_numeric($nivel)?$nivel:23);

if(isset($_POST['export_bt'])):
	$ombreiras_shop->exportar_ombreira_para_txt();
endif;	
?>