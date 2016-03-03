<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blocks extends CI_Controller
{


    /**
     * User constructor.
     */
    public $state;
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

    public function bs_consent_vendor_block()
    {
        $this->blocks_model->bs_consent();
    }

    public function bs_vendor_block()
    {
        $this->blocks_model->bs_block_deal();
        $this->blocks_model->bs_block_vendor();
    }
    public function bs_block_vendor_state()
    {
        $this->blocks_model->bs_block_vendor_state();
    }
    public function bs_block_buyer(){

        $this->blocks_model->bs_block_buyer();
    }
    public function bs_block_buyer_state()
    {
        $this->blocks_model->bs_block_buyer_state();
    }

    public function bs_block_vendor_selected_owner()
    {
        $vendor_state = $_GET['vendor_state'];

        if(isset($vendor_state)){
            if($vendor_state == 'physical'){

                $this->blocks_model->bs_block_vendor_info();
                $this->blocks_model->bs_block_buyer();
            }
            if($vendor_state == 'law'){

                $this->blocks_model->bs_block_vendor_law_state();
                $this->blocks_model->bs_block_buyer();

            }
            if($vendor_state == 'individual'){

                $this->blocks_model->bs_block_vendor_individual_state();
                $this->blocks_model->bs_block_buyer();

            }
        }
        $_SESSION['state'] = $vendor_state;


    }

    public function bs_block_buyer_selected_owner(){

        $buyer_state = $_GET['buyer_state'];

        if(isset($buyer_state)){
            if($buyer_state == 'physical'){

                $this->blocks_model->bs_block_buyer_info();
                $this->blocks_model->bs_block_ts_info();
                $this->blocks_model->bs_block_serial_car();
                $this->blocks_model->bs_block_car_price();
                $this->blocks_model->bs_block_additional_devices();

            }
            if($buyer_state == 'law'){

                $this->blocks_model->bs_block_buyer_law_state();
                $this->blocks_model->bs_block_ts_info();
                $this->blocks_model->bs_block_serial_car();
                $this->blocks_model->bs_block_car_price();
                $this->blocks_model->bs_block_additional_devices();

            }
            if($buyer_state == 'individual'){

                $this->blocks_model->bs_block_buyer_individual_state();
                $this->blocks_model->bs_block_ts_info();
                $this->blocks_model->bs_block_serial_car();
                $this->blocks_model->bs_block_car_price();
                $this->blocks_model->bs_block_additional_devices();

            }
        }
    }
    public function bs_block_vendor_selected_not_owner()
    {
        $vendor_state = $_GET['vendor_state'];
        if(isset($vendor_state)){
            if($vendor_state == 'physical'){

                $this->blocks_model->bs_block_vendor_info();
                $this->blocks_model->bs_block_vendor_agent();
                $this->blocks_model->bs_block_buyer();
            }
            if($vendor_state == 'law'){

                $this->blocks_model->bs_block_vendor_law_state();
                $this->blocks_model->bs_block_vendor_agent();
                $this->blocks_model->bs_block_buyer();

            }
            if($vendor_state == 'individual'){

                $this->blocks_model->bs_block_vendor_individual_state();
                $this->blocks_model->bs_block_vendor_agent();
                $this->blocks_model->bs_block_buyer();

            }
        }

    }
    public function bs_block_buyer_selected_not_owner(){

        $buyer_state = $_GET['buyer_state'];

        if(isset($buyer_state)){
            if($buyer_state == 'physical'){

                $this->blocks_model->bs_block_buyer_info();
                $this->blocks_model->bs_block_buyer_agent();
                $this->blocks_model->bs_block_ts_info();
                $this->blocks_model->bs_block_serial_car();
                $this->blocks_model->bs_block_car_price();
                $this->blocks_model->bs_block_additional_devices();

            }
            if($buyer_state == 'law'){

                $this->blocks_model->bs_block_buyer_law_state();
                $this->blocks_model->bs_block_buyer_agent();
                $this->blocks_model->bs_block_ts_info();
                $this->blocks_model->bs_block_serial_car();
                $this->blocks_model->bs_block_car_price();
                $this->blocks_model->bs_block_additional_devices();

            }
            if($buyer_state == 'individual'){

                $this->blocks_model->bs_block_buyer_individual_state();
                $this->blocks_model->bs_block_buyer_agent();
                $this->blocks_model->bs_block_ts_info();
                $this->blocks_model->bs_block_serial_car();
                $this->blocks_model->bs_block_car_price();
                $this->blocks_model->bs_block_additional_devices();

            }
        }
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
        if($_SESSION['state'] == 'law' || $_SESSION['state'] == 'individual') {

            $this->blocks_model->bs_block_penalty();
            $this->blocks_model->bs_block_ready();
        }
        else $this->blocks_model->bs_block_car_in_marriage();



    }
    public function bs_block_additional_devices_no()
    {
        $this->blocks_model->bs_block_car_state();
        $this->blocks_model->bs_block_maintenance();
        $this->blocks_model->bs_block_defects();
        $this->blocks_model->bs_block_features();
        $this->blocks_model->bs_block_payment_date();
        $this->blocks_model->bs_block_documents();
        $this->blocks_model->bs_block_accessories();
        if($_SESSION['state'] || $_SESSION['state']) {
            $this->blocks_model->bs_block_penalty();
            $this->blocks_model->bs_block_ready();
        }
        else $this->blocks_model->bs_block_car_in_marriage();
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

    public function police_yes(){
        //заполняем заяву в гибдд
        $this->blocks_model->bs_block_police_yes();
    }
    public function police_no(){
        //кнопка сохранить
        $email = false;
        if( !$this->data['user_id'] ) {
            $email = true;
        }
        $this->blocks_model->bs_block_police_no($email);
    }
    public function statement_buy(){
        //заяву несет представитель
        $email = false;
        if( !$this->data['user_id'] ) {
            $email = true;
        }
        $this->blocks_model->bs_block_statement_no($email);
    }
    public function statement_repres(){
        //заяву несет собственник
        $email = false;
        if( !$this->data['user_id'] ) {
            $email = true;
        }
        $this->blocks_model->bs_block_statement_gibdd($email);
    }

    //Дарение
    public function gift_consent_vendor_block()
    {
        $this->blocks_model->gift_consent();
    }
    public function gift_vendor_block()
    {
        $this->blocks_model->bs_block_deal();
        $this->blocks_model->gift_block_vendor_state();
    }
    public function gift_block_vendor_state()
    {
        $this->blocks_model->gift_block_vendor_state();
    }
    public function gift_block_buyer_state()
    {
        $this->blocks_model->gift_block_buyer_state();
    }
    public function gift_block_vendor_info_owner()
    {
        $this->blocks_model->gift_block_vendor_info();
        $this->blocks_model->gift_block_buyer();
    }

}