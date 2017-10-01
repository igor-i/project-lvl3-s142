<?php

namespace UnitTests;

class DomainsTest extends TestCase
{
    public function testForm()
    {
        $this->post('/domains', ['url' => 'http://ya.ru']);
        $this->seeInDatabase('domains', ['name' => 'http://ya.ru']);
    }

    public function testApplication()
    {
        $this->post('/domains', ['url' => 'http://ya.ru']);
        $this->get('/domains');
        $this->assertResponseOk();
    }
}
