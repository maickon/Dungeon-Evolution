<?php
/**
 * @author Mackon Rangel
 * @copyright 2014
 * @name Dungeon Evolutio Armas gerador
 * @email maickonmaickon@hotmail.com
 */
class Pedras_azuis{
	static $img = "img/pedras/ametista.png";
	private $atributos = array();

	function __construct($atributos = array('nome','preco','nivel','habilidade','deflexao','dano','pts_hab','msg')){
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
			$habilidades = array('habilidade','deflexao','dano','pts_hab');
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

	function gerar_deflexao($nivel = null) {
		if(isset($nivel) && is_numeric($nivel)):
			$this->gerenciar_deflexao($nivel);
		else:
			$df_escolida = rand(1,23);
			$this->gerenciar_deflexao($rd_escolida);
		endif;	
	}

	function gerenciar_deflexao($nivel){
		$df_inicial = 5;
		$df_final = 0;
		for($i = 1; $i<=$nivel; $i++):
			$df_final += $df_inicial;
		endfor;
		$this->deflexao = rand($df_final-4,$df_final);
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

	function gerar_hab_pts($nivel = null) {
		$pt_inicial = 2;
		$pt_final = 2;
		if(isset($nivel) && is_numeric($nivel)):
			for($i=1; $i<=$nivel-1; $i++):
				$pt_inicial += $i+1;
			endfor;

			for($i=1; $i<=$nivel; $i++):
				$pt_final += $i+1;
			endfor;
		else:
			$nivel_escolido = rand(1,23);
			for($i=1; $i<=$nivel_escolido-1; $i++):
				$nivel_anterior = $nivel-1;
				$incremento = $nivel_anterior+1;
				$pt_inicial += $incremento;
			endfor;

			for($i=1; $i<=$nivel; $i++):
				$pt_final += $i+1;
			endfor;
		endif;

		$dif = $pt_final-$pt_inicial;
		$variante = rand(0,$dif-1);
		$this->pts_hab = $pt_inicial+$variante;
	}

	function gerar_preco_compra(){
		$preco_da_pedra_total = (int)(($this->nivel*150)+($this->habilidade*150)+($this->pts_hab*200)+($this->dano*250)+($this->deflexao*150));
		$this->preco = $preco_da_pedra_total.' PO';
	}

	function gerar_preco_venda(){
		$preco_da_pedra_total = (int)(($this->nivel*150)+($this->habilidade*150)+($this->pts_hab*200)+($this->dano*250)+($this->deflexao*150))/2;
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

				case 'pts_hab':
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

				case 'deflexao':
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

	function deflexao(){
		if($this->deflexao == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Bônus na Esq (deflexao): +{$this->deflexao}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->deflexao,'deflexao');
			echo '</div>';
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

	function ametista_img(){
		echo "<span class='pedra_img'>
				<img src=".Pedras_azuis::$img." class='pedra_img'>
			  </span>";
	}

	function dano(){
		if($this->dano == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Bônus de dano em habilidade de classe: +{$this->dano}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->dano,'dano');
			echo '</div>';
		endif;
	}

	function pts_hab(){
		if($this->pts_hab == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Pontos de habilidade (PH): +{$this->pts_hab}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->pts_hab,'pts_hab');
			echo '</div>';
		endif;
	}

	function exibir_pedra(){
		echo '<hr>';
		echo '<br />';
		Pedras_azuis::ametista_img();
		$this->nome = "Pedra Azul (Ametista)";
		$this->nome();
		$this->preco_compra();
		$this->preco_venda();
		$this->nivel();	
		$this->deflexao();
		$this->bonus_habilidade();
		$this->dano();
		$this->pts_hab();
	}

	function exibir_prdra_dropada($nivel=null){
		if($nivel != null):
			$this->nivel = rand(1,$nivel);
		else:
			$this->nivel = rand(1,23);
		endif;
		echo '<div class="armas comum">';
			$this->gerar_pedra_azul();
			$this->exibir_pedra();	
		echo '</div>';
	}

	function gerar_pedra_azul(){
		$this->zerar_habilidades();
		$this->ativar_habilidades();
		$this->gerar_preco_compra();
		$this->gerar_preco_venda();
	}

	function zerar_habilidades(){
		$this->habilidade 	= 0;
		$this->pts_hab	 	= 0;
		$this->dano 		= 0;
		$this->deflexao 	= 0;
	}

	function ativar_habilidades(){
		$habilidades_escolidas = $this->escolher_habilidades(false);
		for($i=1; $i<=count($habilidades_escolidas); $i++):
			switch($habilidades_escolidas[$i]):
				case 'habilidade':
					$this->gerar_habilidade($this->nivel);
				break;

				case 'deflexao':
					$this->gerar_deflexao($this->nivel);
				break;

				case 'dano':
					$this->gerar_dano($this->nivel);
				break;

				case 'pts_hab':
					$this->gerar_hab_pts($this->nivel);
				break;
			endswitch;
		endfor;	
	}
}
?>