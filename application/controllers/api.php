<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

    /**
     * User constructor.
     */
    public function __construct()
    {

        parent::__construct();
    }

    public function index()
    {
        $link = $_GET['link'];

        exec('doc2pdf ' .$link. ' /1.pdf');

        return 'true';
    }

}