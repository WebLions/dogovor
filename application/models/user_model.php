<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function login($login = '', $password = ''){
        $this->db->select('password, id');
        $this->db->from('users');
        $this->db->where('email', $login);
        $query = $this->db->get();
        $result = $query->row();

        if ($query->num_rows() == 1) {
            $password = md5($password . 'soult228');
            if ($result->password === $password) {
                $_SESSION['user_id'] = $result->id;
                $_SESSION['user_email'] = $login;
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    public function register($email)
    {
        $this->db->where("email", $email);
        $query = $this->db->get("users",1,0);
        if($query->num_rows() == 0)
        {
            $pass = $this->generate_password(8);
            $password = md5($pass . 'soult228');
            //preg_match("/(.*)@/", $email, $login);
            $login = $email;
            $data = array(
                'login' => $login,
                'email' => $email,
                'password' => $password
            );
            $this->db->insert('users', $data);
            $user_id = $this->db->insert_id();

            $text = "Спасибо!<br>";
            $text.= "Теперь вы можете зайти в личный кабинет <a href='project.dogovor.jera.ws/user/login'>project.dogovor.jera.ws/user/login</a><br>";
            $text.= "Логин: " . $email . "<br>";
            $text.= "Пароль: " . $pass . "<br>";
            $text.= "Внимание! Поменяйте сгенерированый пароль на новый!<br>";

            $this->XMail("info@jera.ws", $email, "Регистрация", $text);

        }else{
            $result = $query->row();
            $user_id = $result->id;
        }
        return $user_id;
    }

    public function login_in()
    {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    }
    private function XMail($from, $to, $subj, $text)
    {
       // $f         = fopen($filename,"rb");
        $un        = strtoupper(uniqid(time()));
        $head      = "From: $from\n";
        $head     .= "To: $to\n";
        $head     .= "Subject: $subj\n";
        $head     .= "X-Mailer: PHPMail Tool\n";
        $head     .= "Reply-To: $from\n";
        $head     .= "Mime-Version: 1.0\n";
        $head     .= "Content-Type:text/html; charset=utf-8;\r\n";
        $head     .= "boundary=\"----------".$un."\"\n\n";
        $zag       = "------------".$un."\nContent-Type:text/html;\n";
        $zag      .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";
        $zag      .= "------------".$un."\n";
        $zag      .= "Content-Type: application/octet-stream;";
        /*$zag      .= "name=\"".basename($filename)."\"\n";
        $zag      .= "Content-Transfer-Encoding:base64\n";
        $zag      .= "Content-Disposition:attachment;";
        $zag      .= "filename=\"".basename($filename)."\"\n\n";
        $zag      .= chunk_split(base64_encode(fread($f,filesize($filename))))."\n";*/

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
        $userID = $_SESSION['user_id'];
        $this->db->select("id, type, payment, date");
        $this->db->where("id_user", $userID);
        $result = $this->db->get("documents");
        return $result->result_array();
    }
    public function getListDocuments()
    {
        $userID = $_SESSION['user_id'];
        $this->db->select("buy_sale.id, buy_sale.date, types.document_name, types.url, payments.type");
        $this->db->where("buy_sale.id_user", $userID);
        $this->db->join("types", "types.id=buy_sale.type_id");
        $this->db->join("payments", "payments.payID=buy_sale.id");
        $this->db->order_by("buy_sale.date");
        $result = $this->db->get("buy_sale");
        $data = array();
        foreach ($result->result_array() as $item) {
            $data[$item['id']]['type'] = $item['type'];
            $data[$item['id']]['date'] = $item['date'];
            $data[$item['id']]['doc'][] = array(
                'document_name' => $item['document_name'],
                'url' => $item['url'],
            );
        }
        return $data;
    }
    public function checkSub($user_email)
    {
        $this->db->select("");
        $this->db->where("users.user_email", $user_email);
        $this->db->join("users", "users.id=subscribe.user_id");
        $this->db->order_by("buy_sale.date");
        $result = $this->db->get("subscribe");
    }
}