<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() 
    {
		parent::__construct();
		$this->load->helper('general_helper');
		$this->load->model('admin_model');
		//$this->load->library('session');
    }
    public function staff_change_password()
    {
        checkLogin();

        if($this->input->post())
        {
            $this->admin_model->staff_change_password($_POST);
            redirect('admin/staff_list');
            
        }

        $this->load->view('admin/layout/header');
        $this->load->view('admin/staff/staff_change_password');
        $this->load->view('admin/layout/footer');

    }
    public function change_password()
    {
        checkLogin();
        if($this->input->post())
        {
            $this->admin_model->change_password($_POST);
            $this->logout();
            // redirect('admin/index');
        }
        $this->load->view('admin/layout/header');
        $this->load->view('admin/site/change_password');
        $this->load->view('admin/layout/footer');
    }
    public function restaturant_food_dish_list()
    {
        checkLogin();

        $data['dish_list'] = $this->admin_model->get_restaturant_food_dish_list($this->input->get('id'));
        $data['res_name'] = $this->admin_model->get_restaurant_name($this->input->get('id'));

        $this->load->view('admin/layout/header');
        $this->load->view('admin/food/rest_food_dish_list',$data);
        $this->load->view('admin/layout/footer');
    }
    public function add_restaurant_food_dish()
    {
        if($this->input->post())
        {
            $this->admin_model->add_food_dish_data($_POST);
            redirect('admin/food_dish_list');
        }
        $data['category_list'] = $this->admin_model->get_food_type_list();
        $data['res_name'] = $this->admin_model->get_restaurant_name($this->input->get('id'));
        $data['label_list'] = $this->admin_model->get_label_list();

        $this->load->view('admin/layout/header');
        $this->load->view('admin/food/restaurant_food_dish',$data);
        $this->load->view('admin/layout/footer');   

    }
    public function food_dishes_like_report()
    {
        checkLogin();
        
        $data['report'] = $this->admin_model->fooddishlikes_list();

        $data['like_report'] = $this->admin_model->get_total_dishes_like();

        $this->load->view('admin/layout/header');
        $this->load->view('admin/food/likes_report',$data);
        $this->load->view('admin/layout/footer');   

    }
    public function activity_list()
    {
        checkLogin();
        
        $data['activity_list'] = $this->admin_model->get_total_list_of_activity();

        $this->load->view('admin/layout/header');
        $this->load->view('admin/activity/activity_list',$data);
        $this->load->view('admin/layout/footer');   

           
    }
    public function delete_food_dish_img()
    {
        checkLogin();
        $this->admin_model->delete_food_dish_img($this->input->post('f_id'),$this->input->post('img_name'));
        redirect('admin/edit_food_dish?id='.$this->input->post('f_id'));   
    }
    public function delete_background_img()
    {
        checkLogin();
        $this->admin_model->delete_back_img($this->input->post('re_id'),$this->input->post('img_name'));
        redirect('admin/edit_resturant?id='.$this->input->post('re_id'));
    }
    public function delete_notification()
    {
        checkLogin();
        $this->admin_model->delete_back_img($this->input->post('n_id'));
        redirect('admin/notification_list');
           
    }
    public function view_restaurant_detail()
    {
        checkLogin();
     $data['rest_detail'] = $this->admin_model->resturant_detail_view($this->input->get('id'));
     
     $data['rest_time'] = $this->admin_model->resturant_timing($this->input->get('id'));

      $this->load->view('admin/layout/header');
      $this->load->view('admin/food/view_restaurant_detail',$data);
      $this->load->view('admin/layout/footer');   

    }
    public function view_food_dish_detail()
    {
     checkLogin();
     $data['food_detail'] = $this->admin_model->food_dish_detail_view($this->input->get('id'));

      $this->load->view('admin/layout/header');
      $this->load->view('admin/food/view_food_dish_detail',$data);
      $this->load->view('admin/layout/footer');   

    }
    public function add_notification()
    {
        checkLogin();
        if($this->input->post())
        {
            $this->admin_model->add_notification($_POST);
            redirect('admin/notification_list');
        }

    }
    public function notification_list()
    {
        checkLogin();
        
      $data['notification_list'] = $this->admin_model->get_notification_list();

      $this->load->view('admin/layout/header');
      $this->load->view('admin/notification/notification',$data);
      $this->load->view('admin/layout/footer');   
    }
    public function assign_role()
    {
      checkLogin();

      if($this->input->post())
      { 
            $this->admin_model->assign_role_staff_category($_POST);
            redirect('admin/staff_category_list');
      }
      $data['category_name'] = $this->admin_model->get_category_name($this->input->get('id'));
      $data['category_role'] = $this->admin_model->get_roles_name($this->input->get('id'));

      $this->load->view('admin/layout/header');
      $this->load->view('admin/role/assign_role',$data);
      $this->load->view('admin/layout/footer');
    }

    public function add_staff()
    {
        checkLogin();

        $data['staff_category_list'] = $this->admin_model->get_staff_category_list();

        if($this->input->post())
        {
            $this->admin_model->add_staff_data($_POST);
            redirect('admin/staff_list');
        }
      $this->load->view('admin/layout/header');
      $this->load->view('admin/staff/add_staff',$data);
      $this->load->view('admin/layout/footer');

    }
    public function delete_staff()
    {
        checkLogin();

        $result = $this->admin_model->delete_staff($this->input->get('id'));
        $this->session->set_flashdata('success', $result['message']);
        redirect('admin/staff_list');
    }
    public function edit_staff()
    {
        checkLogin();

        if($this->input->post())
        {
            $this->admin_model->edit_staff_data($_POST);
            redirect('admin/staff_list');
        }
      $data['staff_category_list'] = $this->admin_model->get_staff_category_list();
      $data['staff_data'] = $this->admin_model->get_staff_data($this->input->get('tk'));      

      $this->load->view('admin/layout/header');
      $this->load->view('admin/staff/edit_staff',$data);
      $this->load->view('admin/layout/footer');

    }
    public function staff_list()
    {
        checkLogin();

      
      $data['staff_data'] = $this->admin_model->get_staff_list();

      $this->load->view('admin/layout/header');
      $this->load->view('admin/staff/staff_list',$data);
      $this->load->view('admin/layout/footer');

    }
    public function delete_staff_category()
    {
        checkLogin();

        $result = $this->admin_model->delete_category($this->input->get('id'));
        $this->session->set_flashdata('success', $result['message']);
        redirect('admin/staff_category_list');
    }
    public function add_staff_category()
    {
        checkLogin();
        if($this->input->post())
        {
            $this->admin_model->add_staff_category($_POST);
            redirect('admin/staff_category_list');
        }   
    }
    public function edit_staff_category()
    {
        checkLogin();
        if($this->input->post())
        {
            $this->admin_model->edit_staff_category($_POST);
            redirect('admin/staff_category_list');
        }
           
    }
    public function staff_category_list()
    {
        checkLogin();
        
        $data['staff_list'] = $this->admin_model->get_staff_category_list();

      $this->load->view('admin/layout/header');
      $this->load->view('admin/staff/category_list',$data);
      $this->load->view('admin/layout/footer');     
    }
    public function delete_users()
    {
        checkLogin();

        $result = $this->admin_model->delete_users($this->input->get('id'));
        $this->session->set_flashdata('success', $result['message']);
        redirect('admin/users_list');
    }
    public function users_list()
    {
      checkLogin();  
      $data['users'] = $this->admin_model->get_user_list();

      $this->load->view('admin/layout/header');
      $this->load->view('admin/users/users_list',$data);
      $this->load->view('admin/layout/footer');

    }
    public function delete_food_dish()
    {
        checkLogin();

        $result = $this->admin_model->delete_food_dish($this->input->get('id'));
        $this->session->set_flashdata('success', $result['message']);
        redirect('admin/food_dish_list');
    }
    public function edit_food_dish()
    {   
        checkLogin();

        $id = $this->input->get('id');

        if($this->input->post())
        {   
            $this->admin_model->edit_food_dish_data($_POST);
            redirect('admin/food_dish_list');
        }
        $data['category_list'] = $this->admin_model->get_food_type_list();
        $data['rest_list'] = $this->admin_model->get_resturant_list();
        $data['label_list'] = $this->admin_model->get_label_list();
        $data['dish'] = $this->admin_model->get_dish_data($id);

        $this->load->view('admin/layout/header');
        $this->load->view('admin/food/edit_food_dish',$data);
        $this->load->view('admin/layout/footer');
    }
    public function add_food_dish()
    {
        checkLogin();

        if($this->input->post())
        {
            $this->admin_model->add_food_dish_data($_POST);
            redirect('admin/food_dish_list');
        }
        $data['category_list'] = $this->admin_model->get_food_type_list();
        $data['rest_list'] = $this->admin_model->get_resturant_list();
        $data['label_list'] = $this->admin_model->get_label_list();

        $this->load->view('admin/layout/header');
        $this->load->view('admin/food/add_food_dish',$data);
        $this->load->view('admin/layout/footer');
    }
    public function food_dish_list()
    {
        checkLogin();

        $data['dish_list'] = $this->admin_model->get_food_dish_list();

        $this->load->view('admin/layout/header');
        $this->load->view('admin/food/food_dish_list',$data);
        $this->load->view('admin/layout/footer');
    }
    public function delete_resturant()
    {
        checkLogin();

        $result = $this->admin_model->delete_resturant($this->input->get('id'));
        $this->session->set_flashdata('success', $result['message']);
        redirect('admin/resturant_list');
    }
    public function add_resturant()
    {
        checkLogin();

        if($this->input->post())
        {
            $this->admin_model->add_resturant_data($_POST);
            redirect('admin/resturant_list');
        }
        $data['category_list'] = $this->admin_model->get_food_type_list();

        $this->load->view('admin/layout/header');
        $this->load->view('admin/food/add_resturant',$data);
        $this->load->view('admin/layout/footer');
    }
    public function edit_resturant()
    {   
        checkLogin();

        $id = $this->input->get('id');

        if($this->input->post())
        {   
            $this->admin_model->edit_resturant_data($_POST);
            redirect('admin/resturant_list');
        }
        $data['category_list'] = $this->admin_model->get_food_type_list();
        $data['rest'] = $this->admin_model->get_resturant_data($id);
        $data['rest_timing'] = $this->admin_model->resturant_timing($id);
       // p($data['rest_timing']);
        $this->load->view('admin/layout/header');
        $this->load->view('admin/food/edit_resturant',$data);
        $this->load->view('admin/layout/footer');
    }
    public function resturant_list()
    {
        checkLogin();

        $data['rest_list'] = $this->admin_model->get_resturant_list();

        $this->load->view('admin/layout/header');
        $this->load->view('admin/food/resturant_list',$data);
        $this->load->view('admin/layout/footer');

    }

    public function delete_label()
    {
        checkLogin();

        $result = $this->admin_model->delete_label($this->input->get('id'));
        $this->session->set_flashdata('success', $result['message']);
        redirect('admin/label_list');
    }
    public function edit_label_color()
    {
        checkLogin();

        if($this->input->post())
        {
            $this->admin_model->edit_label_color($_POST);
            redirect('admin/label_list');   
        }
    }
    public function add_label_color()
    {
        checkLogin();

        if($this->input->post())
        {
            $this->admin_model->add_label_color($_POST);
            redirect('admin/label_list');
        }
    }
    public function label_list()
    {
        checkLogin();

        $data['label_list'] = $this->admin_model->get_label_list();

        $this->load->view('admin/layout/header');
        $this->load->view('admin/food/label_list',$data);
        $this->load->view('admin/layout/footer');

    }
    public function delete_food_type()
    {
        checkLogin();

        $result = $this->admin_model->delete_food_type($this->input->get('id'));
        $this->session->set_flashdata('success', $result['message']);
        redirect('admin/food_type_list');
    }

    public function add_food_type()
    {
        checkLogin();

        if($this->input->post())
        {
            $this->admin_model->add_food_type($_POST);
            redirect('admin/food_type_list');
        }
    }

    public function edit_food_type()
    {
        checkLogin();

        if($this->input->post())
        {
            $this->admin_model->edit_food_type($_POST);
            redirect('admin/food_type_list');
        }
    }
    public function dashboard()
    {
        checkLogin();

        $data['count'] = $this->admin_model->getDashboardStatistics();
       // $data['like_count'] = $this->admin_model->count_food_dish_like();

        $data['count_fooddishlikes'] = $this->admin_model->getDashboardStatisticsforfooddishlikes();
        $data['log_list'] = $this->admin_model->get_activity_log();
        
        
    	$this->load->view('admin/layout/header');
    	$this->load->view('admin/site/index',$data);
    	$this->load->view('admin/layout/footer');
    }
    
    public function food_type_list()
    {   
        checkLogin();

        $data['category_list'] = $this->admin_model->get_food_type_list();

        $this->load->view('admin/layout/header');
        $this->load->view('admin/food/category_list',$data);
        $this->load->view('admin/layout/footer');
    }
	public function index()
	{
		$this->load->library('form_validation');
    	
		$data = [];
      
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == false) 
        {
            //echo 'hiiiiiii';exit;

            $this->load->view('admin/site/login');
        } 
        else 
        {
           // echo 'hiiiiiii22222';
        	$username = $this->input->post('email');
            $password = $this->input->post('password');
            
            if($this->admin_model->resolve_admin_login($username, $password)) 
            {   
                $user_id = $this->admin_model->get_user_id_from_username($username);
                
                $user = $this->admin_model->get_user($user_id);
               
                $_SESSION['admin_id'] = (int) $user->id;
                $_SESSION['admin_username'] = (string) $user->name;
                $_SESSION['admin_email'] = (string) $user->email;
                $_SESSION['admin_roles'] = (string) $user->roles;
                $_SESSION['admin_logged_in'] = (bool) true;
                //p($_SESSION);

                $data_log = array(
                    'login_id'=>$_SESSION['admin_id'],
                    'description'=>"Admin Login success",
                    'created_at'=>date('Y-m-d H:i:s')
                    );
                $this->db->insert('activity_log',$data_log);
                
                redirect('admin/dashboard');
            
            }
            else 
            {
				$data['error'] = 'Wrong username or password.';
				
				$this->load->view('admin/site/login',$data);
               
            }
		}

		
		
	}
    public function logout()
    {
        checkLogin();
        logout();
        redirect('admin/index');
    }
}
