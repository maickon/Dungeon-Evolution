<?php
class Npc{
	private $atributos = array();
	function __construct($atributos = array('nome','nivel','tipo','forca','destreza','vigor','inteligencia','sabedoria','carisma','fator_vida','fator_pericia',
		'armas','defesa_escudo','rd_escudo','capacete','armadura','calcas','botas','ombreiras','magias','luvas','anel')){
		$this->atributos = $atributos;	
	}

	function add_atributo($novo_atributo){
		array_push($this->atributos, $novo_atributo);
	}

	function rm_atributo($atributo){
		foreach ($this->atributos as $key => $value):
			if($this->atributos[$key] == $atributo):
				unset($this->atributos[$key]);
			endif;
		endforeach;	
	}

	function __set($propiedade, $valor){
		$this->$propiedade = $valor;
	}

	function __get($propiedade){
		$atributo_out = 0;
		foreach ($this->atributos as $key => $value):
			if($this->atributos[$key] == $propiedade):
				if(!isset($this->$propiedade) && $this->$propiedade[$key] != 0):
					echo '<br />Atributo com nome '."<b>$propiedade</b>".' não foi inicializado!';
				else: 
					return $this->atributos[$propiedade];
				endif;
			else:
				$atributo_out = 1;		
			endif;
		endforeach;	
		if($atributo_out)
			echo '<br />A propiedade '."<b>$propiedade</b>".' não foi encontrada.<br />';
	}

	function hab_normal(){
		$this->forca = rand(10,15);
		$this->vigor = rand(10,15);
		$this->destreza = rand(10,15);
		$this->inteligencia = rand(10,15);
		$this->sabedoria = rand(10,15);
		$this->carisma = rand(10,15);	
	}

	function hab_forte(){
		$this->forca = rand(15,25);
		$this->vigor = rand(15,25);
		$this->destreza = rand(15,25);
		$this->inteligencia = rand(15,25);
		$this->sabedoria = rand(15,25);
		$this->carisma = rand(15,25);	
	}

	function hab_super_forte(){
		$this->forca = rand(25,40);
		$this->vigor = rand(25,40);
		$this->destreza = rand(25,40);
		$this->inteligencia = rand(25,40);
		$this->sabedoria = rand(25,40);
		$this->carisma = rand(25,40);	
	}

	function hab_mega_forte(){
		$this->forca = rand(40,65);
		$this->vigor = rand(40,65);
		$this->destreza = rand(40,65);
		$this->inteligencia = rand(40,65);
		$this->sabedoria = rand(40,65);
		$this->carisma = rand(40,65);	
	}

	function hab_ultra_forte(){
		$this->forca = rand(65,95);
		$this->vigor = rand(65,95);
		$this->destreza = rand(65,95);
		$this->inteligencia = rand(65,95);
		$this->sabedoria = rand(65,95);
		$this->carisma = rand(65,95);	
	}

	function hab_titan_forte(){
		$this->forca = rand(95,150);
		$this->vigor = rand(95,150);
		$this->destreza = rand(95,150);
		$this->inteligencia = rand(95,150);
		$this->sabedoria = rand(95,150);
		$this->carisma = rand(95,150);	
	}

	function nivel($nivel){
		$this->nivel = $nivel;
	}

	function pv(){
		return $this->fator_vida*$this->nivel;
	}

	function fator_vida(){
		$this->fator_vida = rand(6,12);
	}

	function fator_pericia(){
		$this->fator_pericia = rand(2,8);
	}

	function defesa(){
		$defesa_total = 50+
					$this->capacete->defesa+
					$this->armadura->defesa+
					$this->defesa_escudo+
					$this->anel->def+
					$this->luvas->defesa+
					$this->calcas->defesa+
					$this->botas->defesa+
					$this->ombreiras->defesa;
		return $defesa_total;
	}

	function reducao(){
		$rd_total = 
					$this->capacete->rd+
					$this->armadura->rd+
					$this->rd_escudo+
					$this->anel->rd+
					$this->luvas->rd+
					$this->calcas->rd+
					$this->botas->rd+
					$this->ombreiras->rd;
		return $rd_total;
	}

