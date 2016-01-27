<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

    /**
     * User constructor.
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->helper(array('html','url'));
        $this->load->library('form_validation');
        $this->load->model('user_model');
    }

    public function document()
    {

        //$md5 = pay_amount, pay_for, ticker, user_login, price_final, pay_type, notify_by_api, api_in_key
        $data = array(
        "price_final"=>"true",
        "user_login"=>"onpay",
        "notify_by_api"=>"true",
        "pay_type"=>"1",
        "pay_amount"=>"100",
        "ticker"=>"RUR",
        "md5"=>"cf653b4c4a7861b2224bd31eb3e3f291",
        "pay_for"=>"Order 342",
        "user_email"=>"user@pochta.ru"
        );
        $this->load->view('blocks/modal_pay',$this->data);
    }
}