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
                        <h4 class="page-title">Staff category</h4>
                        <div class="ml-auto text-right">
                        <?php
                        if (in_array("add_notification", $admin_roles))
                        {
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
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                           $i=1;
                                           foreach ($notification_list as $key => $value) 
                                           {
                                            
                                           ?>
                                           <tr>
                                               <td><?php echo $i ?></td>
                                               <td><?php echo $value['title']; ?></td>
                                               <td><?php echo $value['description']; ?></td>
                                               
                                               <td><?php echo date('d-m-Y h:i:s',strtotime($value['created_at'])); ?></td>
                                               <td>
                                                 <?php
                                                if (in_array("delete_notification", $admin_roles))
                                                {
                                                 $action = '&nbsp;&nbsp;<a class="btn-sm btn-danger text-white" style="cursor:pointer;" onclick="var r=confirm(\'Are you sure want to delete this entry. \');if(r){window.location=\''.$base_url.'admin/delete_notification?id='.$value['id'].'\';}" ><i class="mdi mdi-delete"></i>&nbsp;Delete</a>';

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
            
            
    <!--start model-->
   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        <h4>Add Notification</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <form method="post" action="add_notification">
              <div class="row">
                  <div class="col-md-3">
                      <label>Title</label>
                  </div>
                  <div class="col-md-9">
                      <input type="text" name="title" class="form-control input-sm" placeholder="Enter title">
                      
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-3">
                      <label>Description</label>
                  </div>
                  <div class="col-md-9">
                      <textarea name="description" class="form-control input-sm" placeholder="Enter description"></textarea>
                      <br>
                      <input type="submit" name="add_notification" value="Add">
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
    
</body>

</html>