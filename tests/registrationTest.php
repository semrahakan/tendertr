<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class registrationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;
    use WithoutMiddleware;
    public function testRegister()
    {

        $this->visit(url('/adminpage'))
            ->type('trafftec', 'name')
            ->type('trafftec@example.com', 'email')
            ->type('testpass123', 'password')
            ->press('Register')
            ->see('Home');




    }
}
