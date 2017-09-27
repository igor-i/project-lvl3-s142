<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{
    /**
     * A basic response test.
     *
     * @return void
     */
    public function testResponse()
    {
        $this->get('/');
        $this->assertResponseOk();
    }
}
