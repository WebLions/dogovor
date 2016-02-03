<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blocks extends CI_Controller
{

    /**
     * User constructor.
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->helper('html');
        $this->load->model('blocks_model');

    }
    public function load($name)
    {
            $this->load->view("blocks/{$name}");
    }
    //Разделение продавца физ/юр/инд
    //---Пример
    public function bs_seller_block()
    {
        $this->blocks_model->bs_block_deal();
        $this->blocks_model->bs_block_seller();
    }
    //--------

    public function bs_block_physical_seller()
    {
        $this->blocks_model->bs_block_physical_seller();
    }
    public function bs_block_law_seller()
    {
        $this->blocks_model->bs_block_law_seller();
    }
    public function bs_block_individual_seller()
    {
        $this->blocks_model->bs_block_individual_seller();
    }
    //Владение ТС
    public function bs_owned_car()
    {
        $this->blocks_model->bs_owned_car();
    }
    public function bs_not_owned_car()
    {
        $this->blocks_model->bs_not_owned_car();
    }
    //Разделение покупателя физ/юр/инд
    public function bs_buyer_block()
    {
        $this->blocks_model->bs_buyer_block();
    }
    public function bs_block_physical_buyer()
    {
        $this->blocks_model->bs_block_physical_buyer();
    }
    public function bs_block_law_buyer()
    {
        $this->blocks_model->bs_block_law_buyer();
    }
    public function bs_block_individual_buyer()
    {
        $this->blocks_model->bs_block_individual_buyer();
    }
    //ТС куплен в браке
    public function bs_wife_true()
    {
        $this->blocks_model->bs_wife_true();
    }
    public function bs_wife_false()
    {
        $this->blocks_model->bs_wife_false();
    }
    //Вызов блока доп.устройств
    public function bs_additional_devices_yes()
    {
        $this->blocks_model->bs_additional_devices_yes();
    }
    public function bs_additional_devices_no()
    {
        $this->blocks_model->bs_additional_devices_no();
    }

    //Дарение ТС
    public function gift_seller_block()
    {
        $this->blocks_model->gift_seller_block();
    }
    public function gift_block_physical_seller()
    {
        $this->blocks_model->gift_block_physical_seller();
    }
    public function gift_block_law_seller()
    {
        $this->blocks_model->gift_block_law_seller();
    }
    public function gift_block_individual_seller()
    {
        $this->blocks_model->gift_block_individual_seller();
    }
}