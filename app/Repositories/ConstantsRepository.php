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

}

