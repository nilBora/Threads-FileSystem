<?php

include_once "vendor/autoload.php";

use Jtrw\Process\ProcessFactory;
use Jtrw\Process\Store\FileStore;
use Jtrw\Sandbox\TestCommand;

$start = microtime(true);
$processOne = new ProcessFactory(new FileStore());
$processTwo = new ProcessFactory(new FileStore());
$processThree = new ProcessFactory(new FileStore());

$resultProcessOne = $processOne->run(new TestCommand(['name'=> 'Thread1', 'data'=> 'test1']));
$resultProcessTwo = $processTwo->run(new TestCommand(['name'=> 'Thread2', 'data'=> 'test2']));
$resultProcessThree = $processThree->run(new TestCommand(['name'=> 'Thread3', 'data'=> 'test3']));

print_r($resultProcessOne->getResponse());
print_r($resultProcessTwo->getResponse());
print_r($resultProcessThree->getResponse());

echo 'Time: '.(microtime(true) - $start).' sec.';

