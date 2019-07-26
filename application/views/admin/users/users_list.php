<?php 
$base_url = base_url();
$theme_url = $base_url.'assets/';
$admin_roles = explode(',',$_SESSION['admin_roles']);
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
                        <h3 class="page-title">Users</h3>
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
                                <!-- <h5 class="card-title">Basic Datatable</h5> -->
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Profile</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Location</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                           $i=1;
                                           foreach ($users as $key => $value) 
                                           {
                                           
                                           ?>
                                           <tr>
                                               <td><?php echo $i ?></td>
                                               <td><img src="<?php echo base_url(); ?>assets/uploads/images/user_profiles/<?php echo $value['profile_image']; ?>" height="100" width="100" style="border: 3px #dadada solid;"></td>
                                               <td><?php echo $value['name']; ?></td>
                                               <td><?php echo $value['mobile']; ?></td>
                                               <td><?php echo $value['location']; ?></td>
                                               <td>
                                                 <?php
                                               if (in_array("delete_users", $admin_roles))
                                               {
                                                 $action = '&nbsp;&nbsp;<a class="btn btn-sm btn-danger text-white" style="cursor:pointer;" onclick="var r=confirm(\'Are you sure want to delete this entry. \');if(r){window.location=\''.$base_url.'admin/delete_users?id='.$value['id'].'\';}" ><i class="mdi mdi-delete"></i>&nbsp;Delete</a>';

                                                 echo $action;
                                               }
                                                  ?>
                                               </td>
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