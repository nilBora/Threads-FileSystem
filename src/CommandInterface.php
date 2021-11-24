<?php


namespace Jtrw\Process;


interface CommandInterface
{
    public function run(int $pid);
    
    public function getPID(): int;
    
    public function getName(): string;
}