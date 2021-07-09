<?php

function base_url($url = '')
{
    $base_url_ = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http');
    $base_url_ .= '://'.$_SERVER['HTTP_HOST'];
    $base_url_ .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

    return $base_url_.$url;
}

?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title class="webTitle"><?php echo $title ?? 'DGT'; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta property="og:title" content="WEB DGT (Under Construction )">
    <meta property="og:description" content="WEB Profile and Product Dianglobaltech (Website Under Construction)">
    <meta property="og:image" content="<?php echo base_url('/assets/img/logo.png'); ?>">
    <meta property="og:url" content="<?php echo base_url('/assets/img/logo.png'); ?>">
    <!-- Favicons -->
    <link href="<?php echo base_url('/assets/img/logo.png'); ?>" rel="icon">
    <link href="<?php echo base_url('/assets/img/apple-touch-icon.png'); ?>" rel="apple-touch-icon" sizes="180x180">
    <link href="<?php echo base_url('/assets/img/favicon-32x32.png'); ?>" rel="icon" type="image/png" sizes="32x32">
    <link href="<?php echo base_url('/assets/img/favicon-16x16.png'); ?>" rel="icon" type="image/png" sizes="16x16">
    <meta name="baseUrl" content="<?= base_url(); ?>">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url('/assets/vendor/animate.css/animate.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/aos/aos.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/glightbox/css/glightbox.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/remixicon/remixicon.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/swiper/swiper-bundle.min.css'); ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo base_url('/assets/css/style.css'); ?>" rel="stylesheet">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url('/assets/modules/floatingjs/css/socialfloating.css'); ?>">


    <!-- Vendor JS Files -->

    <!-- Template Main JS File -->
    <style>
    .services .icon-box {
        padding: 10px 60px 10px 60px;
        border-radius: 5%;
    }

    #testimonials .testimonial-item {
        border-radius: 5%;
    }

    /* body {
            background-image: url('<?php echo base_url('uploads/beranda/DSCF1517.JPG'); ?>') !important;
        } */
    </style>

<body class="section-bg">
    <!-- About Section -->
    <section id="aboutSection" class="services ">
        <div class="section-title">
            <div class="container">
                <div class="row">
                    <div class="col"></div>
                    <h2>About Us</h2>
                    <div class="text-wrap" style="width: auto;">
                        Dian Global Tech is an INFORMATION AND TECHNOLOGY (IT)
                        consulting services company established in October 2009
                        by experienced practitioners in their respective fields.
                    </div>
                </div>
            </div>
        </div>
        <div class="container aos-init aos-animate" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-6 col-md-4 d-flex justify-content-center aos-init aos-animate mt-4"
                    data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box iconbox-blue">
                        <div class="container">
                            <div class="icon">
                                <img src="<?php echo base_url('/uploads/aboutus/Tech_Support@4x-8.png'); ?>" width="100"
                                    height="100">
                            </div>
                            <h4><a href="#">Tech Support</a></h4>
                            <div class="text-wrap p-4" style="width: 25rem;">
                                <p>Provide help regarding specific problems with a product or service in IT field</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4 d-flex justify-content-center aos-init aos-animate mt-4"
                    data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon-box iconbox-blue">
                        <div class="container">
                            <div class="icon">
                                <img src="<?php echo base_url('/uploads/aboutus/Consulting@4x-8.png'); ?>" width="100"
                                    height="100">
                            </div>
                            <h4><a href="#">It Consulting</a></h4>
                            <div class="text-wrap p-4" style="width: 25rem;">
                                <p>Provides expert advice on how best to use IT in achieving your business objectives
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4 d-flex justify-content-center aos-init aos-animate mt-4"
                    data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon-box iconbox-blue">
                        <div class="container">
                            <div class="icon">
                                <img src="<?php echo base_url('/uploads/aboutus/App_Dev@4x-8.png'); ?>" width="100"
                                    height="100">
                            </div>
                            <h4><a href="#">App Dev</a></h4>
                            <div class="text-wrap p-4" style="width: 25rem;">
                                <p>Creating, testing and programming apps for computers, mobile phones, and other types
                                    of electronic devices.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4 d-flex justify-content-center aos-init aos-animate mt-4"
                    data-aos="zoom-in" data-aos-delay="400">
                    <div class="icon-box iconbox-blue">
                        <div class="container">
                            <div class="icon">
                                <img src="<?php echo base_url('/uploads/aboutus/Training@4x-8.png'); ?>" width="100"
                                    height="100">
                            </div>
                            <h4><a href="">Training</a></h4>
                            <div class="text-wrap p-4" style="width: 25rem;">
                                <p>Teaching or developing any skills and knowledge that relate to IT field</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    <a href="<?php echo base_url('/assets/compro/id.pdf'); ?>" target="_blank"><button
                            class="btn btn-primary ">Download Company Profile</button></a>
                </div>
            </div>
        </div>
    </section>
    <script src="<?= base_url('assets/admin'); ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/modules/sweetalert2.all.min.js'); ?>"></script>
    <script>
    $(document).ready(function() {
        setTimeout(() => {
            // return
            Swal.fire({
                html: `
                       <img src="<?php echo base_url('/assets/img/logo.png'); ?>" style="width:100px;margin-right:30px;margin-top:50px;margin-bottom:50px"><strong style="font-size:20px">Website Under Construction</strong>
                    `,
                showCloseButton: true,
                focusConfirm: false,
                confirmButtonText: 'Download Company Profile',
                confirmButtonAriaLabel: 'Download Company Profile',
            }).then((result) => {
                if (result.isConfirmed) return window.open(
                    "<?php echo base_url('/assets/compro/id.pdf'); ?>")
            })
        }, 3000);
    })
    </script>
</body>


</head>