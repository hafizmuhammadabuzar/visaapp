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
                <?php $url = (isset($ar)) ? 'updateAr' : 'saveAr';
                echo $page = (isset($ar)) ? 'Edit' : 'New'; ?> On-Arrival/Restriction
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="<?php echo base_url().'admin/'.$url; ?>" method="post">
                            <div class="form-group">
                                <label>On-Arrival*</label>
                                <textarea cols="10" rows="10" class="form-control" name="arrival" required="required"><?php echo $ar->on_arrival; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Restriction*</label>
                                <textarea cols="10" rows="10" class="form-control" name="restriction" required="required"><?php echo $ar->restriction; ?></textarea>
                            </div>
                            <?php if(isset($ar)){ ?>
                            <input type="hidden" name="ar_id" value="<?php echo bin2hex($ar->id); ?>">
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
