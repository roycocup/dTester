<?php
namespace Solution;


use Desperado\XmlBundle\DesperadoXmlBundle;
use Desperado\XmlBundle\Model\XmlGenerator;
use Desperado\XmlBundle\Model\XmlReader;

class XMLReaderWriter implements ReaderWriter
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
        $reader = new XmlReader();
        return $reader->processConvert($this->_payload);
    }

    public function valid(): bool
    {
        $reader = new XmlReader();
        return $reader->isXml($this->_payload);
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
        $writer = new XmlGenerator();
        $data = $writer->generateFromArray($this->getArray());
        file_put_contents($fileName, $data);
    }
}