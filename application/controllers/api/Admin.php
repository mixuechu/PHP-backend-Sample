<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

   

    public function __construct() {
        parent::__construct();
        $this->load->helper('generalapi_helper');
        $this->load->model('api/device_model');
        $this->load->model('api/admin_model');

    }
    public function logout()
    {
        response($this->admin_model->logout($this->input->post('user_token')));   
    }
    public function notification_list()
    {
        response($this->admin_model->notification_list());   
    }
    public function send_otp()
    {
        response($this->admin_model->send_otp());   
    }
    public function cuisine_type()
    {
        response($this->admin_model->get_cuisine_type());   
    }
    public function sign_up()
    {
        response($this->admin_model->sign_up());
    }
    public function login() {
        
        response($this->admin_model->login());
    }
    
    public function food_dish_list() 
    {
       response($this->admin_model->get_food_dish_list());
    }

    public function food_dish_detail() 
    {
       response($this->admin_model->get_food_dish_detail());
    }

    public function food_dish_like() 
    {
       response($this->admin_model->food_dish_like());
    }
    public function favourite_food_dish() 
    {
       response($this->admin_model->get_favourite_food_dish());
    }
    public function restaurant_detail() 
    {
       response($this->admin_model->get_restaurant_detail());
    }
    public function user_account() 
    {
       response($this->admin_model->get_user_account());
    }
    public function edit_user_account() 
    {
       response($this->admin_model->edit_user_account());
    }

}
?>