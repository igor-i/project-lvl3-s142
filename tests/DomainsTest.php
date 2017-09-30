<?php

namespace UnitTests;

use Illuminate\Support\Facades\Artisan;

//use Illuminate\Database\DatabaseManager;

//use Laravel\Lumen\Testing\DatabaseMigrations;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class DomainsTest extends TestCase
{

//    use DatabaseMigrations;

    /**
     * A basic response test.
     *
     * @return void
     */
//    public function testApplication()
//    {
//        $response = $this->call('GET', 'domains');
//        $this->assertEquals(200, $response->status());
//    }

//    TODO: чтобы он использовал route('storeDomain', [['url' => 'http://testdatabase.com']]);
    public function testDatabase()
    {
        echo '3Путин - хуй!';
        $f = DB::table('migrations')->first();
        print_r($f);
        $id = DB::table('domains')->insertGetId(
            [
                'name' => 'http://test.com',
                'created_at' => Carbon::now()
            ]
        );
        echo "YES bitch: {$id} %))))))";
        $this->seeInDatabase('domains', ['id' => $id]);
    }

    public function setUp()
    {
        putenv('DB_CONNECTION=testing');
        parent::setUp();
        Artisan::call('migrate');
    }

    public function tearDown()
    {
//        putenv('DB_CONNECTION=testing');
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}
