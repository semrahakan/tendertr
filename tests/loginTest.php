<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class loginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->visit(url ('/login'))
            ->type('trafftec@example.com', 'email')
            ->type('testpass123', 'password')
            ->press('Login')
            ->see('Home');
    }
}
