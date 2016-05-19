<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Laracasts\Integrated\Extensions\Selenium;
use Laracasts\Integrated\Services\Laravel\Application as Laravel;
use App\Repositories\ConstantsRepository;

/**
 * Test case para realizar o login
 */
class LoginTest extends Selenium
{
    use Laravel;

    protected $baseUrl="https://br75.tribalwars.com.br/";
    public $constants;

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

        $this->constants = new ConstantsRepository();
    }

    /** @test */
    public function testenvValues()
    {
        var_dump($this->constants);
    }

    /** @test */
    public function it_logs_user_in_game()
    {
        $this->login();
        $this->wait(1000);
    }

    /** @test */
    public function get_user_data()
    {
        $player = App\Player::where('name', $this->constants->USER_LOGIN)->get();

        var_dump($player);

        $vila =  $player->vilas->first();

        var_dump($vila);

        echo "\n Aldeias next: " . $vila->getVilasParaFarm(20)->count();

    }

    /*
     * Preenche os fields de login e da submit
     * e da submit
     */
    protected function login()
    {
        $this->visit("/")->wait(2000);

        $this->type($this->constants->USER_LOGIN, 'user');
        $this->type($this->constants->USER_PASSWORD,'password');

        $this->session->element('css selector', 'span.button_middle')->click();
        $this->wait(1000);

        $this->session->element('css selector', '.world_button_active')->click();
    }

    /**
     * Metodo para realizar saques
     */
    public function fazSaques()
    {
        $this->wait(1000);
        $this->session->element('id', 'span.button_middle')->click();
        $this->wait(2000);

    }





}
