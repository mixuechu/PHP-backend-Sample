<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function response($data){
    header('content-type:application/json');
    echo json_encode($data);
}

function getValidationError($form_validation){
    foreach ($form_validation->error_array() as $row){
        return $row;
    }
}
function checkToken($user_id){
    if($user_id==''){response(['status'=>0,'message'=>NO_USER]);exit;}
}