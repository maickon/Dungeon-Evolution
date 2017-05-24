Combatente:	 20 PV, 10 Def, Dano 4 e Mana 5  = 9.75
Conjuradores: 10 PV, Dano 1, Mana 10 e 5 Def = 6.5

<style type="text/css">
	.lvs{
		width: 100%;
		border-radius: 5px;
		border-style: groove;
		float: left;
	}

	.line{
		width: 690px;
		float: left;
	}
	.pts{
		text-align: center;
		border-bottom: 2px white solid;	
		width: 250px;
		background-color: #a9a9a9;
		float: left;
	}

	.atributos{
		width: 440px;
		background-color: #c9c9c9;
		float: left;
		color: white;
	}

	.pv{
		text-align: center;
		width: 100px;
		float: left;
		background-color: green;
	}

	.def{
		text-align: center;
		width: 100px;
		float: left;
		background-color: brown;
	}

	.dano{
		text-align: center;
		width: 100px;
		float: left;
		background-color: red;
	}

	.mana{
		text-align: center;
		width: 100px;
		float: left;
		background-color: blue;
	}
</style>
<?php 
 
 	function tabela_personagem(){
		$pv = $def = $dano = $mana = 10;
		$pts = 0;
	 	
	 	echo '<div class="lvs">';
	 	for ($i=1; $i < 101; $i++) { 
	 		echo "<div class=\"line\">
		 			<div class=\"pts\">
		 				<b>Lv:{$i}</b> - Pontos: {$pts} 
		 			</div> 
		 			<div class=\"atributos\"> 
		 				<div class=\"pv\">
		 					PV:{$pv} 
		 				</div>
						<div class=\"def\">
		 					DEF:{$def} 
		 				</div>
						<div class=\"dano\">
		 					DANO:{$dano} 
		 				</div>
		 				<div class=\"mana\">
		 					MANA:{$mana}
		 				</div>
		 			</div>
		 		</div>
		 		";
	 		$pv 	+= (30/4);
	 		$def 	+= (30/4);
	 		$dano 	+= (30/4);
	 		$mana 	+= (30/4);
	 		$pts += 30;
		}
	 	echo '</div>';
 	}

 	function aumento_comum(){

 	}

 	tabela_personagem();
?>





