<?php

class Aneis{
	private $atributos = array();
	private $label;
	function __construct($atributos = array('nivel','nome','preco','encaixes','raridade','label','encaixe_livre',
		'for','des','vig','int','sab','car',
		'rd','iniciativa','esq','def','dano_magia','dano_hab','pedras','info','pwd_info')){
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
		elseif($probabilidade >= 1001 and $probabilidade <= 10000):
			$this->raridade = 'Lendário';
			$this->label = 'lendario';
		elseif($probabilidade >= 10001 and $probabilidade <= 100000):
			$this->raridade = 'Raro';
			$this->label = 'raro';
		elseif($probabilidade >= 100001 and $probabilidade <= 400000):
			$this->raridade = 'Mágico';
			$this->label = 'magico';
		elseif($probabilidade >= 400001 and $probabilidade <= 1000000):
			$this->raridade = 'Comum';
			$this->label = 'comum';
		endif;
	}

	function escolher_aneis(){
		$file = new Arquivo();
		$aneis = array();
		$file->open_file('arquivos/itens/aneis.txt','r');
		$lista = $file->read_file_armas();
		for($i=0; $i<count($lista); $i++):
			$aneis[$i] = explode('-', $lista[$i]);
		endfor;
		$file->close_file();
		
		$escolido = rand (0, count($aneis)-1);
		$this->nome = utf8_encode($aneis[$escolido][0]);
	}

	function gerar_bonus(){
		$file = new Arquivo();
		$aneis = array();
		$file->open_file('arquivos/itens/aneis.txt','r');
		$lista = $file->read_file_armas();
		for($i=0; $i<count($lista); $i++):
			$aneis[$i] = explode('-', $lista[$i]);
		endfor;
		$file->close_file();
		
		for($i=0; $i<count($aneis); $i++):
			switch($this->nome):
				case $this->nome == utf8_encode($aneis[$i][0]):
						 $this->for 		= $aneis[$i][1]*$this->nivel;
						 $this->des 		= $aneis[$i][2]*$this->nivel;
						 $this->vig 		= $aneis[$i][3]*$this->nivel;
						 $this->int 		= $aneis[$i][4]*$this->nivel;
						 $this->sab 		= $aneis[$i][5]*$this->nivel;
						 $this->car 		= $aneis[$i][6]*$this->nivel;
						 $this->info 		= utf8_encode($aneis[$i][7]);
						 $this->pwd_info 	= $aneis[$i][8]*$this->nivel;
						 $this->rd 			= $aneis[$i][9]*$this->nivel;
						 $this->iniciativa 	= $aneis[$i][10]*$this->nivel;
						 $this->esq 		= $aneis[$i][11]*$this->nivel;
						 $this->def 		= $aneis[$i][12]*$this->nivel;
						 $this->dano_magia 	= $aneis[$i][13]*$this->nivel;
						 $this->dano_hab 	= $aneis[$i][14]*$this->nivel;//14 atributos
				break;
			endswitch;
		endfor;	
	}

	function calcular_preco(){
		$this->preco = ($this->encaixes*10000+$this->for*1000+
						$this->des*1000+$this->vig*1000+$this->int*1000+$this->sab*1000+$this->car*1000+
						$this->encaixe_livre*5000+$this->pwd_info*500+$this->rd*300+$this->iniciativa*300
						+$this->esq*300+$this->def*300+$this->dano_magia*300+$this->dano_hab*300);
	}

