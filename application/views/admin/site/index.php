<style>
    .table td {
        font-size: 0.75rem !important;
        padding: 0.3rem !important;

    }
</style>

<div class="page-wrapper">


    <div class="container-fluid">

        <div class="row">

            <div class="col-md-6 col-lg">
                <div class="card card-hover">
                    <a href="<?php echo base_url(); ?>admin/users_list">
                        <div class="box bg-cyan text-center">
                            <h2 class="font-light text-white"><?php echo $count['userount']; ?></h2>
                            <h3 class="text-white"><i class="mdi mdi-account-multiple"></i>&nbsp;Users</h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg">
                <div class="card card-hover">
                    <a href="<?php echo base_url(); ?>admin/food_dish_list">
                        <div class="box bg-success text-center">
                            <h2 class="font-light text-white"><?php echo $count['foodcount']; ?></h2>
                            <h3 class="text-white"><i class="mdi mdi-food"></i>&nbsp;Food</h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg">
                <div class="card card-hover">
                    <a href="<?php echo base_url(); ?>admin/resturant_list">
                        <div class="box bg-warning text-center">
                            <h2 class="font-light text-white"><?php echo $count['restcount']; ?></h2>
                            <h3 class="text-white"><i class="mdi mdi-beach"></i>&nbsp;Restaurant</h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg">
                <div class="card card-hover">
                    <a href="<?php echo base_url(); ?>admin/label_list">
                        <div class="box bg-danger text-center">
                            <h2 class="font-light text-white"><?php echo $count['labelcount']; ?></h2>
                            <h3 class="text-white"><i class="mdi mdi-label"></i>&nbsp;Label</h3>
                        </div>
                    </a>
                </div>
            </div>

            
        
         <div class="col-md-6 col-lg">
                <div class="card card-hover">
                    <a href="<?php echo base_url(); ?>admin/food_dishes_like_report">
                        <div class="box bg-primary text-center">
                            <h2 class="font-light text-white"><?php echo $count_fooddishlikes; ?></h2>
                            <h3 class="text-white"><i class="mdi mdi-thumb-up"></i>&nbsp;Dishes Likes</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!--activity Log start-->
        <div class="card">

            <div class="col-md-12 ">
                <div class="card-body">
                    <h4 class="card-title">Activity Log</h4>
                </div>
                <div class="comment-widgets scrollable">
                    <div class="table-responsive">

                        <table id="zero_config" class="table table-striped table-bordered ">

                            <thead>

                                <tr>
                                    <th>Activity By</th>
                                    <th>Description</th>
                                    <th style="text-align: right;">Date</th>
                                </tr>

                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($log_list as $value) {
                                    ?>
                                <tr>

                                    <td><?php echo $value['staff_name']; ?></td>
                                    <td><?php echo $value['description']; ?></td>
                                    <td style="white-space: nowrap;text-align: right;"><?php echo date('d-m-Y H:i:s', strtotime($value['created_at'])); ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>

                            </tbody>
                            <tfoot>
                                <tr>

                                    <td colspan="3">
                                        <a href="<?php echo base_url(); ?>admin/activity_list" class="btn-sm btn-primary" style="float: right;">View More</a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>


        </div>
        <!--activity Log end-->


    </div>


</div>

</div> 