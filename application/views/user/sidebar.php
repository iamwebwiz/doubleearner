        

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="<?php echo site_url('user') ?>" id="dash"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('providehelp') ?>" id="ph"><i class="fa fa-gift"></i> Provide Help</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('donations') ?>" id="history"><i class="fa fa-clock-o"></i> Donations History</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('profile') ?>" id="profile"><i class="fa fa-user"></i> My Profile</a>
                    </li>
                    <?php if (!alreadyTestified($this->session->user_id)): ?>
                        <li>
                           <a href="<?php echo site_url('user/writetestimony') ?>" id="testimony"><i class="fa fa-thumbs-up"></i> Give Testimony</a> 
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="support.php" id="support"><i class="fa fa-envelope-o"></i> Contact Support</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('logout') ?>"><i class="fa fa-power-off"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->

        <div id="page-wrapper">
            <div id="page-inner">