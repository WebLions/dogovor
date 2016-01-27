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
    public function bs_seller_block()
    {
        $this->blocks_model->bs_seller_block();
    }
    public function bs_block_physical()
    {
        $this->blocks_model->bs_block_physical();
    }
    public function bs_owned_car()
    {
        $this->blocks_model->bs_owned_car();
    }
    public function bs_not_owned_car()
    {
        $this->blocks_model->bs_not_owned_car();
    }

}