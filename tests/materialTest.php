<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class materialTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;
    use WithoutMiddleware;
    public function testMaterial()
    {

        $this->visit(route ('materials.create'))
            ->type('movable camera', 'material_name')
            ->press('Create')
            ->see('Material');

    }
}
