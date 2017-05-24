<?php
$npc = new Npc();
$npc->init_npc(rand(1,23),rand(1,6));
descricao($npc);
status($npc);
itens($npc);

/*
$armas = new Armas();
$capacetes = new Capacetes();
$escudos = new Escudos();
$aneis = new Aneis();
$armaduras = new Armaduras();
$calcas = new Calcas();
$botas = new Botas();
$ombreiras = new Ombreiras();
$luvas = new Luvas();
$predra_vermelha = new Pedras_vermelhas();


$armas->exibir_arma_sorteada();
$capacetes->exibir_capacetes_sorteada();
$escudos->exibir_escudos_sorteada();
$aneis->exibir_aneis_sorteado();
$armaduras->exibir_armaduras_sorteada();
$calcas->exibir_calcas_sorteada();
$botas->exibir_botas_sorteada();
$ombreiras->exibir_ombreiras_sorteada();
$luvas->exibir_luvas_sorteada();

$predra_vermelha->exibir_prdra_dropada();

$drop->addItens($armas);
$drop->addItens($capacetes);

$drop->itens[0]->exibir_arma_sorteada();
$drop->itens[1]->exibir_capacetes_sorteada();
*/
?>