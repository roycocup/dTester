<?php

use PHPUnit\Framework\TestCase;
use Solution\XMLReaderWriter;


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


    public function testCanPopulatePayload()
    {
        $expected = "<?xml version='1.0' encoding='utf-8'?><users><user><userid>1</userid></user></users>";

        $reader = new XMLReaderWriter();
        $reader->read($expected);
        $out = $reader->getPayload();

        $this->assertEquals($expected, $out);
    }

    public function testCanGetXMLArray()
    {
        $xml = "<?xml version='1.0' encoding='utf-8'?><users><user><userid>1</userid></user></users>";
        $reader = new XMLReaderWriter();
        $reader->read($xml);

        $expected = [
            "user"=>["userid"=>1]
        ];
        $this->assertEquals($expected, $reader->getArray());
    }


    public function testThrowsErrorIfXmlNotValid()
    {
        $xml = "this is not xml";
        $reader = new XMLReaderWriter();
        $reader->read($xml);
        $this->assertFalse($reader->valid());

        $xml = "<?xml version='1.0' encoding='utf-8'?><users><user><userid>1</userid></user></users>";
        $reader->read($xml);
        $this->assertTrue($reader->valid());

        $xml = "<users><user><userid>1</userid></user></users>";
        $reader->read($xml);
        $this->assertTrue($reader->valid());

        $xml = "<users><user><wronngtag><userid>1</userid></user></users>";
        $reader->read($xml);
        $this->assertFalse($reader->valid());
    }

    /**
     * @expectedException \Exception
     */
    public function testThrowExceptionIfNoPayload()
    {
        $xml = "this is not xml";
        $reader = new XMLReaderWriter();
        $reader->getArray();
    }



}
