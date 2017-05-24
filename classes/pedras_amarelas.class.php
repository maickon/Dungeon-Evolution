<?php
/**
 * @author Mackon Rangel
 * @copyright 2014
 * @name Dungeon Evolutio Armas gerador
 * @email maickonmaickon@hotmail.com
 */
class Pedras_amarelas{
	static $img = "img/pedras/topazio.png";
	private $atributos = array();

	function __construct($atributos = array('nome','preco','nivel','habilidade','ouro_extra','dano','chance','msg')){
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
			$habilidades = array('habilidade','preco','dano','chance');
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

	function gerar_dano($nivel = null) {
		if(isset($nivel) && is_numeric($nivel)):
			$this->gerenciar_dano($nivel);
		else:
			$rd_escolida = rand(1,23);
			$this->gerenciar_dano($rd_escolida);
		endif;	
	}

	function gerenciar_dano($nivel){
		$dano_inicial = 5;
		$dano_final = 0;
		for($i = 1; $i<=$nivel; $i++):
			$dano_final += $dano_inicial;
		endfor;
		$this->dano = rand($dano_final-4,$dano_final);
	}

	function gerar_habilidade($nivel = null) {
		$hab_inicial = 2;
		$hab_final = 2;
		if(isset($nivel) && is_numeric($nivel)):
			for($i=1; $i<=$nivel-1; $i++):
				$hab_inicial += $i+1;
			endfor;

			for($i=1; $i<=$nivel; $i++):
				$hab_final += $i+1;
			endfor;
		else:
			$nivel_escolido = rand(1,23);
			for($i=1; $i<=$nivel_escolido-1; $i++):
				$nivel_anterior = $nivel-1;
				$incremento = $nivel_anterior+1;
				$hab_inicial += $incremento;
			endfor;

			for($i=1; $i<=$nivel; $i++):
				$hab_final += $i+1;
			endfor;
		endif;

		$dif = $hab_final-$hab_inicial;
		$variante = rand(0,$dif-1);
		$this->habilidade = $hab_inicial+$variante;
	}

	function ouro_extra($nivel = null){
		$ouro = 0;
		$ouro_superior = 0;
		if(isset($nivel) && $nivel != null && is_numeric($nivel)):
			for($i=1; $i<=$nivel; $i++):
				$ouro = ($i*(($i+1)*100))+($i+1)*100;
			endfor;

			for($i=1; $i<=($nivel+1); $i++):
				$ouro_superior = ($i*(($i+1)*100))+($i+1)*100;
			endfor;
			
			else:
				$nivel_escolido = rand(1,23);
				for($i=1; $i<=$nivel_escolido; $i++):
					$ouro = ($i*(($i+1)*100))+($i+1)*100;
				endfor;

				for($i=1; $i<=($nivel_escolido+1); $i++):
					$ouro_superior = ($i*(($i+1)*100))+($i+1)*100;
				endfor;
		endif;

		$dif = $ouro_superior - $ouro;
		$ouro_variavel = rand(0,$dif-1);	
		$this->ouro_extra = $ouro+$ouro_variavel;
	}

	function gerar_chance_de_drop($nivel = null){
		if(isset($nivel) && is_numeric($nivel)):
			$chance = ($nivel*2);
		else:
			$chance = (rand(1, 23)*2);
		endif;
		$dif = (($nivel+1)*2)-(($nivel*2));
		$variante = rand(0,$dif-1);
		$this->chance = $chance+$variante;
	}

	function gerar_preco_compra(){
		$preco_da_pedra_total = (int)(($this->nivel*150)+($this->habilidade*150)+(($this->ouro_extra/100)*150)+($this->dano*250)+($this->chance*250));
		$this->preco = $preco_da_pedra_total.' PO';
	}

	function gerar_preco_venda(){
		$preco_da_pedra_total = (int)(($this->nivel*150)+($this->habilidade*150)+(($this->ouro_extra/100)*150)+($this->dano*250)+($this->chance*250))/2;
		return $preco_da_pedra_total.' PO';
	}

	function barra_de_progresso($habilidade, $tipo){
		if(is_numeric($habilidade)):
			switch($tipo):
				case 'habilidade':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'preco':
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

				case 'chance':
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

	function ouro(){
		if($this->ouro_extra == 0):
		else:
			echo "<span class='label_pedra'>Bônus de ouro extra a cada sessão: +{$this->ouro_extra}</span>";
		endif;
	}

	function bonus_habilidade(){
		if($this->habilidade == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Bônus em habilidade: +{$this->habilidade}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->habilidade,'habilidade');
			echo '</div>';
		endif;
	}

	function topazio_img(){
		echo "<span class='pedra_img'>
				<img src=".Pedras_amarelas::$img." class='pedra_img'>
			  </span>";
	}

	function dano(){
		if($this->dano == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Aumento de dano em Magias: +{$this->dano}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->dano,'dano');
			echo '</div>';
		endif;
	}

	function chance(){
		if($this->chance == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Aumenta seu DL(Drop Level): +{$this->chance}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->chance,'chance');
			echo '</div>';
		endif;
	}

	function exibir_pedra(){
		echo '<hr>';
		echo '<br />';
		Pedras_amarelas::topazio_img();
		$this->nome = "Pedra Amarela (Topázio)";
		$this->nome();
		$this->preco_compra();
		$this->preco_venda();
		$this->nivel();	
		$this->ouro();
		$this->bonus_habilidade();
		$this->dano();
		$this->chance();
	}

	function exibir_prdra_dropada($nivel=null){
		if($nivel != null):
			$this->nivel = rand(1,$nivel);
		else:
			$this->nivel = rand(1,23);
		endif;
		echo '<div class="armas comum">';
			$this->gerar_pedra_amarela();
			$this->exibir_pedra();	
		echo '</div>';
	}

	function gerar_pedra_amarela(){
		$this->zerar_habilidades();
		$this->ativar_habilidades();
		$this->gerar_preco_compra();
		$this->gerar_preco_venda();
	}

	function zerar_habilidades(){
		$this->habilidade 	= 0;
		$this->ouro_extra 	= 0;
		$this->dano 		= 0;
		$this->chance 		= 0;
	}

	function ativar_habilidades(){
		$habilidades_escolidas = $this->escolher_habilidades(false);
		for($i=1; $i<=count($habilidades_escolidas); $i++):
			switch($habilidades_escolidas[$i]):
				case 'habilidade':
					$this->gerar_habilidade($this->nivel);
				break;

				case 'preco':
					$this->ouro_extra($this->nivel);
				break;

				case 'dano':
					$this->gerar_dano($this->nivel);
				break;

				case 'chance':
					$this->gerar_chance_de_drop($this->nivel);
				break;
			endswitch;
		endfor;	
	}
}
?>