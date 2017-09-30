<?php

use Illuminate\Support\Facades\Artisan;

use Illuminate\Database\DatabaseManager;

//use Laravel\Lumen\Testing\DatabaseMigrations;

use Carbon\Carbon;

class DomainsTest extends TestCase
{

//    use DatabaseMigrations;

    public $testDb;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        putenv('DB_DEFAULT=sqlite_testing');
        $db = app('db');
        $this->testDb = $db->connection('sqlite_testing');
    }

    /**
     * A basic response test.
     *
     * @return void
     */
    public function testApplication()
    {
        $response = $this->call('GET', 'domains');
        $this->assertEquals(200, $response->status());
    }

//    TODO: чтобы он использовал route('storeDomain', [['url' => 'http://testdatabase.com']]);
    public function testDatabase()
    {
        $id = $this->testDb->table('domains')->insertGetId(
            [
                'name' => 'http://test.com',
                'created_at' => Carbon::now()
            ]
        );
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
