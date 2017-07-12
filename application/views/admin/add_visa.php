<div id="wrapper">

    <!-- Navigation -->
    <?php include 'navigation.php'; ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <?php echo validation_errors(); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?php $url = (isset($visa)) ? 'update_visa' : 'save_visa';
                echo $page = (isset($visa)) ? 'Edit' : 'New'; ?> Visa
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="<?php echo base_url().'admin/'.$url; ?>" method="post">
                            <div class="form-group">
                                <label>Area Name*</label>
                                <input class="form-control" name="visa" value="<?php echo $visa->visa; ?>" required="required">
                            </div>                         
                            <div class="form-group">
                                <label>Polygon*</label>
                                <textvisa id="polygon" name="polygon" class="form-control" rows="5" placeholder="Latitude, Longitude <enter> Latitude, Longitude" required='required'><?php echo $visa->polygon; ?></textvisa>
                            </div>
                            <div class="form-group">
                                <?php 
                                $rest = ($visa->is_restricted == 1) ? 'checked="checked"' : ''; 
                                $unrest = ($visa->is_restricted == 0 || !isset($visa)) ? 'checked="checked"' : ''; 
                                ?>
                                <input type="radio" id="restricted" name="restricted" class="form-control" <?php echo $rest; ?> value="1">Restricted
                                <input type="radio" id="restricted" name="restricted" class="form-control" <?php echo $unrest; ?> value="0">Unrestricted
                            </div>
                            <?php if(isset($visa)){ ?>
                            <input type="hidden" name="visa_id" value="<?php echo bin2hex($visa->visa_id); ?>">
                            <?php } ?>
                            <br/>
                            <button type="submit" class="btn btn-default" name="add">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>

    </div>
    <!-- /#page-wrapper -->

</div><!-- /#wrapper -->
