<?php 
$base_url = base_url();
$theme_url = $base_url.'assets/';
$admin_roles = explode(',',$_SESSION['admin_roles']);
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
                        <h4 class="page-title">Food Dishes Likes Report</h4>
                        <div class="ml-auto text-right">
                        

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-12">
                        
                     
                       
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Dish image</th>
                                                <th>Dish Name</th>
                                                <th>Restaurant Name</th>
                                                <th>Total Likes</th>
                                                <!-- <th>Date</th> -->
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                           $i=1;
                                           foreach ($like_report as $key => $value) 
                                           {
                                                $dish_img = explode(',',$value['dish_image']);
                                           ?>
                                           <tr>
                                                <td><?php echo $i; ?></td>
                                               <td><img src="<?php echo base_url(); ?>assets/uploads/images/dish_image/<?php echo $dish_img[0]; ?>" height="80" width="80" style=" box-shadow: 0 0 6px 0px rgba(0, 0, 0, 0.5);object-fit: cover;object-position: center;"></td>
                                               <td><?php echo $value['dish_name']; ?></td>
                                               <td><?php echo $value['restaurant_name']; ?></td>
                                               <td><?php echo $value['total_likes']; ?></td>
                                               <!-- <td><?php echo date('d-m-Y',strtotime($value['created_at'])); ?></td> -->
                                               
                                               
                                           </tr>
                                           <?php
                                           $i++;
                                           }
                                            ?>
                                            
                                        </tbody>
                                        
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
            
          

        </div>
        
    </div>
    

    
   
   <script src="<?php echo $theme_url; ?>extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="<?php echo $theme_url; ?>extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="<?php echo $theme_url; ?>extra-libs/DataTables/datatables.min.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable({
              "pageLength": 50
            });
    </script>