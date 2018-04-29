<?php
/**
 * Created by IntelliJ IDEA.
 * User: rodrigo
 * Date: 28/04/2018
 * Time: 16:30
 */

namespace Solution;


interface ReaderWriter
{
    public function payloadExists():bool;
    public function read(string $payload);
    public function write(string $fileName);
    public function getArray(): array ;
}