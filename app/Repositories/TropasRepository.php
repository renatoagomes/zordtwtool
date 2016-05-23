<?php

namespace App\Repositories;

Class TropasRepository
{

    const QNT_SAFE_SPEAR = 7;
    const QNT_SAFE_SWORD = 7;
    const QNT_SAFE_AXE = 7;
    const QNT_SAFE_SPY = 4;
    const QNT_SAFE_LIGHT = 3;

    public $spear;
    public $sword;
    public $axe;
    public $spy;
    public $light;
    public $heavy;
    public $ram;
    public $catapult;
    public $snob;


    /**
     * Construtor que recebe um array com as tropas
     */
    function __construct(ConstantsRepository $constants, $arrayTropasDisponiveis)
    {
        echo "\n" . "* Construindo objeto TropasRepository, tropas disponiveis:" . "\n";
        var_dump($arrayTropasDisponiveis);

        $this->constants = $constants;

        $this->spear = array_key_exists("SPEAR",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['SPEAR'] : null;
        $this->sword = array_key_exists("SWORD",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['SWORD'] : null;
        $this->axe = array_key_exists("AXE",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['AXE'] : null;
        $this->spy = array_key_exists("SPY",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['SPY'] : null;
        $this->light = array_key_exists("LIGHT",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['LIGHT'] : null;
        $this->heavy = array_key_exists("HEAVY",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['HEAVY'] : null;
        $this->ram = array_key_exists("RAM",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['RAM'] : null;
        $this->catapult = array_key_exists("CATAPULT",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['CATAPULT'] : null;
        $this->snob = array_key_exists("SNOB",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['SNOB'] : null;

        echo "* [DEBUG] this->snob" . $this->snob . "\n";
        echo "* [DEBUG] this->catapult" . $this->catapult . "\n";
        echo "* [DEBUG] this->ram" . $this->ram . "\n";
        echo "* [DEBUG] this->heavy" . $this->heavy . "\n";
        echo "* [DEBUG] this->light" . $this->light . "\n";
        echo "* [DEBUG] this->spy" . $this->spy . "\n";
        echo "* [DEBUG] this->axe" . $this->axe . "\n";
        echo "* [DEBUG] this->sword" . $this->sword . "\n";
        echo "* [DEBUG] this->spear" . $this->spear . "\n";

    }


    /**
     * Metodo para retornar um modelo de atk
     *
     */
    public function getModeloAtk()
    {
        //Se tiver a qnt minima de spys e cl
        if ($this->light >= self::QNT_SAFE_LIGHT && $this->spy >= self::QNT_SAFE_SPY) {
            return [
                $this->constants->FIELD_LIGHT_ID => self::QNT_SAFE_LIGHT,
                $this->constants->FIELD_SPY_ID => self::QNT_SAFE_SPY
            ];
        }

        return null;
    }


    /**
     * Metodo para retornar a quantidade de ataques possiveis
     * com um modelo de ataque especifico
     */
    public function getQntAtks($modeloAtk)
    {
        if (!$modeloAtk) {
            return 0;
        }

        //guardando as quantidades diferentes para cada unidade do modelo no array
        $array_qnts = [];
        foreach ($modeloAtk as $selector => $qnt) {

            //switch para determinar qual a unidade e qual a quantidade ideal para o ataque
            switch($selector) {
            case $this->constants->FIELD_LIGHT_ID:
                $atks = 1;
                    while ($qnt < $atks*$this::QNT_SAFE_LIGHT)
                    {
                        $atks++;
                    }
                $array_qnts[] = $atks;
                continue;

            case $this->constants->FIELD_SPY_ID:
                $atks = 1;
                    while ($qnt < $atks*$this::QNT_SAFE_SPY)
                    {
                        $atks++;
                    }
                $array_qnts[] = $atks;
                continue;
            }

            echo "\n" . "Checando qnt de ataques: " . "\n";

            var_dump($array_qnts);

            asort($array_qnts);
            $retorno = array_shift($array_qnts);
            echo "\n" . "retorno: $retorno" . "\n";

            return $retorno;
        }

    }




}
