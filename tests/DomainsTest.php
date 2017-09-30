<?php

namespace UnitTests;

use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

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

    /**
     * A basic response test.
     *
     * @return void
     */
    public function testApplication()
    {
        $id = DB::table('domains')->insertGetId(
            [
                'name' => 'http://test.com',
                'created_at' => Carbon::now()
            ]
        );
        $response = $this->call('GET', 'domains');
        $this->assertEquals(200, $response->status());
    }

//    TODO: чтобы он использовал route('storeDomain', [['url' => 'http://testdatabase.com']]);
    public function testDatabase()
    {
        $id = DB::table('domains')->insertGetId(
            [
                'name' => 'http://test.com',
                'created_at' => Carbon::now()
            ]
        );
        echo "YES bitch: {$id} %))))))";
        $this->seeInDatabase('domains', ['id' => $id]);
    }
}
