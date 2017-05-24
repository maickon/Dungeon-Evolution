<?php

function rotear_paginas($p){
	switch ($p):
		case 'drop':componente_body_bar('paginas/drop.php');
		break;	

		case 'armas':componente_body_bar('paginas/armas.php');
		break;

		case 'experiencia':componente_body_bar('paginas/experiencia.php');
		break;

		case 'armaduras':componente_body_bar('paginas/armaduras.php');
		break;

		case 'home':componente_body_bar('paginas/home.php');
		break;

		case 'cpt':componente_body_bar('paginas/capacetes.php');
		break;

		case 'magias':componente_body_bar('paginas/magias.php');
		break;

		case 'escudos':componente_body_bar('paginas/escudos.php');
		break;

		case 'armaduras':componente_body_bar('paginas/armaduras.php');
		break;

		case 'botas':componente_body_bar('paginas/botas.php');
		break;

		case 'ombros':componente_body_bar('paginas/ombreiras.php');
		break;

		case 'luvas':componente_body_bar('paginas/luvas.php');
		break;

		case 'calcas':componente_body_bar('paginas/calcas.php');
		break;

		case 'aneis':componente_body_bar('paginas/aneis.php');
		break;

		case 'teste':componente_body_bar('paginas/teste.php');
		break;
		
		case 'export':componente_body_bar('paginas/export_files.php');
		break;

		default:componente_body_bar('paginas/home.php');
		break;
	endswitch;
}
?>