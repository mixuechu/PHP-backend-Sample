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

                        <h4 class="page-title">Add Food Dish</h4>

                        <div class="ml-auto text-right">

                            <a href="<?php echo base_url(); ?>admin/view_restaurant_detail?id=<?php echo $_GET['id']; ?>" class="btn btn-sm btn-primary"><i class="mr-2 mdi mdi-keyboard-backspace"></i>Back</a>

                        </div>

                    </div>

                </div>

            </div>

            

            <div class="container-fluid">
                <div class="card">
                    <div class="row">
                        <div class="col-12 col-md-10 col-lg-8">


                            <div class="card-body py-5">
                                <form method="post" action="add_food_dish" enctype= multipart/form-data class="needs-validation" novalidate>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Restaurant</label>
                                        <div class="col-sm-9">
                                            <p style="padding-top: 8px;"><?php echo $res_name['name']; ?></p>
                                            <input type="hidden" name="resturant_id" value="<?php echo $_GET['id']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dish_name" class="col-sm-3 text-right control-label col-form-label">Dish Name</label>
                                        <div class="col-sm-9">
                                        <input type="text" name="dish_name" class="form-control" placeholder="Enter dish name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="food_type" class="col-sm-3 text-right control-label col-form-label">Select Food Type</label>
                                        <div class="col-sm-9">
                                        <select class="form-control" name="food_type" id="food_type" required>
                                            <option value="">Select</option>
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

                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Dish Description</label>
                                        <div class="col-sm-9">
                                            <textarea name="dish_description" class="form-control" placeholder="Enter discription" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Dish price</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="dish_price" class="form-control" placeholder="Enter dish price" required>
                                    
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Select Label</label>
                                        <div class="col-sm-9">
                                            <select class="form-control " style="width: 100%; height:36px;"  name="label_id" required>
                                                <option  value="">Select</option>
                                                        <?php
                                                            foreach ($label_list as $row) 
                                                            {
                                                            ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['description']; ?></option>
                                                            <?php
                                                            }
                                                        ?>
                                                </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label  class="col-sm-3 text-right control-label col-form-label">Dish Image</label>
                                        <div class="col-sm-9">
                                       <input type="file" name="dish_img[]" class="form-control-file " placeholder="Enter dish name" required multiple style="display: inline;width: auto;">
                                        <span style="font-weight: 600;">Image size (480w x 680h)</span>

                                
                                        <!-- <input type="file" class="custom-file-input" id="dish_img" name="dish_img">
                                        <label class="custom-file-label" for="dish_img">Choose file</label> -->
                                    
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        
                                        <div class="col-sm-9 offset-sm-3 py-3">
                                        <input type="submit" name="add_rest" class="btn btn-primary"  value="Add Food Dish" >
                                    
                                        </div>
                                    </div>
                                


                                </form>
                            </div>
                        </div>


                        <!-- <div class="card">
                            <div class="card-body">
                            <form method="post" action="add_food_dish" enctype= multipart/form-data>
                                <div class="row">
                                        <div class="col-md-2">
                                            <label>Select Restaurant</label>
                                        </div>
                                        <div class="col-md-7">
                                            <select class="form-control" name="resturant_id">
                                                <option value="">--SELECT--</option>
                                                <?php
                                                    foreach ($rest_list as $value) 
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
    
                                            <label>Dish Name</label>

                                        </div>

                                        <div class="col-md-7">

                                            <input type="text" name="dish_name" class="form-control" placeholder="Enter Dish Name" >

                                        </div>



                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Food Type</label>
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

                                            <label>Dish Description</label>

                                        </div>

                                        <div class="col-md-7">

                                           <textarea class="form-control" name="dish_description" placeholder="Enter Discription"></textarea>

                                        </div>



                                </div>

                                <br>

                                <div class="row">

                                    

                                        <div class="col-md-2">

                                            <label>Dish price</label>

                                        </div>

                                        <div class="col-md-7">

                                           <input type="text" name="dish_price" class="form-control" placeholder="Enter price">

                                        </div>



                                </div>

                                <br>

                                <div class="row">

                                    

                                        <div class="col-md-2">

                                            <label>Select Label</label>

                                        </div>

                                        <div class="col-md-7">

                                            <select class="form-control" name="label_id">

                                                <option>--SELECT--</option>

                                                <?php

                                                    foreach ($label_list as $row) 

                                                    {

                                                    ?>

                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['description']; ?></option>

                                                    <?php

                                                    }

                                                 ?>

                                            </select>

                                        </div>



                                </div>

                                <br>

                                <div class="row">
                                        <div class="col-md-2">

                                            <label>Dish Image</label>

                                        </div>

                                        <div class="col-md-7">

                                            <input type="file" name="dish_img">

                                            <br><br>

                                            <input type="submit" name="add_rest" class="btn btn-primary" value="ADD Food Dish">

                                        </div>



                                </div>

                            </form>                



                            </div>

                        </div> -->

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