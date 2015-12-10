<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
       // $this->load->model('user');
    }

    public function login()
    {

        $this->load->view('user/header');
        $this->load->view('user/login');
        $this->load->view('user/footer');
    }

    public function logout()
    {
        //$this->load->view('login');
    }

    public function register()
    {
        $this->load->view('user/header');
        $this->load->view('user/register');
        $this->load->view('user/footer');

    }

    public function profile()
    {
        $this->load->view('user/header');
        $this->load->view('user/profile');
        $this->load->view('user/footer');
    }
}
