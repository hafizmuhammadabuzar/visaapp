<?php $method = $this->uri->segment(3); ?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url().'admin/dashboard' ?>">Admin - VISA APP</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?php echo base_url().'admin/logout' ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="<?php echo base_url().'admin/dashboard'; ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-cc-visa" aria-hidden="true"></i> Visa<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url().'admin/addVisa'; ?>" <?php if($method=='add_area') echo "class='active'" ?>>Add Visa</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'admin/viewVisas'; ?>" <?php if($method=='view_areas') echo "class='active'" ?>>View Visas</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-plane" aria-hidden="true"></i> On-Arrival / Restriction<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url().'admin/addAr'; ?>" <?php if($method=='addAr') echo "class='active'" ?>>Add New</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'admin/viewAR'; ?>" <?php if($method=='viewAr') echo "class='active'" ?>>View</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-globe" aria-hidden="true"></i> Country<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url().'admin/addCountry'; ?>" <?php if($method=='addCountry') echo "class='active'" ?>>Add Country</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'admin/viewCountry'; ?>" <?php if($method=='viewCountry') echo "class='active'" ?>>View Countries</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <!--<a href="<?php // echo base_url().'push_form'; ?>" <?php // if($method=='push_form') echo "class='active'" ?>><i class="fa fa-bell fa-fw"></i> Push Notification</a>-->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>