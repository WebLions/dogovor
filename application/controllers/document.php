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
}