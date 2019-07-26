<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('generalapi_helper');
        $this->load->helper('general_helper');
        $this->load->model('api/device_model');
    }
    public function logout($user_token)
    {
      
    }
    public function notification_list()
    {
      $r = $this->db->select('*')
                    ->from('notification')
                    ->order_by('id','DESC')
                    ->get();
      $res = $r->result_array();
      // return $res;
      return ['status' => 1, 'message' => 'Notification list','date'=>$res];
    }
    public function send_otp()
    {
      $pin_code = mt_rand(1000, 9999);

      sendSingleSms($this->input->post('mobile'),$pin_code);
      return ['status' => 1, 'message' => 'Send OTP successfully'];
    }
    public  function get_cuisine_type()
    {
      $r = $this->db->select('*')
                    ->from('cuisine_type')
                    ->get();
      $res = $r->result_array();

      return ['status' => 1, 'data' => $res];

    }
    public function sign_up()
    {
      $this->load->helper('string');
      $users_token = random_string('alnum',16);

      $pin_code = mt_rand(1000, 9999);
     // echo $pin_code;
       $validateFileResult = validateFile([['profile_image', 'user_profile', ['jpeg', 'png', 'jpg', 'gif']]], true, $this->session);
        if ($validateFileResult['status'] == 1) {
            $fileResult = fileUpload('profile_image', 'images/user_profiles', $this->input->post('profile_image'));
            if ($fileResult['status'] == '1') {
                $user_profile = $fileResult['fileName'];
            }
            else
            {
              $user_profile = ""; 
            }
            
        }

         
      $data = array(
        'name'=>$this->input->post('name'),
        'location'=>$this->input->post('location'),
        'mobile'=>$this->input->post('mobile'),
        'profile_image'=>$user_profile,
        'users_token'=>$users_token,
        'created_at'=>date('Y-m-d H:i:s')
        );
      $this->db->insert('users',$data);
      $user_id = $this->db->insert_id();

      //sendSingleSms($this->input->post('mobile'),$pin_code);

      $data_otp = array(
        'otp_code'=>$this->hash_password($pin_code)
        );

      $this->db->where('id',$user_id);
      $this->db->update('users',$data_otp);

      return ['status' => 1, 'message' => 'You are sign up successfully.'];

    }
    public function login() {
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('email', 'Email', 'required|trim');
        // $this->form_validation->set_rules('password', 'Password', 'required|trim');
        // $this->form_validation->set_rules('device_id', 'Device id', 'required');
        // $this->form_validation->set_rules('device_type', 'Device type', 'required');
        // if ($this->form_validation->run()) {
            if ($this->resolve_user_login($this->input->post('mobile'), $this->input->post('password'))) {
                $users_token = $this->get_user_id_from_username($this->input->post('mobile'));
                $user = $this->get_user($users_token);
                $user['profile_image'] = base_url()."assets/uploads/images/user_profiles/".$user['profile_image']."";

                 $this->load->model('api/device_model');
                 $this->device_model->addDevice($users_token, '0');

              return ['status' => 1, 'message' => 'login success', 'data' => $user];
              } else {
                return ['status' => 0, 'message' => 'Wrong username or password.'];
            }
       
    }
    public function resolve_user_login($mobile, $password) {

        $this->db->select('otp_code');
        $this->db->from('users');
        $this->db->where('mobile', $mobile);
        
        $hash = $this->db->get()->row('otp_code');

        return $this->verify_password_hash($password, $hash);
    }
    private function verify_password_hash($password, $hash) {

        return password_verify($password, $hash);
    }
    private function hash_password($password) 
    {
      return password_hash($password, PASSWORD_BCRYPT);
    }

    public function get_user_id_from_username($username) {

        $this->db->select('users_token');
        $this->db->from('users');
        $this->db->where('mobile', $username);

        return $this->db->get()->row('users_token');
    }
     public function get_user($users_token)
    {
      $r = $this->db->select('id,name,mobile,location,profile_image,users_token,created_at')
                    ->from('users')
                    ->where('users_token',$users_token)
                    ->get();
      $res = $r->row_array();
      return $res;
    }

    public function edit_user_account()
    {
       $validateFileResult = validateFile([['profile', 'profile', ['jpeg', 'png', 'jpg', 'gif']]], true, $this->session);
        if ($validateFileResult['status'] == 1) {
            $fileResult = fileUpload('profile', 'images/user_profiles', $this->input->post('profile'));
            if ($fileResult['status'] == '1') {
                $profile = $fileResult['fileName'];
            }
            else
            {
                $profile = $this->input->post('profile');
            }
        }

      $data = array(
        'name'=>$this->input->post('name'),
        'mobile'=>$this->input->post('mobile'),
        'profile_image'=>$profile

        );

      $this->db->where('users_token',$this->input->post('users_token'));
      $this->db->update('users',$data);

      return ['status' => 1,'message'=>'updated successfully'];
    }
    public function get_user_account()
    {
      $r = $this->db->select('*')
                    ->from('users')
                    ->where('users_token',$this->input->post('users_token'))
                    ->get();
      $res = $r->row_array();
      $res['profile_image'] = base_url()."assets/uploads/images/user_profiles/".$res['profile_image']."";
      return ['status' => 1,'data'=>$res];
    }
    public function get_restaurant_detail()
    {
      $r = $this->db->select('r.*')
                    ->from('restaurant as r')
                    // ->join('cuisine_type as c','c.id=r.food_type')
                    ->where('r.id',$this->input->post('id'))
                    ->get();
      $res  = $r->row_array();
      
      $qr = $this->db->select('*')
                     ->from('restaurant_timing')
                     ->where('rest_id',$this->input->post('id'))
                     ->get();
      $result_data = $qr->result_array();

      $res['restaurant_timing'] = $result_data;

      $new_array = explode(',', $res['bg_image']);
      $name_array ='';

      foreach ($new_array as $key => $val) 
      {
         $name_array .= base_url()."assets/uploads/images/rest_background/".$val.",";

      }

      $new_name_array = rtrim($name_array ,",");

     // / echo $new_name_array;exit;
      $res['bg_image'] = $new_name_array;
      $res['profile_image'] = base_url()."assets/uploads/images/profile/".$res['profile_image']."";
      

      $food_type = explode(',', $res['food_type']);
    
      $res['food_type'] ="";
      foreach ($food_type as $key => $value) 
      {
        $r1 = $this->db->select('*')
                ->from('cuisine_type')
                ->where('id',$value)
                ->get();
        $res2 = $r1->row_array();
        $food_type_name = $res2['name'];
         $res['food_type'] .= $food_type_name.'/';

         $res2['food_type_img'] = base_url()."assets/uploads/images/food_type_img/".$res2['food_type_img']."";
         $res['cuisine_type'][] = $res2;
        
      }
      $res['food_type'] = rtrim($res['food_type'] ,'/');
      $res['is_open'] ='1';
      // p($res);
      return ['status' => 1,'data'=>$res];
    }
    public function get_favourite_food_dish()
    {
      $r = $this->db->select('*')
                    ->from('favourite_dishes')
                    ->where('users_token',$this->input->post('users_token'))
                    ->get();
      $res = $r->row_array();

      if(isset($res) && (!empty($res)))
      {
        $a = rtrim($res['users_favourites']);
      $new_a = explode(',', $a);

      foreach ($new_a as $key => $value) 
      {
          $q = $this->db->select('*')
                        ->from('food_dishes')
                        ->where('id',$value)
                        ->get();
          $resnew = $q->row_array();
          if(is_array($resnew) && !empty($resnew)){

            if(isset($resnew['dish_image']) && (!empty($resnew['dish_image'])))
            {
              $resnew['dish_image'] = base_url()."assets/uploads/images/dish_image/".$resnew['dish_image']."";   
            }
            $result[] = $resnew; 
          }
         

      }
      return ['status' => 1,'data'=>$result];
      }
      else
      {
        return ['status' => 0]; 
      }

    }
    public function get_food_dish_list()
    {
      $r  = $this->db->select('f.*,l.color,l.description as label_description,c.name as cuisine_type,c.food_type_img')
                     ->from('food_dishes as f')
                     ->join('labels as l','l.id=f.label_id','left')
                     ->join('cuisine_type as c','c.id=f.cuisine_type')
                     ->get();
      $res = $r->result_array();

      foreach ($res as $key => $value) 
      {
          $new_array = explode(',', $value['dish_image']);
          // $name_array =[];

          // foreach ($new_array as $key => $val) 
          // {
          //    $name_array[] = base_url()."assets/uploads/images/dish_image/".$val.",";

          // }

          //$new_name_array = rtrim($name_array ,",");

          $res[$key]['dish_image'] = base_url()."assets/uploads/images/dish_image/".$new_array[0];

          $res[$key]['food_type_img'] = base_url()."assets/uploads/images/food_type_img/".$value['food_type_img']."";
      }
      

      return ['status' => 1,'data'=>$res];
    }
    public function get_food_dish_detail()
    {
      $r  = $this->db->select('f.*,l.color,l.description as label_description,r.name as restaurant_name,r.description as restaurant_description')
                     ->from('food_dishes as f')
                     ->join('labels as l','l.id=f.label_id','left')
                     // ->join('cuisine_type as c','c.id=f.cuisine_type')
                     ->join('restaurant as r','r.id=f.restaurant_id')
                     ->where('f.id',$this->input->post('id'))
                     ->get();
      $res = $r->row_array();

      $food_type = explode(',', $res['cuisine_type']);
      $res['cuisine_type'] ="";

      $res2['food_type_img']="";

      foreach ($food_type as $key => $value) 
      {
        $r1 = $this->db->select('*')
                ->from('cuisine_type')
                ->where('id',$value)
                ->get();
        $res2 = $r1->row_array();
         
         $food_type_name = $res2['name'];
         $res['cuisine_type'] .= $food_type_name.'/';

         $res2['food_type_img'] = base_url()."assets/uploads/images/food_type_img/".$res2['food_type_img'].",";
         // $res['cuisine_type'][] = $res2;
        
      }
      $res['cuisine_type'] = rtrim($res['cuisine_type'] ,'/');

      // $cuisine_type = explode(',',$res['cuisine_type']);
      // $cu_type_img = [];
      // foreach ($cuisine_type as $c_type) 
      // {
      //    $cu_type_img[] = base_url()."assets/uploads/images/food_type_img/".$c_type;
      // }
      $res['food_type_img'] = $res2['food_type_img'];
      $res['food_type_img'] = rtrim($res['food_type_img'] ,',');
      $new_array = explode(',', $res['dish_image']);
      $name_array ='';

      foreach ($new_array as $key => $val) 
      {
         $name_array .= base_url()."assets/uploads/images/dish_image/".$val.",";

      }

      $new_name_array = rtrim($name_array ,",");

      $res['dish_image'] = $new_name_array;
      
      $token = $this->input->post('users_token');
      $dish_id = $this->input->post('id');

      if(isset($token) && (!empty($token)))
      {
          $rd = $this->db->select('*')
                      ->from('favourite_dishes')
                      ->where('users_token',$token)
                      ->get();
          $rows = $rd->num_rows();
          if($rows > 0)
          {
              $resd = $rd->row_array();

              $a = rtrim($resd['users_favourites']);
              $new_a = explode(',', $a);
              //p($new_a);
              if(in_array($dish_id,$new_a))
              {
                $res['alredy_like'] = '1';
              }
              else
              {
                $res['alredy_like'] = '0'; 
              }
          }
      }

      return ['status' => 1,'data'=>$res];
    }
    public function food_dish_like()
    {
      $token = $this->input->post('users_token');
      $dish_id = $this->input->post('dish_id');

      $rd = $this->db->select('total_likes')
                             ->from('food_dishes')
                             ->where('id',$dish_id)
                             ->get();
      $tot_like = $rd->row_array();

      $r = $this->db->select('*')
                      ->from('favourite_dishes')
                      ->where('users_token',$token)
                      ->get();
        $rows = $r->num_rows();
        
        
        if($rows > 0)
        {
            $res = $r->row_array();

            $a = rtrim($res['users_favourites']);
            $new_a = explode(',', $a);

            if(!in_array($dish_id, $new_a))
            {
                $data = array(
                  'users_favourites'=>$res['users_favourites'].','.$dish_id
                );
              
              $this->db->where('users_token',$token);
              $this->db->update('favourite_dishes',$data);  

              $data_dish = array(
                'total_likes'=> $tot_like['total_likes']+1
                );
              $this->db->where('id',$dish_id);
              $this->db->update('food_dishes',$data_dish);
            }
        }
        else
        {
          $data_token = array(
            'users_token'=>$token,
            'users_favourites'=>$dish_id
            );
          $this->db->insert('favourite_dishes',$data_token);

          $data_dish = array(
                'total_likes'=> $tot_like['total_likes']+1
                );
              $this->db->where('id',$dish_id);
              $this->db->update('food_dishes',$data_dish);

        }


      return ['status' => 1,'message'=>"Like success"]; 
    }
}
?>