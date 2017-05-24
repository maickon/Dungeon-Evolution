<?php
isset($_POST['nivel'])?$nivel=$_POST['nivel']:$nivel=1;
isset($_POST['qtd'])?$qtd=$_POST['qtd']:$qtd=3;

painel_botoes(
		array('nivel','Insira o nivel desejado aqui!'),
		array('qtd','Insira a qtd de Itens desejado aqui!'),
		'Dropar Itens',
		array('Exibir em Bloco de notas.','export_bt','export_bt'),
		'drop');


$drop = new Drop();
$drop->exibir_itens_dropados(is_numeric($qtd)?$qtd:3,is_numeric($nivel)?$nivel:23);

if(isset($_POST['export_bt'])):
	//$drop->exportar_escudo_para_txt();
endif;	
?>