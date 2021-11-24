<?php


namespace Jtrw\Process\Command;


use Jtrw\Process\Exceptions\InvalidPidException;
use Jtrw\Process\Store\StoreInterface;

class CommandResponse implements CommandResponseInterface
{
    protected StoreInterface $store;
    protected int $pid;
    
    public function __construct(StoreInterface $store, int $pid)
    {
        $this->store = $store;
        $this->pid = $pid;
    } // end __construct
    
    public function getOutputFile(): string
    {
        return $this->store->getOutputFile();
    } // end getOutputFile
    
    public function getResponse(): array
    {
        while (true) {
            $content = $this->store->getOutputFileContent();

            if (!$content) {
                continue;
            }
            $result = json_decode($content, true, JSON_THROW_ON_ERROR);
            if (empty($result['PID'])) {
                continue;
            }
            if ($result['PID'] !== $this->pid) {
                $msg = sprintf(
                    "PID: %s is Not Equals. Result %s",
                    $this->pid,
                    json_encode($result, JSON_THROW_ON_ERROR)
                );
                throw new InvalidPidException($msg);
            }
            unset($result['PID']);
            return $result;
        }
    } // end getResponse
}