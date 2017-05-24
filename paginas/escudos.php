<?php
isset($_POST['nivel'])?$nivel=$_POST['nivel']:$nivel=1;
isset($_POST['qtd'])?$qtd=$_POST['qtd']:$qtd=3;

painel_botoes(
		array('nivel','Insira o nivel desejado aqui!'),
		array('qtd','Insira a qtd de Escudos desejado aqui!'),
		'Exibir Escudos',
		array('Exibir em Bloco de notas.','export_bt','export_bt'),
		'escudos');

$escudos_shop  = new LojaDeEscudos();
$escudos_shop->projatar_escudos(is_numeric($qtd)?$qtd:3,is_numeric($nivel)?$nivel:23);

if(isset($_POST['export_bt'])):
	$escudos_shop->exportar_escudo_para_txt();
endif;	
?>