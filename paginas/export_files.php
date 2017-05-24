<?php
$file = new Arquivo();
$file->open_file('arquivos/paginas/export_files.txt','r');
$file->read_file();
$file->close_file();
?>