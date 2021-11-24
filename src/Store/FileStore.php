<?php
namespace Jtrw\Process\Store;


use Jtrw\Process\Exceptions\FileStoreNotFoundException;

class FileStore implements StoreInterface
{
    protected const DEFAULT_TMP_DIRECTORY = "/tmp";
    
    protected string $tmpDirectory;
    protected string $filePath;
    
    public function __construct(array $options = [])
    {
        $this->tmpDirectory = static::DEFAULT_TMP_DIRECTORY;
        if (!empty($options['tmp_directory'])) {
            $this->tmpDirectory = $options['tmp_directory'];
        }
    } // end __construct
    
    public function createOutputSore(string $name): string
    {
        $this->filePath = tempnam($this->tmpDirectory, $name);
        return $this->filePath;
    } // end createOutputSore
    
    public function getOutputFile(): string
    {
        if (!$this->isOutputFileExist()) {
            throw new FileStoreNotFoundException("File Not Found");
        }
        return $this->filePath;
    } // end getOutputFile
    
    public function getOutputFileContent(): string
    {
        return file_get_contents($this->getOutputFile());
    } // end getOutputFileContent
    
    protected function isOutputFileExist(): bool
    {
        return file_exists($this->filePath);
    } // end isOutputFileExist
}