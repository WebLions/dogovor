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
    /*public function test() {

        $this->load->database();
        $this->load->model('document_model');
        $this->db->select('id, type_of_giver, type_of_taker, police_form, car_in_marriage');
        $res = $this->db->get('buy_sale')->result_array();

        foreach ($res as $val) {

            $id = $this->document_model->set_pack_of_documents($val['type_of_giver'], $val['type_of_taker'], 'buy_sale', $val['police_form'], $val['car_in_marriage']);
            echo $this->db->last_query() . '<br/>';
            echo $val['type_of_giver'] .'-'. $val['type_of_taker'] .'-'. 'buy_sale' .'-'. $val['police_form'] .'-' .'-'. $id .'<br/>';
            $this->db->where('id', $val['id']);
            $this->db->update('buy_sale', array('type_id' => $id));
        }
    }*/
}