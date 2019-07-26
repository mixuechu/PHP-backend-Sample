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

                        <h4 class="page-title">Food Dish Detail</h4>

                        <div class="ml-auto text-right">

                            <a href="<?php echo base_url(); ?>admin/food_dish_list" class="btn btn-sm btn-primary"><i class="mr-2 mdi mdi-keyboard-backspace"></i>Back</a>

                        </div>

                    </div>

                </div>

            </div>

            

            <div class="container-fluid">
                <div class="card">
                    <div class="row">
                        <div class="col-12 col-md-10 col-lg-8">


                            <div class="card-body ">
                                
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3  control-label col-form-label">Dish name</label>
                                        <div class="col-sm-9">
                                            <?php echo $food_detail['dish_name']; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dish_name" class="col-sm-3  control-label col-form-label">Dish price</label>
                                        <div class="col-sm-9">
                                            <?php echo $food_detail['dish_price']; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="food_type" class="col-sm-3  control-label col-form-label">Cuisine type</label>
                                        <div class="col-sm-9">
                                            <?php echo $food_detail['cuisine_type']; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3  control-label col-form-label">Label</label>
                                        <div class="col-sm-9">
                                           <?php echo $food_detail['label']; ?>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3  control-label col-form-label">Dish description</label>
                                        <div class="col-sm-9">
                                            <?php echo $food_detail['dish_description']; ?>
                                    
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-3  control-label col-form-label">Restaurant name</label>
                                        <div class="col-sm-9">
                                             <a href="<?php echo base_url(); ?>admin/view_restaurant_detail?id=<?php echo $food_detail['restaurant_id'];  ?>" style="text-decoration: none;"><?php echo $food_detail['restaurant_name']; ?></a>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label  class="col-sm-3 control-label col-form-label">Total likes</label>
                                        <div class="col-sm-9">
                                            <?php echo $food_detail['total_likes']; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label  class="col-sm-3  control-label col-form-label">Dish Image</label>
                                        <div class="col-sm-9">
                                        <div class="d-flex flex-wrap align-items-center">
                                        <?php
                                            $new_arr = explode(',',$food_detail['dish_image']);
                                            foreach ($new_arr as $key => $val) 
                                            {
                                            ?>
                                            <div class="mx-2 my-2 position-relative" >
                                            <img src="<?php echo base_url(); ?>assets/uploads/images/dish_image/<?php echo $val; ?>" class="img-fluid" height="100" width="160" style=" box-shadow: 0 0 6px 0px rgba(0, 0, 0, 0.5);object-fit: cover;object-position: center;">
                                            
                                            </div>
                                            
                                            <?php
                                            }
                                         ?>
                                         </div>
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