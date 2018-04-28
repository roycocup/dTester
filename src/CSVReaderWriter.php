<?php
namespace Solution;

class CSVReaderWriter implements ReaderWriter
{
    private $_payload = "";

    public function __construct(){}

    public function payloadExists():bool
    {
        return !empty($this->_payload);
    }

    public function read(string $payload)
    {
        $this->_payload = $payload;
    }

    public function getPayload()
    {
        return $this->_payload;
    }

    public function getArray()
    {
        $this->_canExecute();
        return "";
    }

    public function valid(): bool
    {
        return false;
    }

    private function _canExecute()
    {
        if ($this->payloadExists() == false)
        {
            throw new \Exception("Empty payload", 001);
        }
    }

    public function write(string $fileName)
    {
        
    }
}