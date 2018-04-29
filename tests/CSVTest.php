<?php

use PHPUnit\Framework\TestCase;
use Solution\CSVReaderWriter;


class CSVTest extends TestCase
{

    private $_testFile = ".testFile.csv";
    protected function setUp()
    {
        parent::setUp();
        touch($this->_testFile);
    }

    protected function tearDown()
    {
        parent::tearDown();
        if (file_exists($this->_testFile))
            unlink($this->_testFile);
    }


    public function testCanPopulatePayload()
    {
        $expected = "1,2,3";

        $reader = new CSVReaderWriter();
        $reader->read($expected);
        $out = $reader->getPayload();

        $this->assertEquals($expected, $out);
    }

    public function testCanGetArray()
    {
        $in = "1,2,3";

        $reader = new CSVReaderWriter();
        $reader->read($in);
        $out = $reader->getArray();

        $expected = [1,2,3];
        $this->assertEquals($expected, $out);
    }


    public function testEmptyFilenameReturnsFalse()
    {
        $in = "1,2,3";

        $writer = new CSVReaderWriter();
        $writer->read($in);
        $out = $writer->write("");

        $this->assertFalse($out);
    }

    public function testWriteReturnsTrue()
    {
        $in = "1,2,3";

        $writer = new CSVReaderWriter();
        $writer->read($in);
        $out = $writer->write($this->_testFile);

        $this->assertTrue($out);
    }
}
