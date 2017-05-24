<?php
/**
 * @author Mackon Rangel
 * @copyright 2014
 * @name Dungeon Evolutio Armas gerador
 * @email maickonmaickon@hotmail.com
 */
class Armas{
	private $atributos = array();
	private $label;
	function __construct($atributos = array('nivel','preco','dano','habilidades','qtd_habilidade','encaixes','raridade','indice_raridade','encaixes_livres','tipo','categoria','np','pedras')){
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

	function definir_raridade($nivel){
		$probabilidade = rand(1,1000000-($nivel*10000));
		if($probabilidade >= 1 and $probabilidade <= 1000):
			$this->raridade = 'Único';
			$this->label = 'unico';
			$this->indice_raridade = 5;
		elseif($probabilidade >= 1001 and $probabilidade <= 10000):
			$this->raridade = 'Lendário';
			$this->label = 'lendario';
			$this->indice_raridade = 4;
		elseif($probabilidade >= 10001 and $probabilidade <= 100000):
			$this->raridade = 'Raro';
			$this->label = 'raro';
			$this->indice_raridade = 3;
		elseif($probabilidade >= 100001 and $probabilidade <= 400000):
			$this->raridade = 'Mágico';
			$this->label = 'magico';
			$this->indice_raridade = 2;
		elseif($probabilidade >= 400001 and $probabilidade <= 1000000):
			$this->raridade = 'Comum';
			$this->label = 'comum';
			$this->indice_raridade = 1;
		endif;
	}

	function definir_qtd_de_habilidades(){
		switch($this->raridade):
			case 'Comum':$this->qtd_habilidade = 0;
			break;

			case 'Mágico':
				$probabilidade = rand(1,100000);
				if($probabilidade >= 1 and $probabilidade<= 9000):
					$this->qtd_habilidade = 3;
				elseif($probabilidade >= 9001 and $probabilidade<= 40000):
					$this->qtd_habilidade = 2;
				else:
					$this->qtd_habilidade = 1;
				endif;
			break;

			case 'Raro':
				$probabilidade = rand(1,100000);
				if($probabilidade >= 1 and $probabilidade<= 900):
					$this->qtd_habilidade = 5;
				elseif($probabilidade >= 901 and $probabilidade<= 30000):
					$this->qtd_habilidade = 4;
				else:
					$this->qtd_habilidade = 3;
				endif;
			break;

			case 'Lendário':
				$probabilidade = rand(1,100000);
				if($probabilidade >= 1 and $probabilidade<= 90):
					$this->qtd_habilidade = 7;
				elseif($probabilidade >= 91 and $probabilidade<= 20000):
					$this->qtd_habilidade = 6;
				else:
					$this->qtd_habilidade = 5;
				endif;
			break;

			case 'Único':
				$probabilidade = rand(1,100000);
				if($probabilidade >= 1 and $probabilidade<= 9):
					$this->qtd_habilidade = 8;
				elseif($probabilidade >= 10 and $probabilidade<= 10000):
					$this->qtd_habilidade = 7;
				else:
					$this->qtd_habilidade = 6;
				endif;
			break;
		endswitch;
	}

	function embutir_habilidades(){
		if($this->qtd_habilidade == 0):
			return false;
		else:
			$this->habilidades = array();
			for($i=1; $i<=$this->qtd_habilidade;$i++):
				$this->habilidades[$i] = new HabilidadeParaArmas();
				$this->habilidades[$i]->nivel = rand(1,$this->nivel);
				$this->habilidades[$i]->raridade = $this->raridade;
			endfor;	
		endif;
	}

	function init_habilidades(){
		for($i=1; $i<=$this->qtd_habilidade;$i++):
			$this->habilidades[$i]->inicializar_habilidade($this->nivel);
		endfor;
	}

	function exibir_habilidades_embutidas(){
		for($i=1; $i<=$this->qtd_habilidade;$i++):
			$this->habilidades[$i]->exibir_habilidade($this->nivel);
		endfor;
	}

	function tipo_uma_mao() {
		$file = new Arquivo();
		$file->open_file('arquivos/itens/armas_de_uma_mao.txt','r');	
		$tipos = $file->read_file_armas();

		$categoria = array();
		$armas_de_uma_mao = array();

		for($i=0; $i<count($tipos)-1; $i++):
			$categoria[$i] = explode('-', $tipos[$i]);
		endfor;
		$file->close_file();

		$escolido = rand (0, count($categoria)-1);
		$this->categoria = "Arma de uma mão";

		return utf8_encode($categoria[$escolido][1]);
	}

	function tipo_duas_maos() {
		$file = new Arquivo();
		$file->open_file('arquivos/itens/arma_de_duas_maos.txt','r');	
		$tipos = $file->read_file_armas();

		$categoria = array();

		for($i=0; $i<count($tipos); $i++):
			$categoria[$i] = explode('-', $tipos[$i]);
		endfor;
		$file->close_file();

		$escolido = rand (0, count($categoria)-1);
		$this->categoria = "Arma de duas mãos";
	
		return utf8_encode($categoria[$escolido][1]);
	}

	function gerar_tipo() {
		$tipo = rand ( 1, 3 );
		$escolido = null;
		switch ($tipo) :
			case 1 :
				$escolido = $this->tipo_uma_mao();
			break;
				
			case 2 :
				$escolido = $this->tipo_uma_mao();
				break;
					
			case 3 :
				$escolido = $this->tipo_duas_maos();
				break;
		endswitch;
	
		$this->tipo = $escolido;
	}

	function encaixes(){
		if($this->nivel >=1 && $this->nivel <=7):
			$this->encaixes = 0;
		elseif($this->nivel >=8 && $this->nivel <=14):
			if($this->categoria == "Arma de uma mão"):
				$chance_enceixe = rand(1, 10);
				if($chance_enceixe <=3):
					$this->encaixes = 2;
				else:
					$this->encaixes = 1;
				endif;
			elseif($this->categoria == "Arma de duas mãos"):
				$chance_enceixe = rand(1, 10);
				if($chance_enceixe <=3):
					$this->encaixes = 1;
				else:
					$this->encaixes = 2;
				endif;
			endif;
		elseif($this->nivel >=15 && $this->nivel <=21):
			if($this->categoria == "Arma de uma mão"):
				$chance_enceixe = rand(1, 10);
				if($chance_enceixe <=6):
					$this->encaixes = 2;
				else:
					$this->encaixes = 1;
				endif;
			elseif($this->categoria == "Arma de duas mãos"):
				$chance_enceixe = rand(1, 10);
				if($chance_enceixe <=1):
					$this->encaixes = 1;
				elseif($chance_enceixe <=4):
					$this->encaixes = 2;
				else:	
					$this->encaixes = 3;
				endif;
			endif;
		else:
			if($this->categoria == "Arma de uma mão"):
				$chance_enceixe = rand(1, 10);
				if($chance_enceixe <=9):
					$this->encaixes = 2;
				else:
					$this->encaixes = 1;
				endif;
			elseif($this->categoria == "Arma de duas mãos"):
				$chance_enceixe = rand(1, 10);
				if($chance_enceixe <=2):
					$this->encaixes = 2;
				elseif($chance_enceixe <=7):
					$this->encaixes = 3;
				else:	
					$this->encaixes = 4;
				endif;
			endif;
			
		endif;
	}
	
	function gerar_dano(){
		$file = new Arquivo();
		$armas = array();
		if($this->categoria == "Arma de duas mãos"):
			$file->open_file('arquivos/itens/arma_de_duas_maos.txt','r');	
		else:
			$file->open_file('arquivos/itens/armas_de_uma_mao.txt','r');
		endif;	
		$tipos = $file->read_file_armas();
		for($i=0; $i<count($tipos); $i++):
			$armas[$i] = explode('-', $tipos[$i]);
		endfor;
		$file->close_file();

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
		
		switch($nivel):
			case 'fraco':
				for($i=0; $i<count($armas); $i++):
					switch($this->tipo):
						case $this->tipo == utf8_encode($armas[$i][1]):$this->dano = (rand(1,5)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;

			case 'medio':
				for($i=0; $i<count($armas); $i++):
					switch($this->tipo):
						case $this->tipo == utf8_encode($armas[$i][1]):$this->dano = (rand(5,10)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;

			case 'normal':
				for($i=0; $i<count($armas); $i++):
					switch($this->tipo):
						case $this->tipo == utf8_encode($armas[$i][1]):$this->dano = (rand(10,15)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;

			case 'forte':
				for($i=0; $i<count($armas); $i++):
					switch($this->tipo):
						case $this->tipo == utf8_encode($armas[$i][1]):$this->dano = (rand(15,20)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;

			case 'extra_forte':
				for($i=0; $i<count($armas); $i++):
					switch($this->tipo):
						case $this->tipo == utf8_encode($armas[$i][1]):$this->dano = (rand(20,25)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;

			case 'mega_forte':
				for($i=0; $i<count($armas); $i++):
					switch($this->tipo):
						case $this->tipo == utf8_encode($armas[$i][1]):$this->dano = (rand(25,30)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;

			case 'ultra_forte':
				for($i=0; $i<count($armas); $i++):
					switch($this->tipo):
						case $this->tipo == utf8_encode($armas[$i][1]):$this->dano = (rand(30,35)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;

			case 'Bugado':
				for($i=0; $i<count($armas); $i++):
					switch($this->tipo):
						case $this->tipo == utf8_encode($armas[$i][1]):$this->dano = (rand(35,40)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;
		endswitch;	
	}

	function gerar_preco(){
		$preco = ($this->nivel*150)+($this->dano*100)+($this->encaixes*10000)+($this->qtd_habilidade*5000);
		$this->preco = $preco.' PO';
	}

	function definir_espaco_livre(){
		if($this->encaixes == 0):
			$this->encaixes_livres = " 0 ";
		else:
			$this->encaixes_livres = rand(0,$this->encaixes);
			$this->encaixes -= $this->encaixes_livres;
		endif;	
	}

	function embutir_pedras(){
		$pedras = array('ruby','esmeralda','safira','topazio','diamante','ametista');
		if($this->encaixes == 0):
			return false;
		else:
			$this->pedras = array();
			for($i=1; $i<=$this->encaixes;$i++):
				switch($pedras[rand(0,5)]):
					case 'ruby':
						$this->pedras[$i] = new Pedras_vermelhas();
						$this->pedras[$i]->nivel = rand(1,$this->nivel);	
					break;

					case 'esmeralda':
						$this->pedras[$i] = new Pedras_verdes();
						$this->pedras[$i]->nivel = rand(1,$this->nivel);
					break;

					case 'safira':
						$this->pedras[$i] = new Pedras_roxas();
						$this->pedras[$i]->nivel = rand(1,$this->nivel);
					break;

					case 'diamante':
						$this->pedras[$i] = new Pedras_rosas();
						$this->pedras[$i]->nivel = rand(1,$this->nivel);	
					break;

					case 'ametista':
						$this->pedras[$i] = new Pedras_azuis();
						$this->pedras[$i]->nivel = rand(1,$this->nivel);
					break;

					case 'topazio':
						$this->pedras[$i] = new Pedras_amarelas();
						$this->pedras[$i]->nivel = rand(1,$this->nivel);
					break;			
				endswitch;
			endfor;
		endif;
	}

	function init_pedras_embutidas(){
		for($i=1; $i<=$this->encaixes;$i++):
			if(get_class($this->pedras[$i]) == 'Pedras_vermelhas'):
				$this->pedras[$i]->gerar_pedra_vermelha();
			elseif(get_class($this->pedras[$i]) == 'Pedras_verdes'):
				$this->pedras[$i]->gerar_pedra_verde();	
			elseif(get_class($this->pedras[$i]) == 'Pedras_roxas'):
				$this->pedras[$i]->gerar_pedra_roxa();
			elseif(get_class($this->pedras[$i]) == 'Pedras_amarelas'):
				$this->pedras[$i]->gerar_pedra_amarela();
			elseif(get_class($this->pedras[$i]) == 'Pedras_rosas'):
				$this->pedras[$i]->gerar_pedra_rosa();
			elseif(get_class($this->pedras[$i]) == 'Pedras_azuis'):
				$this->pedras[$i]->gerar_pedra_azul();
			endif;
		endfor;
	}

	function exibir_pedras_embutidas(){
		for($i=1; $i<=$this->encaixes;$i++):
			$this->pedras[$i]->exibir_pedra();
		endfor;
	}

	function gerar_preco_total(){
		$preco_pedra = 0;
		$preco_por_habilidade = 0;
		for($i=1; $i<=$this->encaixes;$i++):
			$preco_pedra += $this->pedras[$i]->preco;
		endfor;

		for($i=1; $i<=$this->qtd_habilidade;$i++):
			$preco_por_habilidade += $this->habilidades[$i]->preco_habilidade;
		endfor;

		return $this->preco+$preco_pedra+$preco_por_habilidade;
	}

	function gerar_dano_total(){
		$dano_toal = 0;
		for($i=1; $i<=$this->encaixes;$i++):
			if(get_class($this->pedras[$i]) == 'Pedras_vermelhas'):
				$dano_toal += $this->pedras[$i]->dano;	
			endif;
		endfor;

		return ($this->dano+$dano_toal).' '.$this->dado_de_dano_das_habilidades();
	}

	function dano_total_ineiro(){
		$dano_toal = 0;
		for($i=1; $i<=$this->encaixes;$i++):
			if(get_class($this->pedras[$i]) == 'Pedras_vermelhas'):
				$dano_toal += $this->pedras[$i]->dano;	
			endif;
		endfor;

		for($i=1; $i<=$this->qtd_habilidade;$i++):
			$dano_toal += $this->habilidades[$i]->dano;	
		endfor;

		return ($this->dano+$dano_toal);
	}

	function dado_de_dano_das_habilidades(){
		$preco_por_habilidade = '';
		for($i=1; $i<=$this->qtd_habilidade;$i++):
			$preco_por_habilidade .= $this->habilidades[$i]->dano_medio;
		endfor;	
		return $preco_por_habilidade;
	}

	function calcular_np(){
		$np_total = 0;
		for($i=1; $i<=$this->encaixes;$i++):
			if(get_class($this->pedras[$i]) == 'Pedras_vermelhas'):
				$np_total += (
							($this->pedras[$i]->dano)+
							($this->pedras[$i]->precisao)+
							($this->pedras[$i]->habilidade)+
							($this->pedras[$i]->experiencia/100)
							);
			
			elseif(get_class($this->pedras[$i]) == 'Pedras_verdes'):
				$np_total += (
							($this->pedras[$i]->habilidade)+
							($this->pedras[$i]->esquiva)+
							($this->pedras[$i]->critico)+
							($this->pedras[$i]->precisao_distancia)
							);
		
			elseif(get_class($this->pedras[$i]) == 'Pedras_roxas'):
				$np_total += (
							($this->pedras[$i]->vigor)+
							($this->pedras[$i]->rd)+
							($this->pedras[$i]->regeneracao)+
							($this->pedras[$i]->vida_por_acerto/10)
							);
			elseif(get_class($this->pedras[$i]) == 'Pedras_amarelas'):
				$np_total += (
							($this->pedras[$i]->habilidade)+
							($this->pedras[$i]->ouro_extra/100)+
							($this->pedras[$i]->dano)+
							($this->pedras[$i]->chance)
							);
			elseif(get_class($this->pedras[$i]) == 'Pedras_rosas'):
				$np_total += (
							($this->pedras[$i]->habilidade)+
							($this->pedras[$i]->ouro_extra/100)+
							($this->pedras[$i]->vida_extra)+
							($this->pedras[$i]->sorte)
							);
			elseif(get_class($this->pedras[$i]) == 'Pedras_azuis'):
				$np_total += (
							($this->pedras[$i]->habilidade)+
							($this->pedras[$i]->deflexao)+
							($this->pedras[$i]->dano)+
							($this->pedras[$i]->pts_hab)
							);
			endif;
		endfor;

		for($i=1; $i<=$this->qtd_habilidade;$i++):
			$np_total += $this->habilidades[$i]->dano_medio;
		endfor;

		$nivel_de_poder_final = $this->nivel+$this->encaixes+$this->dano+$np_total;
		$this->np = $nivel_de_poder_final;
	}

	function exibir_arma_sorteada($nivel=null){
		$this->init_armas($nivel);
		echo '<div class="armas '.$this->label.'">';
			$this->nome();
			$this->raridade();
			$this->preco();
			$this->preco_completo();
			$this->categoria();
			$this->encaixe_livre();
			$this->encaixe();
			$this->nivel();
			$this->np();
			$this->dano();
			$this->exibir_pedras_embutidas();
			$this->exibir_habilidades_embutidas($nivel);		
		echo '</div>';
	}

	function init_armas($nivel=null){
		if($nivel != null):
			$this->nivel = rand(1,$nivel);
		else:
			$this->nivel = rand(1,23);
		endif;
		$this->gerar_tipo();
		$this->encaixes();
		$this->definir_espaco_livre();
		$this->embutir_pedras();
		$this->init_pedras_embutidas();
		$this->definir_raridade($nivel);
		$this->gerar_dano();
		$this->definir_qtd_de_habilidades();
		$this->embutir_habilidades();
		$this->gerar_preco();
		$this->init_habilidades();
		$this->calcular_np();
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
			endswitch;	
		else:
			return false;
		endif;
	}

	function nome(){
		echo "<span class='label'>{$this->tipo}</span>";
	}

	function raridade(){
		echo "<span class='label'>Raridade: {$this->raridade}</span>";
	}

	function preco(){
		echo "<span class='label'>Preço da arma: {$this->preco}</span>";
	}

	function preco_completo(){
		echo "<span class='label'>Preço total: {$this->gerar_preco_total()}</span>";
	}

	function categoria(){
		echo "<span class='label'>Categoria: {$this->categoria}</span>";
	}

	function encaixe(){
		echo "<span class='label'>Encaixes: {$this->encaixes}</span>";
	}

	function encaixe_livre(){
		echo "<span class='label'>Esta arma possui {$this->encaixes_livres} slot de encaixe livre.</span>";
	}

	function nivel(){
		echo "<span class='label'>Requisito mínimo para usar esta arma: {$this->nivel}°Nível</span>";
	}

	function np(){
		echo "<span class='label'>Nível de Poder NP: {$this->np}</span>";
		echo '<div class="bord-level">';
			$this->barra_de_progresso($this->np,'np');
		echo '</div>';
	}

	function dano(){
		echo "<span class='label'>Dano: {$this->gerar_dano_total()}</span>";
		echo '<div class="bord-level">';
			$this->barra_de_progresso($this->dano_total_ineiro(),'dano');
		echo '</div>';
	}

}


class LojaDeArmas{
	public $armas;

	function addArma(Armas $arma){
		$this->armas[] = $arma;		
	}

	function exportar_arma_para_txt(){
		$txt_path = "arquivos/exportados/armas/";
		$path = Loader::$path_base.$txt_path;
		$url = Loader::$url_base.$txt_path;
		$arquivo = new Arquivo();
		$data = time('H:i:s').date('dmY');
		$path_final = $path.'Dungeon Evolutio - '.utf8_decode(trim($this->armas[0]->tipo).' '.$this->armas[0]->raridade).' ID '.$data.'.txt';
			
		$arquivo->open_file($path_final);
		$arquivo->write_file(utf8_decode($this->montar_arquivo_txt_da_arma()));
	}

	function montar_arquivo_txt_da_arma(){
		$_n = "\r\n";
		$arquivo_txt = '';
	
		for($i=0; $i<=count($this->armas)-1;$i++):	
			$arquivo_txt .= 
				'>>>>>>>>>>>>'.trim($this->armas[$i]->tipo).' Lv'.$this->armas[$i]->nivel.'<<<<<<<<<<<<'.$_n.
				'Raridade: '.$this->armas[$i]->raridade.$_n.
				'Preço da arma: '.$this->armas[$i]->preco.$_n.
				'Preço total: '.$this->armas[$i]->gerar_preco_total().$_n.
				'Categoria: '.$this->armas[$i]->categoria.$_n.
				'Esta arma possui '.$this->armas[$i]->encaixes_livres.' slot de encaixe livre'.$_n.
				'Encaixes '.$this->armas[$i]->encaixes.$_n.
				'Indicada para o nível: '.$this->armas[$i]->nivel.$_n.
				'Nível de poder (NP): '.$this->armas[$i]->np.$_n.
				'Dano: '.$this->armas[$i]->gerar_dano_total().$_n
				;

				
				if($this->armas[$i]->encaixes != 0):
					for($e=1; $e<=($this->armas[$i]->encaixes);$e++):
						if(get_class($this->armas[$i]->pedras[$e]) == 'Pedras_vermelhas'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->armas[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->armas[$i]->pedras[$e]->preco.$_n.	
								'Preço para Venda: '.$this->armas[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->armas[$i]->pedras[$e]->nivel.$_n.
								'Bônus de experiência: '.$this->armas[$i]->pedras[$e]->experiencia.$_n.
								'Bônus de dano: '.$this->armas[$i]->pedras[$e]->dano.$_n.
								'Bônus em habilidade (Força): '.$this->armas[$i]->pedras[$e]->habilidade.$_n.
								'Bônus de precisão: '.$this->armas[$i]->pedras[$e]->precisao.$_n;
						
						elseif(get_class($this->armas[$i]->pedras[$e]) == 'Pedras_verdes'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->armas[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->armas[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->armas[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->armas[$i]->pedras[$e]->nivel.$_n.
								'Bônus de esquiva: '.$this->armas[$i]->pedras[$e]->esquiva.$_n.
								'Chance de crítico: '.$this->armas[$i]->pedras[$e]->critico.$_n.
								'Bônus de precisao a distância: '.$this->armas[$i]->pedras[$e]->precisao_distancia.$_n.
								'Bônus em habilidade (Destreza): '.$this->armas[$i]->pedras[$e]->habilidade.$_n;

						elseif(get_class($this->armas[$i]->pedras[$e]) == 'Pedras_roxas'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->armas[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->armas[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->armas[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->armas[$i]->pedras[$e]->nivel.$_n.
								'Bônus em habilidade (Vigor): '.$this->armas[$i]->pedras[$e]->vigor.$_n.
								'Bônus de Redução de Dano: '.$this->armas[$i]->pedras[$e]->rd.$_n.
								'Regenera por rodada: '.$this->armas[$i]->pedras[$e]->regeneracao.$_n.
								'Recuperação de vida por acerto: '.$this->armas[$i]->pedras[$e]->vida_por_acerto.$_n;

						elseif(get_class($this->armas[$i]->pedras[$e]) == 'Pedras_amarelas'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->armas[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->armas[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->armas[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->armas[$i]->pedras[$e]->nivel.$_n.
								'Bônus de ouro extra a cada sessão: '.$this->armas[$i]->pedras[$e]->ouro_extra.$_n.
								'Bônus em habilidade (Inteligência): '.$this->armas[$i]->pedras[$e]->habilidade.$_n.
								'Aumento de dano em Magias: '.$this->armas[$i]->pedras[$e]->dano.$_n.
								'Aumenta seu DL(Drop Level): '.$this->armas[$i]->pedras[$e]->chance.$_n;

						elseif(get_class($this->armas[$i]->pedras[$e]) == 'Pedras_rosas'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->armas[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->armas[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->armas[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->armas[$i]->pedras[$e]->nivel.$_n.
								'Bônus de ouro extra a cada sessão: '.$this->armas[$i]->pedras[$e]->ouro_extra.$_n.
								'Bônus em habilidade (Carisma): '.$this->armas[$i]->pedras[$e]->habilidade.$_n.
								'Aumento de Pvs reservas: '.$this->armas[$i]->pedras[$e]->vida_extra.$_n.
								'Aumenta seu DL(Drop Level)/Def/Esq: '.$this->armas[$i]->pedras[$e]->sorte.$_n;

						elseif(get_class($this->armas[$i]->pedras[$e]) == 'Pedras_azuis'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->armas[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->armas[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->armas[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->armas[$i]->pedras[$e]->nivel.$_n.
								'Bônus de deflexão: '.$this->armas[$i]->pedras[$e]->deflexao.$_n.
								'Bônus em habilidade (Sabedoria): '.$this->armas[$i]->pedras[$e]->habilidade.$_n.
								'Pontos de habilidade (PH): '.$this->armas[$i]->pedras[$e]->pts_hab.$_n.
								'Bônus de dano na habilidade de classe: '.$this->armas[$i]->pedras[$e]->dano.$_n;
						endif;
					endfor;
				endif;
					
				if($this->armas[$i]->qtd_habilidade != 0):
					for($h=1; $h<=($this->armas[$i]->qtd_habilidade);$h++):
						$arquivo_txt .= $_n.
							'>>>>>>>>>>>>Habilidades<<<<<<<<<<<<'.$_n.
							'Elemento: '.$this->armas[$i]->habilidades[$h]->elemento.''.$_n.
							'Descrição: '.$this->armas[$i]->habilidades[$h]->descricao;
					endfor;
				endif;
			
				$arquivo_txt .= $_n.'_________________________________________________________________________________________________'.$_n;
			endfor;

		return $arquivo_txt;
	}

	function exibir_armas($nivel){
		echo '<div>';
			foreach ($this->armas as $key => $arma):
				$this->armas[$key]->exibir_arma_sorteada($nivel);
			endforeach;
		echo '</div>';	
	}

	function projatar_armas($qtd,$nivel=null){
		$objeto = 'arma_';
		$classe = 'Armas';

		usleep(300000);
		usleep(300000);
		for($i=0; $i<$qtd; $i++):
			$objeto = new $classe();
			$this->addArma($objeto); 	
		endfor;
		$this->exibir_armas($nivel);
	}
}
?>