	function definir_encaixes(){
		$diferenciador = $this->nivel*1000;
		switch($this->raridade):
			case 'Comum':
				$chance = rand(1,1000000-$diferenciador);
				if($chance <=1000000 and $chance >=10001):
					$this->encaixes = 0;
				elseif($chance <=10000 and $chance >=1001):
					$this->encaixes = 1;
				elseif($chance <=1000 and $chance >= 101):
					$this->encaixes = 2;
				elseif($chance <= 100 and $chance >=1):
					$this->encaixes = 3;
				endif;
			break;

			case 'Mágico':
				$chance = rand(1,900000-$diferenciador);
				if($chance <=900000 and $chance >=40001):
					$this->encaixes = 1;
				elseif($chance <=40000 and $chance >=10001):
					$this->encaixes = 2;
				elseif($chance <=10000 and $chance >= 1001):
					$this->encaixes = 3;
				elseif($chance <=1000 and $chance >= 51):
					$this->encaixes = 0;
				elseif($chance <= 50 and $chance >=1):
					$this->encaixes = 4;
				endif;
			break;

			case 'Raro':
				$chance = rand(1,800000-$diferenciador);
				if($chance <=800000 and $chance >=40001):
					$this->encaixes = 2;
				elseif($chance <=40000 and $chance >=10001):
					$this->encaixes = 3;
				elseif($chance <=10000 and $chance >= 1001):
					$this->encaixes = 4;
				elseif($chance <=1000 and $chance >= 101):
					$this->encaixes = 1;
				elseif($chance <= 100 and $chance >=1):
					$this->encaixes = 0;
				endif;
			break;

			case 'Lendário':
				$chance = rand(1,700000-$diferenciador);
				if($chance <=700000 and $chance >=30001):
					$this->encaixes = 2;
				elseif($chance <=30000 and $chance >=10001):
					$this->encaixes = 3;
				elseif($chance <=10000 and $chance >= 1001):
					$this->encaixes = 4;
				elseif($chance <=1000 and $chance >= 501):
					$this->encaixes = 4;
				elseif($chance <= 500 and $chance >=1):
					$this->encaixes = 0;
				endif;
			break;

			case 'Único':
				$chance = rand(1,600000-$diferenciador);
				if($chance <=600000 and $chance >=40001):
					$this->encaixes = 3;
				elseif($chance <=40000 and $chance >=1001):
					$this->encaixes = 4;
				elseif($chance <=1000 and $chance >=101):
					$this->encaixes = 2;
				elseif($chance <=100 and $chance >=1):
					$this->encaixes = 1;
				endif;
			break;
		endswitch;
	}

	function definir_espaco_livre(){
		$espaco_livre = (4-$this->encaixes);
		$inicio = ($espaco_livre-($espaco_livre-1))-1;
		if($espaco_livre == 0):
			$encaixe_livre = 0;
		else:
			for($i=0; $i<=2; $i++):
				$encaixe_livre = rand($inicio,$espaco_livre);
				if($encaixe_livre != 0):
				else:
					break;
				endif;
			endfor;	
		endif;
		$this->encaixe_livre = $encaixe_livre;
	}

	function embutir_pedras(){
		$pedras = array('ruby','esmeralda','safira','topazio','diamante','ametista');
		if($this->encaixes == 0):
			$this->definir_espaco_livre();
		else:
			$this->definir_espaco_livre();
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

		$nivel_de_poder_final = $this->nivel+$this->encaixes+$this->def+$this->rd+$this->pwd_info+$np_total;
		$this->np = $nivel_de_poder_final;
	}

	function exibir_aneis_sorteado($nivel=null){
		$this->init_aneis($nivel);
		echo '<div class="armas '.$this->label.'">';
			$this->nome();
			$this->raridade();
			$this->preco();
			$this->preco_completo();
			$this->encaixe_livre();
			$this->encaixe();
			$this->nivel();
			$this->np();
			$this->forca();
			$this->des();
			$this->vig();
			$this->int();
			$this->sab();
			$this->car();
			$this->rd();
			$this->iniciativa();
			$this->esq();
			$this->def();
			$this->dano_magia();
			$this->dano_hab();
			$this->info();
			$this->exibir_pedras_embutidas();		
		echo '</div>';
	}

