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

    <!-- ============================================================== -->

    <!-- Main wrapper - style you can find in pages.scss -->

    <!-- ============================================================== -->

    <div id="main-wrapper">

     

  <!--start model-->

   <div class="modal fade" id="edit_category" role="dialog">

    <div class="modal-dialog">

    

      <!-- Modal content-->

      <div class="modal-content">

        <div class="modal-header">

        <h4>Edit Cuisine type</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          

        </div>

        <div class="modal-body">

          <form method="post" action="edit_food_type" enctype= multipart/form-data>

              <div class="row">

                  <div class="col-md-4">

                      <label>Type Name</label>

                  </div>

                  <div class="col-md-7">

                      <input type="text" name="food_type" id="f_name" value="" class="form-control input-sm" placeholder="Enter type name">

                      <input type="hidden" name="f_id" id="f_id" value="">

                      
                  </div>

              </div>
              <br>
              <div class="row">

                  <div class="col-md-4">

                      <label>Food type image</label>

                  </div>

                  <div class="col-md-7">

                      <input type="file" name="ed_food_type_image">
                      <br><br>
                      <input type="hidden" name="ed_food_img" id="ed_food_img_hidden" value="">

                      <img  height="80" width="140" id="ed_food_img" style=" box-shadow: 0 0 6px 0px rgba(0, 0, 0, 0.5);object-fit: cover;object-position: center;">  
                      <br><br>

                      <input type="submit" name="add_food" class="btn btn-sm btn-primary" value="ADD">

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

                        <h4 class="page-title">Cuisine types</h4>

                        <div class="ml-auto text-right">
                        <?php
                        if (in_array("add_food_type", $admin_roles)){
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

                                <!-- <h5 class="card-title">Basic Datatable</h5> -->

                                <div class="table-responsive">

                                    <table id="zero_config" class="table table-striped table-bordered">

                                        <thead>

                                            <tr>

                                                <th>#</th>
                                                
                                                <th>Image</th>

                                                <th>Type Name</th>

                                                <th>Date</th>

                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                           <?php

                                           $i=1;

                                           foreach ($category_list as $key => $value) 

                                           {

                                           ?>

                                           <tr>

                                               <td><?php echo $i ?></td>
                                               
                                               <td><img src="<?php echo base_url(); ?>assets/uploads/images/food_type_img/<?php echo $value['food_type_img']; ?>" height="80" width="140" style=" box-shadow: 0 0 6px 0px rgba(0, 0, 0, 0.5);object-fit: cover;object-position: center;" ></td>
                                              

                                               <td><?php echo $value['name']; ?></td>

                                               <td><?php echo date('d-m-Y h:i:s',strtotime($value['created_at'])); ?></td>

                                               <td>

                                                 <?php
                                                 
                                                if (in_array("edit_food_type", $admin_roles)){
                        
                                                 $action = '<a href="#" class="btn btn-sm btn-primary edt_dailog" data-toggle="modal" data-target="#edit_category" data-id="'.$value['id'].'" data-name="'.$value['name'].'" data-food_type_image ="'.$value['food_type_img'].'" ><i class="mdi mdi-grease-pencil"></i>&nbsp;Edit</a>';

                                                 echo $action;

                                                }

                                                if (in_array("delete_food_type", $admin_roles))
                                                {
                                                 $action_del = '&nbsp;&nbsp;<a class="btn btn-sm btn-danger text-white" style="cursor:pointer;" onclick="var r=confirm(\'Are you sure want to delete this entry. \');if(r){window.location=\''.$base_url.'admin/delete_food_type?id='.$value['id'].'\';}" ><i class="mdi mdi-delete"></i>&nbsp;Delete</a>';
                                                
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

        <h4>Add Cuisine type</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          

        </div>

        <div class="modal-body">

          <form method="post" action="add_food_type" enctype= multipart/form-data>

              <div class="row">

                  <div class="col-md-4">

                      <label>Type Name</label>

                  </div>

                  <div class="col-md-7">

                      <input type="text" name="food_type" class="form-control input-sm" placeholder="Enter type name">

                      

                  </div>

              </div>
              <br>
              <div class="row">

                  <div class="col-md-4">

                      <label>Food type Image</label>

                  </div>

                  <div class="col-md-7">

                      <input type="file" name="food_type_img">

                      <br><br>

                      <input type="submit" name="add_food" class="btn-sm btn-primary" value="ADD">

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

      

        var f_id = $(this).data('id');

        var name = $(this).data('name');

        var food_type_image = $(this).data('food_type_image'); 
        var b_url = "<?php echo base_url(); ?>";
        
        var full_src = b_url+"assets/uploads/images/food_type_img/"+food_type_image;

        $("#ed_food_img").attr("src", full_src);
        

        $(".modal-body #f_id").val( f_id );

        $(".modal-body #ed_food_img_hidden").val( food_type_image );
        
        $(".modal-body #f_name").val( name );



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