<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class reminderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;
    use WithoutMiddleware;
    public function testReminder()
    {
        $this->visit(url('indexReminder'))

            ->type('reminder example ','user_reminder')

            ->press('CreateReminder');


    }

}
