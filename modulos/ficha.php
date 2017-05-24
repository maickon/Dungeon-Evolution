<?php

function descricao($npc){
	$name = "Char N° ".rand(1,99);
	echo '<div class="atributo_linha_descricao">';
		echo '<div class="caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'NOME';
			echo '</div>';
		echo '</div>';

		echo '<div class="caixa_branca_descricao">';
			echo '<div class="atributos_caixa_branca">';
				echo $name;
			echo '</div>';
		echo '</div>';

		echo '<div class="caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'LEVEL';
			echo '</div>';
		echo '</div>';

		echo '<div class="caixa_branca_descricao">';
			echo '<div class="atributos_caixa_branca">';
				echo $npc->nivel;
			echo '</div>';
		echo '</div>';

		echo '<div class="caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'TIPO DE FICHA';
			echo '</div>';
		echo '</div>';

		echo '<div class="caixa_branca_descricao">';
			echo '<div class="atributos_caixa_branca">';
				echo $npc->tipo;
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function atributos($npc){
	$atributos = array($npc->forca,$npc->destreza,$npc->vigor,$npc->sabedoria,$npc->inteligencia,$npc->carisma);
	$atricutos_label = array('FOR','DES','VIG','SAB','INT','CAR');
	echo '<div class="atributos">';
		for($i=0; $i<count($atricutos_label); $i++):
			echo '<div class="atributo_linha_atributos">';
				echo '<div class="caixa_preta">';
					echo '<div class="atributos_caixa_preta">';
						echo $atricutos_label[$i];
					echo '</div>';
				echo '</div>';

				echo '<div class="caixa_branca">';
					echo '<div class="atributos_caixa_branca">';
						echo $atributos[$i];
					echo '</div>';
				echo '</div>';

				echo '<div class="caixa_branca">';
					echo '<div class="atributos_caixa_branca">';
						echo $atributos[$i];
					echo '</div>';
				echo '</div>';
			echo '</div>';
		endfor;
	echo '</div>';
}

function status($npc){
	echo '<div class="atributo_geral">';
		atributos($npc);
		atributos_secundarios_1($npc);
		atributos_secundarios_2($npc);
	echo '</div>';
}

function atributos_secundarios_1($npc){
	echo '<div class="atributo_linha_atributos">';
		pv($npc);
		def($npc);
		esq($npc);
		precisao($npc);
		reducao($npc);
		ph($npc);
		deslocamento($npc);
	echo '</div>';
}

function atributos_secundarios_2($npc){
	echo '<div class="atributos_secundarios2">';
		iniciativa($npc);
		fator_vida($npc);
		fator_pericia($npc);
	echo '</div>';
}

function itens($npc){
	echo '<div class="itens">';
		arma($npc->armas);
		capacete($npc->capacete);
		armadura($npc->armadura);
		aneis($npc->anel);
		luva($npc->luvas);
		calca($npc->calcas);
		bota($npc->botas);
		ombreiras($npc->ombreiras);
		magia($npc->magias);
	echo '</div>';
}

function deslocamento($npc){
	echo '<div class="atributo_linha_atributos">';
		echo '<div class="caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'DESLOCAMENTO';
			echo '</div>';
		echo '</div>';

		echo '<div class="caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $npc->deslocamento();
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function iniciativa($npc){
	echo '<div class="atributo_linha_atributos">';
		echo '<div class="caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'INICIATIVA';
			echo '</div>';
		echo '</div>';

		echo '<div class="caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $npc->iniciativa();
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function fator_vida($npc){
	echo '<div class="atributo_linha_atributos">';
		echo '<div class="caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'FATOR VIDA';
			echo '</div>';
		echo '</div>';

		echo '<div class="caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $npc->fator_vida;
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function fator_pericia($npc){
	echo '<div class="atributo_linha_atributos">';
		echo '<div class="caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'PERICIA';
			echo '</div>';
		echo '</div>';

		echo '<div class="caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $npc->fator_pericia;
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function pv($npc){
	echo '<div class="atributo_linha_atributos">';
		echo '<div class="caixa_preta">';
			echo '<div class="atributos_caixa_preta">';
				echo 'PV';
			echo '</div>';
		echo '</div>';

		echo '<div class="caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $npc->pv();
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function formatar_def($def){
	if($def == 0 || $def == null):
		return '0';
	else:
		return $def;
	endif;
}

function def($npc){
	$defesas = array(
				$npc->defesa(),'+',50,'+',formatar_def(0),'+',formatar_def($npc->defesa_escudo),'+',formatar_def($npc->armadura->defesa),'+',
				formatar_def($npc->capacete->defesa),'+',formatar_def($npc->ombreiras->defesa),'+',formatar_def($npc->calcas->defesa),'+',
				formatar_def($npc->botas->defesa));

	$label = array('','','base','','mágico','','Escudo','','Armadura','','Capacete','','Ombreira','','Calças','','Botas');
	echo '<div class="atributo_linha_atributos">';
		echo '<div class="caixa_preta">';
			echo '<div class="atributos_caixa_preta">';
				echo 'DEF';
			echo '</div>';
		echo '</div>';
		for($i=0; $i<count($defesas); $i++):
			if($defesas[$i] == '+'):
				echo '<div class="caixa_vazia">';
					echo '<div class="sinal">';
						echo '+';
					echo '</div>';
				echo '</div>';
			else:
				echo '<div class="caixa_branca">';
					echo '<div class="atributos_caixa_branca">';
						echo $defesas[$i];
					echo '</div>';
					echo '<div class="label_base">';
						echo $label[$i];
					echo '</div>';
				echo '</div>';
			endif;
		endfor;
	echo '</div>';	
}

function esq($npc){
	$defesas = array($npc->esquiva(),'+',50,'+',$npc->destreza);
	$label = array('','','base','','destreza');
	echo '<div class="atributo_linha_atributos">';
		echo '<div class="caixa_preta">';
			echo '<div class="atributos_caixa_preta">';
				echo 'ESQ';
			echo '</div>';
		echo '</div>';
		for($i=0; $i<count($defesas); $i++):
			if($defesas[$i] == '+'):
				echo '<div class="caixa_vazia">';
					echo '<div class="sinal">';
						echo '+';
					echo '</div>';
				echo '</div>';
			else:
				echo '<div class="caixa_branca">';
					echo '<div class="atributos_caixa_branca">';
						echo $defesas[$i];
					echo '</div>';
					echo '<div class="label_base">';
						echo $label[$i];
					echo '</div>';
				echo '</div>';
			endif;
		endfor;
	echo '</div>';	
}

function reducao($npc){
	echo '<div class="atributo_linha_atributos">';
		echo '<div class="caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'REDUÇÃO';
			echo '</div>';
		echo '</div>';

		echo '<div class="caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $npc->reducao();
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function precisao($npc){
	echo '<div class="atributo_linha_atributos">';
		echo '<div class="caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'PRECISÃO';
			echo '</div>';
		echo '</div>';

		echo '<div class="caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $npc->precisao();
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function ph($npc){
	echo '<div class="atributo_linha_atributos">';
		echo '<div class="caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'PTS DE HABILIDADE';
			echo '</div>';
		echo '</div>';

		echo '<div class="caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $npc->habilidade();
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function capacete($capacete){
	$_n = "<br />";
	echo '<div class="atributo_linha">';
		echo '<div class="label_base2">';
			echo 'Equipamento';
		echo '</div>';
		echo '<div class="itens_caixa_preta">';
			echo '<div class="atributos_caixa_preta">';
				echo 'CAPACETE';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $capacete->nome;
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'HABILIDADES';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca_grande">';
			echo '<div class="atributos_caixa_branca">';
				echo  
					'Raridade: '.$capacete->raridade.$_n.
					'Preço da arma: '.$capacete->preco.$_n.
					'Preço total: '.$capacete->gerar_preco_total().$_n.
					'Esta arma possui '.$capacete->encaixe_livre.' slot de encaixe livre'.$_n.
					'Encaixes '.$capacete->encaixes.$_n.
					'Requisito: '.$capacete->nivel.'° Nível'.$_n.
					'Nível de poder (NP): '.$capacete->np.$_n.
					'RD: '.$capacete->rd.$_n.
					'Defesa: '.$capacete->defesa.$_n;
					echo exibir_pedras_na_ficha2($capacete);
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function aneis($anel){
	$_n = "<br />";
	$arquivo_txt = '';
	echo '<div class="atributo_linha">';
		echo '<div class="label_base2">';
			echo 'Equipamento';
		echo '</div>';
		echo '<div class="itens_caixa_preta">';
			echo '<div class="atributos_caixa_preta">';
				echo 'ANEL';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $anel->nome;
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'HABILIDADES';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca_grande">';
			echo '<div class="atributos_caixa_branca">';
				  $arquivo_txt .= 
					'Raridade: '.$anel->raridade.$_n.
					'Preço da arma: '.$anel->preco.$_n.
					'Preço total: '.$anel->gerar_preco_total().$_n.
					'Esta arma possui '.$anel->encaixe_livre.' slot de encaixe livre'.$_n.
					'Encaixes '.$anel->encaixes.$_n.
					'Requisito: '.$anel->nivel.'° Nível'.$_n.
					'Nível de poder (NP): '.$anel->np.$_n;

					($anel->for == 0)?			:$arquivo_txt .='Força: +'.$anel->for.$_n;
					($anel->des == 0)?			:$arquivo_txt .='Destreza: +'.$anel->des.$_n;
					($anel->vig == 0)?			:$arquivo_txt .='Vigor: +'.$anel->vig.$_n;
					($anel->int == 0)?			:$arquivo_txt .='Inteligência: +'.$anel->int.$_n;			
					($anel->sab == 0)?			:$arquivo_txt .='Sabedoria: +'.$anel->sab.$_n;
					($anel->car == 0)?			:$arquivo_txt .='Carisma: +'.$anel->car.$_n;
					($anel->rd == 0)?			:$arquivo_txt .='RD: +'.$anel->rd.$_n;
					($anel->iniciativa == 0)?	:$arquivo_txt .='iniciativa: +'.$anel->iniciativa.$_n;
					($anel->esq == 0)?			:$arquivo_txt .='Esquiva: +'.$anel->esq.$_n;
					($anel->def == 0)?			:$arquivo_txt .='Defesa: +'.$anel->def.$_n;
					($anel->dano_magia == 0)?	:$arquivo_txt .='Bônus de dano em magia: +'.$anel->dano_magia.$_n;
					($anel->dano_hab == 0)?		:$arquivo_txt .='Bônus de dano em habilidade de classe: +'.$anel->dano_hab.$_n;
					echo $arquivo_txt;
					echo exibir_pedras_na_ficha2($anel);
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function armadura($armadura){
	$_n = "<br />";
	echo '<div class="atributo_linha">';
		echo '<div class="label_base2">';
			echo 'Equipamento';
		echo '</div>';
		echo '<div class="itens_caixa_preta">';
			echo '<div class="atributos_caixa_preta">';
				echo 'ARMADURA';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $armadura->nome;
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'HABILIDADES';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca_grande">';
			echo '<div class="atributos_caixa_branca">';
				echo  
					'Raridade: '.$armadura->raridade.$_n.
					'Preço da arma: '.$armadura->preco.$_n.
					'Preço total: '.$armadura->gerar_preco_total().$_n.
					'Esta arma possui '.$armadura->encaixe_livre.' slot de encaixe livre'.$_n.
					'Encaixes '.$armadura->encaixes.$_n.
					'Requisito: '.$armadura->nivel.'° Nível'.$_n.
					'Nível de poder (NP): '.$armadura->np.$_n.
					'RD: '.$armadura->rd.$_n.
					'Defesa: '.$armadura->defesa.$_n;
					echo exibir_pedras_na_ficha2($armadura);
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function calca($calca){
	$_n = "<br />";
	echo '<div class="atributo_linha">';
		echo '<div class="label_base2">';
			echo 'Equipamento';
		echo '</div>';
		echo '<div class="itens_caixa_preta">';
			echo '<div class="atributos_caixa_preta">';
				echo 'CALÇAS';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $calca->nome;
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'HABILIDADES';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca_grande">';
			echo '<div class="atributos_caixa_branca">';
				echo  
					'Raridade: '.$calca->raridade.$_n.
					'Preço da arma: '.$calca->preco.$_n.
					'Preço total: '.$calca->gerar_preco_total().$_n.
					'Esta arma possui '.$calca->encaixe_livre.' slot de encaixe livre'.$_n.
					'Encaixes '.$calca->encaixes.$_n.
					'Requisito: '.$calca->nivel.'° Nível'.$_n.
					'Nível de poder (NP): '.$calca->np.$_n.
					'RD: '.$calca->rd.$_n.
					'Defesa: '.$calca->defesa.$_n;
					echo exibir_pedras_na_ficha2($calca);
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function bota($bota){
	$_n = "<br />";
	echo '<div class="atributo_linha">';
		echo '<div class="label_base2">';
			echo 'Equipamento';
		echo '</div>';
		echo '<div class="itens_caixa_preta">';
			echo '<div class="atributos_caixa_preta">';
				echo 'BOTAS';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $bota->nome;
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'HABILIDADES';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca_grande">';
			echo '<div class="atributos_caixa_branca">';
				echo  
					'Raridade: '.$bota->raridade.$_n.
					'Preço da arma: '.$bota->preco.$_n.
					'Preço total: '.$bota->gerar_preco_total().$_n.
					'Esta arma possui '.$bota->encaixe_livre.' slot de encaixe livre'.$_n.
					'Encaixes '.$bota->encaixes.$_n.
					'Requisito: '.$bota->nivel.'° Nível'.$_n.
					'Nível de poder (NP): '.$bota->np.$_n.
					'RD: '.$bota->rd.$_n.
					'Defesa: '.$bota->defesa.$_n;
					echo exibir_pedras_na_ficha2($bota);
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function ombreiras($ombreiras){
	$_n = "<br />";
	echo '<div class="atributo_linha">';
		echo '<div class="label_base2">';
			echo 'Equipamento';
		echo '</div>';
		echo '<div class="itens_caixa_preta">';
			echo '<div class="atributos_caixa_preta">';
				echo 'OMBREIRAS';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $ombreiras->nome;
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'HABILIDADES';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca_grande">';
			echo '<div class="atributos_caixa_branca">';
				echo  
					'Raridade: '.$ombreiras->raridade.$_n.
					'Preço da arma: '.$ombreiras->preco.$_n.
					'Preço total: '.$ombreiras->gerar_preco_total().$_n.
					'Esta arma possui '.$ombreiras->encaixe_livre.' slot de encaixe livre'.$_n.
					'Encaixes '.$ombreiras->encaixes.$_n.
					'Requisito: '.$ombreiras->nivel.'° Nível'.$_n.
					'Nível de poder (NP): '.$ombreiras->np.$_n.
					'RD: '.$ombreiras->rd.$_n.
					'Defesa: '.$ombreiras->defesa.$_n;
					echo exibir_pedras_na_ficha2($ombreiras);
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function luva($luvas){
	$_n = "<br />";
	echo '<div class="atributo_linha">';
		echo '<div class="label_base2">';
			echo 'Equipamento';
		echo '</div>';
		echo '<div class="itens_caixa_preta">';
			echo '<div class="atributos_caixa_preta">';
				echo 'LUVAS';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $luvas->nome;
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'HABILIDADES';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca_grande">';
			echo '<div class="atributos_caixa_branca">';
				echo  
					'Raridade: '.$luvas->raridade.$_n.
					'Preço da arma: '.$luvas->preco.$_n.
					'Preço total: '.$luvas->gerar_preco_total().$_n.
					'Esta arma possui '.$luvas->encaixe_livre.' slot de encaixe livre'.$_n.
					'Encaixes '.$luvas->encaixes.$_n.
					'Requisito: '.$luvas->nivel.'° Nível'.$_n.
					'Nível de poder (NP): '.$luvas->np.$_n.
					'RD: '.$luvas->rd.$_n.
					'Defesa: '.$luvas->defesa.$_n;
					echo exibir_pedras_na_ficha2($luvas);
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function magia($magia){
	$_n = "<br />";
	echo '<div class="atributo_linha">';
		echo '<div class="label_base2">';
			echo 'Magia';
		echo '</div>';
		echo '<div class="itens_caixa_preta">';
			echo '<div class="atributos_caixa_preta">';
				echo 'MAGIAS';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca">';
			echo '<div class="atributos_caixa_branca">';
				echo $magia->nome;
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_preta_grande">';
			echo '<div class="atributos_caixa_preta">';
				echo 'DESCRIÇÃO';
			echo '</div>';
		echo '</div>';

		echo '<div class="itens_caixa_branca_grande">';
			echo '<div class="atributos_caixa_branca">';
				print ('  
					Nível:'.$magia->nivel.$_n.'
					Nível de Poder'.$magia->np.$_n.'
					Dano:'.$magia->dano.$_n.'
					Custo de MP:'.$magia->mp.$_n.'
					Info:'.utf8_encode($magia->info).'');
					
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function arma($armas_usadas){
	$_n = "<br />";
	for($i=0; $i<count($armas_usadas); $i++):
		echo '<div class="atributo_linha">';
			if(get_class($armas_usadas[$i]) == 'Escudos'):
				echo '<div class="label_base2">';
					echo 'Equipamento';
				echo '</div>';
				echo '<div class="itens_caixa_preta">';
					echo '<div class="atributos_caixa_preta">';
						echo 'ESCUDO';
					echo '</div>';
				echo '</div>';

				echo '<div class="itens_caixa_branca">';
					echo '<div class="atributos_caixa_branca">';
						echo $armas_usadas[$i]->nome;
					echo '</div>';
				echo '</div>';

				echo '<div class="itens_caixa_preta_grande">';
					echo '<div class="atributos_caixa_preta">';
						echo 'HABILIDADES';
					echo '</div>';
				echo '</div>';

				echo '<div class="itens_caixa_branca_grande">';
					echo '<div class="atributos_caixa_branca">';
						echo  
							'Raridade: '.$armas_usadas[$i]->raridade.$_n.
							'Preço da arma: '.$armas_usadas[$i]->preco.$_n.
							'Preço total: '.$armas_usadas[$i]->gerar_preco_total().$_n.
							'Esta arma possui '.$armas_usadas[$i]->encaixe_livre.' slot de encaixe livre'.$_n.
							'Encaixes '.$armas_usadas[$i]->encaixes.$_n.
							'Requisito: '.$armas_usadas[$i]->nivel.'° Nível'.$_n.
							'Nível de poder (NP): '.$armas_usadas[$i]->np.$_n.
							'RD: '.$armas_usadas[$i]->rd.$_n.
							'Defesa: '.$armas_usadas[$i]->defesa.$_n;
							echo exibir_pedras_na_ficha($armas_usadas,$i);
					echo '</div>';
				echo '</div>';
			else:
				echo '<div class="label_base2">';
					echo 'Equipamento';
				echo '</div>';
				echo '<div class="itens_caixa_preta">';
					echo '<div class="atributos_caixa_preta">';
						echo 'ARMA';
					echo '</div>';
				echo '</div>';

				echo '<div class="itens_caixa_branca">';
					echo '<div class="atributos_caixa_branca">';
						echo $armas_usadas[$i]->tipo;
					echo '</div>';
				echo '</div>';

				echo '<div class="itens_caixa_preta_grande">';
					echo '<div class="atributos_caixa_preta">';
						echo 'HABILIDADES';
					echo '</div>';
				echo '</div>';

				echo '<div class="itens_caixa_branca_grande">';
					echo '<div class="atributos_caixa_branca">';
						echo  
							'Raridade: '.$armas_usadas[$i]->raridade.$_n.
							'Preço da arma: '.$armas_usadas[$i]->preco.$_n.
							'Preço total: '.$armas_usadas[$i]->gerar_preco_total().$_n.
							'Categoria: '.$armas_usadas[$i]->categoria.$_n.
							'Esta arma possui '.$armas_usadas[$i]->encaixes_livres.' slot de encaixe livre'.$_n.
							'Encaixes '.$armas_usadas[$i]->encaixes.$_n.
							'Indicada para o nível: '.$armas_usadas[$i]->nivel.$_n.
							'Nível de poder (NP): '.$armas_usadas[$i]->np.$_n.
							'Dano: '.$armas_usadas[$i]->gerar_dano_total().$_n;
							echo exibir_pedras_na_ficha($armas_usadas,$i);

					echo '</div>';
				echo '</div>';
			endif;
		echo '</div>';
	endfor;	
}

function exibir_pedras_na_ficha($armas_usadas,$i){
	$arquivo_txt = "";
	$_n = "<br />";
	if($armas_usadas[$i]->encaixes != 0):
		for($e=1; $e<=($armas_usadas[$i]->encaixes);$e++):
			if(get_class($armas_usadas[$i]->pedras[$e]) == 'Pedras_vermelhas'):
				$arquivo_txt .= $_n.

					'>>>>>>Predra Vermelha (Rubi)<<<<<<'.$_n.
					'Preço de compra: '.$armas_usadas[$i]->pedras[$e]->preco.$_n.	
					'Preço para Venda: '.$armas_usadas[$i]->pedras[$e]->gerar_preco_venda().$_n.
					'Nível da pedra: '.$armas_usadas[$i]->pedras[$e]->nivel.$_n.
					'Bônus de experiência: '.$armas_usadas[$i]->pedras[$e]->experiencia.$_n.
					'Bônus de dano: '.$armas_usadas[$i]->pedras[$e]->dano.$_n.
					'Bônus em habilidade (Força): '.$armas_usadas[$i]->pedras[$e]->habilidade.$_n.
					'Bônus de precisão: '.$armas_usadas[$i]->pedras[$e]->precisao.$_n;
			
			elseif(get_class($armas_usadas[$i]->pedras[$e]) == 'Pedras_verdes'):
				$arquivo_txt .= $_n.
					'>>>>>Predra Verde (Esmeralda)<<<<<'.$_n.
					'Preço de compra: '.$armas_usadas[$i]->pedras[$e]->preco.$_n.
					'Preço para Venda: '.$armas_usadas[$i]->pedras[$e]->gerar_preco_venda().$_n.
					'Nível da pedra: '.$armas_usadas[$i]->pedras[$e]->nivel.$_n.
					'Bônus de esquiva: '.$armas_usadas[$i]->pedras[$e]->esquiva.$_n.
					'Chance de crítico: '.$armas_usadas[$i]->pedras[$e]->critico.$_n.
					'Bônus de precisao a distância: '.$armas_usadas[$i]->pedras[$e]->precisao_distancia.$_n.
					'Bônus em habilidade (Destreza): '.$armas_usadas[$i]->pedras[$e]->habilidade.$_n;

			elseif(get_class($armas_usadas[$i]->pedras[$e]) == 'Pedras_roxas'):
				$arquivo_txt .= $_n.
					'>>>>>>>Preda Roxa (Safira)<<<<<<<'.$_n.
					'Preço de compra: '.$armas_usadas[$i]->pedras[$e]->preco.$_n.
					'Preço para Venda: '.$armas_usadas[$i]->pedras[$e]->gerar_preco_venda().$_n.
					'Nível da pedra: '.$armas_usadas[$i]->pedras[$e]->nivel.$_n.
					'Bônus em habilidade (Vigor): '.$armas_usadas[$i]->pedras[$e]->vigor.$_n.
					'Bônus de Redução de Dano: '.$armas_usadas[$i]->pedras[$e]->rd.$_n.
					'Regenera por rodada: '.$armas_usadas[$i]->pedras[$e]->regeneracao.$_n.
					'Recuperação de vida por acerto: '.$armas_usadas[$i]->pedras[$e]->vida_por_acerto.$_n;

			elseif(get_class($armas_usadas[$i]->pedras[$e]) == 'Pedras_amarelas'):
				$arquivo_txt .= $_n.
					'>>>>>Pedra Amarela (Topázio)<<<<<'.$_n.
					'Preço de compra: '.$armas_usadas[$i]->pedras[$e]->preco.$_n.
					'Preço para Venda: '.$armas_usadas[$i]->pedras[$e]->gerar_preco_venda().$_n.
					'Nível da pedra: '.$armas_usadas[$i]->pedras[$e]->nivel.$_n.
					'Bônus de ouro extra a cada sessão: '.$armas_usadas[$i]->pedras[$e]->ouro_extra.$_n.
					'Bônus em habilidade (Inteligência): '.$armas_usadas[$i]->pedras[$e]->habilidade.$_n.
					'Aumento de dano em Magias: '.$armas_usadas[$i]->pedras[$e]->dano.$_n.
					'Aumenta seu DL(Drop Level): '.$armas_usadas[$i]->pedras[$e]->chance.$_n;

			elseif(get_class($armas_usadas[$i]->pedras[$e]) == 'Pedras_rosas'):
				$arquivo_txt .= $_n.
					'>>>>>>Pedra Rosa (Diamente)<<<<<<'.$_n.
					'Preço de compra: '.$armas_usadas[$i]->pedras[$e]->preco.$_n.
					'Preço para Venda: '.$armas_usadas[$i]->pedras[$e]->gerar_preco_venda().$_n.
					'Nível da pedra: '.$armas_usadas[$i]->pedras[$e]->nivel.$_n.
					'Bônus de ouro extra a cada sessão: '.$armas_usadas[$i]->pedras[$e]->ouro_extra.$_n.
					'Bônus em habilidade (Carisma): '.$armas_usadas[$i]->pedras[$e]->habilidade.$_n.
					'Aumento de Pvs reservas: '.$armas_usadas[$i]->pedras[$e]->vida_extra.$_n.
					'Aumenta seu DL(Drop Level)/Def/Esq: '.$armas_usadas[$i]->pedras[$e]->sorte.$_n;

			elseif(get_class($armas_usadas[$i]->pedras[$e]) == 'Pedras_azuis'):
				$arquivo_txt .= $_n.
					'>>>>>>Pedra Azul (Ametista)<<<<<<'.$_n.
					'Preço de compra: '.$armas_usadas[$i]->pedras[$e]->preco.$_n.
					'Preço para Venda: '.$armas_usadas[$i]->pedras[$e]->gerar_preco_venda().$_n.
					'Nível da pedra: '.$armas_usadas[$i]->pedras[$e]->nivel.$_n.
					'Bônus de deflexão: '.$armas_usadas[$i]->pedras[$e]->deflexao.$_n.
					'Bônus em habilidade (Sabedoria): '.$armas_usadas[$i]->pedras[$e]->habilidade.$_n.
					'Pontos de habilidade (PH): '.$armas_usadas[$i]->pedras[$e]->pts_hab.$_n.
					'Bônus de dano na habilidade de classe: '.$armas_usadas[$i]->pedras[$e]->dano.$_n;
			endif;
		endfor;
	endif;

	return $arquivo_txt;
}

function exibir_pedras_na_ficha2($armas_usadas){
	$arquivo_txt = "";
	$_n = "<br />";
	if($armas_usadas->encaixes != 0):
		for($e=1; $e<=($armas_usadas->encaixes);$e++):
			if(get_class($armas_usadas->pedras[$e]) == 'Pedras_vermelhas'):
				$arquivo_txt .= $_n.

					'>>>>>Predra Vermelha (Rubi)<<<<<'.$_n.
					'Preço de compra: '.$armas_usadas->pedras[$e]->preco.$_n.	
					'Preço para Venda: '.$armas_usadas->pedras[$e]->gerar_preco_venda().$_n.
					'Nível da pedra: '.$armas_usadas->pedras[$e]->nivel.$_n.
					'Bônus de experiência: '.$armas_usadas->pedras[$e]->experiencia.$_n.
					'Bônus de dano: '.$armas_usadas->pedras[$e]->dano.$_n.
					'Bônus em habilidade (Força): '.$armas_usadas->pedras[$e]->habilidade.$_n.
					'Bônus de precisão: '.$armas_usadas->pedras[$e]->precisao.$_n;
			
			elseif(get_class($armas_usadas->pedras[$e]) == 'Pedras_verdes'):
				$arquivo_txt .= $_n.
					'>>>>Predra Verde (Esmeralda)<<<<'.$_n.
					'Preço de compra: '.$armas_usadas->pedras[$e]->preco.$_n.
					'Preço para Venda: '.$armas_usadas->pedras[$e]->gerar_preco_venda().$_n.
					'Nível da pedra: '.$armas_usadas->pedras[$e]->nivel.$_n.
					'Bônus de esquiva: '.$armas_usadas->pedras[$e]->esquiva.$_n.
					'Chance de crítico: '.$armas_usadas->pedras[$e]->critico.$_n.
					'Bônus de precisao a distância: '.$armas_usadas->pedras[$e]->precisao_distancia.$_n.
					'Bônus em habilidade (Destreza): '.$armas_usadas->pedras[$e]->habilidade.$_n;

			elseif(get_class($armas_usadas->pedras[$e]) == 'Pedras_roxas'):
				$arquivo_txt .= $_n.
					'>>>>>>Preda Roxa (Safira)<<<<<<'.$_n.
					'Preço de compra: '.$armas_usadas->pedras[$e]->preco.$_n.
					'Preço para Venda: '.$armas_usadas->pedras[$e]->gerar_preco_venda().$_n.
					'Nível da pedra: '.$armas_usadas->pedras[$e]->nivel.$_n.
					'Bônus em habilidade (Vigor): '.$armas_usadas->pedras[$e]->vigor.$_n.
					'Bônus de Redução de Dano: '.$armas_usadas->pedras[$e]->rd.$_n.
					'Regenera por rodada: '.$armas_usadas->pedras[$e]->regeneracao.$_n.
					'Recuperação de vida por acerto: '.$armas_usadas->pedras[$e]->vida_por_acerto.$_n;

			elseif(get_class($armas_usadas->pedras[$e]) == 'Pedras_amarelas'):
				$arquivo_txt .= $_n.
					'>>>>Pedra Amarela (Topázio)<<<<'.$_n.
					'Preço de compra: '.$armas_usadas->pedras[$e]->preco.$_n.
					'Preço para Venda: '.$armas_usadas->pedras[$e]->gerar_preco_venda().$_n.
					'Nível da pedra: '.$armas_usadas->pedras[$e]->nivel.$_n.
					'Bônus de ouro extra a cada sessão: '.$armas_usadas->pedras[$e]->ouro_extra.$_n.
					'Bônus em habilidade (Inteligência): '.$armas_usadas->pedras[$e]->habilidade.$_n.
					'Aumento de dano em Magias: '.$armas_usadas->pedras[$e]->dano.$_n.
					'Aumenta seu DL(Drop Level): '.$armas_usadas->pedras[$e]->chance.$_n;

			elseif(get_class($armas_usadas->pedras[$e]) == 'Pedras_rosas'):
				$arquivo_txt .= $_n.
					'>>>>>Pedra Rosa (Diamente)<<<<<'.$_n.
					'Preço de compra: '.$armas_usadas->pedras[$e]->preco.$_n.
					'Preço para Venda: '.$armas_usadas->pedras[$e]->gerar_preco_venda().$_n.
					'Nível da pedra: '.$armas_usadas->pedras[$e]->nivel.$_n.
					'Bônus de ouro extra a cada sessão: '.$armas_usadas->pedras[$e]->ouro_extra.$_n.
					'Bônus em habilidade (Carisma): '.$armas_usadas->pedras[$e]->habilidade.$_n.
					'Aumento de Pvs reservas: '.$armas_usadas->pedras[$e]->vida_extra.$_n.
					'Aumenta seu DL(Drop Level)/Def/Esq: '.$armas_usadas->pedras[$e]->sorte.$_n;

			elseif(get_class($armas_usadas->pedras[$e]) == 'Pedras_azuis'):
				$arquivo_txt .= $_n.
					'>>>>>Pedra Azul (Ametista)<<<<<'.$_n.
					'Preço de compra: '.$armas_usadas->pedras[$e]->preco.$_n.
					'Preço para Venda: '.$armas_usadas->pedras[$e]->gerar_preco_venda().$_n.
					'Nível da pedra: '.$armas_usadas->pedras[$e]->nivel.$_n.
					'Bônus de deflexão: '.$armas_usadas->pedras[$e]->deflexao.$_n.
					'Bônus em habilidade (Sabedoria): '.$armas_usadas->pedras[$e]->habilidade.$_n.
					'Pontos de habilidade (PH): '.$armas_usadas->pedras[$e]->pts_hab.$_n.
					'Bônus de dano na habilidade de classe: '.$armas_usadas->pedras[$e]->dano.$_n;
			endif;
		endfor;
	endif;

	return $arquivo_txt;
}
?>