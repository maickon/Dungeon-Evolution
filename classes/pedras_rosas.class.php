<?php
/**
 * @author Mackon Rangel
 * @copyright 2014
 * @name Dungeon Evolutio Armas gerador
 * @email maickonmaickon@hotmail.com
 */
class Pedras_rosas{
	static $img = "img/pedras/diamante.png";
	private $atributos = array();

	function __construct($atributos = array('nome','preco','nivel','habilidade','ouro_extra','vida_extra','sorte','msg')){
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
			$habilidades = array('habilidade','ouro_extra','vida_extra','sorte');
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

	function gerar_vida_extra($nivel = null) {
		if(isset($nivel) && is_numeric($nivel)):
			$this->gerenciar_vida_extra($nivel);
		else:
			$rd_escolida = rand(1,23);
			$this->gerenciar_vida_extra($rd_escolida);
		endif;	
	}

	function gerenciar_vida_extra($nivel){
		$vida_inicial = 5;
		$vida_final = 0;
		for($i = 1; $i<=$nivel; $i++):
			$vida_final += $vida_inicial;
		endfor;
		$this->vida_extra = rand($vida_final-4,$vida_final);
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

	function gerar_sorte($nivel = null){
		if(isset($nivel) && is_numeric($nivel)):
			$sorte = ($nivel*2);
		else:
			$sorte = (rand(1, 23)*2);
		endif;
		$dif = (($nivel+1)*2)-(($nivel*2));
		$variante = rand(0,$dif-1);
		$this->sorte = $sorte+$variante;
	}

	function gerar_preco_compra(){
		$preco_da_pedra_total = (int)(($this->nivel*150)+($this->habilidade*150)+(($this->ouro_extra/100)*150)+($this->vida_extra*250)+($this->sorte*350));
		$this->preco = $preco_da_pedra_total.' PO';
	}

	function gerar_preco_venda(){
		$preco_da_pedra_total = (int)(($this->nivel*150)+($this->habilidade*150)+(($this->ouro_extra/100)*150)+($this->vida_extra*250)+($this->sorte*350))/2;
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

				case 'vida_extra':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'sorte':
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
			echo "<span class='label_pedra'>Bônus de ouro extra a cada sessão: +{$this->ouro_extra}PO</span>";
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

	function diamante_img(){
		echo "<span class='pedra_img'>
				<img src=".Pedras_rosas::$img." class='pedra_img'>
			  </span>";
	}

	function vida(){
		if($this->vida_extra == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Aumento de Pvs reservas: +{$this->vida_extra}%</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->vida_extra,'vida_extra');
			echo '</div>';
		endif;
	}

	function sua_sorte(){
		if($this->sorte == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Aumenta seu DL(Drop Level)/Def/Esq: +{$this->sorte}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->sorte,'sorte');
			echo '</div>';
		endif;
	}

	function exibir_pedra(){
		echo '<hr>';
		echo '<br />';
		Pedras_rosas::diamante_img();
		$this->nome = "Pedra Rosa (Diamante)";
		$this->nome();
		$this->preco_compra();
		$this->preco_venda();
		$this->nivel();	
		$this->ouro();
		$this->bonus_habilidade();
		$this->vida();
		$this->sua_sorte();
	}

	function exibir_prdra_dropada($nivel=null){
		if($nivel != null):
			$this->nivel = rand(1,$nivel);
		else:
			$this->nivel = rand(1,23);
		endif;
		echo '<div class="armas comum">';
			$this->gerar_pedra_rosa();
			$this->exibir_pedra();	
		echo '</div>';
	}

	function gerar_pedra_rosa(){
		$this->zerar_habilidades();
		$this->ativar_habilidades();
		$this->gerar_preco_compra();
		$this->gerar_preco_venda();
	}

	function zerar_habilidades(){
		$this->habilidade 	= 0;
		$this->ouro_extra 	= 0;
		$this->vida_extra 	= 0;
		$this->sorte		= 0;
	}

	function ativar_habilidades(){
		$habilidades_escolidas = $this->escolher_habilidades(false);
		for($i=1; $i<=count($habilidades_escolidas); $i++):
			switch($habilidades_escolidas[$i]):
				case 'habilidade':
					$this->gerar_habilidade($this->nivel);
				break;

				case 'ouro_extra':
					$this->ouro_extra($this->nivel);
				break;

				case 'vida_extra':
					$this->gerar_vida_extra($this->nivel);
				break;

				case 'sorte':
					$this->gerar_sorte($this->nivel);
				break;
			endswitch;
		endfor;	
	}
}
?>