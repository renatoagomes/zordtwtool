<?php

namespace app\Repositories;

/**
 * Repositorio para guardar as constantes da aplicação
 */
class ConstantsRepository
{
    /** INFO DA TELA DE OVERVIEW **/
    public $MAIN_ID = "map_main";
    public $BARRACKS_ID = "map_barracks";
    public $STABLE_ID = "map_stable";
    public $SMITH_ID = "map_smith";
    public $PLACE_ID = "map_place";
    public $MARKET_ID = "map_market";
    public $WOOD_ID = "map_wood";
    public $STONE_ID = "map_stone";
    public $IRON_ID = "map_iron";
    public $FARM_ID = "map_farm";
    public $STORAGE_ID = "map_storage";
    public $HIDE_ID = "map_hide";
    public $WALL_ID = "map_wall";


    /** INFO DA TELA DE TROPAS **/
    public $FIELD_SPEAR_ID = "unit_input_spear";
    public $FIELD_SWORD_ID = "unit_input_sword";
    public $FIELD_AXE_ID = "unit_input_axe";
    public $FIELD_SPY_ID = "unit_input_spy";
    public $FIELD_LIGHT_ID = "unit_input_light";
    public $FIELD_HEAVY_ID = "unit_input_heavy";
    public $FIELD_RAM_ID = "unit_input_ram";
    public $FIELD_CATAPULT_ID = "unit_input_catapult";
    public $FIELD_SNOB_ID = "unit_input_snob";
    public $FIELD_COORD_CSS = "input.target-input-field";
    public $FIELD_COORD_VILLAGE_BOX_CSS = "div.village-item";
    public $BTN_ATK_ID = "target_attack";
    public $BTN_SUPPORT_ID = "target_support";
    public $BTN_CONFIRMA_ATK_ID = "troop_confirm_go";

    //anchors com a qnt total
    public $ANCHOR_ALL_SPEAR = "units_entry_all_spear";
    public $ANCHOR_ALL_SWORD = "units_entry_all_sword";
    public $ANCHOR_ALL_AXE = "units_entry_all_axe";
    public $ANCHOR_ALL_SPY = "units_entry_all_spy";
    public $ANCHOR_ALL_LIGHT = "units_entry_all_light";
    public $ANCHOR_ALL_HEAVY = "units_entry_all_heavy";
    public $ANCHOR_ALL_RAM = "units_entry_all_ram";
    public $ANCHOR_ALL_CATAPULT = "units_entry_all_catapult";
    public $ANCHOR_ALL_SNOB = "units_entry_all_snob";


    /** INFO DA TELA DE CONFIRMACAO DE ATK **/


    // * USER INFO
    public $USER_LOGIN;
    public $USER_PASSWORD;

    /**
     * Construtor que pega os valores do env.
     */
    function __construct()
    {
        $this->USER_LOGIN = env('USER_LOGIN');
        $this->USER_PASSWORD = env('USER_PASSWORD');
    }

}

