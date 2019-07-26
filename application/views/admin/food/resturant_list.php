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

                        <h4 class="page-title">Restaurants</h4>

                        <div class="ml-auto text-right">
                          <?php
                          if (in_array("add_resturant", $admin_roles)){
                        ?>
                            <a href="<?php echo base_url(); ?>admin/add_resturant" class="btn btn-primary"><i class="mdi mdi-plus-circle mr-2"></i>Add</a>
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
                                                
                                                <th>Image</th>

                                                <th>Name</th>

                                                <th>Description</th>

                                                <th>Contact No</th>

                                                <!-- <th>Open Time</th>

                                                <th>Close Time</th> -->

                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                           <?php

                                           $i=1;

                                           foreach ($rest_list as $key => $value) 

                                           {

                                           ?>

                                           <tr>

                                               <td><?php echo $i ?></td>

                                               <td><img src="<?php echo base_url(); ?>assets/uploads/images/profile/<?php echo $value['profile_image']; ?>" height="80" width="80" style=" box-shadow: 0 0 6px 0px rgba(0, 0, 0, 0.5);object-fit: cover;object-position: center;"></td>

                                               <td><?php echo $value['name']; ?></td>

                                               <td><?php echo $value['description']; ?></td>

                                               <td><?php echo $value['contact_no']; ?></td>

                                               <!-- <td><?php echo $value['open_time']; ?></td>

                                               <td><?php echo $value['close_time']; ?></td> -->

                                               <td style="white-space: nowrap;">

                                                 <?php

                                                 if (in_array("view_restaurant_detail", $admin_roles))
                                                 {

                                                $action = '<a href="'.$base_url.'admin/view_restaurant_detail?id='.$value['id'].'" class="btn-sm btn btn-success"><i class="mdi mdi-eye"></i></a>';

                                                  echo $action;
                                                }

                                                if (in_array("edit_resturant", $admin_roles))
                                                 {

                                                 $action_ed = '&nbsp;&nbsp;<a href="'.$base_url.'admin/edit_resturant?id='.$value['id'].'" class="btn-sm btn btn-primary edt_dailog" data-id="'.$value['id'].'" data-name="'.$value['name'].'" ><i class="mdi mdi-grease-pencil"></i></a>';

                                                 echo $action_ed;

                                                }
                                                if (in_array("delete_resturant", $admin_roles))
                                                 {
                                                 $action_del = '&nbsp;&nbsp;<a class="btn-sm btn btn-danger text-white" style="cursor:pointer;" onclick="var r=confirm(\'Are you sure want to delete this entry. \');if(r){window.location=\''.$base_url.'admin/delete_resturant?id='.$value['id'].'\';}" ><i class="mdi mdi-delete"></i></a>';
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

            



        </div>

        

    </div>

    

    <script>

      $(document).on("click", ".edt_dailog", function () {

      

        var f_id = $(this).data('id');

        var name = $(this).data('name');

     

        $(".modal-body #f_id").val( f_id );

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


</body>



</html>