	function init_aneis($nivel=null){
		if($nivel != null):
			$this->nivel = rand(1,$nivel);
		else:
			$this->nivel = rand(1,23);
		endif;
		$this->escolher_aneis();
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

				case 'for':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'des':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'vig':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'int':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'sab':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'car':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'rd':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'iniciativa':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'esq':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'def':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'dano_magia':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'dano_hab':
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
		echo "<span class='label'>{$this->nome} Lv {$this->nivel}</span>";
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

	function info(){
		echo "<span class='label'>Info: {$this->info}</span>";
	}

	function np(){
		echo "<span class='label'>Nível de Poder NP: {$this->np}</span>";
		echo '<div class="bord-level">';
			$this->barra_de_progresso($this->np,'np');
		echo '</div>';
	}

	function forca(){
		if($this->for == 0):
		else:	
			echo "<span class='label'>Força: +{$this->for}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->for,'for');
			echo '</div>';
		endif;
	}	

	function des(){
		if($this->des == 0):
		else:
			echo "<span class='label'>Destreza: +{$this->des}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->des,'des');
			echo '</div>';
		endif;
	}	

	function vig(){
		if($this->vig == 0):
		else:
			echo "<span class='label'>Vigor: +{$this->vig}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->vig,'vig');
			echo '</div>';
		endif;
	}	

	function int(){
		if($this->int == 0):
		else:
			echo "<span class='label'>Inteligência: +{$this->int}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->int,'int');
			echo '</div>';
		endif;
	}

	function sab(){
		if($this->sab == 0):
		else:
			echo "<span class='label'>Sabedoria: +{$this->sab}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->sab,'sab');
			echo '</div>';
		endif;
	}

	function car(){
		if($this->car == 0):
		else:
			echo "<span class='label'>Carisma: +{$this->car}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->car,'car');
			echo '</div>';
		endif;
	}

	function rd(){
		if($this->rd == 0):
		else:
			echo "<span class='label'>Redução de Dano (RD): +{$this->rd}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->rd,'rd');
			echo '</div>';
		endif;
	}		

	function iniciativa(){
		if($this->iniciativa == 0):
		else:
		echo "<span class='label'>Bônus em iniciativa: +{$this->iniciativa}</span>";
		echo '<div class="bord-level">';
			$this->barra_de_progresso($this->iniciativa,'iniciativa');
		echo '</div>';
		endif;
	}

	function esq(){
		if($this->esq == 0):
		else:
			echo "<span class='label'>Bônus em Esquiva: +{$this->esq}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->esq,'esquiva');
			echo '</div>';
		endif;
	}

	function def(){
		if($this->def == 0):
		else:
			echo "<span class='label'>Bônus em defesa: +{$this->def}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->def,'def');
			echo '</div>';
		endif;
	}

	function dano_magia(){
		if($this->dano_magia == 0):
		else:
			echo "<span class='label'>Bônus de Dano por Magia: +{$this->dano_magia}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->dano_magia,'dano_magia');
			echo '</div>';
		endif;
	}

	function dano_hab(){
		if($this->dano_hab == 0):
		else:
			echo "<span class='label'>Bônus de Dano em Habilidade de Classe: +{$this->dano_hab}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->dano_hab,'dano_hab');
			echo '</div>';
		endif;
	}
}

class LojaDeAneis{
	public $aneis;

	function exportar_aneis_para_txt(){
		$txt_path = "arquivos/exportados/aneis/";
		$path = Loader::$path_base.$txt_path;
		$url = Loader::$url_base.$txt_path;
		$arquivo = new Arquivo();
		$data = time('H:i:s').date('dmY');
		$path_final = $path.'Dungeon Evolutio - '.utf8_decode($this->aneis[0]->nome.' '.$this->aneis[0]->raridade).' ID '.$data.'.txt';
		$url_final = $path.'Dungeon Evolutio - '.utf8_decode($this->aneis[0]->nome.' '.$this->aneis[0]->raridade).' ID '.$data.'.txt';
		
		$arquivo->open_file($path_final);
		$arquivo->write_file($this->montar_arquivo_txt_do_anel());
	}

