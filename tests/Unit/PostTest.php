<?php

namespace Tests\Unit;

use phpDocumentor\Reflection\DocBlock\Tags\Generic;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        function forCircle($max = 100):array
        {
            $numbers = [];
            for ($i=0;$i<$max;$i++){
                if ($i%2 === 1){
                    $numbers[] = $i;
                }
            }
            return $numbers;
        }

        function generator($max = 100):iterable
        {

            for ($i=0;$i<$max;$i++){
                echo "$i" . PHP_EOL;
                yield $i;
            }
        }

        function readFileFunnc()
        {
//            $file =  readfile(__DIR__ . '/test_file.txt');
//            $file =  file(__DIR__ . '/test_file.txt');
//            $file = file_get_contents(__DIR__ . '/test_file.txt');

            $contentArray = [];
            $file = fopen(__DIR__ . '/test_file.txt', 'r');
            while (($let = fgets($file)) !== false) $res = array_push($contentArray, trim($let));
            return $contentArray;
        }

        $file = readFileFunnc();
        foreach ($file as $f) {
            $f = substr($f, 0,4);
            dump($f . 'trololo');
        }
    }
}
