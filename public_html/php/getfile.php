<?php
header('Access-Control-Allow-Origin: *');
$file = file_get_contents('http://75.agentovs.net/php/index.php?act=getAll');
echo $file;