	function deslocamento(){
		return $this->destreza/2;
	}

	function iniciativa(){
		return $this->destreza;
	}

	function esquiva(){
		return $esqtuiva_total = 50+$this->destreza;
	}

	function precisao(){
		return $this->forca;
	}

	function habilidade(){
		return $this->sabedoria/2;
	}

	function defesa_por_escudo(){
		$this->defesa_escudo = 0;
	}

	function rd_por_escudo(){
		$this->rd_escudo = 0;
	}

	function verificar_arma_usada($nivel,$tipo){	
		switch($tipo):
			case 'Arma de uma mão':
				$arma = null;
				$t = true;
				while($t == true):
					$arma = new Armas();
					$arma->init_armas($nivel);
					if($arma->categoria == 'Arma de uma mão'):
						$t=false;
						return $arma;
					endif;
				endwhile;
			break;

			case 'Arma de duas mãos':
				$arma = null;
				$t = true;
				while($t == true):
					$arma = new Armas();
					$arma->init_armas($nivel);
					if($arma->categoria == 'Arma de duas mãos'):
						$t=false;
						return $arma;
					endif;
				endwhile;
			break;
		endswitch;
	}

	function gerar_arma_usada($nivel){
		$conjundo = array('arma','arma_escudo','duas_armas','arma_duas_maos');
		$conj_escolhido = $conjundo[rand(0,3)];
		$objetos;
		switch($conj_escolhido):
			case 'arma': $objetos[] = $this->verificar_arma_usada($nivel,'Arma de uma mão');
			break;

			case 'arma_escudo':	$objetos[] = $this->verificar_arma_usada($nivel,'Arma de uma mão');
								$escudos = new Escudos();
								$escudos->init_escudos($nivel);
								$this->defesa_escudo = $escudos->defesa;
								$this->rd_escudo = $escudos->rd;
								$objetos[] = $escudos;
			break;

			case 'duas_armas':	$objetos[] = $this->verificar_arma_usada($nivel,'Arma de uma mão');
								$objetos[] = $this->verificar_arma_usada($nivel,'Arma de uma mão');
			break;

			case 'arma_duas_maos': $objetos[] = $this->verificar_arma_usada($nivel,'Arma de duas mãos');
			break;
		endswitch;

		return $objetos;
	}

	function init_npc($nivel = null, $tipo = 1){
		if($nivel != null):
			$this->nivel($nivel);
		else:
			$this->nivel(rand(1,23));
		endif;
		$this->defesa_por_escudo();
		$this->rd_por_escudo();
		$this->fator_pericia();
		$this->fator_vida();
		$this->armas = $this->gerar_arma_usada($this->nivel);

		$this->capacete = new Capacetes;
		$this->capacete->init_capacetes($this->nivel);
		
		$this->armadura = new Armaduras;
		$this->armadura->init_armaduras($this->nivel);
		
		$this->anel = new Aneis;
		$this->anel->init_aneis($this->nivel);
		
		$this->luvas = new Luvas;
		$this->luvas->init_luvas($this->nivel);
		
		$this->calcas = new Calcas;
		$this->calcas->init_calcas($this->nivel);
		
		$this->botas = new Botas;
		$this->botas->init_botas($this->nivel);
		
		$this->ombreiras = new Ombreiras;
		$this->ombreiras->init_ombreiras($this->nivel);
		
		$this->magias = new Magias;
		$this->magias->init_magia($this->nivel);

		switch($tipo):
			case 1:$this->hab_normal();
					$this->tipo = "Normal";
			break;

			case 2:$this->hab_forte();
					$this->tipo = "Forte";
			break;

			case 3:$this->hab_super_forte();
					$this->tipo = "Super Forte";
			break;

			case 4:$this->hab_mega_forte();
					$this->tipo = "Mega Forte";
			break;

			case 5:$this->hab_ultra_forte();
					$this->tipo = "Ultra Forte";
			break;

			case 6:$this->hab_titan_forte();
					$this->tipo = "Hacker";
			break;
		endswitch;
	}
}
?>