<?php
isset($_POST['nivel'])?$nivel=$_POST['nivel']:$nivel=1;
isset($_POST['qtd'])?$qtd=$_POST['qtd']:$qtd=3;

painel_botoes(
		array('nivel','Insira o nivel desejado aqui!'),
		array('qtd','Insira a qtd de magias visíveis aqui!'),
		'Exibir Magias',
		array('Exibir Magias em Bloco de notas.','export_bt','export_bt'),
		'magias');

$magia_shop  = new LojaDeMagias();
$magia_shop->projatar_magias(is_numeric($qtd)?$qtd:3,is_numeric($nivel)?$nivel:rand(1,23));

if(isset($_POST['export_bt'])):
	//$loja->exportar_arma_para_txt();
endif;	
?>