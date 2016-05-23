<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Laracasts\Integrated\Extensions\Selenium;
use Laracasts\Integrated\Services\Laravel\Application as Laravel;
use App\Repositories\ConstantsRepository;
use WebDriver\LocatorStrategy as LocatorStrategy;
use App\Player;
use App\Vila;

/**
 * Test case para realizar o login
 */
class LoginTest extends Selenium
{
    use Laravel;

    protected $baseUrl="https://br75.tribalwars.com.br/";
    public $constants;

    protected $player;

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

    public function get_player_data()
    {
        $this->player = Player::where('name', $this->constants->USER_LOGIN)->get()->first();
        var_dump($this->player);
    }

    /** @test */
    public function mainTest()
    {
        $this->login();
        $this->wait(1000);

        $this->goToPraca();
        $this->wait(1000);

        echo "\n" . "* Pegando tropas disponiveis..." . "\n";
        $tropasDisponiveis = $this->getTropasDisponiveis();
        var_dump($tropasDisponiveis);

        $this->wait(1000);

        /* TODO -- terminar esse loop
        while ($this->getModeloAtk($tropasDisponiveis)) {
            //Chamar funcao que preenche campos
            //Chamar funcao que da submit
            //recalcular tropas
        }
        */
    }

    /*
     * Preenche os fields de login e da submit
     * e da submit
     */
    protected function login()
    {
        $this->visit($this->baseUrl)->wait(2000);

        $this->type($this->constants->USER_LOGIN, 'user');
        $this->type($this->constants->USER_PASSWORD,'password');

        $this->session->element(LocatorStrategy::CSS_SELECTOR, 'span.button_middle')->click();
        $this->wait(1000);

        $this->session->element(LocatorStrategy::CSS_SELECTOR, '.world_button_active')->click();
    }

    /**
     * Metodo para realizar saques
     */
    public function fazSaques()
    {
        $this->session->element(LocatorStrategy::ID, $this->constants->PLACE_ID)->click();
        $this->wait(1500);

        $arrayTropas = $this->getTropasDisponiveis();
        $this->session->close();


        $TR = new TropasRepository($this->constants, $arrayTropas);
        $modeloTropas = $TR->getModeloAtk();
        $qntAtks = $TR->getQntAtks($modeloTropas);

        $alvos = $this->player->vilas->first()->getFarm($qntAtks);

        foreach ($alvos as $alvo) {
            $this->preencheCamposAtk($modeloTropas, $alvo);
            $this->wait(500);
            $this->submitAtk();
        }

        $this->type($this->constants->USER_LOGIN, 'user');
        $this->type($this->constants->USER_PASSWORD,'password');

        $this->session->element(LocatorStrategy::CSS_SELECTOR, 'span.button_middle')->click();
        $this->wait(1000);

        $this->session->element(LocatorStrategy::CSS_SELECTOR, '.world_button_active')->click();
    }


    /**
     * Metodo para procurar pelas quantidades de cada tropa e montar um array para retornar
     *
     * @return array com as tropas disponiveis e suas respectivas quantidades
     */
    public function getTropasDisponiveis()
    {
        $qntTropaSpear = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_SPEAR);
            $anchorAllSpear = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_SPEAR)->text();
            $qntTropaSpear = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchorAllSpear));
        } catch (Exception $e) {
            echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaAxe = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_AXE);
            $anchorAllAxe = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_AXE)->text();
            $qntTropaAxe = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchorAllAxe));
        } catch (Exception $e) {
            echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaSpy = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_SPY);
            $anchor_all_spy = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_SPY)->text();
            $qntTropaSpy = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchor_all_spy));
        } catch (Exception $e) {
            echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaLight = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_LIGHT);
            $anchorAllTropasText = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_LIGHT)->text();
            $qntTropaLight = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchorAllTropasText));
        } catch (Exception $e) {
            echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaHeavy = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_HEAVY);
            $anchor_all_heavy = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_HEAVY)->text();
            $qntTropaHeavy = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchor_all_heavy));
        } catch (Exception $e) {
            echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaRam = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_RAM);
            $anchor_all_ram = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_RAM)->text();
            $qntTropaRam = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchor_all_ram));
        } catch (Exception $e) {
            echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaCatapult = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_CATAPULT);
            $anchor_all_catapult = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_CATAPULT)->text();
            $qntTropaCatapult = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchor_all_catapult));
        } catch (Exception $e) {
            echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaSnob = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_SNOB);
            $anchor_all_snob = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_SNOB)->text();
            $qntTropaSnob = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchor_all_snob));
        } catch (Exception $e) {
            echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        return [
            'SPEAR' => $qntTropasSpear,
            'SWORD' => $qntTropasSword,
            'AXE' => $qntTropasAxe,
            'SPY' => $qntTropasSpy,
            'LIGHT' => $qntTropasLight,
            'HEAVY' => $qntTropasHeavy,
            'RAM' => $qntTropasRam,
            'CATAPULT' => $qntTropasCatapult,
            'SNOB' => $qntTropasSnob
        ];
    }

    /**
     * Navega para a pagina da Praça a partir da tela de overview
     */
    public function goToPraca()
    {
        $this->waitForElement($this->constants->PLACE_ID);
        $this->session->element(LocatorStrategy::ID, $this->constants->PLACE_ID)->click();
        $this->wait(1000);
        echo "\n" . $this->session->url() . "\n";
    }


}
