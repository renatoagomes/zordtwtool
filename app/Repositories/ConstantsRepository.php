<?php

namespace app\Repositories;

/**
 * Repositorio para guardar as constantes da aplicação
 */
class ConstantsRepository
{

    // * USER INFO
    public $USER_LOGIN;
    public $USER_PASSWORD;
    public $HOME_URL;

    /**
     * Construtor que pega os valores do env.
     */
    function __construct()
    {
        echo 'inside construtor';
        $this->USER_LOGIN = env('USER_LOGIN');
        $this->USER_PASSWORD = env('USER_PASSWORD');
        $this->HOME_URL = env('HOME_URL');
    }

    /** INFO DA TELA DE TROPAS **/
    public $FIELD_SPEAR = "#unit_input_spear";
    public $FIELD_SWORD = "#unit_input_sword";
    public $FIELD_AXE = "#unit_input_axe";
    public $FIELD_SPY = "#unit_input_spy";
    public $FIELD_LIGHT = "#unit_input_light";
    public $FIELD_HEAVY = "#unit_input_heavy";
    public $FIELD_RAM = "#unit_input_ram";
    public $FIELD_CATAPULT = "#unit_input_catapult";
    public $FIELD_SNOB = "#unit_input_snob";


}

