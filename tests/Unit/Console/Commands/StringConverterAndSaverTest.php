<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSuccessfullyWriteOneLine()
    {
        $this->artisan("command:stringConverterAndSaver albert\n");
        $this->expectOutputString("ALBERT\naLbErT\nCSV created!");
        $file = fgets(fopen(__DIR__. "/../../../../result.csv","r"));
        $this->assertEquals("a,l,b,e,r,t\n", $file);
    }
}
