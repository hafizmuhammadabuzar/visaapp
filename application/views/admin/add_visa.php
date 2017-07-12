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
                <?php $url = (isset($visa)) ? 'updateVisa' : 'saveVisa';
                echo $page = (isset($visa)) ? 'Edit' : 'New'; ?> Visa
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="<?php echo base_url().'admin/'.$url; ?>" method="post">
                            <div class="form-group">
                                <label>Days*</label>
                                <input class="form-control" name="days" value="<?php echo $visa->days; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Type*</label>
                                <input class="form-control" name="type" value="<?php echo $visa->type; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Price*</label>
                                <input class="form-control" name="price" value="<?php echo $visa->price; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Description*</label>
                                <textarea cols="10" rows="10" class="form-control" name="description" value="<?php echo $visa->description; ?>" required="required"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Steps*</label>
                                <textarea cols="10" rows="10" class="form-control" name="steps" value="<?php echo $visa->steps; ?>" required="required"></textarea>
                            </div>
                            <?php if(isset($visa)){ ?>
                            <input type="hidden" name="visa_id" value="<?php echo bin2hex($visa->id); ?>">
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
