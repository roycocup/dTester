<?php

use PHPUnit\Framework\TestCase;
use Pay4Later\PDT\Serializer\Adapter\XmlClass;
use Pay4Later\PDT\Serializer\Adapter\XmlClassOptions;
use Pay4Later\PDT\Serializer\Adapter\ClassOptions;

class XMLTest extends TestCase
{

    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }


    public function testCanGetRoot()
    {
        $xml = "<?xml version='1.0' encoding='utf-8'?><users><user><userid>1</userid></user></users>";

        $reader = new \XMLReader();
        $reader->XML($xml);

        while($reader->read()) {
            if ($reader->nodeType == XMLReader::ELEMENT) {
                $reader->getAttribute()
//                $address = $reader->getAttribute('address');
//                $latitude = $reader->getAttribute('lat');
//                $longitude = $reader->getAttribute('lng');
            }
        }

    }

}
