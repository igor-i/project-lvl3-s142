<?php

use Illuminate\Support\Facades\Artisan;

use Laravel\Lumen\Testing\DatabaseMigrations;

use Carbon\Carbon;

class DomainsTest extends TestCase
{

//    use DatabaseMigrations;

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        putenv('DB_DEFAULT=sqlite_testing');
        return require __DIR__.'/../bootstrap/app.php';
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
        $id = DB::table('domains')->insertGetId(
            [
                'name' => 'http://test.com',
                'created_at' => Carbon::now()
            ]
        );
        $this->seeInDatabase('domains', ['id' => $id]);
    }

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}
