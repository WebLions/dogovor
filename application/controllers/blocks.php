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

    }
    public function load($name)
    {

            $this->load->view("user/{$name}");

    }

}