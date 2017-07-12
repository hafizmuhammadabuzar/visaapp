<div id="wrapper" class="login">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="LoginBox">  
                    <h1 class="page-header">Login</h1>
                    <?php echo $this->session->userdata('msg'); ?>
                    <form action="<?php echo base_url('admin/login'); ?>" method="post">
                        <div class="form-group">
                            <label>Username:</label>
                            <input type="text" name="username" required="required" />
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" name="password" required="required" />
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Log In">
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
