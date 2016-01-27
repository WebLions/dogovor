<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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

    public function login()
    {
        if( $this->data['user_id'] ) {
            redirect('/user/profile','refresh');
        }
        $this->form_validation->set_rules('login','Login','trim|required|xss_clean');
        $this->form_validation->set_rules('password','Password','trim|required|xss_clean');
        if( $this->form_validation->run() == TRUE )
        {
            $result = $this->user_model->login( $this->input->post('login'), $this->input->post('password') );
            if($result){
                redirect('user/profile');
            }else{
                redirect('user/login');
            }
        }else {
            $this->load->view('user/login_header');
            $this->load->view('user/login');
            $this->load->view('user/footer');
        }
    }

    public function payment_history()
    {
        $this->load->view('user/header');
        $this->load->view('user/payment_history');
        $this->load->view('user/footer');
    }
    public function documents()
    {
        if( !$this->data['user_id'] ) {
            redirect('/','refresh');
        }
        $this->data['documents'] = $this->user_model->getListDocuments( );
       // var_dump($this->data['documents']);

        $this->load->view('user/header');
        $this->load->view('user/documents', $this->data);
        $this->load->view('user/footer');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        session_destroy();
        redirect('/user/login','refresh');
    }

    public function register()
    {

        $this->load->view('user/login_header');
        $this->load->view('user/register');
        $this->load->view('user/footer');

    }

    public function profile()
    {
        if( !$this->data['user_id'] ) {
            redirect('/user/login','refresh');
        }
        $this->load->view('user/header');
        $this->load->view('user/profile');
        $this->load->view('user/footer');
    }
    public function wallet()
    {
        if( !$this->data['user_id'] ) {
            redirect('/user/login','refresh');
        }
        $this->load->view('user/header');
        $this->load->view('user/wallet');
        $this->load->view('user/footer');
    }

    public function payments()
    {
        if( !$this->data['user_id'] ) {
            redirect('/user/login','refresh');
        }
        $this->data['payments'] = $this->user_model->get_my_documents();

        $this->load->view('user/header');
        $this->load->view('user/myDocuments', $this->data);
        $this->load->view('user/footer');
    }

}
