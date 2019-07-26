<?php 

$base_url = base_url();

$theme_url = $base_url.'assets/';

?>

    <!-- Custom CSS -->

    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>extra-libs/multicheck/multicheck.css">

    <link href="<?php echo $theme_url; ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>libs/select2/dist/css/select2.min.css">
    <style>
    .was-validated .form-control-file:invalid{
        color: #da542e;
    }
/*    .without_ampm::-webkit-datetime-edit-ampm-field {
   display: none;
 }
 input[type=time]::-webkit-clear-button {
   -webkit-appearance: none;
   -moz-appearance: none;
   -o-appearance: none;
   -ms-appearance:none;
   appearance: none;
   margin: -10px; 
 }*/
 /*input[type=time]::-webkit-datetime-edit-ampm-field {
  display: none;
}*/
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

                        <h4 class="page-title">Add Restaurant</h4>

                        <div class="ml-auto text-right">

                            <a href="<?php echo base_url(); ?>admin/resturant_list" class="btn btn-sm btn-primary"> <i class="mr-2 mdi mdi-keyboard-backspace"></i>Back</a>

                        </div>

                    </div>

                </div>

            </div>

            

            <div class="container-fluid">
                <div class="card ">
                    <div class="row">
                        <div class="col-12 col-md-10 col-lg-8">
                        <div class="card-body py-5">
                            <form method="post" action="add_resturant" enctype= multipart/form-data class="needs-validation" novalidate>

                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Restaurant Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="rest_name" class="form-control" placeholder="Enter resturant name"  required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Contact Number</label>
                                    <div class="col-sm-9">
                                    <input type="text" name="contact_no" class="form-control" placeholder="Enter contact number" required maxlength="10">
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Cuisine type</label>
                                    <div class="col-sm-9">
                                    <select class="select2 form-control m-t-15" multiple="multiple" name="food_type[]" required >
                                        <!-- <select class="form-control " style="width: 100%; height:36px;"  name="food_type" required> -->
                                        <!-- <optgroup label="Alaskan/Hawaiian Time Zone"> -->
                                                
                                            <!-- <option  value="">Select</option> -->
                                            <?php
                                                    foreach ($category_list as $value) 
                                                    {
                                                    ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                                    <?php
                                                    }
                                                 ?>
                                                 <!-- </optgroup> -->
                                        </select>
                                    </div>
                                </div>  

                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <textarea name="address" class="form-control" placeholder="Enter address" required></textarea>
                                    </div>
                                </div>      
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="description" class="form-control" placeholder="Enter description" required></textarea>
                                    </div>
                                </div>      
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Restaurant Timing</label>
                                    <div class="col-sm-9">
                                    <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                <th><b>Day</b></th>
                                                <th colspan="2" style="text-align: center;"><b>Morning Time</b></th>
                                                <th colspan="2" style="text-align: center;"><b>Evening Time</b></th>  
                                                </tr>
                                                <tr>
                                                      <td></td>
                                                      <td style="text-align: center;">OPEN</td>
                                                      <td style="text-align: center;">CLOSE</td>
                                                      <td style="text-align: center;">OPEN</td>
                                                      <td style="text-align: center;">CLOSE</td>
                                                      
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>MON<input type="hidden" name="day[1][daynm]" value="MON"></td>
                                                    <td>
                                                    <!-- <select name="day[1][mor_open_time]" class="w-100 form-control">
                                                        <option value="00">00</option>
                                                         <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[1][mor_open_time]">
                                                    </td>
                                                    <td>
                                                    <!-- <select name="day[1][mor_close_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                       <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php
                                                       }
                                                        ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[1][mor_close_time]">
                                                    </td>
                                                    <td>
                                                    <!-- <select name="day[1][eve_open_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                         <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[1][eve_open_time]">
                                                    </td>
                                                    <td>
                                                    <!-- <select name="day[1][eve_close_time]" class="w-100 form-control">
                                                        <option value="00">00</option>
                                                       <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php
                                                       }
                                                        ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[1][eve_close_time]">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>TUE<input type="hidden" name="day[2][daynm]" value="TUE"></td>
                                                    <td>
                                                    <!-- <select name="day[2][mor_open_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                         <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[2][mor_open_time]">
                                                    </td>
                                                    <td>
                                                    <!-- <select name="day[2][mor_close_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                       <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php
                                                       }
                                                        ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[2][mor_close_time]">
                                                    </td>
                                                    <td>
                                                    <!-- <select name="day[2][eve_open_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                         <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[2][eve_open_time]">
                                                    </td>
                                                    <td>
                                                    <!-- <select name="day[2][eve_close_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                       <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php
                                                       }
                                                        ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[2][eve_close_time]">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>WED<input type="hidden" name="day[3][daynm]" value="WED"></td>
                                                    <td>
                                                    <!-- <select name="day[3][mor_open_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                         <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[3][mor_open_time]">
                                                    </td>
                                                    <td>
                                                 <!--    <select name="day[3][mor_close_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                       <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php
                                                       }
                                                        ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[3][mor_close_time]">
                                                    </td>
                                                    <td>
                                                    <!-- <select name="day[3][eve_open_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                         <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[3][eve_open_time]">
                                                    </td>
                                                    <td>
                                                    <!-- <select name="day[3][eve_close_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                       <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php
                                                       }
                                                        ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[3][eve_close_time]">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>THU<input type="hidden" name="day[4][daynm]" value="THU"></td>
                                                    <td>
                                                    <!-- <select name="day[4][mor_open_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                         <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[4][mor_open_time]">
                                                    </td>
                                                    <td>
                                                   <!--  <select name="day[4][mor_close_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                       <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php
                                                       }
                                                        ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[4][mor_close_time]">
                                                    </td>
                                                    <td>
                                                   <!--  <select name="day[4][eve_open_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                         <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[4][eve_open_time]">
                                                    </td>
                                                    <td>
                                                    <!-- <select name="day[4][eve_close_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                       <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php
                                                       }
                                                        ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[4][eve_close_time]">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>FRI<input type="hidden" name="day[5][daynm]" value="FRI"></td>
                                                    <td>
                                                    <!-- <select name="day[5][mor_open_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                         <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[5][mor_open_time]">
                                                    </td>
                                                    <td>
                                                <!--     <select name="day[5][mor_close_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                       <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php
                                                       }
                                                        ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[5][mor_close_time]">
                                                    </td>
                                                    <td>
                                                   <!--  <select name="day[5][eve_open_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                         <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[5][eve_open_time]">
                                                    </td>
                                                    <td>
                                                   <!--  <select name="day[5][eve_close_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                       <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php
                                                       }
                                                        ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[5][eve_close_time]">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>SAT<input type="hidden" name="day[6][daynm]" value="SAT"></td>
                                                    <td>
                                                    <!-- <select name="day[6][mor_open_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                         <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[6][mor_open_time]">
                                                    </td>
                                                    <td>
                                                    <!-- <select name="day[6][mor_close_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                       <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php
                                                       }
                                                        ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[6][mor_close_time]">
                                                    </td>
                                                    <td>
                                                    <!-- <select name="day[6][eve_open_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                         <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[6][eve_open_time]">
                                                    </td>
                                                    <td>
                                                    <!-- <select name="day[6][eve_close_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                       <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php
                                                       }
                                                        ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[6][eve_close_time]">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>SUN<input type="hidden" name="day[7][daynm]" value="SUN"></td>
                                                    <td>
                                                    <!-- <select name="day[7][mor_open_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                         <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[7][mor_open_time]">
                                                    </td>
                                                    <td>
                                                   <!--  <select name="day[7][mor_close_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                       <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php
                                                       }
                                                        ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[7][mor_close_time]">
                                                    </td>
                                                    <td>
                                                    <!-- <select name="day[7][eve_open_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                         <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php } ?>
                                                        
                                                    </select> -->
                                                     <input type="time" class="form-control w-100 without_ampm" name="day[7][eve_open_time]">
                                                    </td>
                                                    <td>
                                                    <!-- <select name="day[7][eve_close_time]" class="w-100 form-control">
                                                    <option value="00">00</option>
                                                       <?php 
                                                       for ($i=1; $i <= 12; $i++) 
                                                       { 
                                                       ?>
                                                       <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                       <?php
                                                       }
                                                        ?>
                                                        
                                                    </select> -->
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[7][eve_close_time]">
                                                    </td>
                                                </tr>
                                            </tbody>
                                            
                                    </table>
                                    <!-- <input type="time" name="open_time" class="form-control time-inputmask" placeholder="Enter open time" required> -->
                                    </div>
                                </div>      
                                <!-- <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Close Time</label>
                                    <div class="col-sm-9">
                                    <input type="time" name="close_time" class="form-control time-inputmask" placeholder="Enter close time" required>
                                    </div>
                                </div>      --> 
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Profile Image</label>
                                    <div class="col-sm-9">
                                    <input type="file" name="profile_pic" class="form-control-file"  required style="display: inline;width: auto;">
                                    <span style="font-weight: 600;">Image size (98w x 98h)</span>
                                    </div>
                                </div>      
                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Background Image</label>
                                    <div class="col-sm-9">
                                    <input type="file" name="back_img[]" class="form-control-file"  required multiple style="display: inline;width: auto;">
                                    <span style="font-weight: 600;">Image size (480w x 200h)</span>
                                    </div>
                                </div>  

                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label"></label>
                                    <div class="col-sm-9">
                                    <input type="submit" name="add_rest" class="btn btn-primary" value="Add Resturant"  required>
                                    </div>
                                </div>  
                                    
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>


                <!-- <div class="row d-none">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <form method="post" action="add_resturant" enctype= multipart/form-data>

                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Restaurant Name</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="rest_name" class="form-control" placeholder="Enter Resturant" >
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-2">
                                            <label>Contact No</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="number" name="contact_no" class="form-control" placeholder="Enter Contact No" maxlength="10">
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-md-2">
                                         <label>Cuisine type</label>
                                        </div>
                                        <div class="col-md-7">
                                            <select class="form-control" name="food_type">
                                                <option value="">--SELECT--</option>
                                                <?php
                                                    foreach ($category_list as $value) 
                                                    {
                                                    ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                                    <?php
                                                    }
                                                 ?>
                                            </select>
                                        </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Address</label>
                                        </div>
                                        <div class="col-md-7">
                                           <textarea class="form-control" name="address" placeholder="Enter Address"></textarea>
                                        </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Description</label>
                                    </div>
                                    <div class="col-md-7">
                                        <textarea class="form-control" name="description" placeholder="Enter Description"></textarea>

                                        </div>



                                </div>

                                <br>

                                <div class="row">
                                        <div class="col-md-2">
                                            <label>Open Time</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="time" name="open_time" class="form-control" placeholder="Enter Restaurant" >
                                        </div>
                                </div>
                                <br>
                                <div class="row">
                                        <div class="col-md-2">
                                            <label>Close Time</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="time" name="close_time" class="form-control" placeholder="Enter Restaurant" >
                                        </div>
                                </div>
                                <br>
                                <div class="row">
                                        <div class="col-md-2">
                                           <label>Profile Image</label>
                                       </div>
                                       <div class="col-md-7">
                                            <input type="file" name="profile_pic" >
                                        </div>
                               </div>
                               <br>
                                <div class="row">
                                        <div class="col-md-2">
                                            <label>Background Image</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="file" name="back_img">
                                           
                                        </div>
                                </div>
                                <div class="row mt-4">
                                        <div class="col-md-2">
                                            <label>Background Image</label>
                                        </div>
                                        <div class="col-md-7 ">
                                            <input type="file" name="back_img">
                                            <br><br>
                                            <input type="submit" name="add_rest" class="btn btn-primary" value="Add Resturant">
                                        </div>
                                </div>

                            </form>                



                            </div>

                        </div>

                    </div>

                </div> -->

               

            <!-- </div> -->

            



        </div>

        

    </div>
  
     <script src="<?php echo $theme_url; ?>libs/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo $theme_url; ?>libs/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(".select2").select2({
            placeholder: "  Select cuisine types",
        });
    </script>
    <script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

    



</body>



</html>