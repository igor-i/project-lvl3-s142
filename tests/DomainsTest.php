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

    public function testForm()
    {
        $count = DB::table('domains')->count();
        echo "+++++ 1: {$count} +++++";
        $this->call('POST', 'domains', ['url' => 'http%3A%2F%2Ftest.com']);
        $count = DB::table('domains')->count();
        echo "+++++ 2: {$count} +++++";
//        $id = DB::table('domains')->insertGetId(
//            [
//                'name' => 'http://test.com',
//                'created_at' => Carbon::now()
//            ]
//        );
        $row = DB::table('domains')->where('id', '1')->first();
//        echo "++++++ name: {$row->name} ++++++";
        print_r($row);
        $count = DB::table('domains')->count();
        echo "+++++ 3: {$count} +++++";
        $this->seeInDatabase('domains', ['name' => 'http://test.com']);
        echo '+++++ 4 +++++';
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
