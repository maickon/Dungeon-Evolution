<?php
/**
 * @author Mackon Rangel
 * @copyright 2014
 * @name Dungeon Evolutio Armas gerador
 * @email maickonmaickon@hotmail.com
 */
class Pedras_verdes{
	static $img = "img/pedras/esmeralda.png";
	private $atributos = array();

	function __construct($atributos = array('nome','preco','nivel','habilidade','esquiva','critico','precisao_distancia','msg')){
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

	function escolher_habilidades($sortear = true, $encaixes = null){
		if($sortear != true):
			$habilidades = array('habilidade','esquiva','critico','precisao_distancia');
			$qtd_habilidades = rand(1, 4);
			$nova_lista1 = null;
			$nova_lista2 = null;
			for($i=1; $i<= $qtd_habilidades; $i++):
				$nova_lista1[$i] = $habilidades[rand(0,3)];
				if($i>1):
					if(in_array($nova_lista1[$i], $nova_lista2)):
						$i--;
					endif;
				endif;
				$nova_lista2[$i] = $nova_lista1[$i];
			endfor;

			return $nova_lista1;
		endif;
	}

	function gerar_esquiva($nivel = null) {
		if(isset($nivel) && is_numeric($nivel)):
			$this->gerenciar_esquiva($nivel);
		else:
			$esquiva_escolida = rand(1,23);
			$this->gerenciar_esquiva($esquiva_escolida);
		endif;	
	}

	function gerenciar_esquiva($nivel){
		$esquiva_inicial = 5;
		$esquiva_final = 0;
		for($i = 1; $i<=$nivel; $i++):
			$esquiva_final += $esquiva_inicial;
		endfor;
		$this->esquiva = rand($esquiva_final-4,$esquiva_final);
	}

	function gerar_chance_de_critico($nivel = null) {
		if(isset($nivel) && is_numeric($nivel)):
			$this->gerenciar_chance_de_critico($nivel);
		else:
			$esquiva_escolida = rand(1,23);
			$this->gerenciar_chance_de_critico($esquiva_escolida);
		endif;	
	}

	function gerenciar_chance_de_critico($nivel){
		$chance_critica_inicial = 5;
		$chance_critica_final = 0;
		for($i = 1; $i<=$nivel; $i++):
			$chance_critica_final += $chance_critica_inicial;
		endfor;
		$this->critico = rand($chance_critica_final-4,$chance_critica_final);
	}

	function gerar_habilidade($nivel = null) {
		$habilidade_inicial = 2;
		$habilidade_final = 2;
		if(isset($nivel) && is_numeric($nivel)):
			for($i=1; $i<=$nivel-1; $i++):
				$habilidade_inicial += $i+1;
			endfor;

			for($i=1; $i<=$nivel; $i++):
				$habilidade_final += $i+1;
			endfor;
		else:
			$nivel_escolido = rand(1,23);
			for($i=1; $i<=$nivel_escolido-1; $i++):
				$nivel_anterior = $nivel-1;
				$incremento = $nivel_anterior+1;
				$habilidade_inicial += $incremento;
			endfor;

			for($i=1; $i<=$nivel; $i++):
				$habilidade_final += $i+1;
			endfor;
		endif;

		$dif = $habilidade_final-$habilidade_inicial;
		$variante = rand(0,$dif-1);
		$this->habilidade = $habilidade_inicial+$variante;
	}

	function gerar_precisao_a_distancia($nivel = null){
		$precisao_inicial = 0;
		$precisao_final = 0;
		if(isset($nivel) && is_numeric($nivel)):
			$precisao = ($nivel*2);
		else:
			$precisao = (rand(1, 23)*2);
		endif;
		$dif = (($nivel+1)*2)-(($nivel*2));
		$variante = rand(0,$dif-1);
		$this->precisao_distancia = $precisao+$variante;
	}

	function gerar_preco_compra(){
		$preco_da_pedra_total = (int)(($this->nivel*150)+($this->esquiva*150)+($this->precisao_distancia*150)+($this->habilidade*250)+($this->critico*350));
		$this->preco = $preco_da_pedra_total.' PO';
	}

	function gerar_preco_venda(){
		$preco_da_pedra_total = (int)(($this->nivel*150)+($this->esquiva*150)+($this->precisao_distancia*150)+($this->habilidade*250)+($this->critico*350))/2;
		return $preco_da_pedra_total.' PO';
	}

	function barra_de_progresso($habilidade, $tipo){
		if(is_numeric($habilidade)):
			switch($tipo):
				case 'critico':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'esquiva':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'precisao':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'deslocamento':
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
		echo "<span class='label_pedra'>Nome: {$this->nome}</span>";
	}

	function preco_compra(){
		$preco = (int)$this->preco;
		echo "<span class='label_pedra'>Preço para Compra: {$preco}</span>";
	}

	function preco_venda(){
		$preco_venda = (int)$this->gerar_preco_venda();
		echo "<span class='label_pedra'>Preço para Venda: {$preco_venda}</span>";
	}

	function nivel(){
		echo "<span class='label_pedra'>Nível da pedra: {$this->nivel}</span>";
	}

	function bonus_habilidade(){
		if($this->habilidade == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Bônus em habilidade: +{$this->habilidade}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->habilidade,'deslocamento');
			echo '</div>';
		endif;
	}

	function esmeralda_img(){
		echo "<span class='pedra_img'>
				<img src=".Pedras_verdes::$img." class='pedra_img'>
			  </span>";
	}
    
	function esquiva(){
		if($this->esquiva == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Bônus de Esquiva: +{$this->esquiva}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->esquiva,'esquiva');
			echo '</div>';
		endif;
	}

	function critico(){
		if($this->critico == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Chance de crítico: {$this->critico}%</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->critico,'critico');
			echo '</div>';
		endif;
	}

	function precisao_distancia(){
		if($this->precisao_distancia == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Bônus de Precisão a distância: {$this->precisao_distancia}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->precisao_distancia,'precisao');
			echo '</div>';
		endif;
	}

	function exibir_pedra(){
		echo '<hr>';
		echo '<br />';
		Pedras_verdes::esmeralda_img();
		$this->nome = "Pedra Verde (Esmeralda)";
		$this->nome();
		//$this->nivel;
		$this->preco_compra();
		$this->preco_venda();
		$this->nivel();	
		$this->bonus_habilidade();
		$this->esquiva();
		$this->critico();
		$this->precisao_distancia();
	}

	function exibir_prdra_dropada($nivel=null){
		if($nivel != null):
			$this->nivel = rand(1,$nivel);
		else:
			$this->nivel = rand(1,23);
		endif;
		echo '<div class="armas comum">';
			$this->gerar_pedra_verde();
			$this->exibir_pedra();	
		echo '</div>';
	}

	function gerar_pedra_verde(){
		$this->zerar_habilidades();
		$this->ativar_habilidades();
		$this->gerar_preco_compra();
		$this->gerar_preco_venda();
	}

	function zerar_habilidades(){
		$this->habilidade 			= 0;
		$this->esquiva 				= 0;
		$this->critico 				= 0;
		$this->precisao_distancia 	= 0;
	}

	function ativar_habilidades(){
		$habilidades_escolidas = $this->escolher_habilidades(false);
		for($i=1; $i<=count($habilidades_escolidas); $i++):
			switch($habilidades_escolidas[$i]):
				case 'habilidade':
					$this->gerar_habilidade($this->nivel);
				break;

				case 'esquiva':
					$this->gerar_esquiva($this->nivel);
				break;

				case 'critico':
					$this->gerar_chance_de_critico($this->nivel);
				break;

				case 'precisao_distancia':
					$this->gerar_precisao_a_distancia($this->nivel);
				break;
			endswitch;
		endfor;	
	}
}
?>