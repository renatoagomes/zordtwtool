<?php

namespace App\Repositories;

Class TropasRepository
{

    const QNT_SAFE_SPEAR = 7;
    const QNT_SAFE_SWORD = 7;
    const QNT_SAFE_AXE = 7;
    const QNT_SAFE_SPY = 4;
    const QNT_SAFE_LIGHT = 3;

    private $qnt_spear;
    private $qnt_sword;
    private $qnt_axe;
    private $qnt_spy;
    private $qnt_light;
    private $qnt_heavy;
    private $qnt_ram;
    private $qnt_catapult;
    private $qnt_snob;


    /**
     * Construtor que recebe um array com as tropas
     */
    function __construct(ConstantsRepository $constants, $arrayTropasDisponiveis)
    {
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
    }


    /**
     * Metodo para retornar um modelo de atk
     *
     */
    public function getModeloAtk()
    {
        //Se tiver a qnt minima de spys e cl
        if ($this->qnt_light >= self::QNT_SAFE_LIGHT && $this->qnt_spy >= self::QNT_SAFE_SPY) {
            return [
            $this->constants->FIELD_LIGHT_ID => self::QNT_SAFE_LIGHT,
            $this->constants->FIELD_SPY_ID => self::QNT_SAFE_SPY
            ];
        }

        return [];
    }

    public function getQntAtks($modeloAtk)
    {
        $array_qnts = [];

        foreach ($modeloAtk as $selector => $qnt) {

            switch($selector) {
            case $this->constants->FIELD_LIGHT_ID:
                $atks = 1;
                    while ($qnt < $atks*$this::QNT_SAFE_LIGHT)
                    {
                        $atks++;
                    }
                $array_qnts[] = $atks;
                break;

            case $this->constants->FIELD_SPY_ID:
                $atks = 1;
                    while ($qnt < $atks*$this::QNT_SAFE_SPY)
                    {
                        $atks++;
                    }
                $array_qnts[] = $atks;
                break;
            }

            return array_shift(asort($array_qnts));
        }


    }




}
