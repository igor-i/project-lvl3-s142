<?php

namespace UnitTests;

use Illuminate\Support\Facades\Artisan;

//use Illuminate\Database\DatabaseManager;

use Laravel\Lumen\Testing\DatabaseMigrations;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class DomainsTest extends TestCase
{

    use DatabaseMigrations;

//    public $testDb;

//    public function createApplication()
//    {
//        putenv('DB_CONNECTION=testing');
//        parent::createApplication();
//    }

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        putenv('DB_CONNECTION=testing');
//        $db = app('db');
//        $this->testDb = $db->connection('testing');
        echo '1Путин - хуй!';
        Artisan::call('migrate');
        echo '2Путин - хуй!';
    }

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

//    public function setUp()
//    {
//        parent::setUp();
//        Artisan::call('migrate');
//    }
//
//    public function tearDown()
//    {
//        Artisan::call('migrate:reset');
//        parent::tearDown();
//    }
}
