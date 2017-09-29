<?php

//use Laravel\Lumen\Testing\DatabaseMigrations;

use \Carbon\Carbon;

class DomainsTest extends TestCase
{
    use DatabaseMigrations;

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

//    public function testDatabase()
//    {
//        $id = DB::table('domains')->insertGetId(
//            [
//                'name' => 'http://testdatabase.com',
//                'created_at' => Carbon::now()
//            ]
//        );
//        $this->seeInDatabase('domains', ['id' => $id]);
//    }
}
