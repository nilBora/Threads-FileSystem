<?php
namespace Jtrw\Sandbox;

use Jtrw\Process\AbstractCommand;

class TestCommand extends AbstractCommand
{
    public function start()
    {
        sleep(5);
        $this->result = $this->getParams();
    }
}