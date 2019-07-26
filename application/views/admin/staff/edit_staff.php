<?php 
$base_url = base_url();
$theme_url = $base_url.'assets/';
?>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>extra-libs/multicheck/multicheck.css">
    <link href="<?php echo $theme_url; ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- <link href="<?php echo $theme_url; ?>dist/css/style.min.css" rel="stylesheet"> -->


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
                        <h4 class="page-title">Edit staff</h4>
                        <div class="ml-auto text-right">
                        <a href="<?php echo base_url(); ?>admin/staff_list" class="btn btn-sm btn-primary"><i class="mr-2 mdi mdi-keyboard-backspace"></i>Back</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
            <div class="card">
                    <div class="row">
                        <div class="col-12 col-md-10 col-lg-8">
                            <div class="card-body">
                                <form method="post" action="edit_staff" enctype="multipart/form-data" class="needs-validation" novalidate>
                                
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Select category</label>
                                        <div class="col-sm-9">
                                            <select class="form-control " style="width: 100%; height:36px;" name="category_id" required="">
                                                <option value="">Select</option>
                                                <?php
                                                    foreach ($staff_category_list as $value) 
                                                    {
                                                    ?>
                                                    <option value="<?php echo $value['id']; ?>" <?php if($staff_data['category_id']==$value['id']){echo "selected";} ?>><?php echo $value['category_name']; ?></option>
                                                    <?php
                                                    }
                                                 ?>
                                            </select>
                                        </div>
                                    </div>  
                                
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" placeholder="Enter name"  value="<?php echo $staff_data['name']; ?>" required="">
                                            <input type="hidden" name="staff_id" value="<?php echo $staff_data['id'] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Email</label>
                                        <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control" placeholder="Enter email" required="" value="<?php echo $staff_data['email']; ?>">
                                            
                                        </div>
                                    </div>
                                   
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label"></label>
                                        <div class="col-sm-9">
                                            <input type="submit" name="add_staff" class="btn btn-primary" value="Update">
                                        </div>
                                    </div>
                                <form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-12">
                       
                        <div class="card">
                            <div class="card-body">
                                
                            <form method="post" action="edit_staff">
                                <div class="row">
                                    
                                        <div class="col-md-2">
                                            <label>Select category</label>
                                        </div>
                                        <div class="col-md-7">
                                            <select class="form-control" name="category_id">
                                                <option value="">--select--</option>
                                                <?php
                                                    foreach ($staff_category_list as $value) 
                                                    {
                                                    ?>
                                                    <option value="<?php echo $value['id']; ?>" <?php if($staff_data['category_id']==$value['id']){echo "selected";} ?>><?php echo $value['category_name']; ?></option>
                                                    <?php
                                                    }
                                                 ?>
                                            </select>
                                        </div>

                                </div>
                                <br>
                                <div class="row">
                                    
                                        <div class="col-md-2">
                                            <label>Name</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="name" class="form-control" placeholder="Enter name" value="<?php echo $staff_data['name']; ?>" >
                                            <input type="hidden" name="staff_id" value="<?php echo $staff_data['id'] ?>">
                                        </div>

                                </div>
                                <br>
                                <div class="row">
                                    
                                        <div class="col-md-2">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="email" class="form-control input-sm" placeholder="Enter email" value="<?php echo $staff_data['email']; ?>"> 
                                            <br><br>
                                        <input type="submit" name="edit_staff" class="btn-sm btn-primary" value="UPDATE">

                                        </div>

                                </div>
                                
                                
                            </form>                

                            </div>
                        </div>
                    </div>
                </div> -->
               
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