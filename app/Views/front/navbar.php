<header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

        <h1 class="logo me-auto">
            <!-- <a href="index.html"><span>Com</span>pany</a> -->
            <a href="index.html" class="logo me-auto me-lg-0">
                <img src="<?php echo base_url('assets/img/logo.svg'); ?>" alt="logo" class="img-fluid">
                <span class="ms-1">DGT</span>
            </a>
        </h1>
        <!-- Uncomment below if you prefer to use an image logo -->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
            <li><a href="<?php echo base_url('/'); ?>" class="active">Beranda</a></li>

            <li class="dropdown"><a href="#"><span>About</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                <li><a href="<?php echo base_url('aboutus'); ?>">About Us</a></li>
                <li><a href="<?php echo base_url('aboutteam'); ?>">Fio cantik</a></li>
                <li><a href="<?php echo base_url('abouttestimonials'); ?>">Team</a></li>
                </ul>
            </li>

            
            <li><a href="contact.html">Contact</a></li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <div class="header-social-links d-flex">
            <a href="https://www.facebook.com/dian.globaltech.92/" target="_blank" class="facebook"><i class="bu bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bu bi-instagram"></i></a>
        </div>

        </div>
    </header>