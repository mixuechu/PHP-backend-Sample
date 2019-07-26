<?php 

$base_url = base_url();

$theme_url = $base_url.'assets/';

?>

    <!-- Custom CSS -->

    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>extra-libs/multicheck/multicheck.css">

    <link href="<?php echo $theme_url; ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

   
    <style>
    .was-validated .form-control-file:invalid{
        color: #da542e;
    }
    span.close_icon 
    {
        position: absolute;
        top: 0px;
        display: block;
        right: 5px;
        padding: 0;
        color: #fff;
        font-size: 16px;
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

                        <h4 class="page-title">Restaurant Detail</h4>

                        <div class="ml-auto text-right">

                            <a href="<?php echo base_url(); ?>admin/resturant_list" class="btn btn-sm btn-primary"><i class="mr-2 mdi mdi-keyboard-backspace"></i>Back</a>

                            <a href="<?php echo base_url(); ?>admin/add_restaurant_food_dish?id=<?php echo $rest_detail['id']; ?>" class="btn btn-sm btn-success"><i class="mdi mdi-plus-circle mr-2"></i>Add Food Dish</a>

                            <a href="<?php echo base_url(); ?>admin/restaturant_food_dish_list?id=<?php echo $rest_detail['id']; ?>" class="btn btn-sm btn-info"><i class="mdi mdi-view-list mr-2"></i>Food Dish List</a>

                        </div>

                    </div>

                </div>

            </div>

            

            <div class="container-fluid">
                <div class="card">
                    <div class="row">
                        <div class="col-12 col-md-10 col-lg-8">


                            <div class="card-body py-7">
                               
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3  control-label col-form-label">Name</label>
                                        <div class="col-sm-9">
                                           <?php echo $rest_detail['name']; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dish_name" class="col-sm-3  control-label col-form-label">Cuisine Type</label>
                                        <div class="col-sm-9">
                                            <?php echo $rest_detail['food_type_name']; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="food_type" class="col-sm-3  control-label col-form-label">Description</label>
                                        <div class="col-sm-9">
                                        <?php echo $rest_detail['description']; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3  control-label col-form-label">Address</label>
                                        <div class="col-sm-9">
                                            <?php echo $rest_detail['address']; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label col-form-label">Restaurant Timing</label>
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
                                                <?php
                                                foreach ($rest_time as $val2) 
                                                {
                                                ?>

                                                <tr>
                                                    <td><?php echo $val2['day']; ?></td>
                                                    <td><?php echo $val2['mor_open_time']; ?></td>
                                                    <td><?php echo $val2['mor_close_time']; ?></td>
                                                    <td><?php echo $val2['eve_open_time']; ?></td>
                                                    <td><?php echo $val2['eve_close_time']; ?></td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                                
                                            </tbody>
                                            
                                    </table>

                                    
                                        </div>
                                    </div>


                                  <!--   <div class="form-group row">
                                        <label class="col-sm-3  control-label col-form-label">Close Time</label>
                                        <div class="col-sm-9">
                                            <?php echo $rest_detail['close_time']; ?>
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                        <label  class="col-sm-3 control-label col-form-label">Profile Image</label>
                                        <div class="col-sm-9">
                                            <img src="<?php echo base_url(); ?>assets/uploads/images/profile/<?php echo $rest_detail['profile_image']; ?>" height="100" width="100" style=" box-shadow: 0 0 6px 0px rgba(0, 0, 0, 0.5);object-fit: cover;object-position: center;">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label  class="col-sm-3 control-label col-form-label">Background Image</label>
                                        <div class="col-sm-9">
                                        <div class="d-flex flex-wrap align-items-center">
                                        <?php
                                            $new_img = explode(',',$rest_detail['bg_image']);
                                            foreach ($new_img as $key => $value) 
                                            {
                                                ?>
                                            <div class="mx-2 my-2 position-relative" >
                                             <img src="<?php echo base_url(); ?>assets/uploads/images/rest_background/<?php echo $value; ?>" height="80" width="140" style=" box-shadow: 0 0 6px 0px rgba(0, 0, 0, 0.5);object-fit: cover;object-position: center;">
                                            </div>
                                                    
                                           <?php
                                            }
                                         ?>

                                            
                                        </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label  class="col-sm-3  control-label col-form-label">Created At</label>
                                        <div class="col-sm-9">
                                            <?php echo date('Y-m-d h:i:s',strtotime($rest_detail['created_at'])); ?>
                                        </div>
                                    </div>

                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    
    

   
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