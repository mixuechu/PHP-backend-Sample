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
     
  <!--start model-->
   <div class="modal fade" id="edit_category" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h4>Edit Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <form method="post" action="edit_staff_category">
              <div class="row">
                  <div class="col-md-3">
                      <label>Category name</label>
                  </div>
                  <div class="col-md-8">
                      <input type="text" name="ed_category_name" id="ed_category_name" value="" class="form-control input-sm" placeholder="Enter category name" autocomplete="off">
                      <input type="hidden" name="category_id" id="ed_category_id" value="">
                      <br>
                      <input type="submit" name="edit_category" class="btn-sm btn-primary" value="UPDATE">
                  </div>
                  
              </div>
              
          </form>
        </div>
        
      </div>
      
    </div>
  </div>
    <!--end model-->

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
                        <h4 class="page-title">Staff category</h4>
                        <div class="ml-auto text-right">
                         <?php
                          if (in_array("add_staff_category", $admin_roles)){
                          ?>

                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="mdi mdi-plus-circle mr-2"></i>Add</a>
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
                                                <th>Category name</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                           $i=1;
                                           foreach ($staff_list as $key => $value) 
                                           {
                                            
                                           ?>
                                           <tr>
                                               <td><?php echo $i ?></td>
                                               <td><?php echo $value['category_name']; ?></td>
                                               
                                               <td><?php echo date('d-m-Y h:i:s',strtotime($value['created_at'])); ?></td>
                                               <td>
                                                 <?php
                                                 if (in_array("assign_role", $admin_roles))
                                                 {
                                                  $action = '<a href="'.base_url().'admin/assign_role?id='.$value['id'].'" class="btn-sm btn-success"><i class="mdi mdi-settings"></i>&nbsp;Manage Roles</a>';

                                                  echo $action;
                                                  }
                                                  if (in_array("edit_staff_category", $admin_roles))
                                                  {
                                                  $action_ed = '&nbsp;&nbsp;<a href="#" class="btn btn-sm btn-primary edt_dailog" data-toggle="modal" data-target="#edit_category" data-id="'.$value['id'].'" data-category_name="'.$value['category_name'].'"><i class="mdi mdi-grease-pencil"></i>&nbsp;Edit</a>';

                                                    echo $action_ed;
                                                  }
                                                  if (in_array("delete_staff_category", $admin_roles))
                                                  {
                                                    $action_del = '&nbsp;&nbsp;<a class="btn btn-sm btn-danger text-white" style="cursor:pointer;" onclick="var r=confirm(\'Are you sure want to delete this entry. \');if(r){window.location=\''.$base_url.'admin/delete_staff_category?id='.$value['id'].'\';}" ><i class="mdi mdi-delete"></i>&nbsp;Delete</a>';

                                                   echo $action_del;
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
            
            
    <!--start model-->
   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h4>Add Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <form method="post" action="add_staff_category">
              <div class="row">
                  <div class="col-md-3">
                      <label>Category Name</label>
                  </div>
                  <div class="col-md-9">
                      <input type="text" name="category_name"  value=""  class="form-control input-sm" placeholder="Enter category name">
                      <br>
                      <input type="submit" name="add_cat" class="btn-sm btn-primary" value="ADD">
                  
                  </div>
              </div>
              

          </form>
        </div>
        
      </div>
      
    </div>
  </div>
    <!--end model-->

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