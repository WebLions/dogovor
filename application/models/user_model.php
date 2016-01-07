<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function login(){

    }

    public function register($email)
    {
        $pass = $this->generate_password(8);
        $password = md5($pass . 'soult228');
        preg_match("/(.*)@/", $email, $login);
        $login = $login[1];
        $data = array(
            'login' => $login,
            'email' => $email,
            'password' => $password
        );
        $this->db->insert('users', $data);
        //$this->XMail($email, $pass);
        return (bool) ($this->db->affected_rows() > 0);
    }

    public function login_in()
    {
        return isset($_SESSION['user_id']);
    }
    private function XMail($from, $to, $subj, $text, $filename)
    {
        $f         = fopen($filename,"rb");
        $un        = strtoupper(uniqid(time()));
        $head      = "From: $from\n";
        $head     .= "To: $to\n";
        $head     .= "Subject: $subj\n";
        $head     .= "X-Mailer: PHPMail Tool\n";
        $head     .= "Reply-To: $from\n";
        $head     .= "Mime-Version: 1.0\n";
        $head     .= "Content-Type:multipart/mixed;";
        $head     .= "boundary=\"----------".$un."\"\n\n";
        $zag       = "------------".$un."\nContent-Type:text/html;\n";
        $zag      .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";
        $zag      .= "------------".$un."\n";
        $zag      .= "Content-Type: application/octet-stream;";
        $zag      .= "name=\"".basename($filename)."\"\n";
        $zag      .= "Content-Transfer-Encoding:base64\n";
        $zag      .= "Content-Disposition:attachment;";
        $zag      .= "filename=\"".basename($filename)."\"\n\n";
        $zag      .= chunk_split(base64_encode(fread($f,filesize($filename))))."\n";

        return @mail("$to", "$subj", $zag, $head);
    }
    private function generate_password($number)
    {
        $arr = array('a','b','c','d','e','f',
            'g','h','i','j','k','l',
            'm','n','o','p','r','s',
            't','u','v','x','y','z',
            'A','B','C','D','E','F',
            'G','H','I','J','K','L',
            'M','N','O','P','R','S',
            'T','U','V','X','Y','Z',
            '1','2','3','4','5','6',
            '7','8','9','0','.',',',
            '(',')','[',']','!','?',
            '&','^','%','@','*','$',
            '<','>','/','|','+','-',
            '{','}','`','~');
        // Генерируем пароль
        $pass = "";
        for($i = 0; $i < $number; $i++)
        {
            // Вычисляем случайный индекс массива
            $index = rand(0, count($arr) - 1);
            $pass .= $arr[$index];
        }
        return $pass;
    }
    public function get_my_documents()
    {
        $userID = $_SESSION['userID'];
        $this->db->select("id, type, payment, date");
        $this->db->where("userID", $userID);
        $result = $this->db->get("documents");
        return $result->result_array();
    }
}