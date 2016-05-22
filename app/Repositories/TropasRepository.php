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

        $this->qnt_spear = array_key_exists("qnt_spear",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['qnt_spear'] : null;
        $this->qnt_sword = array_key_exists("qnt_sword",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['qnt_sword'] : null;
        $this->qnt_axe = array_key_exists("qnt_axe",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['qnt_axe'] : null;
        $this->qnt_spy = array_key_exists("qnt_spy",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['qnt_spy'] : null;
        $this->qnt_light = array_key_exists("qnt_light",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['qnt_light'] : null;
        $this->qnt_heavy = array_key_exists("qnt_heavy",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['qnt_heavy'] : null;
        $this->qnt_ram = array_key_exists("qnt_ram",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['qnt_ram'] : null;
        $this->qnt_catapult = array_key_exists("qnt_catapult",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['qnt_catapult'] : null;
        $this->qnt_snob = array_key_exists("qnt_snob",$arrayTropasDisponiveis) ? $arrayTropasDisponiveis['qnt_snob'] : null;
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





}
