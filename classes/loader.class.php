<?php
/**
 * @author Mackon Rangel
 * @copyright 2014
 * @name Dungeon Evolutio Armas gerador
 * @email maickonmaickon@hotmail.com
 */
class Loader{
	static $url_base = "http://127.0.0.1/Dungeon-Evolution-master/";
	//static $url_base = "http://dungeonevolution.orgfree.com/";
	static $path_base;
	private $atributos = array();

	function __construct($atributos = array('css','classes','paginas','img','modulos')){
		$this->atributos = $atributos;	
		Loader::$path_base = dirname(__DIR__)."/";	
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

	function __init__(){
		$this->css 		= Loader::$path_base.'css/';
		$this->classes 	= Loader::$path_base.'classes/';
		$this->paginas 	= Loader::$url_base.'paginas/';
		$this->modulos 	= Loader::$path_base.'modulos/';
		$this->img 		= array(
							'elementos'=>Loader::$url_base.'img/elementos/',
							'ficha'=>Loader::$url_base.'img/ficha/',
							'logo'=>Loader::$url_base.'img/logo/',
							'pedras'=>Loader::$url_base.'img/pedras/');
	}

	function load_files($path){
		$barra_n = "\n";
		if(opendir($path)):
			$pasta = opendir($path);
			$lista_de_arquivo = array();
			$i=0;
			while($p = readdir($pasta)):
				if($p != '.' and $p != '..'):
					$lista_de_arquivo[$i] = $p;
					$i++;
				endif;
			endwhile;
		
			for($i=0;$i<count($lista_de_arquivo);$i++):
				//print $path.$lista_de_arquivo[$i].$barra_n;	
				require_once $path.$lista_de_arquivo[$i];
				echo $barra_n;		
			endfor;
		else:
			return 0;
		endif;
	}

	function load_img($file){
		return $this->img['logo'].$file;
	}

	function load_css($css_path,$import=false){
		if(opendir($css_path)):
			$pasta = opendir($css_path);
			$barra_n = "\n";
			$css = array();
			$i=0;
			while($p = readdir($pasta)):
				if($p != '.' and $p != '..'):
					$css[$i] = $p;
					$i++;
				endif;
			endwhile;
			$url_css = Loader::$url_base .'css/';
			$arqCss = $css;
			for($i=0;$i<count($arqCss);$i++):
				if($import == true):
					print '<style type="text/css">@import url("'.$url_css.$arqCss[$i].'");</style>'.$barra_n.'';
				else:
					print '<link href="'.$url_css.$arqCss[$i].'" rel="stylesheet"" />'.$barra_n.'';
				endif;
			endfor;
		else:
			return 0;
		endif;
	}
}
?>