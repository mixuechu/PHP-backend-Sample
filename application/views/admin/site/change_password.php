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

                        <h4 class="page-title">Change Password</h4>

                        <div class="ml-auto text-right">

                            

                        </div>

                    </div>

                </div>

            </div>

            

            <div class="container-fluid">
                <div class="card ">
                    <div class="row">
                        <div class="col-12 col-md-10 col-lg-8">
                        <div class="card-body py-5">
                            <form method="post" action="change_password" enctype= multipart/form-data class="needs-validation" novalidate>

                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input id="new_password" type="password" name="new_password" placeholder="Enter Password" data-validate-length="8" class="form-control col-md-7 col-xs-12" required="required" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Confirm Password</label>
                                    <div class="col-sm-9">
                                    <input id="confirm_password" type="password" name="confirm_password" placeholder="Enter Password" data-validate-length="8" class="form-control col-md-7 col-xs-12" required="required" onkeyup="checkPasswordMatch();" autocomplete="off">

                                    <span id="divCheckPasswordMatch" style="color: red;font-size: 13px;"></span>
                                        
                                    </div>
                                </div>
 
                               

                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label"></label>
                                    <div class="col-sm-9">
                                    <input type="submit" name="change_pass" id="change_pass" class="btn btn-primary" value="CHANGE"  required disabled>
                                    </div>
                                </div>  
                                    
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        

    </div>
  
     <script src="<?php echo $theme_url; ?>libs/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo $theme_url; ?>libs/select2/dist/js/select2.min.js"></script>
  

<script type="text/javascript">
    function checkPasswordMatch() {
    var password = $("#new_password").val();
    var confirmPassword = $("#confirm_password").val();

    if (password != confirmPassword)
    {
        $("#divCheckPasswordMatch").html("Passwords do not match!");
        //$('#change_pass').attr('disabled','disabled');
      }
    else{
        $("#divCheckPasswordMatch").html("");
        $('#change_pass').removeAttr('disabled','disabled');
      }
}

$(document).ready(function () {
   $("#txtConfirmPassword").keyup(checkPasswordMatch);
});
</script>
    



</body>



</html>