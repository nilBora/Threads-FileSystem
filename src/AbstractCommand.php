<?php
namespace Jtrw\Process;

use Jtrw\Process\Traits\StringPrepareTrait;
use ReflectionClass;

abstract class AbstractCommand implements CommandInterface
{
    use StringPrepareTrait;
    
    protected int $pid;
    protected array $result;
    protected ?string $commandName = null;
    
    protected array $params = [];
    
    public function __construct(array $params = [])
    {
        $this->params = $params;
    } // end __construct
    
    public function run(int $pid): void
    {
        $this->pid = $pid;
        
        $this->start();
        
        $this->saveResult();
    } // end run
    
    public function getParams(): array
    {
        return $this->params;
    } // end getParams
    
    public function getPID(): int
    {
        return $this->pid;
    } // end getPID
    
    public function getName(): string
    {
        if (isset($this->commandName)) {
            return $this->commandName;
        }
        $reflect = new ReflectionClass($this);
    
        $this->commandName = $this->getSnakeCaseFromCamelCase($reflect->getShortName());

        return $this->commandName;
    } // end getName
    
    public function saveResult(): void
    {
        $this->result['PID'] = $this->pid;
        $content = json_encode($this->result, JSON_THROW_ON_ERROR);
        echo $content;
    } // end saveResult
}
