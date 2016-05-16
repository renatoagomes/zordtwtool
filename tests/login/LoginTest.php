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


    function __construct() {
        $this->constants = new ConstantsRepository();
    }


    /** @test */
    public function it_logs_user_in_game()
    {
        $this->login();
    }

    /*
     * Preenche os fields de login
     * e da submit
     */
    protected function login()
    {
        $fields = $this->getLoginFields();

        return $this->visit($this->constants->HOME_URL)
            ->wait(2000)
            ->andSubmitForm('login_form', $fields);
    }

    /*
     * Seleciona o mundo na tela de login
     */
    protected function selectWorld()
    {
        return $this->visit($this->constants->LOGIN_URL)
            ->andSubmitForm('login_form', $fields);
    }

    protected function getLoginFields()
    {
        return [
            'user' => $this->constants->USER_LOGIN,
            'password' => $this->constants->USER_PASSWORD
        ];
    }





}
