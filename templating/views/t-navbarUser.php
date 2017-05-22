<!-- START asdasd Header -->
<header id="header" class="navbar navbar-fixed-top">
    <div class="container">
        <!-- START navbar header -->
        <div class="navbar-header">
            <!-- Brand -->
            <a class="navbar-brand" href="javascript:void(0);">
                <span class="logo-figure" style="margin-left:-4px;"></span>
                <!-- <span class="logo-text"></span> -->
                <span>Neon</span>
            </a>
            <!--/ Brand -->
        </div>
        <!--/ END navbar header -->

        <!-- START Toolbar -->
        <div class="navbar-toolbar clearfix">
            <!-- START Left nav -->
            <ul class="nav navbar-nav">
                <!-- Navbar collapse: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
                <li class="navbar-main navbar-toggle">
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="meta">
                            <span class="icon"><i class="ico-paragraph-justify3"></i></span>
                        </span>
                    </a>
                </li>
                <!--/ Navbar collapse -->
            </ul>
            <!--/ END Left nav -->

            <!-- START Right nav -->
            <ul class="nav navbar-nav navbar-right" >
                <!-- Profile dropdown -->
                <li class="dropdown profile">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="meta">
                            <span class="avatar"><img src="<?= base_url('assets/image/avatar/avatar7.jpg'); ?>" class="img-circle" alt="" /></span>
                            <!--<span class="text hidden-xs hidden-sm pl5"><?= $this->session->userdata['USERNAME']; ?></span>-->
                            <span class="text hidden-xs hidden-sm pl5">User</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= base_url('index.php/siswa'); ?>"><span class="icon"><i class="ico-user-plus2"></i></span> My Accounts</a></li>
                        <li><a href="<?= base_url('index.php/siswa/profilesetting'); ?>"><span class="icon"><i class="ico-cog4"></i></span> Profile Setting</a></li>
                        <li><a href="javascript:void(0);"><span class="icon"><i class="ico-question"></i></span> Help</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('index.php/login/logout'); ?>"><span class="icon"><i class="ico-exit"></i></span> Sign Out</a></li>
                    </ul>
                </li>
                <!-- Profile dropdown -->
            </ul>
            <!--/ END Right nav -->
        </div>
        <!--/ END Toolbar -->
    </div>
</header>
<!--/ END Template Header -->
