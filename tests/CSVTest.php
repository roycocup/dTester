<?php

use PHPUnit\Framework\TestCase;
use Solution\CSVReaderWriter;


class CSVTest extends TestCase
{

    private $testFile = ".testFile.csv";
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
        $expected = "1,2,3";

        $reader = new CSVReaderWriter();
        $reader->read($expected);
        $out = $reader->getPayload();

        $this->assertEquals($expected, $out);
    }

}
