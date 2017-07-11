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
                <?php $url = (isset($manager)) ? 'update_manager' : 'save_manager'; 
                echo $page = (isset($manager)) ? 'Edit' : 'New'; ?> Manager
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="<?php echo base_url().'admin/'.$url; ?>" method="post">
                            <div class="form-group">
                                <label>Name *</label>
                                <input class="form-control" name="username" value="<?php echo $manager->name; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Email *</label>
                                <input class="form-control" name="email" value="<?php echo $manager->email; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Password <?php if(!isset($manager)){ echo '*'; }?></label>
                                <input type="password" class="form-control" name="password" value="" <?php if(!isset($manager)){echo "required='required'";} ?>>
                            </div>    
                            <div class="form-group">
                                <label>Mobile *</label>
                                <input class="form-control" name="mobile" value="<?php echo $manager->mobile; ?>" required="required">
                            </div>                         
                            <div class="form-group">
                                <label>Polygon*</label>
                                <textarea id="polygon" name="polygon" class="form-control" rows="5" placeholder="Latitude <space> Longitude, Latiude <space> Longitude" required='required'><?php echo $manager->polygon; ?></textarea>
                            </div>
                            
                            <!--<div class="field-wrap polygon-main">
                                <h4>Add Polygon</h4>
                                <a href="#" style="display: block; margin: 0 0 10px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add more</a>
                                <div id="polygon-clone">
                                    <input class="form-control" name="polygon[]" id="polygon" required="required">
                                    <i class="fa fa-times clone-remove" aria-hidden="true"></i>
                                </div>										
                            </div>-->
                            <?php if(isset($manager)){ ?>
                            <input type="hidden" name="manager_id" value="<?php echo bin2hex($manager->manager_id); ?>">
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

<!--<script type="text/javascript">
    $(document).ready(function () {
        
        $('.polygon-main a').click(function (e) {
            e.preventDefault();
            $("#polygon-clone:last").clone().find("input:text").val("").end().appendTo(".polygon-main");
        });
        $(document).on("click", ".clone-remove", function (e) {
            if ($('div[id^=polygon]').length > 1) {
                $(this).closest('#polygon-clone').remove();
            } else {
                $('#polygon').val('');
            }
        });
    });
</script>-->
