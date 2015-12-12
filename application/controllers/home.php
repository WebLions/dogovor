<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
	}

	public function index()
	{
		redirect('/','refresh');

		$this->load->view('home');

	}
}
