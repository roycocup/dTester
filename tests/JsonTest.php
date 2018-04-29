<?php

use PHPUnit\Framework\TestCase;
use Solution\JsonReaderWriter;


class JsonTest extends TestCase
{

    private $_testFile = ".testFile.yaml";
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

    public function dataJsonProvider(){
        $j = '{"user_id": 4}';
        $j2 = '{
    "user_id": 4,
    "first_name": "Joe",
    "last_name": "Public",
    "username": "joey99",
    "user_type": "Employee",
    "last_login_time": "22-09-2014 08:23:54"
  },';
        return [
            [$j],
            [$j2],
        ];
    }

    /**
     * @dataProvider dataJsonProvider
     */
    public function testCanPopulatePayload($data)
    {
        $reader = new JsonReaderWriter();
        $reader->read($data);
        $out = $reader->getPayload();

        $this->assertEquals($data, $out);
    }

    /**
     * @dataProvider dataJsonProvider
     */
    public function testCanGetArray($in)
    {
        $reader = new JsonReaderWriter();
        $reader->read($in);
        $out = $reader->getArray();

        $this->assertTrue(is_array($out));
    }


//    public function testEmptyFilenameReturnsFalse()
//    {
//        $in = "1,2,3";
//
//        $writer = new JsonReaderWriter();
//        $writer->read($in);
//        $out = $writer->write("");
//
//        $this->assertFalse($out);
//    }
//
//    public function testWriteReturnsTrue()
//    {
//        $in = "1,2,3";
//
//        $writer = new JsonReaderWriter();
//        $writer->read($in);
//        $out = $writer->write($this->_testFile);
//
//        $this->assertTrue($out);
//    }
}
