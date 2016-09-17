<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class tenderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;
    use WithoutMiddleware;
    public function testTender()
    {
            $this->visit(route('tender.create'))
                ->type('01', 'number')
                ->type('traffic lambs tender ', 'name')
                ->type('production', 'type')
                ->type('2016', 'date')
                ->type('open tender', 'method')
                ->type('contract', 'agreement')
                ->select('1', 'priority')
                ->select('1', 'phases_id')
                ->type('proposal evaluation completed', 'state')
                ->type('the next meeting will be on 25', 'details')
                ->select('7', 'user_id')
                ->select('7', 'user_id2')
                ->type('100', 'mun_id')
                ->see('Tender');


    }
}