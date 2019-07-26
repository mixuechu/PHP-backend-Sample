<?php 
$base_url = base_url();
$theme_url = $base_url.'assets/';
$admin_roles = explode(',',$_SESSION['admin_roles']);

?>

    <!-- Custom CSS -->

    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>extra-libs/multicheck/multicheck.css">

    <link href="<?php echo $theme_url; ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
<!-- 
    <link href="<?php echo $theme_url; ?>dist/css/style.min.css" rel="stylesheet"> -->



    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/js/bootstrap-colorpicker.min.js"></script> 





    <div class="preloader">

        <div class="lds-ripple">

            <div class="lds-pos"></div>

            <div class="lds-pos"></div>

        </div>

    </div>

   

    <div id="main-wrapper">

     

  <!--start model-->

   <div class="modal fade" id="edit_label" role="dialog">

    <div class="modal-dialog">

    

      <!-- Modal content-->

      <div class="modal-content">

        <div class="modal-header">

        <h4>Edit Label</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          

        </div>

        <div class="modal-body">

          <form method="post" action="edit_label_color">

              <div class="row">

                  <div class="col-md-3">

                      <label>Select Color</label>

                  </div>

                  <div class="col-md-8">

                      <input type="text" name="ed_l_color" id="ed_l_color" value="" class="form-control input-sm" placeholder="Enter type name" autocomplete="off">

                      <input type="hidden" name="l_id" id="ed_l_id" value="">

                  

                  </div>

                  <div class="col-md-1" id="set_color">

                    

                  </div>

              </div>

              <br>

              <div class="row">

                  <div class="col-md-3">

                      <label>Description</label>

                  </div>

                  <div class="col-md-9">

                      <input type="text" name="ed_l_desc" id="ed_l_desc" value="" class="form-control input-sm" placeholder="Enter description">

                      

                      <br>

                      <input type="submit" name="edit_label" class="btn btn-sm btn-primary" value="ADD">

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

                        <h4 class="page-title">Labels</h4>

                        <div class="ml-auto text-right">
                          <?php
                          if (in_array("add_label_color", $admin_roles)){
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

                                                <th>Color</th>

                                                <th>Description</th>

                                                <th>Date</th>

                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                           <?php

                                           $i=1;

                                           foreach ($label_list as $key => $value) 

                                           {

                                            $color =$value['color'];

                                           ?>

                                           <tr>

                                               <td><?php echo $i ?></td>

                                               <td><?php echo $value['color']; ?><span <?php echo 'style="background-color:'.$color.';height:10px;width:10px;margin-left:20px;" '?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>

                                               <td><?php echo $value['description']; ?></td>

                                               <td><?php echo date('d-m-Y h:i:s',strtotime($value['created_at'])); ?></td>

                                               <td>

                                                 <?php

                                               if (in_array("edit_label_color", $admin_roles))
                                               {

                                                 $action = '<a href="#" class="btn btn-sm btn-primary edt_dailog" data-toggle="modal" data-target="#edit_label" data-id="'.$value['id'].'" data-color="'.$value['color'].'" data-description="'.$value['description'].'" ><i class="mdi mdi-grease-pencil"></i>&nbsp;Edit</a>';

                                                 echo $action;


                                               }
                                               if (in_array("delete_label", $admin_roles))
                                               {
                                                 $action_del = '&nbsp;&nbsp;<a class="btn btn-sm btn-danger text-white" style="cursor:pointer;" onclick="var r=confirm(\'Are you sure want to delete this entry. \');if(r){window.location=\''.$base_url.'admin/delete_label?id='.$value['id'].'\';}" ><i class="mdi mdi-delete"></i>&nbsp;Delete</a>';

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

        <h4>Add Label</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          

        </div>

        <div class="modal-body">

          <form method="post" action="add_label_color">

              <div class="row">

                  <div class="col-md-3">

                      <label>Select Color</label>

                  </div>

                  <div class="col-md-9">

                      <input type="text" name="l_color"  value="" id="color" class="form-control input-sm" placeholder="Enter type name" readonly style="background-color: #fff;">

                      

                  

                  </div>

              </div>

              <br>

              <div class="row">

                  <div class="col-md-3">

                      <label>Description</label>

                  </div>

                  <div class="col-md-9">

                      <input type="text" name="description"  value="" class="form-control input-sm" placeholder="Enter description">

                      

                      <br>

                      <input type="submit" name="edit_label" class="btn-sm btn-primary" value="ADD">

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

    $('#color').colorpicker({});

    $('#ed_l_color').colorpicker({});

    

</script> 



    <script>

      $(document).on("click", ".edt_dailog", function () {

      

        var l_id = $(this).data('id');

        var color = $(this).data('color');

        var description = $(this).data('description');

        

        $('#set_color').css('background-color', color);



        $(".modal-body #ed_l_id").val( l_id );

        $(".modal-body #ed_l_color").val( color );

        $(".modal-body #ed_l_desc").val( description );



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