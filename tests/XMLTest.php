<?php

use PHPUnit\Framework\TestCase;
use Solution\XMLReaderWriter;


class XMLTest extends TestCase
{

    private $testFile = ".testFile.xml";
    protected function setUp()
    {
        parent::setUp();
        touch($this->testFile);
    }

    protected function tearDown()
    {
        parent::tearDown();
        unlink($this->testFile);
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

    /**
     * @expectedException \Exception
     */
    public function testThrowExceptionIfNoPayload()
    {
        $xml = "this is not xml";
        $reader = new XMLReaderWriter();
        $reader->getArray();
    }


    public function testReturnFalseIfXmlNotValid()
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


    public function testCanWriteToFile()
    {
        $expected = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<root>
  <user>
    <userid>1</userid>
  </user>
</root>
";
        $writer = new XMLReaderWriter();
        $writer->read($expected);
        $writer->write($this->testFile);
        $out = file_get_contents($this->testFile);

        $this->assertEquals($expected, $out);
    }

}
