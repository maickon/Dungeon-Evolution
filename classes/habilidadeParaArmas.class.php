<?php
/**
 * @author Mackon Rangel
 * @copyright 2014
 * @name Dungeon Evolutio Armas gerador
 * @email maickonmaickon@hotmail.com
 */
class HabilidadeParaArmas{
	private $img = "img/elementos/";
	private $atributos = array();

	function __construct($atributos = array('nivel','raridade','dado_de_dano','preco_habilidade','dano_medio','dano','elemento','descricao')){
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

	function preco_por_habilidade(){
		$preco_por_dado = $this->nivel;
		switch($this->dado_de_dano):
			case 'Nenhum':$preco_por_dado *= 0;
			break;

			case 'd6':$preco_por_dado *= 250;
			break;

			case 'd8':$preco_por_dado *= 450;
			break;

			case 'd10':$preco_por_dado *= 650;
			break;

			case 'd12':$preco_por_dado *= 850;
			break;
		endswitch;
		$this->preco_habilidade = $preco_por_dado;
	}

	function nivel_de_habilidade($nivel=null){
		if($nivel != null):
			$this->nivel = rand(1,$nivel);
		else:
			$this->nivel = rand(1,23);
		endif;	
	}

	function gerar_elemento(){
		$elementos =array('Fogo','Gelo/Frio','Ácido','Veneno','Luz','Trevas/Escuridão','Água','Vento','Eletricidade'); 
		$elemento_escolhido = rand(0,count($elementos)-1);
		$this->elemento = $elementos[$elemento_escolhido];
	}

	function carregar_img($nome){
		$this->img .=$nome;
	}

	function gerar_descricao(){
		$msg = "Esta arma tem a capacidade de causar $this->nivel.$this->dado_de_dano de dano adicional por ";
		switch($this->elemento):
			case 'Fogo':
				$this->descricao = $msg.$this->elemento;
				$this->carregar_img('fogo.png');
			break;

			case 'Gelo/Frio':
				$this->descricao = $msg.$this->elemento;
				$this->carregar_img('gelo.png');
			break;

			case 'Ácido':
				$this->descricao = $msg.$this->elemento;
				$this->carregar_img('acido.png');
			break;

			case 'Veneno':
				$this->descricao = $msg.$this->elemento;
				$this->carregar_img('veneno.png');
			break;

			case 'Luz':
				$this->descricao = $msg.$this->elemento;
				$this->carregar_img('luz.png');
			break;

			case 'Trevas/Escuridão':
				$this->descricao = $msg.$this->elemento;
				$this->carregar_img('escuridao.png');
			break;

			case 'Água':		
				$this->descricao = $msg.$this->elemento;
				$this->carregar_img('agua.png');
			break;

			case 'Vento':
				$this->descricao = $msg.$this->elemento;
				$this->carregar_img('vento.png');
			break;

			case 'Eletricidade':
				$this->descricao = $msg.$this->elemento;
				$this->carregar_img('eletrico.png');
			break;
		endswitch;
	}

	function definir_dado_de_dano(){
		switch($this->raridade):
			case 'Comum':$this->dado_de_dano = 'Nenhum';
						 $this->dano_medio = 0;
			break;

			case 'Mágico':$this->dado_de_dano = 'd6';
						  $this->dano_medio = ' +'.$this->nivel.$this->dado_de_dano;
						  $this->dano = 3*$this->nivel;
			break;

			case 'Raro':$this->dado_de_dano = 'd8';
						$this->dano_medio = ' +'.$this->nivel.$this->dado_de_dano;
						$this->dano = 4*$this->nivel;
			break;

			case 'Lendário':$this->dado_de_dano = 'd10';
							$this->dano_medio = ' +'.$this->nivel.$this->dado_de_dano;
							$this->dano = 5*$this->nivel;

			case 'Único':$this->dado_de_dano = 'd12';
					     $this->dano_medio = ' +'.$this->nivel.$this->dado_de_dano;
					     $this->dano = 6*$this->nivel;
			break;
		endswitch;
	}

	function barra_de_progresso($habilidade, $tipo){
		if(is_numeric($habilidade)):
			$barra = (int)($habilidades/1);
			for($i=1; $i<=$barra; $i++):
				echo '<div class="'.$tipo.'">
					  </div>';	  
			endfor;
		else:
			return false;
		endif;
	}

	function hab_img(){
		echo "<span class='hab_img'>
				<img src=".$this->img." class='hab_img'>
			  </span>";
	}

	function descricao(){
		echo "<span class='label_hab'>Descrição: {$this->descricao}</span>";
	}

	function elemento(){
		echo "<span class='label_hab'>Elemento: {$this->elemento}</span>";
	}

	function exibir_habilidade($nivel = null){
		echo '<hr>';
		echo '<br />';
		echo '<div class"habilidades">';
			echo '<div class"hab_logo">';
				$this->hab_img();
			echo '</div>';
			echo '<div class"hab_descricao">';
				$this->elemento();
				$this->descricao();
			echo '</div>';
		echo '</div>';
		echo '<br />';
	}

	function inicializar_habilidade($nivel){
		if($nivel != null):
			$this->nivel = rand(1,$nivel);
		else:
			$this->nivel = rand(1,23);
		endif;
		$this->definir_dado_de_dano();
		$this->preco_por_habilidade();
		$this->gerar_elemento();
		$this->gerar_descricao();
		
	}
}
?>