<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document extends CI_Controller
{
    /**
     * User constructor.
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->helper('html');
        $this->load->model('document_model');

    }
    public function buy_sale()  //  в ссылке выглядит так document/name
    {

        $this->document_model->get_doc_buy_sale();//вызов нужно функции модели;

    }
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
    public function select_from_database()
    {
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
        $this->insert_into_database();
        //$this->select_from_database();
    }
}