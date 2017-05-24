<?php
require_once 'classes/loader.class.php';
$load = new Loader();
$load->__init__();
$load->load_css($load->css);
$load->load_files($load->classes);
//$load->load_files($load->paginas);
$load->load_files($load->modulos);


?>