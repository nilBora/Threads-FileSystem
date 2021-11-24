<?php


namespace Jtrw\Process\Store;


interface StoreInterface
{
    public function createOutputSore(string $name): string;
    public function getOutputFile(): string;
}