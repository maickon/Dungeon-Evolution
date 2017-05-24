<?php
isset($_POST['nivel'])?$nivel=$_POST['nivel']:$nivel=1;
isset($_POST['qtd'])?$qtd=$_POST['qtd']:$qtd=3;

painel_botoes(
		array('nivel','Insira o nivel desejado aqui!'),
		array('qtd','Insira a qtd de Aneis desejado aqui!'),
		'Exibir Aneis',
		array('Exibir em Bloco de notas.','export_bt','export_bt'),
		'aneis');

$aneis_shop  = new LojaDeAneis();
$aneis_shop->projatar_aneis(is_numeric($qtd)?$qtd:3,is_numeric($nivel)?$nivel:23);

if(isset($_POST['export_bt'])):
	$aneis_shop->exportar_aneis_para_txt();
endif;	
?>