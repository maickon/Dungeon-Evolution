<?php
isset($_POST['nivel'])?$nivel=$_POST['nivel']:$nivel=1;
isset($_POST['qtd'])?$qtd=$_POST['qtd']:$qtd=3;

painel_botoes(
		array('nivel','Insira o nivel desejado aqui!'),
		array('qtd','Insira a qtd de Luvas desejada aqui!'),
		'Exibir Luvas',
		array('Exibir em Bloco de notas.','export_bt','export_bt'),
		'luvas');

$luvas_shop  = new LojaDeLuvas();
$luvas_shop->projatar_luvas(is_numeric($qtd)?$qtd:3,is_numeric($nivel)?$nivel:23);

if(isset($_POST['export_bt'])):
	$luvas_shop->exportar_luva_para_txt();
endif;	
?>