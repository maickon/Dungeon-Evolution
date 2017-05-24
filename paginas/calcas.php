<?php
isset($_POST['nivel'])?$nivel=$_POST['nivel']:$nivel=1;
isset($_POST['qtd'])?$qtd=$_POST['qtd']:$qtd=3;

painel_botoes(
		array('nivel','Insira o nivel desejado aqui!'),
		array('qtd','Insira a qtd de Calças desejada aqui!'),
		'Exibir Calças',
		array('Exibir em Bloco de notas.','export_bt','export_bt'),
		'calcas');

$calcas_shop  = new LojaDeCalcas();
$calcas_shop->projatar_calcas(is_numeric($qtd)?$qtd:3,is_numeric($nivel)?$nivel:23);

if(isset($_POST['export_bt'])):
	$calcas_shop->exportar_calcas_para_txt();
endif;	
?>