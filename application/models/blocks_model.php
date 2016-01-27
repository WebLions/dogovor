<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Blocks_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();//Работа с бд
    }
}