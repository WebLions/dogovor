<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

    /**
     * User constructor.
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->helper(array('html','url'));
        $this->load->library('form_validation');
        $this->load->model('ajax_model');
    }

    public function modal_pay()
    {
        $this->load->view('blocks/modal_pay',$this->data);
    }
    public function personal_data()
    {
        $this->load->view('blocks/personal_data',$this->data);
    }

    public function getBlock($b = '',$d = 0,$data = false){
        $this->ajax_model->$b($d, $data);
    }
}