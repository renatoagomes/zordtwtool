<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Laracasts\Integrated\Extensions\Selenium;
use Laracasts\Integrated\Services\Laravel\Application as Laravel;
use App\Repositories\ConstantsRepository;
use App\Repositories\TropasRepository;
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

    /**
     * Carrega os dados do Player
     */
    public function loadUserData()
    {
        $this->player = Player::where('name', $this->constants->USER_LOGIN)->get()->first();
    }

    /** @test */
    public function mainTest()
    {
        echo "\n" . "* Iniciando Teste ";
        echo "\n" . "* Carregando Player ";

        $this->loadUserData();

        $this->login();
        $this->wait(1000);

        $this->goToPraca();
        $this->wait(1000);

        $this->entraLoopSaques();

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
     * Metodo para entrar no loop de realizacao de saque,
     * chamando os metodos que fazem os tratamentos especificos
     */
    public function entraLoopSaques()
    {
        //pegando tropas disponiveis
        $tropasDisponiveis = $this->getTropasDisponiveis();

        //instanciando um repositorio de tropas para lidar encapsular logicas internas
        $TropasRepository = new TropasRepository($this->constants, $tropasDisponiveis);

        //pegando um modelo de atk baseado nas minhas tropas disponiveis
        $modeloAtk = $TropasRepository->getModeloAtk();

        echo "\n" . "* modeloAtk: \n" ;
        var_dump($modeloAtk);

        //checando o numero de ataques possiveis com esse modelo de ataque
        $qntAtks = $TropasRepository->getQntAtks($modeloAtk);

        echo "\n" . "* Entrando no loop de saques... Numero de Atks que serao realizados: " . $qntAtks . "\n";

        //Enquanto existerem atks para serem feitos
        while ($qntAtks) {

            //Pego alvos para essa quantidade de atks
            $alvos = $this->player->vilas->first()->getFarm($qntAtks);
            foreach ($alvos as $alvo) {
                echo "\n" . "* Faltam " . $qntAtks . " ataques, alvo atual: " . $alvo->coordAmigavel . "\n";

               //TODO criar esses metodos
               //$this->preencheCamposAtk($modeloAtk, $alvo);
               //$this->wait(500);
               //$this->submitAtk();
                $qntAtks--;
            }
        }

        return $this;
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
            //echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaSword = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_SWORD);
            $anchorAllSword = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_SWORD)->text();
            $qntTropaSword = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchorAllSword));
        } catch (Exception $e) {
            //echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaAxe = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_AXE);
            $anchorAllAxe = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_AXE)->text();
            $qntTropaAxe = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchorAllAxe));
        } catch (Exception $e) {
            //echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaSpy = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_SPY);
            $anchor_all_spy = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_SPY)->text();
            $qntTropaSpy = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchor_all_spy));
        } catch (Exception $e) {
            //echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaLight = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_LIGHT);
            $anchorAllTropasText = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_LIGHT)->text();
            $qntTropaLight = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchorAllTropasText));
        } catch (Exception $e) {
            //echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaHeavy = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_HEAVY);
            $anchor_all_heavy = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_HEAVY)->text();
            $qntTropaHeavy = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchor_all_heavy));
        } catch (Exception $e) {
            //echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaRam = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_RAM);
            $anchor_all_ram = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_RAM)->text();
            $qntTropaRam = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchor_all_ram));
        } catch (Exception $e) {
            //echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaCatapult = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_CATAPULT);
            $anchor_all_catapult = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_CATAPULT)->text();
            $qntTropaCatapult = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchor_all_catapult));
        } catch (Exception $e) {
            //echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        $qntTropaSnob = 0;
        try {
            $this->waitForElement($this->constants->ANCHOR_ALL_SNOB);
            $anchor_all_snob = $this->session->element(LocatorStrategy::ID, $this->constants->ANCHOR_ALL_SNOB)->text();
            $qntTropaSnob = preg_replace('/\)/', '',  preg_replace('/\(/', '', $anchor_all_snob));
        } catch (Exception $e) {
            //echo "\n" . "Ocorreu uma Exception: " . get_class($e) . "\n";
        }

        return [
            'SPEAR' => $qntTropaSpear,
            'SWORD' => $qntTropaSword,
            'AXE' => $qntTropaAxe,
            'SPY' => $qntTropaSpy,
            'LIGHT' => $qntTropaLight,
            'HEAVY' => $qntTropaHeavy,
            'RAM' => $qntTropaRam,
            'CATAPULT' => $qntTropaCatapult,
            'SNOB' => $qntTropaSnob
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
    }


}
