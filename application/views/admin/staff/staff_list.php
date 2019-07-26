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
                        <h4 class="page-title">Staff list</h4>
                        <div class="ml-auto text-right">
                        <?php
                          if (in_array("delete_users", $admin_roles))
                          {
                         ?>
                            <a href="<?php echo base_url(); ?>admin/add_staff" class="btn btn-primary"><i class="mdi mdi-plus-circle mr-2"></i>Add</a>
                        <?php } ?>

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
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                           $i=1;
                                           foreach ($staff_data as $key => $value) 
                                           {
                                            
                                           ?>
                                           <tr>
                                               <td><?php echo $i ?></td>
                                               <td><?php echo $value['name']; ?></td>
                                               <td><?php echo $value['email']; ?></td>
                                               <td><?php echo $value['role']; ?></td>
                                               
                                               <td><?php echo date('d-m-Y h:i:s',strtotime($value['created_at'])); ?></td>
                                               <td>
                                                 <?php
                                                 if (in_array("edit_staff", $admin_roles))
                                                  {
                                                    $action = '<a href="'.base_url().'admin/edit_staff?tk='.$value['staff_token'].'" class="btn btn-sm btn-primary edt_dailog"><i class="mdi mdi-grease-pencil"></i>&nbsp;Edit</a>';

                                                    echo $action;
                                                  }
                                                  if (in_array("edit_staff", $admin_roles))
                                                  {
                                                  $action_del = '&nbsp;&nbsp;<a class="btn btn-sm btn-danger text-white" style="cursor:pointer;" onclick="var r=confirm(\'Are you sure want to delete this entry. \');if(r){window.location=\''.$base_url.'admin/delete_staff?id='.$value['id'].'\';}" ><i class="mdi mdi-delete"></i>&nbsp;Delete</a>';
                                                    
                                                    echo $action_del;
                                                    
                                                  }
                                                  if (in_array("staff_change_password", $admin_roles))
                                                  {
                                                  $action_pass = '&nbsp;&nbsp;<a href="'.base_url().'admin/staff_change_password?st='.$value['staff_token'].'" class="btn btn-sm btn-success edt_dailog"><i class="mdi mdi-grease-key"></i>&nbsp;Change Password</a>';
                                                    
                                                    echo $action_pass;
                                                    
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
    

    <script>
      $(document).on("click", ".edt_dailog", function () {
      
        var category_id = $(this).data('id');
        var category_name = $(this).data('category_name');
        
        $(".modal-body #ed_category_id").val( category_id );
        $(".modal-body #ed_category_name").val( category_name );
        

      });

    </script>
   
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