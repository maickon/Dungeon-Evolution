<?php

class Drop{
	public $itens;
	public $indice;

	function addItens($itens){
		$this->itens[] = $itens;		
	}

	function gerar_indice(){
		$this->indice[] = $escolhido = rand(0,9);
	}

	function item_dropado($indice, $i){
		$itens = array(
						'armas','capacetes','escudos','aneis','armaduras','calcas','botas','ombreiras','luvas',
						'predra_vermelha','predra_verde','predra_roxa','predra_rosa','predra_azul','predra_amarela'
					);
		if($indice == 9):
			$this->indice[$i] = rand(9,14);
			return $itens[$this->indice[$i]];
		else:
			return $itens[$this->indice[$i]];
		endif;
	}

	function escolher_classe($indice){
		$classes = array(
						'Armas','Capacetes','Escudos','Aneis','Armaduras','Calcas','Botas','Ombreiras','Luvas',
						'Pedras_vermelhas','Pedras_verdes','Pedras_roxas','Pedras_rosas','Pedras_azuis','Pedras_amarelas'
					);
		return $classes[$indice];
	}

	function escolher_metodo($indice){
		$metodos = array(
						'exibir_arma_sorteada',
						'exibir_capacetes_sorteada',
						'exibir_escudos_sorteada',
						'exibir_aneis_sorteado',
						'exibir_armaduras_sorteada',
						'exibir_calcas_sorteada',
						'exibir_botas_sorteada',
						'exibir_ombreiras_sorteada',
						'exibir_luvas_sorteada',
						'exibir_prdra_dropada',
						'exibir_prdra_dropada',
						'exibir_prdra_dropada',
						'exibir_prdra_dropada',
						'exibir_prdra_dropada',
						'exibir_prdra_dropada'
					);
		return $metodos[$indice];
	}
	
	function exibir_itens_dropados($qtd,$nivel){
		$this->init_drop($qtd,$nivel);
		for($i=0; $i<count($this->itens); $i++):
			$medoto = $this->escolher_metodo($this->indice[$i]);
			$this->itens[$i]->$medoto();
		endfor;	
	}

	function init_drop($qtd,$nivel=null){
		for($i=0; $i<$qtd; $i++):
			$this->gerar_indice();
			$obj = $this->item_dropado($this->indice[$i], $i);
			$classe = $this->escolher_classe($this->indice[$i]);
			$obj = new $classe;
			$this->addItens($obj);
		endfor;
	}
}
?>