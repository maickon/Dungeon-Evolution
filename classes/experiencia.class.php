<?php
/**
 * @author Mackon Rangel
 * @copyright 2014
 * @name Dungeon Evolutio Armas gerador
 * @email maickonmaickon@hotmail.com
 */
class Experiencia{
	private $atributos = array();

	function __construct($atributos){
		$this->atributos = $atributos;		
	}

	function exibir_xp($msg = null, $nivel = null){
		$xp = 0;
		echo '<div class="label_xp">';
			if($msg):
				echo $msg;
				echo '<br />';
			endif;
		echo '</div>';

		echo '<div class="table_xp1">';		
			for($i=1; $i<=23; $i++):
				$xp = ($i*(($i+1)*1000))+($i+1)*1000;
				$xp_anterior = (($i-1)*((($i-1	)+1)*1000))+(($i-1)+1)*1000;
				$dif = ($xp - $xp_anterior);
				$n = '<b>'.$i.'</b>';
				if($i%2 == 0):
					echo "<span class='linha1'>Nível $n - (XP $xp)</span>";
				else:
					echo "<span class='linha2'>Nível $n - (XP $xp)</span>";					
				endif;	
				//- Diferença ($dif)
			endfor;
		echo '</div>';

		echo '<div class="table_xp2">';		
			for($i=24; $i<=46; $i++):
				$xp = ($i*(($i+1)*1000))+($i+1)*1000;
				$xp_anterior = (($i-1)*((($i-1	)+1)*1000))+(($i-1)+1)*1000;
				$dif = ($xp - $xp_anterior);
				$n = '<b>'.$i.'</b>';
				if($i%2 == 0):
					echo "<span class='linha1'>Nível $n - (XP $xp)</span>";
				else:
					echo "<span class='linha2'>Nível $n - (XP $xp)</span>";					
				endif;	
				//- Diferença ($dif)
			endfor;
		echo '</div>';
	}

	function calculo_ganho_xp($nivel = null, $msg = null){
		$xp = 0;
		$count = 0;
		echo '<div class="label_xp">';
			if($msg):
				echo $msg;
				echo '<br />';
			endif;
		echo '</div>';

		echo '<div class="table_xp1">';	
			if(isset($nivel) && $nivel != null && is_numeric($nivel)):
				for($i=1; $i<=$nivel; $i++):
					$count++;
					$xp = (($i*(($i+1)*100))+($i+1)*100)/2;
					if($i%2 == 0):
						echo "<span class='linha1'>Nível <b>$i</b> - (XP $xp)</span>";
					else:
						echo "<span class='linha2'>Nível <b>$i</b> - (XP $xp)</span>";					
					endif;
				endfor;		
			endif;
		echo '</div>';

		echo '<div class="table_xp2">';	
			if(isset($nivel) && $nivel != null && is_numeric($nivel)):
				for($i=$count+1; $i<=($count*2); $i++):
					$xp = (($i*(($i+1)*100))+($i+1)*100)/2;
					if($i%2 == 0):
						echo "<span class='linha1'>Nível <b>$i</b> - (XP $xp)</span>";
					else:
						echo "<span class='linha2'>Nível <b>$i</b> - (XP $xp)</span>";					
					endif;
				endfor;		
			endif;
		echo '</div>';
	}

	function calcular_ganho_de_xp_por_diferenca($player_nivel = null, $enemy_nivel = null){
		$xp_ganho = 0;
		$erro = 0;
		if(isset($enemy_nivel) && $enemy_nivel != null && is_numeric($enemy_nivel)):
			if(isset($player_nivel) && $player_nivel != null && is_numeric($player_nivel)):
				$xp = (($enemy_nivel*(($enemy_nivel+1)*100))+($enemy_nivel+1)*100)/2;
				if($enemy_nivel > $player_nivel):
					$dif = ($enemy_nivel-$player_nivel);
					$xp_ganho = $xp*$dif;
				elseif($enemy_nivel < $player_nivel):
					$dif = ($player_nivel-$enemy_nivel);
					$xp_ganho = (int)($xp/$dif);
				else:
					$xp_ganho = $xp;
				endif;
			else:
				$erro = 1;
			endif;
		else:
			$erro = 1;		
		endif;

		if($erro == 1):
			return false;
		else:
			return $xp_ganho;
		endif;
		
	}

	function __set($propiedade, $valor){
		$this->$propiedade = $valor;
	}

	function __get($propiedade){
		return $this->atributos[$propiedade];
	}
}
?>