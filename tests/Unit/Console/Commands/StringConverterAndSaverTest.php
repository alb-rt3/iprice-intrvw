<?php

namespace Tests\Unit\Console\Commands;

use App\Console\Commands\StringConverterAndSaver;
use Illuminate\Contracts\Console\Kernel;
// use Illuminate\Foundation\Console\Kernel;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSuccessfullyWriteEmptyString()
    {
        $fp = fopen(__DIR__ . '/../test/test_input', "r");
        $rtrim = rtrim(fgets($fp, 1024));
        // $fp = fopen(__DIR__ . '/../test/test_input', "r");
        // $rtrim = rtrim(fgets($fp, 1024));
        // self::assertEquals('first line of file', $rtrim);
        // $this->artisan('command:stringConverterAndSaver')
        //  ->expectsQuestion('', 'Taylor Otwell')
        //  ->expectsQuestion('', 'PHP');
        $this->artisan('command:stringConverterAndSaver');

        $this->assertTrue(true);
    }
}
