<?php


namespace Jtrw\Process\Command;


interface CommandResponseInterface
{
    public function getResponse(): array;
    public function getOutputFile(): string;
}