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

//    TODO: чтобы он использовал route('storeDomain', [['url' => 'http://testdatabase.com']]);
    public function testForm()
    {
        $this->call('POST', 'domains', ['url' => 'http%3A%2F%2Ftest.com']);
//        $id = DB::table('domains')->insertGetId(
//            [
//                'name' => 'http://test.com',
//                'created_at' => Carbon::now()
//            ]
//        );
        echo DB::table('domains')->first();
        $this->seeInDatabase('domains', ['url' => 'http://test.com']);
    }

    public function testApplication()
    {
        DB::table('domains')->insertGetId(
            [
                'name' => 'http://test.com',
                'created_at' => Carbon::now()
            ]
        );
        $response = $this->call('GET', 'domains');
        $this->assertEquals(200, $response->status());
    }
}
