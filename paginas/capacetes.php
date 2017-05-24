<?php
isset($_POST['nivel'])?$nivel=$_POST['nivel']:$nivel=1;
isset($_POST['qtd'])?$qtd=$_POST['qtd']:$qtd=3;

painel_botoes(
		array('nivel','Insira o nivel desejado aqui!'),
		array('qtd','Insira a qtd de Capacetes desejado aqui!'),
		'Exibir Capacetes',
		array('Exibir em Bloco de notas.','export_bt','export_bt'),
		'cpt');

$loja = new LojaDeCapacetes();
$loja->projatar_capacetes(is_numeric($qtd)?$qtd:3,is_numeric($nivel)?$nivel:23);

if(isset($_POST['export_bt'])):
	$loja->exportar_capacete_para_txt();
endif;	
?>