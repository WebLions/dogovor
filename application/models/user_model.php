<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->datebase();
    }
    public function login(){

    }

    public function register($email, $password)
    {
        $password = md5($password . 'soult228');
        $data = array(
            'email' => $email,
            'password' => $password
        );
        $this->db->insert('users', $data);

        return (bool) ($this->db->affected_rows() > 0);
    }

    public function login_in()
    {
        return isset($_SESSION['user_id']);
    }
}