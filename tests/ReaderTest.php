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


    public function testAssertOptionsValid()
    {
        $optionsOptions = new ClassOptions();
        $options = new XmlClassOptions($optionsOptions);
        $xml = new XmlClass($options);
        $c = $xml->getOptions()->getClass();
        var_dump($c); die;
        $this->assertTrue($c instanceof XmlClassOptions);
    }


    public function testXmlCanSerialize()
    {
        $options = new XmlClassOptions();
        $xml = new XmlClass($options);
        
        $testArray = [1,2,3,4,5, "umbrella", "something else"];

        $serialized = $xml->serialize($testArray);

        $this->assertTrue(!empty($serialized));

    }

    public function testXmlCanUnserialize()
    {
        $options = new XmlClassOptions();
        $xml = new XmlClass($options);

        $testArray = [1,2,3,4,5, "umbrella", "something else"];

        $serialized = $xml->serialize($testArray);

        $this->assertTrue(!empty($serialized));

        $result = $xml->unserialize();

        $this->assertEquals($result, $testArray);
    }

}
