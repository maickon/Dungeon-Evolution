<?php
$file = new Arquivo();
$file->open_file('arquivos/paginas/home.txt','r');
$file->read_file();
$file->close_file();
?>