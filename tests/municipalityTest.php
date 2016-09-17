<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class municipalityTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;
    use WithoutMiddleware;
    public function testMunicipalityForm()
    {

        $this->visit(route('municipality.create'))
        ->type('Istanbul Kadikoy', 'muniName')
        ->type('HASANPASA Neighborhood FAHRETTINKERIM GOKAY Street. NO:2 ', 'address')
        ->type('Istanbul', 'city')
        ->type('0216 5425000', 'phone')
        ->type('semra hakan', 'personName')
        ->type('00', 'personPhone')
        ->type('semrahakan@gmail.com', 'personMail')
        ->press('Send')
        ->see('Tender');


    }
}
