<?php
isset($_POST['nivel'])?$nivel=$_POST['nivel']:$nivel=1;
isset($_POST['qtd'])?$qtd=$_POST['qtd']:$qtd=3;

painel_botoes(
		array('nivel','Insira o nivel desejado aqui!'),
		array('qtd','Insira a qtd de Armaduras desejado aqui!'),
		'Exibir Armaduras',
		array('Exibir em Bloco de notas.','export_bt','export_bt'),
		'armaduras');

$armaduras_shop  = new LojaDeArmaduras();
$armaduras_shop->projatar_armaduras(is_numeric($qtd)?$qtd:3,is_numeric($nivel)?$nivel:23);

if(isset($_POST['export_bt'])):
	$armaduras_shop->exportar_armadura_para_txt();
endif;	
?>