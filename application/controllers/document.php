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

    public function <name>()  //  в ссылке выглядит так document/name
    {

        $this->document_model->//вызов нужно функции модели;

    }

}