<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Admin_model extends CI_Model 

{

	public function __construct() 

	{

		parent::__construct();

		$this->load->database();

		$this->load->helper('general_helper');
		error_reporting(0);

	}
	public function change_password($post)
	{
		$data = array(
			'password'=>$this->hash_password($post['new_password'])
			);
		$this->db->where('id',$_SESSION['admin_id']);
		$this->db->update('staff',$data);
	}
	public function staff_change_password($post)
	{
		$data = array(
			'password'=>$this->hash_password($post['new_password'])
			);
		$this->db->where('staff_token',$post['staff_token']);
		$this->db->update('staff',$data);
	}
	public function get_restaturant_food_dish_list($id)
	{
		$r = $this->db->select('f.*,r.name as resturant_name,c.name as food_type_name')

					  ->from('food_dishes as f')

					  ->join('restaurant as r','f.restaurant_id=r.id')

					  ->join('cuisine_type as c','f.cuisine_type=c.id')
					  ->where('f.restaurant_id',$id)
					  ->get();

		$res  = $r->result_array();

		return $res;

	}
	public function get_restaurant_name($id)
	{
		$r = $this->db->select('name,id')
					  ->from('restaurant')
					  ->where('id',$id)
					  ->get();
		$res = $r->row_array();
		return $res;
	}
	public function fooddishlikes_list() 
	{
        $sql = "SELECT GROUP_CONCAT(DISTINCT users_favourites ORDER BY id SEPARATOR ',') as likeddishes FROM favourite_dishes";
                //print_r($this->db->query($sql)->row_array());exit;

        $result = $this->db->query($sql)->row_array();
        
        $distinctlikedishes = array_unique(explode(",",$result['likeddishes']));
        $dishes_likes_string = implode(',', $distinctlikedishes);
        //echo $dishes_likes_string;
		// "SELECT GROUP_CONCAT(DISTINCT users_favourites ORDER BY id SEPARATOR ',') as likeddishes FROM favourite_dishes";
        $query = "SELECT * FROM food_dishes WHERE id IN (".$dishes_likes_string.")"; 
        // SELECT * FROM food_dishes WHERE id IN (2,3,5,7,6,8,10,43,16,24,55,57,49,15,11,37)

        $result1 = $this->db->query($query)->result_array();
       // p($result1);
        return $result1;
    }


	public function get_total_dishes_like()
	{
		$r = $this->db->select('f.*,r.name as restaurant_name')
		              ->from('food_dishes as f')
		              ->join('restaurant as r','r.id=f.restaurant_id')
		              ->where('total_likes !=','0')
		              ->get();
		$res = $r->result_array();
		return $res;
				 
	}
	public function count_food_dish_like()
	{
		$r = $this->db->select('*')
				 ->from('food_dishes')
				 ->where('total_likes !=','0')
				 ->get();

		$rows = $r->num_rows();
		return $rows;
	}
	public function get_total_list_of_activity()
	{
		$r = $this->db->select('a.*,s.name as staff_name')
					  ->from('activity_log as a')
					  ->join('staff as s','s.id=a.login_id')
					  ->order_by('id','DESC')
					  ->get();
		$res = $r->result_array();
		return $res;	
	}
	public function get_activity_log()
	{
		$r = $this->db->select('a.*,s.name as staff_name')
					  ->from('activity_log as a')
					  ->join('staff as s','s.id=a.login_id')
					  ->order_by('created_at', 'desc')
					  ->limit('10')
					  ->get();
		$res = $r->result_array();
		return $res;
	}
	public function delete_notification($id)
	{
		$r = $this->db->select('description')
		              ->from('notification')
		              ->where('id',$id)
		              ->get();
		 $res = $r->row_array();

        $this->db->delete('notification', array('id' => $id));
        

        $data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Deleted notification with description "'.$res['description'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);

        return ['status'=>1,'message'=>' deleted successfully.'];

    }
	public function delete_food_dish_img($id,$img_name)
	{
		$r = $this->db->select('dish_image')
		              ->from('food_dishes')
		              ->where('id',$id)
		              ->get();
		 $res = $r->row_array();
		 $oldphoto = explode(",", $res['dish_image']);

         foreach (array_keys($oldphoto, $img_name) as $key) {
    			unset($oldphoto[$key]);
			}
			$newphoto = implode(',',$oldphoto);
			$data =array(
				'dish_image'=>$newphoto
				);

			$this->db->where('id',$id);
			$this->db->update('food_dishes',$data);
		 
	}

	public function delete_back_img($id,$img_name)
	{
		$r = $this->db->select('bg_image')
		              ->from('restaurant')
		              ->where('id',$id)
		              ->get();
		 $res = $r->row_array();
		 $oldphoto = explode(",", $res['bg_image']);

         foreach (array_keys($oldphoto, $img_name) as $key) {
    			unset($oldphoto[$key]);
			}
			$newphoto = implode(',',$oldphoto);
			$data =array(
				'bg_image'=>$newphoto
				);

			$this->db->where('id',$id);
			$this->db->update('restaurant',$data);
		 
	}
	public function food_dish_detail_view($id)
	{
		$r = $this->db->select('f.*,r.name as restaurant_name,l.description as label,l.color,c.name as cuisine_type')
					  ->from('food_dishes as f')
					  ->join('restaurant as r','r.id=f.restaurant_id')
					  ->join('labels as l','l.id=f.label_id')
					  ->join('cuisine_type as c','c.id=f.cuisine_type')
					  ->where('f.id',$id)
					  ->get();
		$res = $r->row_array();
		return $res;
	}
	public function resturant_detail_view($id)
	{
		$r = $this->db->select('*')
					  ->from('restaurant')
					  ->where('id',$id)
					  ->get();
		$res = $r->row_array();
		
		$food_type = explode(',', $res['food_type']);
		
		$res['food_type_name'] ="";
		foreach ($food_type as $key => $value) 
		{
			$r1 = $this->db->select('*')
						  ->from('cuisine_type')
						  ->where('id',$value)
						  ->get();
			$res2 = $r1->row_array();
			$food_type_name = $res2['name'];
			 $res['food_type_name'] .= $food_type_name.'/';
			 // $res['cuisine_type'][] =  $res2;
			
		}
		$res['food_type_name'] = rtrim($res['food_type_name'] ,'/');
		// p($res);
		return $res;
	}
	public function add_notification($post)
	{
		$this->load->model('api/device_model');
        $device = $this->device_model->getByDeviceIdAndType1();
        //p($device);
        $androiddevice = 0;
        $iosdevice = 0;
        foreach($device as $value){
              $device_type = $value['device_type'];
			  if (intval($device_type) == 1) {
                   
                    $registration_id[] = $value['fcm_token'];
                }elseif(intval($device_type) == 0){
                   
                    $registration_id[] = $value['fcm_token'];
                }   
            }

        if ($device_type == 1) 
        {
               
                      $fields = array(
                         
                         'registration_ids' => $registration_id,
                         'notification' => array('title' => 'PoketEat',
                                                 'body' => $post['description'],
                                                 'vibrate' => true,
                                                 'sound' => true,
                                                 'badge' =>0, 
                                                 'content-available' => 1,
                                                 'largeIcon' => 'large_icon',
                                                 'smallIcon' => 'small_icon'
                                                 ),
                          'data' => array('message' => $post['description'], 
                          	              'title'=> $post['title'], 
                                          'vibrate' => true,
                                          'sound' => true,
                                          'badge' =>0, 
                                          'content-available' => 1,
                                          'largeIcon' => 'large_icon',
                                          'smallIcon' => 'small_icon',
                                          'priority' => "high"
                                          )
                              
                     
                      );

                      $headers = array(
                                'Authorization: key=AAAAD1sHM_Q:APA91bF8X_iesMqnHdJ3jzHvH6W1QUQuUoTSHar9CqPYczIGYtKs8sYHUuFWW5cG99QV510VlhjNE0nO1qVipRMo1wEnmuvw228SBSv7n1fimOJZdGgxmazTdvpxei7jbqGeM8ENG0iH',
                                'Content-Type: application/json'
                            );

                      $ch = curl_init();
                       curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
               
                      curl_setopt( $ch,CURLOPT_POST, true );
                      curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                      curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                      curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                      curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields));
                      $result = curl_exec($ch );
                      curl_close( $ch );
                      
                      unset($registration_id);
                      unset($ch);
                      unset($headers);
                      unset($fields);
    

                    }

                    if ($device_type == 0) 
                    {
               
                       $fields = array(
                         
                         'registration_ids' => $registration_id,
                         'notification' => array('title' => 'PoketEat',
                                                 'body' => $post['description'],
                                                 'vibrate' => true,
                                                 'sound' => true,
                                                 'badge' =>0, 
                                                 'content_available' => true,
                                                 'largeIcon' => 'large_icon',
                                                 'smallIcon' => 'small_icon'
                                                 ),
                          'data' => array('message' => $post['description'],
                          				  'title'=> $post['title'], 
                                          'vibrate' => true,
                                          'sound' => true,
                                          'badge' =>0, 
                                          'content_available' => true,
                                          'largeIcon' => 'large_icon',
                                          'smallIcon' => 'small_icon',
                                          'priority' => "high",
                                          
                                        )
                              
                     
                      );
                       
                       $headers = array(
                                'Authorization: key=AAAAD1sHM_Q:APA91bF8X_iesMqnHdJ3jzHvH6W1QUQuUoTSHar9CqPYczIGYtKs8sYHUuFWW5cG99QV510VlhjNE0nO1qVipRMo1wEnmuvw228SBSv7n1fimOJZdGgxmazTdvpxei7jbqGeM8ENG0iH',
                                'Content-Type: application/json'
                            );

                      $ch = curl_init();
                       curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
               
                      curl_setopt( $ch,CURLOPT_POST, true );
                      curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                      curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                      curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                      curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields));
                      $result = curl_exec($ch );
                      curl_close( $ch );
                    
                      unset($registration_id);
                      unset($ch);
                      unset($headers);
                      unset($fields);
                                         
                    }
                  
          
                  

		$data = array(
			'title'=> $post['title'],
			'description'=> $post['description'],
			'created_at' => date('Y-m-d H:i:s')
			);

		$this->db->insert('notification',$data);
		$n_id = $this->db->insert_id();
		
		$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Sent and added notification with description "'.$post['description'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);

	}
	public function get_notification_list()
	{
		$r = $this->db->select('*')
					  ->from('notification')
					  ->get();
		$res = $r->result_array();
		return $res;
	}
	public function getDashboardStatistics() {
        $sql = "select (SELECT COUNT(*) FROM users ) as userount "
                . " ,(SELECT COUNT(*) FROM food_dishes ) as foodcount "
                . " ,(SELECT COUNT(*) FROM restaurant ) as restcount "
                . " ,(SELECT COUNT(*) FROM labels ) as labelcount ";
                //print_r($this->db->query($sql)->row_array());exit;

        return $this->db->query($sql)->row_array();
    }

    public function getDashboardStatisticsforfooddishlikes() {
        $sql = "SELECT GROUP_CONCAT(DISTINCT users_favourites ORDER BY id SEPARATOR ',') as likeddishes FROM favourite_dishes";
                //print_r($this->db->query($sql)->row_array());exit;

        $result = $this->db->query($sql)->row_array();
        $distinctlikedishes = array_unique(explode(",",$result['likeddishes']));
//"SELECT GROUP_CONCAT(DISTINCT users_favourites ORDER BY id SEPARATOR ',') as likeddishes FROM favourite_dishes";
        // $query = "SELECT * FROM users_favourites WHERE id IN (".$distinctlikedishes.")"; 

        $dishes_likes_string = implode(',', $distinctlikedishes);
        //echo $dishes_likes_string;
		// "SELECT GROUP_CONCAT(DISTINCT users_favourites ORDER BY id SEPARATOR ',') as likeddishes FROM favourite_dishes";
        $query = "SELECT COUNT(*) as likescount FROM food_dishes WHERE id IN (".$dishes_likes_string.")"; 

        $result1 = $this->db->query($query)->row_array();
        //p($result1['likescount']);
        return $result1['likescount'];
    }

	public function assign_role_staff_category($post)
	{
		
		$data = array(
			'roles'=>implode(',', $post['role'])
			);
		
		$this->db->where('id',$post['category_id']);
		$this->db->update('staff_category',$data);

		$r = $this->db->select('*')
					  ->from('staff_category')
					  ->where('id',$post['category_id'])
					  ->get();
		$res = $r->result_array();
		

		$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Assigned roles to category "'.$res['category_name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);



	}
	public function get_category_name($id)
	{
		$r = $this->db->select('category_name')
				      ->from('staff_category')
				      ->where('id',$id)
				      ->get();
		$res = $r->row_array();
		return $res['category_name'];
	}
	public function get_roles_name($id)
	{
		$r = $this->db->select('roles')
				      ->from('staff_category')
				      ->where('id',$id)
				      ->get();
		$res = $r->row_array();
		return $res['roles'];
	}
	public function delete_staff($id)
	{
		$r = $this->db->select('*')
				      ->from('staff')
				      ->where('id',$id)
				      ->get();
		$res = $r->row_array();

		$this->db->delete('staff', array('id' => $id));

		$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Deleted staff "'.$res['name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);

        return ['status'=>1,'message'=>' deleted successfully.'];
	}
	public function edit_staff_data($post)
	{
		$data = array(
			'category_id'=>$post['category_id'],
			'name'=>$post['name'],
			'email'=>$post['email'],

			);
		$this->db->where('id',$post['staff_id']);
		$this->db->update('staff',$data);

		$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Updated staff details of '.$post['name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);

	}
	public function get_staff_data($token)
	{
		$r = $this->db->select('*')
				      ->from('staff')
				      
				      ->where('staff_token',$token)
				      ->get();
		$res = $r->row_array();
		return $res;
	}
	public function add_staff_data($post)
	{
		$this->load->helper('string');

		if($this->check_email($post['email']))
        {
                $this->session->set_flashdata('success', "email already exist so please try again");
                redirect('admin/add_staff');
        }
        else
        {

			$token = random_string('alnum', 16);

			$data = array(
				'category_id'=>$post['category_id'],
				'staff_token'=>$token,
				'name'=>$post['name'],
				'email'=>$post['email'],
				'password'=>$this->hash_password($post['password']),
				'created_at'=>date('Y-m-d H:i:s')
				);
			$this->db->insert('staff',$data);
			$s_id  = $this->db->insert_id();

			$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Added staff with name "'.$post['name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
            $this->db->insert('activity_log',$data_log);

		}


	}
	public function check_email($email)
	{
		$this->db->where('email',$email);
        $query = $this->db->get('staff');
        if ($query->num_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }
	}
	public function get_staff_list()
	{
		$r = $this->db->select('s.*,sc.category_name as role')
				      ->from('staff as s')
				      ->join('staff_category as sc','sc.id=s.category_id')
				      ->get();
		$res = $r->result_array();
		return $res;
	}
	public function delete_category($id)
	{
		$r = $this->db->select('*')
				      ->from('staff_category')				      
				      ->where('id',$id)
				      ->get();
		$res = $r->row_array();

		$this->db->delete('staff_category', array('id' => $id));

		$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Deleted staff category with name "'.$res['category_name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);

        return ['status'=>1,'message'=>' deleted successfully.'];
	}
	public function edit_staff_category($post)
	{
		$data = array(
			'category_name'=>$post['ed_category_name']
		
			);
		$this->db->where('id',$post['category_id']);
		$this->db->update('staff_category',$data);
		
		$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Updated staff category name "'.$post['ed_category_name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);

	}
	public function add_staff_category($post)
	{
		$data = array(
			'category_name'=>$post['category_name'],

			'created_at'=>date('Y-m-d H:i:s')
			);
		$this->db->insert('staff_category',$data);
		$c_id = $this->db->insert_id();

		$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Added staff category "'.$post['category_name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);

	}
	public function get_staff_category_list()
	{
		$r = $this->db->select('*')
		 		      ->from('staff_category')
		 		      ->get();
		 $res = $r->result_array();
		 return $res;
	}
	public function delete_users($id)

	{
		$r = $this->db->select('*')
		 		      ->from('users')
		 		      ->where('id',$id)
		 		      ->get();
		 $res = $r->row_array();

		$this->db->delete('users', array('id' => $id));

		$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Deleted user "'.$res['name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);

        return ['status'=>1,'message'=>' deleted successfully.'];

	}

	public function get_user_list()

	{

		$r = $this->db->select('*')

		 		      ->from('users')

		 		      ->get();

		 $res = $r->result_array();

		 return $res;

	}

	public function delete_food_dish($id)

	{
		$r = $this->db->select('*')
		 		      ->from('food_dishes')
		 		      ->where('id',$id)
		 		      ->get();
		 $res = $r->row_array();

		$this->db->delete('food_dishes', array('id' => $id));

		$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Deleted food dish "'.$res['dish_name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);

        return ['status'=>1,'message'=>' deleted successfully.'];

	}

	public function edit_food_dish_data($post)

	{

		// $validateFileResult = validateFile([['dish_img', 'dish_img', ['jpeg', 'png', 'jpg', 'gif']]], true, $this->session);

  //       if ($validateFileResult['status'] == 1) {

  //           $fileResult = fileUpload('dish_img', 'images/dish_image', $this->input->post('dish_img'));

  //           if ($fileResult['status'] == '1') {

  //               $dish_img = $fileResult['fileName'];

  //           }

  //           else

  //       	{

  //       		$dish_img = $post['old_dish_img'];

  //       	}

  //       }

        if(isset($_FILES['dish_img']['name'][0]) && (!empty($_FILES['dish_img']['name'][0]))) 
        {
        	//echo 'ddddd';exit;
            $filesCount = count($_FILES['dish_img']['name']);

            for ($i = 0; $i < $filesCount; $i++) 
            {

                $_FILES['userFile']['name'] = $_FILES['dish_img']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['dish_img']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['dish_img']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['dish_img']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['dish_img']['size'][$i];

                $uploadPath = 'assets/uploads/images/dish_image';

                $new_name = time() . $_FILES['userFile']['name'];
                $config['file_name'] = $new_name;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = '*';
                //$config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('userFile')) {

                    $fileData = $this->upload->data();

                    $name_array[] = $fileData['file_name'];

                    $back_filename = $name_array;
                }
            }
            
        	$file_name = implode(',',$back_filename);

        	if(isset($post['old_dish_img']) && (!empty($post['old_dish_img'])))
        	{
        		$old_back_file_name = implode(',',$post['old_dish_img']);

        		$dish_file_name = $old_back_file_name.','.$file_name;
        	}
        	else
        	{
        		$dish_file_name = implode(',',$back_filename);
        	}
        }
        else
        {
        	
        	$dish_file_name = implode(',',$post['old_dish_img']);
        	
        }


        $data = array(

					'restaurant_id'=>$post['resturant_id'],

					'dish_image'=>$dish_file_name,

					'dish_name'=>$post['dish_name'],

					'dish_description'=>$post['dish_description'],

					'dish_price'=>$post['dish_price'],

					'label_id'=>isset($post['label_id'])?$post['label_id']:'0',
					'is_label_exist'=>isset($post['label_id'])?'1':'0',
					'cuisine_type'=>$post['food_type']

					

					);

        $this->db->where('id',$post['f_id']);

        $this->db->update('food_dishes',$data);

         $data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Updated food dish details of "'.$post['dish_name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);

	}

	public function get_dish_data($id)

	{

		$r= $this->db->select('*')

					 ->from('food_dishes')

					 ->where('id',$id)

					 ->get();

		$res = $r->row_array();

		return $res;

	}

	public function add_food_dish_data($post)

	{

		// $validateFileResult1 = validateFile([['dish_img', 'dish_img', ['jpeg', 'png', 'jpg', 'gif']]], true, $this->session);

  //       if ($validateFileResult1['status'] == 1) {

  //           $fileResult1 = fileUpload('dish_img', 'images/dish_image', $this->input->post('dish_img'));

  //           if ($fileResult1['status'] == '1') {

  //               $dish_img = $fileResult1['fileName'];

  //           }

  //       }

		if ($_FILES['dish_img']['name']) {

            $filesCount = count($_FILES['dish_img']['name']);

            for ($i = 0; $i < $filesCount; $i++) 
            {

                $_FILES['userFile']['name'] = $_FILES['dish_img']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['dish_img']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['dish_img']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['dish_img']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['dish_img']['size'][$i];

                $uploadPath = 'assets/uploads/images/dish_image';

                $new_name = time() . $_FILES['userFile']['name'];
                $config['file_name'] = $new_name;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = '*';
                //$config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('userFile')) {

                    $fileData = $this->upload->data();

                    $name_array[] = $fileData['file_name'];

                    $dish_filename = $name_array;
                }
            }
            //return $filename;
        }
        
        $dish_file_name = implode(',',$dish_filename);




        $data = array(

					'restaurant_id'=>$post['resturant_id'],

					'dish_image'=>$dish_file_name,

					'dish_name'=>$post['dish_name'],

					'dish_description'=>$post['dish_description'],

					'dish_price'=>$post['dish_price'],

					'label_id'=>isset($post['label_id'])?$post['label_id']:'0',

					'cuisine_type'=>$post['food_type'],
					'is_label_exist'=>isset($post['label_id'])?'1':'0',
					'created_at'=>date('Y-m-d H:i:s')

					);

			

        $this->db->insert('food_dishes',$data);
        $d_id = $this->db->insert_id();

        $data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Added food dish "'.$post['dish_name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);

	}

	public function get_food_dish_list()

	{

		$r = $this->db->select('f.*,r.name as resturant_name,c.name as food_type_name')

					  ->from('food_dishes as f')

					  ->join('restaurant as r','f.restaurant_id=r.id')

					  ->join('cuisine_type as c','f.cuisine_type=c.id')

					  ->get();

		$res  = $r->result_array();

		return $res;

	}

	public function delete_resturant($id)

    {
    	$r = $this->db->select('*')
		 		      ->from('restaurant')
		 		      ->where('id',$id)
		 		      ->get();
		 $res = $r->row_array();

        

        $query = $this->db->get_where('restaurant', array('id' => $id));

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $picture = $row->bg_image;
            unlink(realpath('assets/uploads/images/rest_background/' . $picture));
            $this->db->delete('restaurant', array('id' => $id));
            
        }

        $data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Deleted restaurant "'.$res['name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);

        return ['status'=>1,'message'=>' deleted successfully.'];

    }

	public function edit_resturant_data($post)
	{
		//p($post);
	$validateFileResult = validateFile([['profile_pic', 'profile_pic', ['jpeg', 'png', 'jpg', 'gif']]], true, $this->session);
		if ($validateFileResult['status'] == 1) {

            $fileResult = fileUpload('profile_pic', 'images/profile', $this->input->post('profile_pic'));

            if ($fileResult['status'] == '1') {

                $profile_pic = $fileResult['fileName'];

            }

            else

        	{

        		$profile_pic = $post['old_profile_img'];

        	}

        }

        
        
        if(isset($_FILES['back_img']['name'][0]) && (!empty($_FILES['back_img']['name'][0]))) 
        {
        	//echo 'ddddd';exit;
            $filesCount = count($_FILES['back_img']['name']);

            for ($i = 0; $i < $filesCount; $i++) 
            {

                $_FILES['userFile']['name'] = $_FILES['back_img']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['back_img']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['back_img']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['back_img']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['back_img']['size'][$i];

                $uploadPath = 'assets/uploads/images/rest_background';

                $new_name = time() . $_FILES['userFile']['name'];
                $config['file_name'] = $new_name;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = '*';
                //$config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('userFile')) {

                    $fileData = $this->upload->data();

                    $name_array[] = $fileData['file_name'];

                    $back_filename = $name_array;
                }
            }
            
        	$file_name = implode(',',$back_filename);

        	if(isset($post['old_back_img']) && (!empty($post['old_back_img'])))
        	{
        		$old_back_file_name = implode(',',$post['old_back_img']);

        		$back_file_name = $old_back_file_name.','.$file_name;
        	}
        	else
        	{
        		$back_file_name = implode(',',$back_filename);
        	}
        }
        else
        {
        	
        	$back_file_name = implode(',',$post['old_back_img']);
        	
        }


		$data = array(

					'name'=>$post['rest_name'],

					'contact_no'=>$post['contact_no'],

					'food_type'=>$post['food_type'],

					'description'=>$post['description'],

					'address'=>$post['address'],

					// 'open_time'=>$post['open_time'],

					// 'close_time'=>$post['close_time'],

					'profile_image'=>$profile_pic,

					'bg_image'=>$back_file_name,

					'created_at'=>date('Y-m-d H:i:s')

					);

			//p($data);

			$this->db->where('id',$post['r_id']);

			$this->db->update('restaurant',$data);

			if(isset($post['day']) && (!empty($post['day'])))
			{
				foreach ($post['day'] as $val_time) 
				{

					$day_data = array(
					'rest_id'=>$post['r_id'],
					'day'=>$val_time['daynm'],
					'mor_open_time'=>$val_time['mor_open_time'],
					'mor_close_time'=>$val_time['mor_close_time'],
					'eve_open_time'=>$val_time['eve_open_time'],
					'eve_close_time'=>$val_time['eve_close_time'],
					'created_at'=>date('Y-m-d H:i:s')
					);
					if(isset($val_time['rest_time_id']) && (!empty($val_time['rest_time_id'])))
					{
						$this->db->where('id',$val_time['rest_time_id']);
						$this->db->update('restaurant_timing',$day_data);	
					}
					else
					{
						$this->db->insert('restaurant_timing',$day_data);
					}
					
				}
			}

			$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Updated Restaurant details of "'.$post['rest_name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
           $this->db->insert('activity_log',$data_log);


	}
	public function resturant_timing($id)
	{
		$r = $this->db->select('*')
					  ->from('restaurant_timing')
					  ->where('rest_id',$id)
					  ->get();
		$res = $r->result_array();
		return $res;
	}
	public function get_resturant_data($id)

	{

		$r = $this->db->select('*')

					  ->from('restaurant')

					  ->where('id',$id)

					  ->get();

		$res = $r->row_array();

		return $res;

	}

	public function add_resturant_data($post)
	{
		//p($post);
		$validateFileResult = validateFile([['profile_pic', 'profile_pic', ['jpeg', 'png', 'jpg', 'gif']]], true, $this->session);

        if ($validateFileResult['status'] == 1) {

            $fileResult = fileUpload('profile_pic', 'images/profile', $this->input->post('profile_pic'));

            if ($fileResult['status'] == '1') {

                $profile_pic = $fileResult['fileName'];

            }

        }

         if ($_FILES['back_img']['name']) {

            $filesCount = count($_FILES['back_img']['name']);

            for ($i = 0; $i < $filesCount; $i++) 
            {

                $_FILES['userFile']['name'] = $_FILES['back_img']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['back_img']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['back_img']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['back_img']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['back_img']['size'][$i];

                $uploadPath = 'assets/uploads/images/rest_background';

                $new_name = time() . $_FILES['userFile']['name'];
                $config['file_name'] = $new_name;
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = '*';
                //$config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('userFile')) {

                    $fileData = $this->upload->data();

                    $name_array[] = $fileData['file_name'];

                    $back_filename = $name_array;
                }
            }
            //return $filename;
        }
        
        $back_file_name = implode(',',$back_filename);
        // $validateFileResult1 = validateFile([['back_img', 'back_img', ['jpeg', 'png', 'jpg', 'gif']]], true, $this->session);

        // if ($validateFileResult1['status'] == 1) {

        //     $fileResult1 = fileUpload('back_img', 'images/rest_background', $this->input->post('back_img'));

        //     if ($fileResult1['status'] == '1') {

        //         $back_img = $fileResult1['fileName'];

        //     }

        // }

       $food_type =  implode(',',$post['food_type']); 

		$data = array(

					'name'=>$post['rest_name'],

					'contact_no'=>$post['contact_no'],

					'food_type'=>$food_type,

					'description'=>$post['description'],

					'address'=>$post['address'],

					// 'open_time'=>$post['open_time'],

					// 'close_time'=>$post['close_time'],

					'profile_image'=>$profile_pic,

					'bg_image'=>$back_file_name,

					'created_at'=>date('Y-m-d H:i:s')

					);



			$this->db->insert('restaurant',$data);
			$r_id = $this->db->insert_id();

			foreach ($post['day'] as $val1) 
			{
				//p($val1);
				$day_data = array(
					'rest_id'=>$r_id,
					'day'=>$val1['daynm'],
					'mor_open_time'=>$val1['mor_open_time'],
					'mor_close_time'=>$val1['mor_close_time'],
					'eve_open_time'=>$val1['eve_open_time'],
					'eve_close_time'=>$val1['eve_close_time'],
					'created_at'=>date('Y-m-d H:i:s')
					);
				$this->db->insert('restaurant_timing',$day_data);

			}
		    $data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'New restaurant is added "'.$post['rest_name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
           $this->db->insert('activity_log',$data_log);
	}



	function do_miltiupload_files($files)
    {   
        $images = array();
               
        foreach ($files['name'] as $key => $image) 
        {

            $_FILES['multi_images[]']['name']= $files['name'][$key];

            $_FILES['multi_images[]']['type']= $files['type'][$key];

            $_FILES['multi_images[]']['tmp_name']= $files['tmp_name'][$key];

            $_FILES['multi_images[]']['error']= $files['error'][$key];

            $_FILES['multi_images[]']['size']= $files['size'][$key];

            $timestamp = time();
            
            $name = trim($image);
            $post_name = str_replace(' ', '_', $name); 
           
            $fileName = $timestamp .'_'. $post_name;
            
            $images[] = $fileName;

                $now = date('Y-m-d H:i:s');
      
                    $data = array(

                        'file_name'=>$fileName,
						 );

                 $this->admin_model->create_files('files',$data);
                
        } 
return $images;

    }

	public function get_resturant_list()

	{

		$r = $this->db->select('*')

					  ->from('restaurant')

					  ->get();

		$res = $r->result_array();

		return $res;

	}

	public function delete_label($id)

	{
		$r = $this->db->select('*')
					  ->from('labels')
					  ->where('id',$id)
					  ->get();

		$res = $r->row_array();

		 $this->db->delete('labels', array('id' => $id));
		 

		 $data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Deleted label "'.$res['description'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);

        return ['status'=>1,'message'=>' deleted successfully.'];

	}

	public function edit_label_color($post)
	{

		$data_ed = array(

			'color'=>$post['ed_l_color'],

			'description'=>$post['ed_l_desc']

			);

		$this->db->where('id',$post['l_id']);

		$this->db->update('labels',$data_ed);

		$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Updated label information of "'.$post['ed_l_desc'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);

	}

	public function add_label_color($post)

	{

		$data = array(

			'color'=>$post['l_color'],

			'description'=>$post['description'],

			'created_at'=>date('Y-m-d H:i:s')

			);

		$this->db->insert('labels',$data);
		$l_id = $this->db->insert_id();

		$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Added label "'.$post['description'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);


	}

	public function get_label_list()

	{

		$r = $this->db->select('*')

					  ->from('labels')

					  ->get();

		$res = $r->result_array();

		return $res;

	}

	public function delete_food_type($id)

    {
    	$r = $this->db->select('*')
					  ->from('cuisine_type')
					  ->where('id',$id)
					  ->get();

		$res = $r->row_array();

        $this->db->delete('cuisine_type', array('id' => $id));
		

        $data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Deleted cuisine type "'.$res['name'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
       $this->db->insert('activity_log',$data_log);

        return ['status'=>1,'message'=>' deleted successfully.'];

    }

    

	public function edit_food_type($post)

	{

        $validateFileResult1 = validateFile([['ed_food_type_image', 'ed_food_type_image', ['jpeg', 'png', 'jpg', 'gif']]], true, $this->session);

        if ($validateFileResult1['status'] == 1) {

            $fileResult1 = fileUpload('ed_food_type_image', 'images/food_type_img', $this->input->post('ed_food_type_image'));

            if ($fileResult1['status'] == '1') {

                $ed_food_type_image = $fileResult1['fileName'];

            }

            else

        	{

        		$ed_food_type_image = $post['ed_food_img'];

        	}

        }


		$data = array(

			'name'=>$post['food_type'],
			'food_type_img'=>$ed_food_type_image



			);

		$this->db->where('id',$post['f_id']);

		$this->db->update('cuisine_type',$data);

		$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Updated cuisine type "'.$post['food_type'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
       $this->db->insert('activity_log',$data_log);


	}

	public function add_food_type($post)
	{

		$validateFileResult = validateFile([['food_type_img', 'food_type_img', ['jpeg', 'png', 'jpg', 'gif']]], true, $this->session);

        if ($validateFileResult['status'] == 1) {

            $fileResult = fileUpload('food_type_img', 'images/food_type_img', $this->input->post('food_type_img'));

            if ($fileResult['status'] == '1') {

                $food_type_img = $fileResult['fileName'];

            }

            
        }



		$data = array(

			'name'=>$post['food_type'],
			'food_type_img'=>$food_type_img,

			'created_at'=>date('Y-m-d H:i:s')

			);

		$this->db->insert('cuisine_type',$data);
		$ac_id = $this->db->insert_id();

		$data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>'Added cuisine type "'.$post['food_type'].'"',
                    'created_at'=>date('Y-m-d H:i:s')
                    );
        $this->db->insert('activity_log',$data_log);



	}

	public function get_food_type_list()

	{

		$r = $this->db->select('*')

				      ->from('cuisine_type')

				      ->get();

		$res = $r->result_array();

		return $res;

	}

	public function get_user_name($id)

    {



    	$r = $this->db->select('email')

    				  ->from('staff')

    				  ->where('id',$id)

    				  ->get();

    	$res = $r->row_array();

    	return $res;

    } 

	public function resolve_admin_login($username, $password) 

	{
		$this->db->select('password');

		$this->db->from('staff');

		$this->db->where('email', $username);

		$hash = $this->db->get()->row('password');

		// p($hash);

		return $this->verify_password_hash($password, $hash);

		

	}

	private function verify_password_hash($password, $hash) 

	{

		return password_verify($password, $hash);

		

	}

	public function get_user_id_from_username($username) {

		

		$this->db->select('id');

		$this->db->from('staff');

		$this->db->where('email', $username);



		return $this->db->get()->row('id');

		

	}

	public function get_user($user_id) 
	{
		$r = $this->db->select('s.*,c.roles')
					  ->from('staff as s')
					  ->join('staff_category as c','c.id=s.category_id')
					  ->where('s.id', $user_id)
					  ->get();
		$res = $r->row();
		return $res;

		

	}

	private function hash_password($password) {

        

        return password_hash($password, PASSWORD_BCRYPT);

        

    }



}

