<html>
	<head>
		<title>Dungeon Evolution</title>
		<meta charset="UTF-8" />
		<meta name="description" content="Dungeon Evolution. Site sobre RPG de mesa com regras adptadas dos famosos jogos eletrônicos." />
		<meta name="keywords" content="RPG, Video Game, Evolução, Evoluir personagem, Melhor RPG Game, Fantasia Medieval, Fantasia conteporânea." />
		<meta name="author" content="Maickon José Rangel" />
		<link rel="icon" type="image/png" sizes="144x144" href="img/logo/evolution.png" />
	</head>
	<body>
	<?php
	require_once 'init.php';

	$menu_bar = array(
					array('?p=armas','Armas'),
					array('?p=cpt','Capacetes'),
					array('?p=escudos','Escudos'),
					array('?p=aneis','Aneis'),
					array('?p=armaduras','Armaduras'),
					array('?p=calcas','Calças'),
					array('?p=botas','Botas'),
					array('?p=ombros','Ombreiras'),
					array('?p=luvas','Luvas'),
					array('?p=colar','Colares'),
					array('?p=magias','Magias'),
					array('?p=export','Arquivos Exportados'),
					array('?p=experiencia','Experiência'),
					array('?p=drop','Dropar Itens')
					);
	componente_menu_bar($menu_bar);
	componente_logo_bar($load->load_img('DungeonEvolution.png'));
	rotear_paginas(isset($_GET['p'])?$_GET['p']:'home');
	
	componente_footer_bar(
					$menu_bar,
					'<p class="copyright">Dungeon Evolution &copy 2014 - Site desenvolvido por Maickon Rangel</p>');
	?>
	</body>
</html>