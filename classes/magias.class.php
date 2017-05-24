<?php
class Magias{
	private $atributos = array();
	function __construct($atributos = array('nome','nivel','np','preco','tipo','dano','cura','status','mp','info')){
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

	function selecionar_magia(){
		$txt = ".txt";
		$arquivos = array('agua','terra','cura','especial','fogo','statusDown','statusUp','vento');
		$escolhido = rand(1,count($arquivos)-1);
		$arquivo_escolhido = $arquivos[$escolhido].$txt;
		$this->tipo = $arquivo_escolhido;
	}

	function escolher_magia(){
		$file = new Arquivo();
		$magias = array();
		$file->open_file('arquivos/magias/'.$this->tipo,'r');
		$lista = $file->read_file_magias();
		for($i=0; $i<count($lista); $i++):
			$magias[$i] = explode('-', $lista[$i]);
		endfor;
		$file->close_file();
		
		$escolido = rand (0, count($magias)-1);
		$this->nome = utf8_encode($magias[$escolido][0]);
	}

	function buscar_magia(){
		$file = new Arquivo();
		$magias = array();
		$file->open_file('arquivos/magias/'.$this->tipo,'r');
		$lista = $file->read_file_magias();
		for($i=0; $i<count($lista); $i++):
			$magias[$i] = explode('-', $lista[$i]);
		endfor;
		$file->close_file();
		
		for($i=0; $i<count($magias); $i++):
			switch($this->nome):
				case $this->nome == utf8_encode($magias[$i][0]):
						 $this->dano 	= $magias[$i][1]*$this->nivel;
						 $this->cura 	= $magias[$i][2]*$this->nivel;
						 $this->mp 	 	= $magias[$i][3]*$this->nivel;
						 $this->info 	= $magias[$i][4];
						 $this->status 	= $magias[$i][5]*$this->nivel;
				break;
			endswitch;
		endfor;	
	}

	function calcular_dano(){
		$dano_total = 0;
		if($this->dano == 0):
		else:
			for($i=0; $i<=$this->nivel; $i++):
				$dano_total +=rand(1,$this->dano-1);
			endfor;
		endif;
		return $dano_total;
	}

	function calcular_mp(){
		$mp_total = 0;
		if($this->mp == 0):
		else:
			for($i=0; $i<=$this->nivel; $i++):
				$mp_total +=rand(1,$this->mp);	
			endfor;
		endif;
		return $mp_total;
	}

	function calcular_cura(){
		$cura_total = 0;
		if($this->cura == 0):
		else:
			for($i=0; $i<=$this->nivel; $i++):
				$cura_total +=rand(1,$this->cura-1);
			endfor;
		endif;
		return $cura_total;
	}

	function calcular_info(){
		$status_total = 0;
		if($this->status == 0):
		else:
			for($i=0; $i<=$this->nivel; $i++):
				$status_total +=rand(1,$this->status-1);
			endfor;
		endif;
		if($status_total == 0)
				$status_total = '';
		return utf8_encode($this->info.$status_total);
	}

	function calcular_status(){
		$status_total = 0;
		if($this->status == 0):
		else:
			for($i=0; $i<=$this->nivel; $i++):
				$status_total +=rand(1,$this->status-1);
			endfor;
		endif;
		return $status_total;
	}

	function barra_de_progresso($habilidade, $tipo){
		if(is_numeric($habilidade)):
			switch($tipo):
				case 'np':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'dano':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'cura':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;
			endswitch;	
		else:
			return false;
		endif;
	}

	function calcular_np(){
		$this->np = ($this->nivel+$this->calcular_dano()+$this->calcular_mp()+$this->calcular_cura()+$this->calcular_status())/10;
	}

	function calcular_preco(){
		$this->preco = ($this->nivel*150)+(($this->calcular_dano()/10)*200)+(($this->calcular_cura()/10)*200)+(($this->calcular_status()/10)*200)+($this->np*150);
	}

	function nome(){
		echo "<span class='label'>{$this->nome} Lv {$this->nivel}</span>";
	}

	function nivel(){
		echo "<span class='label'>Requisito mínimo para usar esta magia: {$this->nivel}°Nível</span>";
	}

	function preco(){
		echo "<span class='label'>Preço: {$this->preco}</span>";
	}

	function info(){
		echo "<span class='label'>Info: {$this->calcular_info()}</span>";
	}

	function np(){
		echo "<span class='label'>Nível de Poder NP: {$this->np}</span>";
		echo '<div class="bord-level">';
			$this->barra_de_progresso($this->np,'np');
		echo '</div>';
	}

	function dano(){
		if($this->dano == 0):
		else:
			echo "<span class='label'>Dano: {$this->calcular_dano()}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->calcular_dano(),'dano');
			echo '</div>';
		endif;
	}

	function mp(){
		if($this->mp == 0):
		else:
			echo "<span class='label'>Custo de MP: {$this->calcular_mp()}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->calcular_mp(),'dano');
			echo '</div>';
		endif;
	}

	function cura(){
		if($this->cura == 0):
		else:
			echo "<span class='label'>Cura: {$this->calcular_cura()}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->calcular_cura(),'cura');
			echo '</div>';
		endif;
	}

	function exibir_magias_sorteada($nivel = null){
		$this->init_magia($nivel);
		echo '<div class="armas magico">';
			$this->nome();
			$this->nivel();
			$this->np();
			$this->dano();
			$this->mp();
			$this->cura();
			$this->preco();
			$this->info();
		echo '</div>';
	}

	function init_magia($nivel){
		if($nivel != null):
			$this->nivel = rand(1,$nivel);
		else:
			$this->nivel = rand(1,23);
		endif;
		$this->selecionar_magia();
		$this->escolher_magia();
		$this->buscar_magia();
		$this->calcular_np();
		$this->calcular_preco();
	}
}

class LojaDeMagias{
	public $magias;

	function addMagias(Magias $magias){
		$this->magias[] = $magias;		
	}

	function exibir_magias($nivel){
		echo '<div>';
			foreach ($this->magias as $key => $magias):
				$this->magias[$key]->exibir_magias_sorteada($nivel);
			endforeach;
		echo '</div>';	
	}

	function projatar_magias($qtd,$nivel=null){
		$objeto = 'magias_';
		$classe = 'Magias';

		usleep(300000);
		usleep(300000);
		for($i=0; $i<$qtd; $i++):
			$objeto = new $classe();
			$this->addMagias($objeto); 	
		endfor;
		$this->exibir_magias($nivel);
	}
}

?>