	function montar_arquivo_txt_do_anel(){
		$_n = "\r\n";
		$arquivo_txt = '';
	
		for($i=0; $i<=count($this->aneis)-1;$i++):	
			$arquivo_txt .= 
				'>>>>>>>>>>>>'.$this->aneis[$i]->nome.' Lv '.$this->aneis[$i]->nivel.'<<<<<<<<<<<<'.$_n.
				'Raridade: '.$this->aneis[$i]->raridade.$_n.
				'Preço da arma: '.$this->aneis[$i]->preco.$_n.
				'Preço total: '.$this->aneis[$i]->gerar_preco_total().$_n.
				'Esta arma possui '.$this->aneis[$i]->encaixe_livre.' slot de encaixe livre'.$_n.
				'Encaixes '.$this->aneis[$i]->encaixes.$_n.
				'Requisito: '.$this->aneis[$i]->nivel.'° Nível'.$_n.
				'Nível de poder (NP): '.$this->aneis[$i]->np.$_n;
				($this->aneis[$i]->for == 0)?		:$arquivo_txt .='Força: '.$this->aneis[$i]->for.$_n;
				($this->aneis[$i]->des == 0)?		:$arquivo_txt .='Destreza: '.$this->aneis[$i]->des.$_n;
				($this->aneis[$i]->vig == 0)?		:$arquivo_txt .='Vigor: '.$this->aneis[$i]->vig.$_n;
				($this->aneis[$i]->int == 0)?		:$arquivo_txt .='Inteligência: '.$this->aneis[$i]->int.$_n;			
				($this->aneis[$i]->sab == 0)?		:$arquivo_txt .='Sabedoria: '.$this->aneis[$i]->sab.$_n;
				($this->aneis[$i]->car == 0)?		:$arquivo_txt .='Carisma: '.$this->aneis[$i]->car.$_n;
				($this->aneis[$i]->rd == 0)?		:$arquivo_txt .='RD: '.$this->aneis[$i]->rd.$_n;
				($this->aneis[$i]->iniciativa == 0)?:$arquivo_txt .='iniciativa: '.$this->aneis[$i]->iniciativa.$_n;
				($this->aneis[$i]->esq == 0)?		:$arquivo_txt .='Esquiva: '.$this->aneis[$i]->esq.$_n;
				($this->aneis[$i]->def == 0)?		:$arquivo_txt .='Defesa: '.$this->aneis[$i]->def.$_n;
				($this->aneis[$i]->dano_magia == 0)?:$arquivo_txt .='Bônus de dano em magia: '.$this->aneis[$i]->dano_magia.$_n;
				($this->aneis[$i]->dano_hab == 0)?	:$arquivo_txt .='Bônus de dano em habilidade de classe: '.$this->aneis[$i]->dano_hab.$_n;
	
				if($this->aneis[$i]->encaixes != 0):
					for($e=1; $e<=($this->aneis[$i]->encaixes);$e++):
						if(get_class($this->aneis[$i]->pedras[$e]) == 'Pedras_vermelhas'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->aneis[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->aneis[$i]->pedras[$e]->preco.$_n.	
								'Preço para Venda: '.$this->aneis[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->aneis[$i]->pedras[$e]->nivel.$_n.
								'Bônus de experiência: '.$this->aneis[$i]->pedras[$e]->experiencia.$_n.
								'Bônus de dano: '.$this->aneis[$i]->pedras[$e]->dano.$_n.
								'Bônus em habilidade (Força): '.$this->aneis[$i]->pedras[$e]->habilidade.$_n.
								'Bônus de precisão: '.$this->aneis[$i]->pedras[$e]->precisao.$_n;
						
						elseif(get_class($this->aneis[$i]->pedras[$e]) == 'Pedras_verdes'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->aneis[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->aneis[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->aneis[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->aneis[$i]->pedras[$e]->nivel.$_n.
								'Bônus de esquiva: '.$this->aneis[$i]->pedras[$e]->esquiva.$_n.
								'Chance de crítico: '.$this->aneis[$i]->pedras[$e]->critico.$_n.
								'Bônus de precisao a distância: '.$this->aneis[$i]->pedras[$e]->precisao_distancia.$_n.
								'Bônus em habilidade (Destreza): '.$this->aneis[$i]->pedras[$e]->habilidade.$_n;

						elseif(get_class($this->aneis[$i]->pedras[$e]) == 'Pedras_roxas'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->aneis[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->aneis[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->aneis[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->aneis[$i]->pedras[$e]->nivel.$_n.
								'Bônus em habilidade (Vigor): '.$this->aneis[$i]->pedras[$e]->vigor.$_n.
								'Bônus de Redução de Dano: '.$this->aneis[$i]->pedras[$e]->rd.$_n.
								'Regenera por rodada: '.$this->aneis[$i]->pedras[$e]->regeneracao.$_n.
								'Recuperação de vida por acerto: '.$this->aneis[$i]->pedras[$e]->vida_por_acerto.$_n;

						elseif(get_class($this->aneis[$i]->pedras[$e]) == 'Pedras_amarelas'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->aneis[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->aneis[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->aneis[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->aneis[$i]->pedras[$e]->nivel.$_n.
								'Bônus de ouro extra a cada sessão: '.$this->aneis[$i]->pedras[$e]->ouro_extra.$_n.
								'Bônus em habilidade (Inteligência): '.$this->aneis[$i]->pedras[$e]->habilidade.$_n.
								'Aumento de dano em Magias: '.$this->aneis[$i]->pedras[$e]->dano.$_n.
								'Aumenta seu DL(Drop Level): '.$this->aneis[$i]->pedras[$e]->chance.$_n;

						elseif(get_class($this->aneis[$i]->pedras[$e]) == 'Pedras_rosas'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->aneis[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->aneis[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->aneis[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->aneis[$i]->pedras[$e]->nivel.$_n.
								'Bônus de ouro extra a cada sessão: '.$this->aneis[$i]->pedras[$e]->ouro_extra.$_n.
								'Bônus em habilidade (Carisma): '.$this->aneis[$i]->pedras[$e]->habilidade.$_n.
								'Aumento de Pvs reservas: '.$this->aneis[$i]->pedras[$e]->vida_extra.$_n.
								'Aumenta seu DL(Drop Level)/Def/Esq: '.$this->aneis[$i]->pedras[$e]->sorte.$_n;

						elseif(get_class($this->aneis[$i]->pedras[$e]) == 'Pedras_azuis'):
							$arquivo_txt .= $_n.
								'>>>>>>>>>>>>'.$this->aneis[$i]->pedras[$e]->nome.'<<<<<<<<<<<<'.$_n.
								'Preço de compra: '.$this->aneis[$i]->pedras[$e]->preco.$_n.
								'Preço para Venda: '.$this->aneis[$i]->pedras[$e]->gerar_preco_venda().$_n.
								'Nível da pedra: '.$this->aneis[$i]->pedras[$e]->nivel.$_n.
								'Bônus de deflexão: '.$this->aneis[$i]->pedras[$e]->deflexao.$_n.
								'Bônus em habilidade (Sabedoria): '.$this->aneis[$i]->pedras[$e]->habilidade.$_n.
								'Pontos de habilidade (PH): '.$this->aneis[$i]->pedras[$e]->pts_hab.$_n.
								'Bônus de dano na habilidade de classe: '.$this->aneis[$i]->pedras[$e]->dano.$_n;
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

	function addAneis(Aneis $aneis){
		$this->aneis[] = $aneis;		
	}

	function exibir_aneis($nivel){
		echo '<div>';
			foreach ($this->aneis as $key => $aneis):
				$this->aneis[$key]->exibir_aneis_sorteado($nivel);
			endforeach;
		echo '</div>';	
	}

	function projatar_aneis($qtd,$nivel=null){
		$objeto = 'aneis_';
		$classe = 'Aneis';

		usleep(300000);
		usleep(300000);
		for($i=0; $i<$qtd; $i++):
			$objeto = new $classe();
			$this->addAneis($objeto); 	
		endfor;
		$this->exibir_aneis($nivel);
	}
}
?>