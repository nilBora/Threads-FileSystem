<?php

include_once "vendor/autoload.php";

$start = microtime(true);
$processOne = new \Jtrw\Process\ProcessFactory(new \Jtrw\Process\Store\FileStore());
$processTwo = new \Jtrw\Process\ProcessFactory(new \Jtrw\Process\Store\FileStore());

$resultProcessOne = $processOne->run(new \Jtrw\Sandbox\TestCommand(['name'=> 'Hello world', 'data'=> 'test']));
$resultProcessTwo = $processTwo->run(new \Jtrw\Sandbox\TestCommand(['name'=> 'Hello', 'data'=> 'test']));

print_r($resultProcessOne->getResponse());
print_r($resultProcessTwo->getResponse());


