<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

class StringConverterAndSaverTest extends TestCase
{
    public function testSuccessfullyWriteOneLine()
    {
        $this->artisan("command:stringConverterAndSaver albert\n");
        $this->expectOutputString("ALBERT\naLbErT\nCSV created!");
        $file = fgets(fopen(__DIR__ . "/../../../../result.csv", "r"));
        $this->assertEquals("a,l,b,e,r,t\n", $file);
    }

    public function testSuccessfullyWriteMultiline()
    {
        $this->artisan("command:stringConverterAndSaver --test\n");
        $this->expectOutputString("TIGWT7QVSA\nDQUOMYHQOQ\n0XZTVO@NG5V\nXDPVWPIU6I\nGIM4!OBBLAJ\nTHQAHA3PBP\nKNVEFWCZXK\nST0S3YHJJR\nX5DSBWHV2W\nKWMK3VLXRX\ntIgWt7QvSa\ndQuOmYhQoQ\n0xZtVo@Ng5V\nxDpVwPiU6i\ngIm4!ObBlAj\ntHqAhA3pBp\nkNvEfWcZxK\nsT0s3YhJjR\nx5DsBwHv2W\nkWmK3vLxRx\nCSV created!");
        $file = fopen(__DIR__ . "/../../../../result.csv", "r");
        $expectedCsvOutput = [
            "T,i,g,w,t,7,Q,V,S,a\n",
            "D,Q,U,o,M,Y,h,q,o,Q\n",
            "0,X,z,T,V,o,@,n,G,5,V\n",
            "x,d,p,v,w,p,I,U,6,i\n",
            "g,I,M,4,!,o,B,B,l,a,J\n",
            "t,H,q,A,H,a,3,P,b,p\n",
            "k,n,v,E,F,W,c,z,X,k\n",
            "S,t,0,S,3,Y,H,J,j,r\n",
            "x,5,D,S,b,w,h,v,2,w\n",
            "K,W,M,k,3,V,L,x,R,X\n",
        ];
        $index = 0;
        while (!feof($file)) {
            $outputSentence = fgets($file);
            if(!$outputSentence) {
                break;
            }
            $this->assertEquals($expectedCsvOutput[$index], $outputSentence);
            $index++;
        }
    }
}
