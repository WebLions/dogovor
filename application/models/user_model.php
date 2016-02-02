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

            //Отправляем почту в фидгии
            $this->send_email_to_db($email);
            //Отправляем на почту логин и пароль
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
        $this->db->distinct("table");
        $this->db->select("table");
        $result = $this->db->get("documents");
        var_dump($result->result_array());
        $this->db->select("documents.doc_id as id, documents.date, types.document_name, types.url, payments.type");
        $this->db->where("documents.user_id", $userID);
        foreach ($result->result_array() as $item) {
            $this->db->join("{$item['table']}","{$item['table']}.id=documents.doc_id");
            $this->db->join("types", "types.id={$item['table']}.type_id");
        }
        $this->db->join("payments", "payments.payID=documents.id");
       // $this->db->order_by("documents.date");
        $result = $this->db->get("documents");
        //print_r($this->db->last_query());
        $data = array();
        //var_dump($result->result_array());
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
    public function checkSub($user_id, $doc_id)
    {
        $this->db->where("subscribe.user_id", $user_id);
        $this->db->where("subscribe.date_start < NOW()");
        $this->db->where("subscribe.date_finish > NOW()");
        $result = $this->db->get("subscribe",1,0);
        if($result->num_rows()>0){
            $this->db->insert('payments', array('userID'=>$user_id,'payID'=>$doc_id,'date'=>date("Y-m-d H:i:s"),'type'=>1));
            return true;
        }else{
            return false;
        }

    }
    public function send_email_to_db($email){
        // Ваш ключ доступа к API
        $api_key = "dfc5387aa2874f70b0c518e60ab047bf";//Поменяй на нужный апи, который тебе выдаст сервис
        //Имя метода
        $method = "listSubscribeOptInNow";
        //параметры
        $list_id = "B383252HC49293R98618";
        $phone = "";
        $fname = "";
        $lname = "";
        $mobilecountry = "";
        $fname = "";
        $lname = "";
        $parameters = "apikey=$api_key&list_id=$list_id&email=$email&phone=&mobilecountry=&fname=&lname=&names=&values=&optin=TRUE&update_existing=TRUE";
        // Создаём GET-запрос
        $api_url = "http://api.feedgee.com/1.0/$method?$parameters";

        // Делаем запрос на API-сервер
        if( $curl = curl_init() ) {
            $uagent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)";
            curl_setopt($curl, CURLOPT_URL, $api_url);
            curl_setopt($curl, CURLOPT_HEADER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION,1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curl, CURLOPT_ENCODING, "gzip, deflate");
            curl_setopt($curl, CURLOPT_USERAGENT, $uagent);
            curl_setopt($curl, CURLOPT_COOKIEJAR, "coo.txt");
            curl_setopt($curl, CURLOPT_COOKIEFILE, "coo.txt");
            $out = curl_exec($curl);
            curl_close($curl);
        }

    }
}