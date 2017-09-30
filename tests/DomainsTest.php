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
        $this->post('domains', ['url' => 'http://test.com']);
        $this->seeInDatabase('domains', ['name' => 'http://test.com']);
    }

    public function testApplication()
    {
        $this->post('domains', ['url' => 'http://test.com']);
        $response = $this->get('domains');
        $this->assertEquals(200, $response->status());
    }
}
