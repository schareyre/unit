<?php
/*spl_autoload_extensions(".php");
spl_autoload_register();*/


spl_autoload_register(function ($class) {
	$filename = __DIR__ . '/../' .str_replace('\'', '/', $class) . '.php';
	if(file_exists($filename))	include __DIR__ . '/../' .str_replace('\'', '/', $class) . '.php';
	
	$filename = __DIR__ . '/../../../' .str_replace('\'', '/', $class) . '.php';
	if(file_exists($filename))	include __DIR__ . '/../../../' .str_replace('\'', '/', $class) . '.php';
	//include __DIR__ . '/../../../' .str_replace('\'', '/', $class) . '.php';
});

?>