<?php

namespace UnitTests;

use Illuminate\Support\Facades\Artisan;

class DomainsTest extends TestCase
{
    public function setUp()
    {
        putenv('DB_CONNECTION=testing');
        parent::setUp();
        Artisan::call('migrate');
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    public function testForm()
    {
        $this->call('POST', 'domains', ['url' => 'http://test.com']);
        $this->seeInDatabase('domains', ['name' => 'http://test.com']);
    }

    public function testApplication()
    {
        $this->call('POST', 'domains', ['url' => 'http://test.com']);
        $response = $this->call('GET', 'domains');
        $this->assertEquals(200, $response->status());
    }
}
