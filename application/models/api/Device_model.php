<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Device_model extends CI_Model {

    public $tableName = 'device';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    

    // public function getByToken() {
    //     $this->db->select('*');
    //     $this->db->from($this->tableName);
    //     $this->db->where(['token' => $this->input->post('token')]);
    //     $deviceData = $this->db->get()->row_array();
    //     if (is_array($deviceData)) {
    //         if ($deviceData['u_type'] == '0') {
    //             $this->db->select('*');
    //             $this->db->from('client');
    //             $this->db->where('id', $deviceData['u_id']);
    //             return $this->db->get()->row_array();
    //         } else {
    //             $this->db->select('*');
    //             $this->db->from('agent');
    //             $this->db->where('id', $deviceData['u_id']);
    //             return $this->db->get()->row_array();
    //         }
    //     }
    // }

    public function getByDeviceIdAndType1() {
        // print_r($id);exit;
        $this->db->select('*');
        $this->db->from($this->tableName);
       
     //      foreach($id as $org => $val)
     // {    // where $org is the instance of one object of active record
     //    $this->db->or_where('u_id',$val);
     //    $this->db->where('fcm_token !=','');

     // }
      
        // $this->db->where('u_id', $id);
     
     $this->db->order_by("created_at", "desc");
     return $this->db->get()->result_array();
    // echo $this->db->last_query();
    // print_r($trtt);exit;
    }

    public function getByDeviceIdAndType($data) {
//        echo 'helllo';
//        exit;
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where($data);
        return $this->db->get()->row_array();
    }

    public function addDevice($users_token, $device_type) 
    {
       $data = [
            'device_id' => $this->input->post('device_id'),
            // 'device_type' => $this->input->post('device_type'),
            // 'fcm_token' => $this->input->post('fcm_token'),
        ];


        $deviceData = $this->getByDeviceIdAndType($data);

        if (is_array($deviceData)) 
        {
             $data = [
                    'users_token' => $users_token,
                    'fcm_token' => $this->input->post('fcm_token'),
                    'device_id' => $this->input->post('device_id'),
                    'device_type' => $device_type,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

            $this->db->where('id', $deviceData['id']);
            $this->db->update('device',$data);
        } 
        else 
        {
               $data = [
                    'users_token' => $users_token,
                    'fcm_token' => $this->input->post('fcm_token'),
                    'device_id' => $this->input->post('device_id'),
                    'device_type' => $this->input->post('device_type'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            $this->db->insert($this->tableName, $data);
        }
        // return $data;
    }

}
