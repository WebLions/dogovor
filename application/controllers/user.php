<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    /**
     * User constructor.
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->helper('html');

    }

    public function login()
    {
        if( !$this->data['user_id'] ) {
            $this->load->view('user/login_header');
            $this->load->view('user/login');
            $this->load->view('user/footer');
        }else{
            redirect('/','refresh');
        }
    }

    public function document()
    {
        $this->load->view('user/document_header');
        $this->load->view('user/document');
        $this->load->view('user/footer');
    }
    public function main()
    {
        $this->load->view('user/header');
        $this->load->view('user/main');
        $this->load->view('user/footer');
    }

    public function logout()
    {
        //$this->load->view('login');
    }

    public function register()
    {
        $this->load->view('user/login_header');
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
