<?php
namespace Jtrw\Process;

use Jtrw\Process\Command\CommandResponse;
use Jtrw\Process\Command\CommandResponseInterface;
use Jtrw\Process\Store\StoreInterface;

class ProcessFactory
{
    protected const WORKER_FILE_NAME = "jProcess";
    
    protected StoreInterface $store;
    protected array $commandsResponse = [];
    protected int $uid = 1;
    
    public function __construct(StoreInterface $store)
    {
        if (PHP_SAPI !== 'cli') {
            throw new \Exception("Only CLI!");
        }
        $this->store = $store;
    } // end __construct
    
    public function run(CommandInterface $command): CommandResponseInterface
    {
        $file = __DIR__.'/'.static::WORKER_FILE_NAME.'.php';
        
        $commandStr = base64_encode(serialize($command));
    
        $outputFile = $this->store->createOutputSore($command->getName());
        
        $cmd = sprintf(
            "php -q %s --id=%s --command=%s >> %s 2>&1 & echo $!",
            $file,
            $this->uid,
            $commandStr,
            $outputFile
        );
        
        $result = [];
        $pid = exec($cmd, $result);

        $this->uid++;
        
        $commandResponse = new CommandResponse($this->store, $pid);
        $this->commandsResponse[$command->getName()] = $commandResponse;
        return $commandResponse;
    } // end run
    
    public function __destruct()
    {
        foreach ($this->commandsResponse as $commandName => $commandResponse) {
            unlink($commandResponse->getOutputFile());
        }
    } // end __destruct
}