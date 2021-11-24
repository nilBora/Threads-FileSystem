<?php
namespace Jtrw\Process;

use Jtrw\Process\Exceptions\CommandInterfaceNotFoundException;

class jProcessWorker
{
    protected int $id;
    protected string $command;
    
    public function __construct()
    {
        $options = getopt("", ["id:", "command:"]);
        $this->command = $options['command'];
        $this->id = (int) $options['id'];
    } // end __construct
    
    public function run(): void
    {
        $command = $this->getCommandInstance();
        
        $command->run($this->getPid());
    } // end run
    
    protected function getCommandInstance(): CommandInterface
    {
        $command = unserialize(base64_decode($this->command), ['allowed_classes' => true]);
    
        if (!$command instanceof CommandInterface) {
            throw new CommandInterfaceNotFoundException("Instance Must Be Implement CommandInterface");
        }
        
        return $command;
    } // end getCommandInstance
    
    protected function getPid(): int
    {
        return getmypid();
    } // end getPid
}