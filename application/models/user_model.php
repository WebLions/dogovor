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
        /*
        $head     .= "boundary=\"----------".$un."\"\n\n";
        $zag       = "------------".$un."\nContent-Type:text/html;\n";*/
        $zag      = "\n\n$text\n\n";
       /* $zag      .= "------------".$un."\n";
        $zag      .= "Content-Type: application/octet-stream;";*/
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
    public function getUserPayments($user_id)
    {
        $this->db->where("userID", $user_id);
        $result = $this->db->get("payments");
        return $result->result_array();
    }
    public function getListDocuments()
    {
        $userID = $_SESSION['user_id'];
        $this->db->distinct("table");
        $this->db->select("table");
        $result = $this->db->get("documents");
       // var_dump($result->result_array());
        $this->db->select("documents.id as id, documents.date, types.document_name, types.url, payments.type");
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
            $data[$item['id']]['type_s'] = ($item['type']==1)?"Оплаченно":"Не оплаченно";
            $data[$item['id']]['type'] = $item['type'];
            $data[$item['id']]['date'] = $item['date'];
            $data[$item['id']]['doc'][] = array(
                'document_name' => $item['document_name'],
                'url' => $item['url'],
            );
            $data[$item['id']]['day'] = 31 - ceil((time() - strtotime($item['date'])) / 86400);
        }
        return $data;
    }
    public function checkSub($user_id, $doc_id)
    {
        $this->db->where("subscribe.user_id", $user_id);
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
        //echo $email;
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
    public function userInfo($user_id){
        $this->db->select("*");
        $this->db->where("users.id",$user_id);
        $query = $this->db->get("users",1,0);
        return $query->row();
    }
    public function userGlobalInfo($user_id){

        $this->db->where("user_id",$user_id);
        $data['doc_create'] = $this->db->count_all_results("documents");

        $this->db->select("subscribe.date_finish");
        $this->db->where("subscribe.user_id", $user_id);
        $this->db->where("subscribe.date_finish > NOW()");
        $result = $this->db->get("subscribe",1,0);
        $query = $result->row();
        if($result->num_rows()>0){
            $dif = ceil((strtotime($query->date_finish) - time()) / 86400);
            $data['subscribe'] = $dif. "<small style=\"font-size:50%\">дней</small>";
        }else{
            $data['subscribe'] = "<a style=\"font-size: 15px\" href='/user/subscription'>Оформить</a>";
        }

        $this->db->where("user_id",$user_id);
        $this->db->join("payments","payments.payID=documents.id");
        $data['doc_pay'] = $this->db->count_all_results("documents");
        $this->db->flush_cache();
        $data['doc_all'] = $this->db->count_all("documents");

        return $data;
    }
    public function saveProfile($post, $user_id)
    {
        $this->db->where("email",$post['email']);
        $this->db->where("id <>", $user_id);
        if($this->db->count_all_results("users"))
        {
            return false;
        }

        $this->db->where("id",$user_id);
        $this->db->set("fio",$post['fio']);
        $this->db->set("email",$post['email']);
        $this->db->set("login",$post['email']);
        if(!empty($post['password'])){
            $password = md5($post['password'] . 'soult228');
            $this->db->set("password",$password);
        }
        $this->db->set("about",$post['about']);
        $this->db->update("users");
        return true;
    }
}