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
    //Юридическое лицо полный блок
    public function bs_vendor_block()
    {
        $this->blocks_model->bs_block_deal();
        $this->blocks_model->bs_block_vendor();
    }
    public function bs_block_vendor_physical_state()
    {
        $this->blocks_model->bs_block_vendor_state();
    }
    public function bs_block_vendor_law_state()
    {
        $this->blocks_model->bs_block_buyer_info();
        $this->blocks_model->bs_block_ts_info();
        $this->blocks_model->bs_block_serial_car();
        $this->blocks_model->bs_block_car_price();
        $this->blocks_model->bs_block_additional_devices();
    }
    public function bs_block_vendor_individual_state()
    {
        $this->blocks_model->bs_block_buyer_info();
        $this->blocks_model->bs_block_ts_info();
        $this->blocks_model->bs_block_serial_car();
        $this->blocks_model->bs_block_car_price();
        $this->blocks_model->bs_block_additional_devices();
    }

    public function bs_block_vendor_info_owner()
    {
        $this->blocks_model->bs_block_vendor_info();
        $this->blocks_model->bs_block_buyer();
    }
    public function bs_block_vendor_info_not_owner()
    {
        $this->blocks_model->bs_block_vendor_info();
        $this->blocks_model->bs_block_vendor_agent();
        $this->blocks_model->bs_block_buyer();
    }


    public function bs_block_additional_devices_yes()
    {
        $this->blocks_model->bs_block_additional_devices_list();
        $this->blocks_model->bs_block_car_state();
        $this->blocks_model->bs_block_maintenance();
        $this->blocks_model->bs_block_defects();
        $this->blocks_model->bs_block_features();
        $this->blocks_model->bs_block_payment_date();
        $this->blocks_model->bs_block_documents();
        $this->blocks_model->bs_block_accessories();
        $this->blocks_model->bs_block_car_in_marriage();
    }
    public function bs_block_additional_devices_no()
    {
        $this->blocks_model->bs_block_car_state();
        $this->blocks_model->bs_block_maintenance();
        $this->blocks_model->bs_block_defects();
        $this->blocks_model->bs_block_features();
        $this->blocks_model->bs_block_payment_date();
        $this->blocks_model->bs_block_document();
        $this->blocks_model->bs_block_accessories();
        $this->blocks_model->bs_block_car_in_marriage();
    }

    public function bs_block_car_in_marriage_yes()
    {
        $this->blocks_model->bs_block_spounse();
        $this->blocks_model->bs_block_penalty();
        $this->blocks_model->bs_block_ready();
    }
    public function bs_block_car_in_marriage_no()
    {
        $this->blocks_model->bs_block_penalty();
        $this->blocks_model->bs_block_ready();
    }


}