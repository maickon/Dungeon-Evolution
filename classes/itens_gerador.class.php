<?php
/**
 * @author Mackon Rangel
 * @copyright 2014
 * @name Dungeon Evolutio Armas gerador
 * @email maickonmaickon@hotmail.com
 */
abstract class ItemGerador{
	private $atributos = array();

	function __construct($atributos = array()){
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
}

class ArmasGerador extends ItemGerador{

	function __construct($atributos){
		parent::__construct($atributos);	
	}

	function pegar_armas(){
		$file = new Arquivo();
		$armas = array();
		$file->open_file('arquivos/itens_criados/armas_de_uma_mao.txt','r');
		$lista = $file->read_file_armas();
		for($i=0; $i<count($lista); $i++):
			$armas[$i] = explode('\r\n', utf8_encode($lista[$i]));
		endfor;
		$file->close_file();
		
		return $armas;
	}

	function gerar_bonus(){
		$armas = $this->pegar_armas();
		$armas_txt = '';
		$_n = "\r\n";

		$nivel;
		$escolhido = rand(0,100000000);
		if($escolhido >=0 and $escolhido<= 10):
			$nivel = 'Bugado';
		elseif($escolhido >=11 and $escolhido<= 1000):
			$nivel = 'ultra_forte';
		elseif($escolhido >=1001 and $escolhido<= 10000):
			$nivel = 'mega_forte';
		elseif($escolhido >=10001 and $escolhido<= 100000):
			$nivel = 'extra_forte';
		elseif($escolhido >=100001 and $escolhido<= 30000000):
			$nivel = 'forte';
		elseif($escolhido >=30000001 and $escolhido<= 70000000):
			$nivel = 'medio';
		elseif($escolhido >=70000001 and $escolhido<= 100000000):
			$nivel = 'fraco';
		endif;	

		for($i=0; $i<count($armas); $i++):
			
			switch($escolhido):
				case 'fraco':
					$armas[$i][0] .="-".(string)rand(1,5).$_n;
					$armas_txt .= $armas[$i][0];
				break;

				case 'medio':
					$armas[$i][0] .="-".(string)rand(5,10).$_n;
					$armas_txt .= $armas[$i][0];
				break;

				case 'normal':
					$armas[$i][0] .="-".(string)rand(10,15).$_n;
					$armas_txt .= $armas[$i][0];
				break;

				case 'forte':
					$armas[$i][0] .="-".(string)rand(15,20).$_n;
					$armas_txt .= $armas[$i][0];
				break;

				case 'extra_forte':
					$armas[$i][0] .="-".(string)rand(20,25).$_n;
					$armas_txt .= $armas[$i][0];
				break;

				case 'mega_forte':
					$armas[$i][0] .="-".(string)rand(25,30).$_n;
					$armas_txt .= $armas[$i][0];
				break;

				case 'ultra_forte':
					$armas[$i][0] .="-".(string)rand(30,35).$_n;
					$armas_txt .= $armas[$i][0];
				break;

				case 'Bugado':
					$armas[$i][0] .="-".(string)rand(35,40).$_n;
					$armas_txt .= $armas[$i][0];
				break;
				
			endswitch;
		endfor;	

		$file = new Arquivo();
		echo Loader::$url_base.'arquivos/itens/armas_de_uma_mao.txt';
		$file->open_file(Loader::$url_base.'/arquivos/itens/armas_de_uma_mao.txt','r');
		if($file->write_file($armas_txt)):
			echo 'gravado';
		else:
			echo 'nao gravado';
		endif;
		$file->close_file();
	}
}

?>