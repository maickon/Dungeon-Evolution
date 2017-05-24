<?php
/**
 * @author Mackon Rangel
 * @copyright 2014
 * @name Dungeon Evolutio Armas gerador
 * @email maickonmaickon@hotmail.com
 */
class Pedras_roxas{
	static $img = "img/pedras/safira.png";
	private $atributos = array();

	function __construct($atributos = array('nome','preco','nivel','vigor','rd','regeneracao','vida_por_acerto','msg')){
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
			$habilidades = array('vigor','rd','regeneracao','vida_por_acerto');
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

	function gerar_rd($nivel = null) {
		if(isset($nivel) && is_numeric($nivel)):
			$this->gerenciar_rd($nivel);
		else:
			$rd_escolida = rand(1,23);
			$this->gerenciar_rd($rd_escolida);
		endif;	
	}

	function gerenciar_rd($nivel){
		$rd_inicial = 5;
		$rd_final = 0;
		for($i = 1; $i<=$nivel; $i++):
			$rd_final += $rd_inicial;
		endfor;
		$this->rd = rand($rd_final-4,$rd_final);
	}

	function gerar_regeneracao($nivel = null) {
		if(isset($nivel) && is_numeric($nivel)):
			$this->gerenciar_regeneracao($nivel);
		else:
			$regeneracao_escolida = rand(1,23);
			$this->gerenciar_regeneracao($regeneracao_escolida);
		endif;	
	}

	function gerenciar_regeneracao($nivel){
		$rg_inicial = 5;
		$rg_final = 0;
		for($i = 1; $i<=$nivel; $i++):
			$rg_final += $rg_inicial;
		endfor;
		$this->regeneracao = rand($rg_final-4,$rg_final);
	}

	function gerar_vigor($nivel = null) {
		$vigor_inicial = 2;
		$vigor_final = 2;
		if(isset($nivel) && is_numeric($nivel)):
			for($i=1; $i<=$nivel-1; $i++):
				$vigor_inicial += $i+1;
			endfor;

			for($i=1; $i<=$nivel; $i++):
				$vigor_final += $i+1;
			endfor;
		else:
			$nivel_escolido = rand(1,23);
			for($i=1; $i<=$nivel_escolido-1; $i++):
				$nivel_anterior = $nivel-1;
				$incremento = $nivel_anterior+1;
				$vigor_inicial += $incremento;
			endfor;

			for($i=1; $i<=$nivel; $i++):
				$vigor_final += $i+1;
			endfor;
		endif;

		$dif = $vigor_final-$vigor_inicial;
		$variante = rand(0,$dif-1);
		$this->vigor = $vigor_inicial+$variante;
	}

	function gerar_vida_por_acerto($nivel = null){
		$vida_inicial = 0;
		$vida_final = 0;
		if(isset($nivel) && is_numeric($nivel)):
			$vida = ($nivel*20);
		else:
			$vida = (rand(1, 23)*20);
		endif;
		$dif = (($nivel+1)*20)-(($nivel*20));
		$variante = rand(0,$dif-1);
		$this->vida_por_acerto = $vida+$variante;
	}

	function gerar_preco_compra(){
		$preco_da_pedra_total = (int)(($this->nivel*150)+($this->vigor*150)+($this->rd*150)+($this->regeneracao*250)+($this->vida_por_acerto*250));
		$this->preco = $preco_da_pedra_total.' PO';
	}

	function gerar_preco_venda(){
		$preco_da_pedra_total = (int)(($this->nivel*150)+($this->vigor*150)+($this->rd*150)+($this->regeneracao*250)+($this->vida_por_acerto*250))/2;
		return $preco_da_pedra_total.' PO';
	}

	function barra_de_progresso($habilidade, $tipo){
		if(is_numeric($habilidade)):
			switch($tipo):
				case 'vigor':
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

				case 'regeneracao':
					$barra = (int)($habilidade);
					for($i=1; $i<=$barra; $i++):
						echo '<div class="'.$tipo.'">
							  </div>';	  
					endfor;
				break;

				case 'vida_por_acerto':
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

	function bonus_vigor(){
		if($this->vigor == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Bônus em habilidade: +{$this->vigor}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->vigor,'vigor');
			echo '</div>';
		endif;
	}

	function safira_img(){
		echo "<span class='pedra_img'>
				<img src=".Pedras_roxas::$img." class='pedra_img'>
			  </span>";
	}
   
	function rd(){
		if($this->rd == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Bônus de Redução de Dano: {$this->rd}</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->rd,'rd');
			echo '</div>';
		endif;
	}

	function regeneracao(){
		if($this->regeneracao == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Regenera por rodada: +{$this->regeneracao}Pvs</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->regeneracao,'regeneracao');
			echo '</div>';
		endif;
	}

	function vida_por_acerto(){
		if($this->vida_por_acerto == 0):
			echo "<span></span>";
			echo "<div></div>";
		else:
			echo "<span class='label_pedra'>Recuperação de vida por acerto: {$this->vida_por_acerto}Pvs</span>";
			echo '<div class="bord-level">';
				$this->barra_de_progresso($this->vida_por_acerto,'vida_por_acerto');
			echo '</div>';
		endif;
	}

	function exibir_pedra(){
		echo '<hr>';
		echo '<br />';
		Pedras_roxas::safira_img();
		$this->nome = "Pedra Roxa (Safira)";
		$this->nome();
		//$this->nivel;
		$this->preco_compra();
		$this->preco_venda();
		$this->nivel();	
		$this->bonus_vigor();
		$this->rd();
		$this->regeneracao();
		$this->vida_por_acerto();
	}

	function exibir_prdra_dropada($nivel=null){
		if($nivel != null):
			$this->nivel = rand(1,$nivel);
		else:
			$this->nivel = rand(1,23);
		endif;
		echo '<div class="armas comum">';
			$this->gerar_pedra_roxa();
			$this->exibir_pedra();	
		echo '</div>';
	}

	function gerar_pedra_roxa(){
		$this->zerar_habilidades();
		$this->ativar_habilidades();
		$this->gerar_preco_compra();
		$this->gerar_preco_venda();
	}

	function zerar_habilidades(){
		$this->vigor 			= 0;
		$this->rd 				= 0;
		$this->regeneracao 		= 0;
		$this->vida_por_acerto 	= 0;
	}

	function ativar_habilidades(){
		$habilidades_escolidas = $this->escolher_habilidades(false);
		for($i=1; $i<=count($habilidades_escolidas); $i++):
			switch($habilidades_escolidas[$i]):
				case 'vigor':
					$this->gerar_vigor($this->nivel);
				break;

				case 'rd':
					$this->gerar_rd($this->nivel);
				break;

				case 'regeneracao':
					$this->gerar_regeneracao($this->nivel);
				break;

				case 'vida_por_acerto':
					$this->gerar_vida_por_acerto($this->nivel);
				break;
			endswitch;
		endfor;	
	}
}
?>