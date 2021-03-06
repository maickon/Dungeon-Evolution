<?php
/**
 * @author Mackon Rangel
 * @copyright 2014
 * @name Dungeon Evolutio Armas gerador
 * @email maickonmaickon@hotmail.com
 */
class Capacetes{
	private $atributos = array();
	private $label;
	function __construct($atributos = array('nivel','nome','preco','encaixes','raridade','indice_raridade','label','encaixe_livre','defesa','rd','np','pedras')){
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

	function escolher_capacete(){
		$file = new Arquivo();
		$capacetes = array();
		$file->open_file('arquivos/itens/capacetes.txt','r');
		$lista = $file->read_file_armas();
		for($i=0; $i<count($lista); $i++):
			$capacetes[$i] = explode('-', $lista[$i]);
		endfor;
		$file->close_file();
		
		$escolido = rand (0, count($capacetes)-1);
		$this->nome = utf8_encode($capacetes[$escolido][1]);
	}

	function gerar_bonus(){
		$file = new Arquivo();
		$capacetes = array();
		$file->open_file('arquivos/itens/capacetes.txt','r');
		$lista = $file->read_file_armas();
		for($i=0; $i<count($lista); $i++):
			$capacetes[$i] = explode('-', $lista[$i]);
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
				for($i=0; $i<count($capacetes); $i++):
					switch($this->nome):
						case $this->nome ==  utf8_encode($capacetes[$i][1]):
								$this->defesa = (rand(1,2)*$this->nivel)*$this->indice_raridade;
							 	$this->rd = (rand(1,2)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;

			case 'medio':
				for($i=0; $i<count($capacetes); $i++):
					switch($this->nome):
						case $this->nome ==  utf8_encode($capacetes[$i][1]):
								$this->defesa = (rand(3,4)*$this->nivel)*$this->indice_raridade;
							 	$this->rd = (rand(3,4)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;

			case 'normal':
				for($i=0; $i<count($capacetes); $i++):
					switch($this->nome):
							case $this->nome ==  utf8_encode($capacetes[$i][1]):
								 $this->defesa = (rand(5,6)*$this->nivel)*$this->indice_raridade;
								 $this->rd = (rand(5,6)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;

			case 'forte':
				for($i=0; $i<count($capacetes); $i++):
					switch($this->nome):
							case $this->nome ==  utf8_encode($capacetes[$i][1]): 
									$this->defesa = (rand(7,8)*$this->nivel)*$this->indice_raridade;
							   		$this->rd = (rand(7,8)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;

			case 'extra_forte':
				for($i=0; $i<count($capacetes); $i++):
					switch($this->nome):
						case $this->nome ==  utf8_encode($capacetes[$i][1]):
							 	$this->defesa = (rand(9,20)*$this->nivel)*$this->indice_raridade;
							 	$this->rd = (rand(9,10)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;

			case 'mega_forte':
				for($i=0; $i<count($capacetes); $i++):
					switch($this->nome):
						case $this->nome ==  utf8_encode($capacetes[$i][1]):
							 	$this->defesa = (rand(11,12)*$this->nivel)*$this->indice_raridade;
								$this->rd = (rand(11,12)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;

			case 'ultra_forte':
				for($i=0; $i<count($capacetes); $i++):
					switch($this->nome):
						case $this->nome ==  utf8_encode($capacetes[$i][1]):
							 	$this->defesa = (rand(13,14)*$this->nivel)*$this->indice_raridade;
							 	$this->rd = (rand(13,14)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;

			case 'Bugado':
				for($i=0; $i<count($capacetes); $i++):
					switch($this->nome):
						case $this->nome ==  utf8_encode($capacetes[$i][1]):
							 	$this->defesa = (rand(15,20)*$this->nivel)*$this->indice_raridade;
								$this->rd = (rand(15,20)*$this->nivel)*$this->indice_raridade;
						break;
					endswitch;
				endfor;
			break;
		endswitch;	
	}

	function calcular_preco(){
		$this->preco = ($this->encaixes*10000+$this->defesa*250+$this->rd*300+$this->encaixe_livre*5000);
	}

	function definir_encaixes(){
		$chance_de_ter_pedra = rand(0,100000);
		if($chance_de_ter_pedra >= 0 and $chance_de_ter_pedra <=1000):
			$this->encaixes = 1;
		else:
			$this->encaixes = 0;
		endif;
	}	

	function definir_espaco_livre(){
		$chance_de_encaixe_livre = rand(0,10);
		if($chance_de_encaixe_livre >= 0 and $chance_de_encaixe_livre <=2):
			$this->encaixe_livre = 1;
		else:
			$this->encaixe_livre = 0;
		endif;
	}

	function embutir_pedras(){
		$pedras = array('ruby','esmeralda','safira','topazio','diamante','ametista');
		if($this->encaixes == 0):
			$this->definir_espaco_livre();
		else:
			$this->encaixe_livre = 0;
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
		for($i=1; $i<=$this->encaixes;$i++):
			$preco_pedra += $this->pedras[$i]->preco;
		endfor;

		return $this->preco+$preco_pedra;
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

		$nivel_de_poder_final = $this->nivel+$this->encaixes+$this->defesa+$this->rd+$np_total;
		$this->np = $nivel_de_poder_final;
	}

	function exibir_capacetes_sorteada($nivel=null){
		$this->init_capacetes($nivel);
		echo '<div class="armas '.$this->label.'">';
			$this->nome();
			$this->raridade();
			$this->preco();
			$this->preco_completo();
			$this->encaixe_livre();
			$this->encaixe();
			$this->nivel();
			$this->np();
			$this->defesa();
			$this->rd();
			$this->exibir_pedras_embutidas();		
		echo '</div>';
	}

	function init_capacetes($nivel=null){
		if($nivel != null):
			$this->nivel = rand(1,$nivel);
		else:
			$this->nivel = rand(1,23);
		endif;
		$this->escolher_capacete();
		$this->definir_raridade($nivel);
		$this->gerar_bonus();
		$this->definir_encaixes();
		$this->embutir_pedras();
		$this->init_pedras_embutidas();
		$this->calcular_preco();
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

				case 'defesa':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'reducao':
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
		echo "<span class='label'>{$this->nome}</span>";
	}

	function raridade(){
		echo "<span class='label'>Raridade: {$this->raridade}</span>";
	}

	function preco(){
		echo "<span class='label'>Preço do item: {$this->preco}</span>";
	}

	function preco_completo(){
		echo "<span class='label'>Preço total: {$this->gerar_preco_total()}</span>";
	}

	function encaixe(){
		echo "<span class='label'>Encaixes: {$this->encaixes}</span>";
	}

	function encaixe_livre(){
		echo "<span class='label'>Este item possui {$this->encaixe_livre} slot de encaixe livre.</span>";
	}

	function nivel(){
		echo "<span class='label'>Requisito mínimo para usar esta item: {$this->nivel}°Nível</span>";
	}

	function np(){
		echo "<span class='label'>Nível de Poder NP: {$this->np}</span>";
		echo '<div class="bord-level">';
			$this->barra_de_progresso($this->np,'np');
		echo '</div>';
	}

	function defesa(){
		echo "<span class='label'>Defesa: +{$this->defesa}</span>";
		echo '<div class="bord-level">';
			$this->barra_de_progresso($this->defesa,'defesa');
		echo '</div>';
	}	

	function rd(){
		echo "<span class='label'>Redução de Dano(RD): +{$this->rd}</span>";
		echo '<div class="bord-level">';
			$this->barra_de_progresso($this->rd,'reducao');
		echo '</div>';
	}	
}

class LojaDeCapacetes{
	public $capacetes;

	function exportar_capacete_para_txt(){
		$txt_path = "arquivos/exportados/capacetes/";
		$path = Loader::$path_base.$txt_path;
		$url = Loader::$url_base.$txt_path;
		$arquivo = new Arquivo();
		$data = time('H:i:s').date('dmY');
		$path_final = $path.'Dungeon Evolutio - '.utf8_decode(trim($this->capacetes[0]->nome).' '.$this->capacetes[0]->raridade).' ID '.$data.'.txt';
		$url_final = $path.'Dungeon Evolutio - '.utf8_decode($this->capacetes[0]->nome.' '.$this->capacetes[0]->raridade).' ID '.$data.'.txt';

		$arquivo->open_file($path_final);
		$arquivo->write_file($this->montar_arquivo_txt_do_capacete());
	}

	function montar_arquivo_txt_do_capacete(){
		$_n = "\r\n";
		$arquivo_txt = '';
	
		for($i=0; $i<=count($this->capacetes)-1;$i++):	
			$arquivo_txt .= 
				'>>>>>>>>>>>>'.trim($this->capacetes[$i]->nome).' Lv '.$this->capacetes[$i]->nivel.'<<<<<<<<<<<<'.$_n.
				'Raridade: '.$this->capacetes[$i]->raridade.$_n.
				'Preço da arma: '.$this->capacetes[$i]->preco.$_n.
				'Preço total: '.$this->capacetes[$i]->gerar_preco_total().$_n.
				'Esta arma possui '.$this->capacetes[$i]->encaixe_livre.' slot de encaixe livre'.$_n.
				'Encaixes '.$this->capacetes[$i]->encaixes.$_n.
				'Requisito: '.$this->capacetes[$i]->nivel.'° Nível'.$_n.
				'Nível de poder (NP): '.$this->capacetes[$i]->np.$_n.
				'RD: '.$this->capacetes[$i]->rd.$_n.
				'Defesa: '.$this->capacetes[$i]->defesa.$_n
				;

				
				if($this->capacetes[$i]->encaixes != 0):
					for($e=1; $e<=($this->capacetes[$i]->encaixes);$e++):
						if(get_class($this->capacetes[$i]->pedras[$e]) == 'Pedras_vermelhas'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->capacetes[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->capacetes[$i]->pedras[$e]->preco.$_n.	
								'Preço para Venda: '.$this->capacetes[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->capacetes[$i]->pedras[$e]->nivel.$_n.
								'Bônus de experiência: '.$this->capacetes[$i]->pedras[$e]->experiencia.$_n.
								'Bônus de dano: '.$this->capacetes[$i]->pedras[$e]->dano.$_n.
								'Bônus em habilidade (Força): '.$this->capacetes[$i]->pedras[$e]->habilidade.$_n.
								'Bônus de precisão: '.$this->capacetes[$i]->pedras[$e]->precisao.$_n;
						
						elseif(get_class($this->capacetes[$i]->pedras[$e]) == 'Pedras_verdes'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->capacetes[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->capacetes[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->capacetes[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->capacetes[$i]->pedras[$e]->nivel.$_n.
								'Bônus de esquiva: '.$this->capacetes[$i]->pedras[$e]->esquiva.$_n.
								'Chance de crítico: '.$this->capacetes[$i]->pedras[$e]->critico.$_n.
								'Bônus de precisao a distância: '.$this->capacetes[$i]->pedras[$e]->precisao_distancia.$_n.
								'Bônus em habilidade (Destreza): '.$this->capacetes[$i]->pedras[$e]->habilidade.$_n;

						elseif(get_class($this->capacetes[$i]->pedras[$e]) == 'Pedras_roxas'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->capacetes[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->capacetes[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->capacetes[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->capacetes[$i]->pedras[$e]->nivel.$_n.
								'Bônus em habilidade (Vigor): '.$this->capacetes[$i]->pedras[$e]->vigor.$_n.
								'Bônus de Redução de Dano: '.$this->capacetes[$i]->pedras[$e]->rd.$_n.
								'Regenera por rodada: '.$this->capacetes[$i]->pedras[$e]->regeneracao.$_n.
								'Recuperação de vida por acerto: '.$this->capacetes[$i]->pedras[$e]->vida_por_acerto.$_n;

						elseif(get_class($this->capacetes[$i]->pedras[$e]) == 'Pedras_amarelas'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->capacetes[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->capacetes[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->capacetes[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->capacetes[$i]->pedras[$e]->nivel.$_n.
								'Bônus de ouro extra a cada sessão: '.$this->capacetes[$i]->pedras[$e]->ouro_extra.$_n.
								'Bônus em habilidade (Inteligência): '.$this->capacetes[$i]->pedras[$e]->habilidade.$_n.
								'Aumento de dano em Magias: '.$this->capacetes[$i]->pedras[$e]->dano.$_n.
								'Aumenta seu DL(Drop Level): '.$this->capacetes[$i]->pedras[$e]->chance.$_n;

						elseif(get_class($this->capacetes[$i]->pedras[$e]) == 'Pedras_rosas'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->capacetes[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->capacetes[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->capacetes[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->capacetes[$i]->pedras[$e]->nivel.$_n.
								'Bônus de ouro extra a cada sessão: '.$this->capacetes[$i]->pedras[$e]->ouro_extra.$_n.
								'Bônus em habilidade (Carisma): '.$this->capacetes[$i]->pedras[$e]->habilidade.$_n.
								'Aumento de Pvs reservas: '.$this->capacetes[$i]->pedras[$e]->vida_extra.$_n.
								'Aumenta seu DL(Drop Level)/Def/Esq: '.$this->capacetes[$i]->pedras[$e]->sorte.$_n;

						elseif(get_class($this->capacetes[$i]->pedras[$e]) == 'Pedras_azuis'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->capacetes[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->capacetes[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->capacetes[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->capacetes[$i]->pedras[$e]->nivel.$_n.
								'Bônus de deflexão: '.$this->capacetes[$i]->pedras[$e]->deflexao.$_n.
								'Bônus em habilidade (Sabedoria): '.$this->capacetes[$i]->pedras[$e]->habilidade.$_n.
								'Pontos de habilidade (PH): '.$this->capacetes[$i]->pedras[$e]->pts_hab.$_n.
								'Bônus de dano na habilidade de classe: '.$this->capacetes[$i]->pedras[$e]->dano.$_n;
						endif;
					endfor;
				endif;
				
				/*	
				if($this->capacetes[$i]->qtd_habilidade != 0):
					for($h=1; $h<=($this->capacetes[$i]->qtd_habilidade);$h++):
						$arquivo_txt .= $_n.
							'>>>>>>>>>>>>Habilidades<<<<<<<<<<<<'.$_n.
							'Elemento: '.$this->capacetes[$i]->habilidades[$h]->elemento.''.$_n.
							'Descrição: '.$this->capacetes[$i]->habilidades[$h]->descricao;
					endfor;
				endif;
				*/
				$arquivo_txt .= $_n.'_________________________________________________________________________________________________'.$_n;
			endfor;

		return $arquivo_txt;
	}

	function addCapacetes(Capacetes $capacetes){
		$this->capacetes[] = $capacetes;		
	}

	function exibir_capacetes($nivel){
		echo '<div>';
			foreach ($this->capacetes as $key => $capacetes):
				$this->capacetes[$key]->exibir_capacetes_sorteada($nivel);
			endforeach;
		echo '</div>';	
	}

	function projatar_capacetes($qtd,$nivel=null){
		$objeto = 'capacetes_';
		$classe = 'Capacetes';

		usleep(300000);
		usleep(300000);
		for($i=0; $i<$qtd; $i++):
			$objeto = new $classe();
			$this->addCapacetes($objeto); 	
		endfor;
		$this->exibir_capacetes($nivel);
	}
}

?>