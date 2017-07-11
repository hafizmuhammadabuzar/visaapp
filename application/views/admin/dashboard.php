<div id="wrapper">

    <!-- Navigation -->
    <?php include 'navigation.php'; ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
                
                <div class="row">
                	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mobilefull">
                    	<div class="BoderBox">
                            <h4>Fridge</h4>
                            <img src="<?php echo base_url(); ?>assets/dashboard/dist/images/fridge.png" class="img-responsive" alt="Fridge" />
						<p><?php echo $total->fridges; ?></p>
						</div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mobilefull">
                    	<div class="BoderBox">
                            <h4>Area Manager</h4>
                            <img src="<?php echo base_url(); ?>assets/dashboard/dist/images/areamanager.png" class="img-responsive" alt="Area Manager" />
						<p><?php echo $total->amanagers; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mobilefull">
                    	<div class="BoderBox">
                            <h4>Zone Manger</h4>
                            <img src="<?php echo base_url(); ?>assets/dashboard/dist/images/zone-manager.png" class="img-responsive" alt="Zone Manger" />
						<p><?php echo $total->zmanagers; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 mobilefull">
                    	<div class="BoderBox">
                            <h4>Users</h4>
                            <img src="<?php echo base_url(); ?>assets/dashboard/dist/images/users.png" class="img-responsive" alt="Users" />
    					<p><?php echo $total->users; ?></p>
                        </div>
					</div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
