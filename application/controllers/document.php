<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document extends CI_Controller
{
    /**
     * User constructor.
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->helper(array('html','url'));
        $this->load->model('document_model');
        $this->load->model('user_model');
        $this->load->library('form_validation');

    }
    public function buy_sale($id)  //  в ссылке выглядит так document/name
    {
        if( !$this->data['user_id'] ) {
            redirect('/','refresh');
        }
        $this->data['doc'] = $this->document_model->get_doc_buy_sale( (int) $id );//вызов нужно функции модели;
        redirect($this->data['doc']);
    }
    /*public function test_packset(){
        $this->document_model->testpack();
    }*/
    public function act_of_reception()  //  в ссылке выглядит так document/name
    {

        $this->document_model->get_doc_act_of_reception();//вызов нужно функции модели;

    }
    public function receipt_of_money()  //  в ссылке выглядит так document/name
    {

        $this->document_model->get_doc_receipt_of_money();//вызов нужно функции модели;

    }
    public function gibdd()  //  в ссылке выглядит так document/name
    {

        $this->document_model->get_doc_statement_gibdd();//вызов нужно функции модели;

    }
    public function marriage()  //  в ссылке выглядит так document/name
    {

        $this->document_model->get_doc_statement_vendor_marriage();//вызов нужно функции модели;

    }
    public function json()
    {
        $this->document_model->testjson();
    }
    public function select_from_database()
    {
        echo '<meta http-equiv="content-type" content="text/html; charset=UTF-8" />';
        $this->document_model->select_from_database();
    }
    public function insert_into_database()
    {
        $this->document_model->insert_into_database();
    }
    public function check_post()
    {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
    }
    public function go_buy_sale()
    {
        if( !$this->data['user_id'] ) {
            $this->form_validation->set_rules('email','E-mail','trim|required|xss_clean');
            if($this->form_validation->run() == true)
            {
                if( !$this->data['user_id'] ) {
                    $this->data['user_id'] = $this->user_model->register($this->input->post('email'));
                }
                $this->document_model->insert_into_database( $this->data['user_id'] );

                $link = $this->pay_model->getPayLink();
                redirect($link);

            }else{
                redirect('user/login');
            }
        }else{
            $this->document_model->insert_into_database( $this->data['user_id'] );

            $link = $this->pay_model->getPayLink();
            redirect($link);
        }
    }
    public function create()
    {
        $this->load->view('user/document_header');
        $this->load->view('user/document');
        $this->load->view('user/footer');
    }
}