<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

    /**
     * User constructor.
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->helper(array('html','url'));
        //$this->load->library('form_validation');
       // $this->load->model('user_model');
        $this->load->model('pay_model');
    }
    public function check()
    {
        $type = $_POST['type'];
        if($type=="check"){
            $this->pay_model->check();
        }elseif($type=="pay"){
            $this->pay_model->pay();
        }else{
            echo false;
        }
    }

    public function doc($id)
    {
        redirect($this->pay_model->getPayLink($id));
    }
    public function subscribe($id)
    {
        redirect($this->pay_model->getPaySubLink($id));
    }
}