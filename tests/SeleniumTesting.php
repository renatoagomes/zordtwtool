<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Laracasts\Integrated\Extensions\Selenium;
use Laracasts\Integrated\Services\Laravel\Application as Laravel;

use WebDriver\WebDriver;

use Selenium\Locator as l;
class SeleniumTesting extends Selenium
{
    use Laravel;

    protected $baseUrl = "http://localhost:8000/";

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    protected $driver;
    protected $session;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        if ( ! $this->app )
        {
            $this->app = $this->createApplication();
        }

        $this->driver  = new WebDriver();
        $this->session = null;
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->session = $this->driver->session();
        var_dump($this->driver->status());
        $this->session->open($this->baseUrl);
        $this->wait(2000);

        $element = $this->session->element('name', 'campox');
        $element2 = $this->session->element('css selector', '.classe-x');
        $element2->click();
        $this->session->type($element, 'lalala');
        var_dump($element);

        






    }


}
