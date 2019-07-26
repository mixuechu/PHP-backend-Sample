<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('generalapi_helper');
        $this->load->model('api/device_model');
    }
    public function give_menu_feedback()
    {
      $data = array(
        'user_id'=>$this->input->post('user_id'),
        'item_id'=>$this->input->post('item_id'),
        'menu_date'=>$this->input->post('menu_date'),
        'item_name'=>$this->input->post('item_name'),
        'rating'=>$this->input->post('rating'),
        'description'=>$this->input->post('description'),
        'created_at'=>date('Y-m-d H:i:s')

        );

      $this->db->insert('user_feedback',$data);
      return ['status' => 1,'message'=>"Feedback Send Successfully"];
    }
    public function get_payment_details()
    {
        $r = $this->db->select('*')
                      ->from('takhmeen_user')
                      
                      ->where('ITS',$this->input->post('its_no'))
                      ->get();
        $res = $r->row_array();

        $q = $this->db->select('*')
                      ->from('user_payment')
                      
                      ->where('user_id',$res['id'])
                      ->get();
        $result = $q->result_array();
        return ['status' => 1,'data'=>$result];
    }
    public function get_takhmeen_details()
    {
       $r = $this->db->select('gc.*,ty.type_name,tu.id as user_id')
                      ->from('generate_card as gc')
                      ->join('takhmeen_type as ty','ty.id=gc.takhmeen_type')
                      ->join('takhmeen_user as tu','tu.ITS=gc.its_number')
                      ->where('its_number',$this->input->post('its_no'))
                      ->where('outstanding_amount >','0')
                      ->get();
        $res= $r->result_array();
        return ['status' => 1,'data'=>$res];
            
    }
    public function get_menu_for_feedback()
    {
        $r = $this->db->select('*')
                      ->from('daily_menu')
                      ->where('date',$this->input->post('menu_date'))
                      ->get();
        $res = $r->row_array();
         return ['status' => 1, 'message' => 'Request Send successfully.','data'=>$res];
    }
    public function stop_thali_req()
    {  
        $data = array(
                    'user_id' => $this->input->post('user_id'),
                    'request_type' => $this->input->post('request_type'),
                    'stop_thali_type' =>$this->input->post('stop_thali_type'),
                    'one_day_date'=> $this->input->post('one_day_date'),
                    'stop_thali_from_date'=> $this->input->post('stop_thali_from_date'),
                    'stop_thali_to_date'=> $this->input->post('stop_thali_to_date'),
                    'req_thali_on_off'=> $this->input->post('req_thali_on_off'),
                    'created_at'=>date('Y-m-d H:i:s')
        );
        
        $this->db->insert('stop_thali_req', $data);
        
        $data_req = array(
            'req_thali_on_off'=>$this->input->post('req_thali_on_off')
            );
        $this->db->where('id',$this->input->post('user_id'));
        $this->db->update('takhmeen_user',$data_req);

        return ['status' => 1, 'message' => 'Request Send successfully.'];
          
    

    }
    public function start_thali_req()
    {
         $data = array(
                    'user_id' => $this->input->post('user_id'),
                    'request_type' => $this->input->post('request_type'),
                    'start_thali_date'=>$this->input->post('start_thali_date'),
                    'created_at'=>date('Y-m-d H:i:s')
        );
        
        $this->db->insert('request_management', $data);

        $data_req = array(
            'req_thali_on_off'=>'on'
            );
        $this->db->where('user_id',$this->input->post('user_id'));
        $this->db->update('stop_thali_req',$data_req);
        
        return ['status' => 1, 'message' => 'Request Send successfully.'];
       

    }
    public function center_change_req()
    {
        $data = array(
                    'user_id' => $this->input->post('user_id'),
                    'request_type' => $this->input->post('request_type'),
                    'center_id'=>$this->input->post('center_id'),
                    'created_at'=>date('Y-m-d H:i:s')
        );
        
        $this->db->insert('request_management', $data);
        return ['status' => 1, 'message' => 'Request Send successfully.'];
    }
    public function tifin_change_req()
    {
        $this->load->library('HijriDate');
     
        $hijri = new HijriDate(strtotime($data));
        $year = $hijri->get_year();

        $data = array(
                    'user_id' => $this->input->post('user_id'),
                    'request_type' => $this->input->post('request_type'),
                    'size_of_tifin'=>$this->input->post('size_of_tifin'),
                    'created_at'=>date('Y-m-d H:i:s')
        );
        
        $this->db->insert('request_management', $data);

        $r = $this->db->select('ITS')
                      ->from('takhmeen_user')
                      ->where('id',$this->input->post('user_id'))
                      ->get();
        $res  = $r->row_array();

        $q = $this->db->select('*')
                      ->from('generate_card')
                      ->where('its_number',$res['ITS'])
                      ->where('current_year',$year)
                      ->get();
        $result  = $q->row_array();

        $tifin_data = array(
            'size_of_thali'=>$this->input->post('size_of_tifin')
            );
        $this->db->where('id',$result['id']);
        $this->db->update('generate_card',$tifin_data);

        return ['status' => 1, 'message' => 'Tifin Change successfully.'];
    }
    
    public function get_all_notification() 
    {   
        $r  = $this->db->select('*')
                       ->from('notification')
                       ->get();
        $data = $r->result_array();
        
        return ['status' => 1, 'message' => 'success', 'data' => $data];
    }
    public function get_all_menu_list()
    {
        $r  = $this->db->select('*')
                       ->from('daily_menu')
                       ->where('status','1')
                       ->get();
        $data = $r->result_array();
        
        return ['status' => 1, 'message' => 'success', 'data' => $data];
    }
      public function login() {
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('email', 'Email', 'required|trim');
        // $this->form_validation->set_rules('password', 'Password', 'required|trim');
        // $this->form_validation->set_rules('device_id', 'Device id', 'required');
        // $this->form_validation->set_rules('device_type', 'Device type', 'required');
        // if ($this->form_validation->run()) {
            if ($this->resolve_user_login($this->input->post('its_number'), $this->input->post('password'))) {
                $user_id = $this->get_user_id_from_username($this->input->post('its_number'));
                $user = $this->get_takhmeen_user($user_id);

                // $this->load->model('api/device_model');
                // $token = $this->device_model->addDevice($user_id, '0');

              return ['status' => 1, 'message' => 'login success', 'data' => $user];
              } else {
                return ['status' => 0, 'message' => 'Wrong username or password.'];
            }
       
    }


    public function resolve_user_login($username, $password) {

        $this->db->select('password');
        $this->db->from('takhmeen_user');
        $this->db->where('ITS', $username);
        
        $hash = $this->db->get()->row('password');

        return $this->verify_password_hash($password, $hash);
    }
    private function verify_password_hash($password, $hash) {

        return password_verify($password, $hash);
    }
    public function get_user_id_from_username($username) {

        $this->db->select('id');
        $this->db->from('takhmeen_user');
        $this->db->where('ITS', $username);
        return $this->db->get()->row('id');
    }

    public function get_takhmeen_user($id)
    {
      $r = $this->db->select('*')
                    ->from('takhmeen_user')
                    ->where('id',$id)
                    ->get();
      $res = $r->result_array();
      return $res;
    }

}
?>