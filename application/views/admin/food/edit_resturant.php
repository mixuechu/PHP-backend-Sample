<?php 
$base_url = base_url();
$theme_url = $base_url.'assets/';
?>
<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>extra-libs/multicheck/multicheck.css">
<link href="<?php echo $theme_url; ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
<link href="<?php echo $theme_url; ?>dist/css/style.min.css" rel="stylesheet">

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
                    <h4 class="page-title">Edit Restaurant</h4>
                    <div class="ml-auto text-right">
                    <a href="<?php echo base_url(); ?>admin/resturant_list" class="btn btn-sm btn-primary"><i class="mr-2 mdi mdi-keyboard-backspace"></i>Back</a>
                </div>
            </div>
        </div>
     </div>
<div class="container-fluid">

            <div class="card ">
                <div class="row">
                    <div class="col-12 col-md-10 col-lg-8">
                        <div class="card-body py-5">
                            <form method="post" action="edit_resturant" enctype= multipart/form-data class="needs-validation" novalidate>
                            
                                <div class="form-group row">
                                    <label class="col-lg-3 text-lg-right text-leftcontrol-label col-form-label">Restaurant Name</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="rest_name" class="form-control" placeholder="Enter Resturant" value="<?php echo $rest['name']; ?>" required>
                                        <input type="hidden" name="r_id" id="r_id" value="<?php echo $rest['id']; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 text-lg-right text-leftcontrol-label col-form-label">Contact Number</label>
                                    <div class="col-lg-9">
                                    <input type="text" name="contact_no" class="form-control" placeholder="Enter contact number" value="<?php echo $rest['contact_no']; ?>"  required>
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 text-lg-right text-leftcontrol-label col-form-label">Cuisine type</label>
                                    <div class="col-lg-9">
                                        <select class="form-control " style="width: 100%; height:36px;"  name="food_type" required>
                                            <option  value="">Select</option>
                                            <?php
                                                    foreach ($category_list as $value) 
                                                    {
                                                    ?>
                                                    <option value="<?php echo $value['id']; ?>" <?php if($rest['food_type']==$value['id']){echo "selected";}else{echo "";} ?>><?php echo $value['name']; ?></option>
                                                    <?php
                                                    }
                                                 ?>
                                        </select>
                                    </div>
                                </div>  

                                <div class="form-group row">
                                    <label class="col-lg-3 text-lg-right text-leftcontrol-label col-form-label">Address</label>
                                    <div class="col-lg-9">
                                        <textarea name="address" class="form-control" placeholder="Enter Address" required><?php echo $rest['address'] ?></textarea>
                                    </div>
                                </div>      
                                <div class="form-group row">
                                    <label class="col-lg-3 text-lg-right text-leftcontrol-label col-form-label">Description</label>
                                    <div class="col-lg-9">
                                        <textarea name="description" class="form-control" placeholder="Enter Address" required><?php echo $rest['description'] ?></textarea>
                                    </div>
                                </div>      
                                <div class="form-group row">
                                    <label class="col-lg-3 text-lg-right text-leftcontrol-label col-form-label">Restaurant Timing</label>
                                    <div class="col-lg-9">
                                    <!-- <input type="time" name="open_time" class="form-control time-inputmask" placeholder="Enter Open time" value="<?php echo $rest['open_time']; ?>" required> -->
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
                                               
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[1][mor_open_time]" value="<?php if(isset($rest_timing[0]['mor_open_time']) && (!empty($rest_timing[0]['mor_open_time']))){echo $rest_timing[0]['mor_open_time'];}else{echo "";} ?>">
                                                    <input type="hidden" name="day[1][rest_time_id]" value="<?php if(isset($rest_timing[0]['id']) && (!empty($rest_timing[0]['id']))){echo $rest_timing[0]['id'];}else{echo "";} ?>">
                                                    </td>
                                                    <td>
                                            
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[1][mor_close_time]" value="<?php if(isset($rest_timing[0]['mor_close_time']) && (!empty($rest_timing[0]['mor_close_time']))){echo $rest_timing[0]['mor_close_time'];}else{echo "";} ?>">

                                                    </td>
                                                    <td>
                                                
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[1][eve_open_time]" value="<?php if(isset($rest_timing[0]['eve_open_time']) && (!empty($rest_timing[0]['eve_open_time']))){echo $rest_timing[0]['eve_open_time'];}else{echo "";} ?>">
                                                    </td>
                                                    <td>
                                                 
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[1][eve_close_time]" value="<?php if(isset($rest_timing[0]['eve_close_time']) && (!empty($rest_timing[0]['eve_close_time']))){echo $rest_timing[0]['eve_close_time'];}else{echo "";} ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>TUE<input type="hidden" name="day[2][daynm]" value="TUE"></td>
                                                    <td>
                                                 
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[2][mor_open_time]" value="<?php if(isset($rest_timing[1]['mor_open_time']) && (!empty($rest_timing[1]['mor_open_time']))){echo $rest_timing[1]['mor_open_time'];}else{echo "";} ?>">
                                                    <input type="hidden" name="day[2][rest_time_id]" value="<?php if(isset($rest_timing[1]['id']) && (!empty($rest_timing[1]['id']))){echo $rest_timing[1]['id'];}else{echo "";} ?>">
                                                    </td>
                                                    <td>
                                               
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[2][mor_close_time]" value="<?php if(isset($rest_timing[1]['mor_close_time']) && (!empty($rest_timing[1]['mor_close_time']))){echo $rest_timing[1]['mor_close_time'];}else{echo "";} ?>">
                                                    </td>
                                                    <td>
                                                
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[2][eve_open_time]" value="<?php if(isset($rest_timing[1]['eve_open_time']) && (!empty($rest_timing[1]['eve_open_time']))){echo $rest_timing[1]['eve_open_time'];}else{echo "";} ?>">
                                                    </td>
                                                    <td>
                                              
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[2][eve_close_time]" value="<?php if(isset($rest_timing[1]['eve_close_time']) && (!empty($rest_timing[1]['eve_close_time']))){echo $rest_timing[1]['eve_close_time'];}else{echo "";} ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>WED<input type="hidden" name="day[3][daynm]" value="WED"></td>
                                                    <td>
                                          
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[3][mor_open_time]" value="<?php if(isset($rest_timing[2]['mor_open_time']) && (!empty($rest_timing[2]['mor_open_time']))){echo $rest_timing[2]['mor_open_time'];}else{echo "";} ?>">

                                                    <input type="hidden" name="day[3][rest_time_id]" value="<?php if(isset($rest_timing[2]['id']) && (!empty($rest_timing[2]['id']))){echo $rest_timing[2]['id'];}else{echo "";} ?>">

                                                    </td>
                                                    <td>
                                          
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[3][mor_close_time]" value="<?php if(isset($rest_timing[2]['mor_close_time']) && (!empty($rest_timing[2]['mor_close_time']))){echo $rest_timing[2]['mor_close_time'];}else{echo "";} ?>">
                                                    </td>
                                                    <td>
                                             
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[3][eve_open_time]" value="<?php if(isset($rest_timing[2]['eve_open_time']) && (!empty($rest_timing[2]['eve_open_time']))){echo $rest_timing[2]['eve_open_time'];}else{echo "";} ?>">
                                                    </td>
                                                    <td>
                                             
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[3][eve_close_time]" value="<?php if(isset($rest_timing[2]['eve_close_time']) && (!empty($rest_timing[2]['eve_close_time']))){echo $rest_timing[2]['eve_close_time'];}else{echo "";} ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>THU<input type="hidden" name="day[4][daynm]" value="THU"></td>
                                                    <td>
                                                   
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[4][mor_open_time]" value="<?php if(isset($rest_timing[3]['mor_open_time']) && (!empty($rest_timing[3]['mor_open_time']))){echo $rest_timing[3]['mor_open_time'];}else{echo "";} ?>">

                                                    <input type="hidden" name="day[4][rest_time_id]" value="<?php if(isset($rest_timing[3]['id']) && (!empty($rest_timing[3]['id']))){echo $rest_timing[3]['id'];}else{echo "";} ?>">

                                                    </td>
                                                    <td>
                                             
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[4][mor_close_time]" value="<?php if(isset($rest_timing[3]['mor_close_time']) && (!empty($rest_timing[3]['mor_close_time']))){echo $rest_timing[3]['mor_close_time'];}else{echo "";} ?>">
                                                    </td>
                                                    <td>
                                            
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[4][eve_open_time]" value="<?php if(isset($rest_timing[3]['eve_open_time']) && (!empty($rest_timing[3]['eve_open_time']))){echo $rest_timing[3]['eve_open_time'];}else{echo "";} ?>">
                                                    </td>
                                                    <td>
                                             
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[4][eve_close_time]" value="<?php if(isset($rest_timing[3]['eve_close_time']) && (!empty($rest_timing[3]['eve_close_time']))){echo $rest_timing[3]['eve_close_time'];}else{echo "";} ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>FRI<input type="hidden" name="day[5][daynm]" value="FRI"></td>
                                                    <td>
                                          
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[5][mor_open_time]" value="<?php if(isset($rest_timing[4]['mor_open_time']) && (!empty($rest_timing[4]['mor_open_time']))){echo $rest_timing[4]['mor_open_time'];}else{echo "";} ?>">

                                                     <input type="hidden" name="day[5][rest_time_id]" value="<?php if(isset($rest_timing[4]['id']) && (!empty($rest_timing[4]['id']))){echo $rest_timing[4]['id'];}else{echo "";} ?>">

                                                    </td>
                                                    <td>
                                               
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[5][mor_close_time]" value="<?php if(isset($rest_timing[4]['mor_close_time']) && (!empty($rest_timing[4]['mor_close_time']))){echo $rest_timing[4]['mor_close_time'];}else{echo "";} ?>">
                                                    </td>
                                                    <td>
                                                 
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[5][eve_open_time]" value="<?php if(isset($rest_timing[4]['eve_open_time']) && (!empty($rest_timing[4]['eve_open_time']))){echo $rest_timing[4]['eve_open_time'];}else{echo "";} ?>"
>
                                                    </td>
                                                    <td>
                                             
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[5][eve_close_time]" value="<?php if(isset($rest_timing[4]['eve_close_time']) && (!empty($rest_timing[4]['eve_close_time']))){echo $rest_timing[4]['eve_close_time'];}else{echo "";} ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>SAT<input type="hidden" name="day[6][daynm]" value="SAT"></td>
                                                    <td>
                                            
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[6][mor_open_time]" value="<?php if(isset($rest_timing[5]['mor_open_time']) && (!empty($rest_timing[5]['mor_open_time']))){echo $rest_timing[5]['mor_open_time'];}else{echo "";} ?>">

                                                    <input type="hidden" name="day[6][rest_time_id]" value="<?php if(isset($rest_timing[5]['id']) && (!empty($rest_timing[5]['id']))){echo $rest_timing[5]['id'];}else{echo "";} ?>">

                                                    </td>
                                                    <td>
                                               
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[6][mor_close_time]" value="<?php if(isset($rest_timing[5]['mor_close_time']) && (!empty($rest_timing[5]['mor_close_time']))){echo $rest_timing[5]['mor_close_time'];}else{echo "";} ?>">
                                                    </td>
                                                    <td>
                                             
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[6][eve_open_time]" value="<?php if(isset($rest_timing[5]['eve_open_time']) && (!empty($rest_timing[5]['eve_open_time']))){echo $rest_timing[5]['eve_open_time'];}else{echo "";} ?>"
>
                                                    </td>
                                                    <td>
                                                
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[6][eve_close_time]" value="<?php if(isset($rest_timing[5]['eve_close_time']) && (!empty($rest_timing[5]['eve_close_time']))){echo $rest_timing[5]['eve_close_time'];}else{echo "";} ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>SUN<input type="hidden" name="day[7][daynm]" value="SUN"></td>
                                                    <td>
                                                  
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[7][mor_open_time]" value="<?php if(isset($rest_timing[6]['mor_open_time']) && (!empty($rest_timing[6]['mor_open_time']))){echo $rest_timing[6]['mor_open_time'];}else{echo "";} ?>">

                                                    <input type="hidden" name="day[7][rest_time_id]" value="<?php if(isset($rest_timing[6]['id']) && (!empty($rest_timing[6]['id']))){echo $rest_timing[6]['id'];}else{echo "";} ?>">

                                                    </td>
                                                    <td>
                                                 
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[7][mor_close_time]" 
                                                    value="<?php if(isset($rest_timing[6]['mor_close_time']) && (!empty($rest_timing[6]['mor_close_time']))){echo $rest_timing[6]['mor_close_time'];}else{echo "";} ?>">
                                                    </td>
                                                    <td>
                                                  
                                                     <input type="time" class="form-control w-100 without_ampm" name="day[7][eve_open_time]" value="<?php if(isset($rest_timing[6]['eve_open_time']) && (!empty($rest_timing[6]['eve_open_time']))){echo $rest_timing[6]['eve_open_time'];}else{echo "";} ?>">
                                                    </td>
                                                    <td>
                                               
                                                    <input type="time" class="form-control w-100 without_ampm" name="day[7][eve_close_time]" value="<?php if(isset($rest_timing[6]['eve_close_time']) && (!empty($rest_timing[6]['eve_close_time']))){echo $rest_timing[6]['eve_close_time'];}else{echo "";} ?>">
                                                    </td>
                                                </tr>
                                            </tbody>
                                    </table>

                                    </div>
                                </div>      
                                



                                <div class="form-group row">
                                    <label class="col-lg-3 text-lg-right text-leftcontrol-label col-form-label">Profile Image</label>
                                    <div class="col-lg-9">
                                        <input type="file" name="profile_pic" class="form-control-file"  required>
                                        <div class="m-3">
                                            <img src="<?php echo base_url(); ?>assets/uploads/images/profile/<?php echo $rest['profile_image']; ?>" class="img-fluid" height="auto" width="120px">
                                        </div>
                                        <input type="hidden" name="old_profile_img" value="<?php echo $rest['profile_image']; ?>">
                                    </div>
                                </div>      
                                <div class="form-group row">
                                    <label class="col-lg-3 text-lg-right text-leftcontrol-label col-form-label">Background Image</label>
                                    <div class="col-lg-9">
                                        <input type="file" name="back_img[]" class="form-control-file"  required multiple>
                                        <div class="d-flex flex-wrap align-items-center">
                                        <?php
                                            $new_img = explode(',', $rest['bg_image']);
                                            $i=0;
                                            foreach ($new_img as $key => $value) 
                                            {
                                            ?>

                                            <input type="hidden" name="old_back_img[]" value="<?php echo $value; ?>">
                                            <div class="mx-2 my-2 position-relative" >
                                                <img src="<?php echo base_url(); ?>assets/uploads/images/rest_background/<?php echo $value; ?>" class="img-fluid" height="auto" width="160px">
                                                <span class="close_icon" onclick="del_img('<?php echo $value; ?>');">
                                                    <i class="mdi mdi-close-circle"></i>
                                                </span>
                                            </div>
                             
                                            <?php
                                            $i++;
                                            }
                                         ?>
                                        </div>
                                    </div>
                                </div>  

                                <div class="form-group row">
                                    <label class="col-lg-3 text-lg-right text-leftcontrol-label col-form-label"></label>
                                    <div class="col-lg-9">
                                    <input type="submit" name="add_rest" class="btn btn-primary" value="Update Resturant" >
                                    </div>
                                </div>  
                                    
                            
                            </form>
                        </div>
                    </div>
                </div>
                <style>
                   span.close_icon {
                        position: absolute;
                        top: 0px;
                        display: block;
                        right: 5px;
                        padding: 0;
                        color: #fff;
                        font-size: 16px;
                    }
                </style>
                


<div id="notify_model" class="modal fade" role="dialog" style="margin-top: 150px;">
  <div class="modal-dialog" style="width: 350px;">

    <div class="modal-content">

      <div class="modal-body">
        <p style="font-size: 14px;">Are You sure want to delete this image.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="yes_delete">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>

  </div>
</div>
<!--end model-->  

            </div>

            



        </div>

        

    </div>

    

   <script>
       function del_img(img_name)
       {    
        var re_id = $('#r_id').val();
        var b_url = '<?php echo base_url(); ?>';

            $('#notify_model').modal('show');

            $('#yes_delete').click(function (){

                $.ajax({
                    type: "POST",
                    url: b_url + 'admin/delete_background_img',
                    data: {
                        re_id : re_id,
                        img_name : img_name
                    },

                    success: function (response) 
                    {
                        
                        location.reload();
                    }
                  });

            })
       }
   </script> 



</body>



</html>