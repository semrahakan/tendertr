<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class contactTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;
    use WithoutMiddleware;
    public function testExample()
    {


        $this->visit(route('contact.index'))
            ->type('example ','contactName')
            ->type('012345','contactPhone')
            ->type('example@example.com','contactEmail')
            ->type('Leverson Street','address')
            ->press('createContact');
    }

}
