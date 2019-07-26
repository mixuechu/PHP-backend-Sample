<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

   

    public function __construct() {
        parent::__construct();
        $this->load->helper('generalapi_helper');
        $this->load->model('api/device_model');
        $this->load->model('api/mumin_model');

    }
    public function give_feedback()
    {
        response($this->mumin_model->give_menu_feedback());
    }
    public function takhmeen_detail()
    {
        response($this->mumin_model->get_takhmeen_details());
    }
    public function payment_detail()
    {
        response($this->mumin_model->get_payment_details());
    }

    public function get_menu_for_feedback()
    {
        response($this->mumin_model->get_menu_for_feedback());   
    }

    public function notification_log() 
    {
       response($this->mumin_model->get_all_notification());
    }
    public function menu_list() 
    {
       response($this->mumin_model->get_all_menu_list());
    }
    public function login() {
        
        response($this->mumin_model->login());
    }
    public function stop_thali_request() 
    {
        response($this->mumin_model->stop_thali_req());
    }
    public function start_thali_request() 
    {
        response($this->mumin_model->start_thali_req());
    }
    public function center_change() 
    {
        response($this->mumin_model->center_change_req());
    }
    public function tifin_change() 
    {
        response($this->mumin_model->tifin_change_req());
    }

    

}
?>