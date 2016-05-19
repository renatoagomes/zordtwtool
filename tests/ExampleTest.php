<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Laracasts\Integrated\Extensions\Selenium;
use Laracasts\Integrated\Services\Laravel\Application as Laravel;

use App\Tribo;

class ExampleTest extends Selenium
{
    protected $baseUrl = "http://localhost:8000/";

    use Laravel;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel 5')
             ->type(Tribo::orderByRaw('RANDOM()')->first()->name, 'campox')
             ->wait(2000);
    }
}
