<?php

function __autoload($name) 
{
	include_once ("../$name.class.php");
}

$page = !isset($_GET['p']) ?: $_GET['p'] . '.php';
if(!file_exists($page))
	echo 'FILE NOT FOUND!' ;
else
	include($page);

?>