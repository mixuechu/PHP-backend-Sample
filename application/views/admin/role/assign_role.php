<?php 
$base_url = base_url();
$theme_url = $base_url.'assets/';
$admin_roles = explode(',',$category_role);
//p($admin_roles);
?>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>extra-libs/multicheck/multicheck.css">
    <link href="<?php echo $theme_url; ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="<?php echo $theme_url; ?>dist/css/style.min.css" rel="stylesheet">

    <style>
    [sub-cat] + label{
        font-size: 16px;
    font-weight: 700;
    }
    
    </style>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    
    <div id="main-wrapper">
     
  
        <div class="page-wrapper">
        <div style="padding-top: 10px;">
            <?= alertWidget(validation_errors()); ?>
                    <?= alertWidget($this->session->flashdata('success'), 0); ?>
                    <?= alertWidget($this->session->flashdata('error')); ?>
                    <?php
                    if (isset($error)) {
                        echo alertWidget($error);
                    }
                    ?>
              </div>

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Assign Role</h4>
                        
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-12">
                       
                        <div class="card">
                            <div class="card-body">
                                
                            <form method="post" action="assign_role">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4 pb-4 pt-3">
                                        <label>Staff Category : <b><?php echo $category_name; ?></b></label>
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-12">
                                       
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="sel_all"  value="all">
                                            <label class="custom-control-label" for="sel_all" style="font-size:16px;font-weight: 700;" >Select All</label>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="col-md-3">
                                    <input type="hidden" name="category_id" value="<?php echo $_GET['id']; ?>" >

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input sub_cat" name="role[]"  id="sel_cusine_type" sub-cat="cusine"  value="food_type_list" <?php
                                                    if (in_array("food_type_list", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="sel_cusine_type" >Cuisine types</label>
                                        </div>
                                        <div class="ml-4" h-id="sel_cusine_type">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input cusine" name="role[]"  id="cusine1"  value="add_food_type" <?php
                                                    if (in_array("add_food_type", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="cusine1" >Add</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input cusine" name="role[]"  id="cusine2"  value="edit_food_type" <?php
                                                    if (in_array("edit_food_type", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="cusine2" >Edit</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input cusine" name="role[]"  id="cusine3"  value="delete_food_type" <?php
                                                    if (in_array("delete_food_type", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="cusine3" >Delete</label>
                                        </div>
                                        <!-- <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input cusine" name="role[]"  id="cusine4"  value="food_type_list">
                                            <label class="custom-control-label" for="cusine4" >List</label>
                                        </div> -->
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input sub_cat"  id="sel_label" name="role[]"  sub-cat="lbl" value="label_list" <?php
                                                    if (in_array("label_list", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="sel_label" >Labels</label>
                                        </div>
                                      
                                         <div class="ml-4" h-id="sel_label">
                                         <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input lbl" name="role[]"  id="lbl1"  value="add_label_color" <?php
                                                    if (in_array("add_label_color", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="lbl1" >Add</label>
                                        </div>
                                         <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input lbl" name="role[]"  id="lbl2"  value="edit_label_color" <?php
                                                    if (in_array("edit_label_color", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="lbl2" >Edit</label>
                                        </div>
                                         <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input lbl" name="role[]"  id="lbl3"  value="delete_label" <?php
                                                    if (in_array("delete_label", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="lbl3" >Delete</label>
                                        </div>
                                        
                                           
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                   
                                    <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input sub_cat"  sub-cat="rest" name="role[]"  id="sel_rest"  value="resturant_list" <?php
                                                    if (in_array("resturant_list", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="sel_rest" >Restaurants</label>
                                        </div>
                                        <div class="ml-4"  h-id="sel_rest">

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input rest" name="role[]"  id="rest1"  value="add_resturant" <?php
                                                    if (in_array("add_resturant", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="rest1" >Add</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input rest" name="role[]"  id="rest2"  value="edit_resturant" <?php
                                                    if (in_array("edit_resturant", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="rest2" >Edit</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input rest" name="role[]"  id="rest3"  value="delete_resturant" <?php
                                                    if (in_array("delete_resturant", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="rest3" >Delete</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input rest" name="role[]"  id="rest4"  value="view_restaurant_detail" <?php
                                                    if (in_array("view_restaurant_detail", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="rest4" >Detailview</label>
                                        </div>
                                          
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                    
                                    <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input sub_cat"  id="sel_food" name="role[]"  sub-cat="fds" value="food_dish_list" <?php
                                                    if (in_array("food_dish_list", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="sel_food" >Food dishes</label>
                                        </div>
                                        <div class="ml-4" h-id="sel_food">

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input fds" name="role[]"  id="fds1"  value="add_food_dish" <?php
                                                    if (in_array("add_food_dish", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="fds1" >Add</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input fds" name="role[]"  id="fds2"  value="edit_food_dish" <?php
                                                    if (in_array("edit_food_dish", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="fds2" >Edit</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input fds" name="role[]"  id="fds3"  value="delete_food_dish" <?php
                                                    if (in_array("delete_food_dish", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="fds3" >Delete</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input fds" name="role[]"  id="fds4"  value="view_food_dish_detail" <?php
                                                    if (in_array("view_food_dish_detail", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="fds4" >Detailview</label>
                                        </div>
                                          
                                        </div>
                                    </div>

                                    
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                    
                                    <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input sub_cat" sub-cat="usr" name="role[]" id="sel_usr" value="users_list" <?php
                                                    if (in_array("users_list", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="sel_usr">Users</label>
                                        </div>
                                        <div class="ml-4" h-id="sel_usr">
                                        
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input usr" name="role[]"  id="usr2" value="delete_users" <?php
                                                    if (in_array("delete_users", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="usr2">Delete</label>
                                        </div>
                                            
                                            
                                        </div>
                                    </div>

                                     <div class="col-md-3">
                                     <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input sub_cat" sub-cat="stc" name="role[]" id="stf_cat" value="staff_category_list" <?php
                                                    if (in_array("staff_category_list", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="stf_cat">Staff category</label>
                                        </div>
                                    

                                        <div  class="ml-4"  h-id="stf_cat">

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input stc" name="role[]" id="stc1" value="add_staff_category" <?php
                                                    if (in_array("add_staff_category", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="stc1">Add</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input stc" name="role[]" id="stc2" value="edit_staff_category" <?php
                                                    if (in_array("edit_staff_category", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="stc2">Edit</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input stc" name="role[]" id="stc3" value="delete_staff_category" <?php
                                                    if (in_array("delete_staff_category", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="stc3">Delete</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input stc" name="role[]" id="stc4" value="assign_role" <?php
                                                    if (in_array("assign_role", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="stc4">Manageroles</label>
                                        </div>
                                            
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                    <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input sub_cat" sub-cat="stf" name="role[]" id="sel_stf" value="staff_list" <?php
                                                    if (in_array("staff_list", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="sel_stf">Staff</label>
                                        </div>
                                   

                                    <div class="ml-4" h-id="sel_stf">
                                    <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input stf" name="role[]" id="stf1" value="add_staff" <?php
                                                    if (in_array("add_staff", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="stf1">Add</label>
                                        </div>
                                    <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input stf" name="role[]" id="stf2" value="edit_staff" <?php
                                                    if (in_array("edit_staff", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="stf2">Edit</label>
                                        </div>
                                    <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input stf" name="role[]" id="stf3" value="delete_staff" <?php
                                                    if (in_array("delete_staff", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="stf3">Delete</label>
                                        </div>
                                        
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input stf" name="role[]" id="stf4" value="staff_change_password" <?php
                                                    if (in_array("staff_change_password", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="stf4">Change Password</label>
                                        </div>

                                           
                                        </div>
                                    </div>

                                   <div class="col-md-3">
                                       <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input sub_cat" sub-cat="usr" name="role[]" id="sel_usr" value="notification_list" <?php
                                                    if (in_array("notification_list", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="sel_usr">Notification</label>
                                        </div>
                                        <div class="ml-4" h-id="sel_usr">
                                       
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input usr" name="role[]"  id="usr2" value="add_notification" <?php
                                                    if (in_array("add_notification", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="usr2">Add</label>
                                        </div>
                                         <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input stf" name="role[]" id="stf3" value="delete_notification" <?php
                                                    if (in_array("delete_notification", $admin_roles))
                                                    {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                            <label class="custom-control-label" for="stf3">Delete</label>
                                        </div>   
                                            
                                        </div>
                                   </div>


                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" name="assign" class="btn-sm btn-primary" value="Assign">
                                    </div>
                                </div>
                            </form>                

                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
            

        </div>
        
    </div>
    
    <script>
    
    $("#sel_all").click(function () {
            $("input[type='checkbox']").prop('checked', $(this).prop('checked'));
            // if(!$(this).prop('checked')){
            //     $("#sel_all+ label").text("Select All");
            // }else{
            //     $("#sel_all+ label").text("Deselect All");
            // }
    });
    $(".sub_cat").click(function () {
        var el = $(this).attr("sub-cat");
            $("."+el).prop('checked', $(this).prop('checked'));
    });
    $("input[name='role[]']").on("click",function(){
    //console.log($(this).parent().parent().attr("h-id"));
    var t = $('#'+$(this).parent().parent().attr("h-id")).attr("sub-cat");
    //console.log(t);
    //console.log("l :"+ checkitem(t));
    
    if(checkitem(t)){
        //console.log("if" + $(this).prop('checked'));
        $('#'+$(this).parent().parent().attr("h-id")).prop('checked', true);
    }else{
        // $('#'+$(this).parent().parent().attr("h-id")).prop('indeterminate', false);
        $('#'+$(this).parent().parent().attr("h-id")).prop('checked', false);
        //console.log("else"+ $(this).prop('checked'));
    }
    
    });
    
    function checkitem(cl){
        var n,m;
        $("."+cl).each(function(){
            if($(this).prop('checked')){
                m = true;
            }
            else{
               n = true;
            }
        });
        if(m ){
            return true;
        }
        else{
            return false;
        }
        

    }
    
    
    
    </script>

