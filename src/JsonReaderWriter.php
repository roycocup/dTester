<?php
namespace Solution;


class JsonReaderWriter implements ReaderWriter
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

    public function getArray():array
    {
        $this->_canExecute();

        $res = json_decode($this->_payload);

        if (!is_array($res))
            return false;

        return $res;
    }

    public function valid(): bool
    {
        $res = $this->getArray();
        if (!is_array($res))
            return false;

        return true;
    }

    private function _canExecute()
    {
        if ($this->payloadExists() == false)
        {
            throw new \Exception("Empty payload", 001);
        }
    }

    public function write(string $fileName): bool
    {
        $arr = $this->getArray();
        try {
            $yaml = Yaml::dump($arr);
        } catch (\Exception $e){
            echo $e->getMessage();
            return false;
        }

        return true;
    }
}