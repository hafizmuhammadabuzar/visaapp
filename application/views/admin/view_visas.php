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
        <?php echo $this->session->userdata('msg');
        $this->session->unset_userdata('msg');
        ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                View Visas
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                                   id="dataTables-example" role="grid" aria-describedby="dataTables-example_info"
                                   style="width: 100%;" width="100%">
                                <thead>
                                    <tr role="row">
                                        <th>Days</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Steps</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

<?php foreach ($visas as $row): ?>
                                        <tr class="gradeA odd" role="row">
                                            <td><?php echo $row['days']; ?></td>
                                            <td><?php echo $row['type']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td><?php echo substr($row['description'], 0, 45).'...'; ?></td>
                                            <td><?php echo substr($row['steps'], 0, 45).'...'; ?></td>
                                            <td>
                                                <a href="<?php echo base_url() . 'admin/editVisa/' . bin2hex($row['id']); ?>" title="edit">
                                                    <i class="fa fa-edit"></i>
                                                </a> |
                                                <a href="<?php echo base_url() . 'admin/deleteVisa/' . bin2hex($row['id']); ?>" title="delete">
                                                    <i class="fa fa-remove" style="color: #880000"></i>
                                                </a>
                                            </td>
                                        </tr>
<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->

                        <!-- /.panel-body -->
                    </div>

                </div>
                <!-- /#page-wrapper -->

            </div><!-- /#wrapper -->