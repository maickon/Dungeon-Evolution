<?php
isset($_POST['nivel'])?$nivel=$_POST['nivel']:$nivel=1;
isset($_POST['qtd'])?$qtd=$_POST['qtd']:$qtd=3;

painel_botoes(
		array('nivel','Insira o nivel desejado aqui!'),
		array('qtd','Insira a qtd de Botas desejada aqui!'),
		'Exibir Botas',
		array('Exibir em Bloco de notas.','export_bt','export_bt'),
		'botas');

$botas_shop  = new LojaDeBotas();
$botas_shop->projatar_botas(is_numeric($qtd)?$qtd:3,is_numeric($nivel)?$nivel:23);

if(isset($_POST['export_bt'])):
	$botas_shop->exportar_bota_para_txt();
endif;	
?>