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
                <?php $url = (isset($country)) ? 'updateCountry' : 'saveCountry';
                echo $page = (isset($country)) ? 'Edit' : 'New'; ?> Country
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="<?php echo base_url().'admin/'.$url; ?>" method="post">
                            <div class="form-group">
                                <label>Country Name*</label>
                                <input class="form-control" name="country" value="<?php echo $country->country_name; ?>" required="required">
                            </div>
                            <?php if(isset($country)){ ?>
                            <input type="hidden" name="country_id" value="<?php echo bin2hex($country->id); ?>">
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
