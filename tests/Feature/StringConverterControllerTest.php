<?php

namespace Tests\Feature;

use Tests\TestCase;
use Faker\Provider\Lorem;

class StringConverterControllerTest extends TestCase
{
    public function testCapsLockEndpoint()
    {
        $words = implode(" ", Lorem::words(5));
        $response = $this->call('GET', '/api/capslock', ["sentences" => $words]);
        $response->assertStatus(200);
        $this->assertEquals(strtoupper($words), data_get($response, 'result'));
    }

    public function testAlternateEndpoint()
    {
        $response = $this->post('/api/alternate', ["sentences" => 'Albert Jonathan']);
        $response->assertStatus(200);
        $this->assertEquals("aLbErT jOnAtHaN", data_get($response, 'result'));
    }

    public function testSaveCsv()
    {
        $words = implode(" ", Lorem::words(10));
        $response = $this->post('/api/savecsv', ["sentences" => $words]);
        $response->assertStatus(200);
        $this->assertEquals("CSV created! Please check a file called result_api.csv in public folder", data_get($response, 'result'));

        //Couldn't managed to figure out how to assert with CSV file.
        // $filename = public_path('result_api.csv');
        // $file = fopen($filename, "r");
        // $this->assertEquals( implode(" ", str_replace('"', '', str_split($words))), fgets($file));
    }
}
