<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class uploadTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpload()
    {

        $file = new Symfony\Component\HttpFoundation\File\UploadedFile( storage_path( 'app/test-file.csv' ), 'test-file.csv', 'text/plain', 446 );
        $this->call( 'POST', '/upload', [], [], [ 'csv_file' => $file ] );
        $this->assertResponseOk();

    }
}
