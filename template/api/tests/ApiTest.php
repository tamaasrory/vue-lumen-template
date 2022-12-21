<?php
/**
 * Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
 * website : https://tamaasrory.com
 * email : tamaasrory@gmail.com
 */

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApiv1()
    {
        // test http://localhost:8000/api/v1
        $this->get('/api/v1/');

        // hasil yang di harapkan adalah json kosong -> []
        $this->seeJsonEquals([]);
    }
}
