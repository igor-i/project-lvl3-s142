<?php

use Illuminate\Support\Facades\Artisan;

use Laravel\Lumen\Testing\DatabaseMigrations;

use Carbon\Carbon;

class DomainsTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @return mixed
     */
    public function createApplication()
    {
        putenv('DB_DEFAULT=sqlite_testing');
        $app = require __DIR__ . '/../bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
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
