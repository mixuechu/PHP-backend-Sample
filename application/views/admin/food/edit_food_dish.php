<?php 

$base_url = base_url();

$theme_url = $base_url.'assets/';

?>

    <!-- Custom CSS -->

    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>extra-libs/multicheck/multicheck.css">

    <link href="<?php echo $theme_url; ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    




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

                        <h4 class="page-title">Edit Food dish</h4>

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

                        
                            <div class="card-body py-5">
                                <form method="post" action="edit_food_dish" enctype= multipart/form-data class="needs-validation" novalidate>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Select Restaurant</label>
                                        <div class="col-sm-9">
                                            <select class="form-control " style="width: 100%; height:36px;"  name="resturant_id" required>
                                                    <option  value="">Select</option>
                                                    <?php

                                                        foreach ($rest_list as $value) 

                                                        {

                                                        ?>

                                                        <option value="<?php echo $value['id']; ?>" <?php if($dish['restaurant_id'] == $value['id']){echo "selected";}else{echo "";} ?>><?php echo $value['name']; ?></option>

                                                        <?php

                                                        }

                                                        ?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dish_name" class="col-sm-3 text-right control-label col-form-label">Dish Name</label>
                                        <div class="col-sm-9">
                                        <input type="text" name="dish_name" class="form-control" placeholder="Enter Dish Name" value="<?php echo $dish['dish_name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="food_type" class="col-sm-3 text-right control-label col-form-label">Food Type</label>
                                        <div class="col-sm-9">
                                        <select class="form-control" name="food_type" id="food_type" required>
                                            <option value="">Select</option>
                                                
                                            <?php
                                            foreach ($category_list as $value) 
                                            {
                                            ?>
                                            <option value="<?php echo $value['id']; ?>" <?php if($dish['cuisine_type'] == $value['id']){echo "selected";}else{echo "";} ?>><?php echo $value['name']; ?></option>
                                            <?php
                                            }
                                            ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Dish Description</label>
                                        <div class="col-sm-9">
                                            <textarea name="dish_description" class="form-control" placeholder="Enter Discription" required><?php echo $dish['dish_description']; ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Dish price</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="dish_price" class="form-control" placeholder="Enter Enter price" value="<?php echo $dish['dish_price']; ?>" required>
                                    
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
                                                    <option value="<?php echo $row['id']; ?>" <?php if($dish['label_id'] == $row['id']){echo "selected";}else{echo "";} ?>><?php echo $row['description']; ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label  class="col-sm-3 text-right control-label col-form-label">Dish Image</label>
                                        <div class="col-sm-9">
                                        <input type="hidden" name="f_id" id="f_id" value="<?php echo $dish['id']; ?>">
                                        <input type="file" name="dish_img[]" class="form-control-file" multiple>
                                        <div class="d-flex flex-wrap align-items-center">
                                        <?php
                                            $new_arr = explode(',',$dish['dish_image']);
                                            foreach ($new_arr as $key => $val) 
                                            {
                                            ?>
                                        <!-- <input type="file" class="custom-file-input" id="dish_img" name="dish_img">
                                        <label class="custom-file-label" for="dish_img">Choose file</label> -->
                                        <input type="hidden" name="old_dish_img[]" value="<?php echo $val; ?>">
                                        <div class="mx-2 my-2 position-relative" >
                                            <img src="<?php echo base_url(); ?>assets/uploads/images/dish_image/<?php echo $val; ?>"  class="img-fluid" height="auto" width="160px">
                                            <span class="close_icon" onclick="del_img('<?php echo $val; ?>');">
                                                    <i class="mdi mdi-close-circle"></i>
                                                </span>
                                            </div>
                                        <?php } ?>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        
                                        <div class="col-sm-9 offset-sm-3 py-3">
                                        <input type="submit" name="add_rest" class="btn btn-primary"  value="Update Food Dish" >
                                    
                                        </div>
                                    </div>
                                


                                </form>
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

                        <!-- <div class="card">

                            <div class="card-body">

                                

                            <form method="post" action="edit_food_dish" enctype= multipart/form-data>

                                <div class="row">

                                    

                                        <div class="col-md-2">

                                            <label>Select Resturant</label>

                                        </div>

                                        <div class="col-md-7">

                                            <select class="form-control" name="resturant_id">

                                                <option value="">--SELECT--</option>

                                                <?php

                                                    foreach ($rest_list as $value) 

                                                    {

                                                    ?>

                                                    <option value="<?php echo $value['id']; ?>" <?php if($dish['restaurant_id'] == $value['id']){echo "selected";}else{echo "";} ?>><?php echo $value['name']; ?></option>

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

                                            <input type="text" name="dish_name" class="form-control" placeholder="Enter Dish Name" value="<?php echo $dish['dish_name']; ?>" >

                                            <input type="hidden" name="f_id" value="<?php echo $dish['id']; ?>">
                                            

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

                                                    <option value="<?php echo $value['id']; ?>" <?php if($dish['cuisine_type'] == $value['id']){echo "selected";}else{echo "";} ?>><?php echo $value['name']; ?></option>

                                                    <?php

                                                    }

                                                 ?>

                                            </select>

                                        </div>



                                </div>

                                <br>

                                <div class="row">

                                    

                                        <div class="col-md-2">

                                            <label>Dish Discription</label>

                                        </div>

                                        <div class="col-md-7">

                                           <textarea class="form-control" name="dish_description" placeholder="Enter Discription"><?php echo $dish['dish_description']; ?></textarea>

                                        </div>



                                </div>

                                <br>

                                <div class="row">

                                    

                                        <div class="col-md-2">

                                            <label>Dish Price</label>

                                        </div>

                                        <div class="col-md-7">

                                           <input type="text" name="dish_price" class="form-control" placeholder="Enter Price" value="<?php echo $dish['dish_price']; ?>">

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

                                    <option value="<?php echo $row['id']; ?>" <?php if($dish['label_id'] == $row['id']){echo "selected";}else{echo "";} ?>><?php echo $row['description']; ?></option>

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

                                            <input type="hidden" name="old_dish_img" value="<?php echo $dish['dish_image']; ?>">

                                            <img src="<?php echo base_url(); ?>assets/uploads/images/dish_image/<?php echo $dish['dish_image']; ?>" height="100" width="100">

                                            <br><br>

                                            <input type="submit" name="add_rest" class=" btn btn-primary" value="UPDATE">

                                        </div>



                                </div>

                            </form>                



                            </div>

                        </div> -->

                    </div>

                </div>

               

            </div>
            </div>

            
<!--start model-->

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

    

       <script>
       function del_img(img_name)
       {    
        var f_id = $('#f_id').val();
        var b_url = '<?php echo base_url(); ?>';

            $('#notify_model').modal('show');

            $('#yes_delete').click(function (){

                $.ajax({
                    type: "POST",
                    url: b_url + 'admin/delete_food_dish_img',
                    data: {
                        f_id : f_id,
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