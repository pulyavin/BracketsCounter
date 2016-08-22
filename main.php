<?php
require __DIR__.'/vendor/autoload.php';

if (empty($argv[1])) {
	die("try setting arguments...");
}

$bracketsCounter = new Project\BracketsCounter($argv[1]);

echo $bracketsCounter->count();