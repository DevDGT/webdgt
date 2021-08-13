<style>
.services .icon-box {
    padding: 10px 60px 10px 60px;
}

.clients .client-logo img {
    height: -webkit-fill-available;
}

.carousel-item .img-fluid {
    object-fit: scale-down;
}

.clients .client-logo {
    height: 7rem;
}
</style>

<div class="container">

    <!-- Hero Section -->
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="10000" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="container-fluid">
                <div class="carousel-inner" role="listbox">
                    <!-- Slide 1 -->
                    <div class="carousel-item img-fluid active"
                        style="background-image: url(<?php echo base_url('/uploads/beranda/DSCF1517.JPG'); ?>);">
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item img-fluid"
                        style="background-image: url(<?php echo base_url('/uploads/beranda/DSCF1509.JPG'); ?>);">
                    </div>
                    <!-- Slide 3 -->
                    <div class="carousel-item img-fluid"
                        style="background-image: url(<?php echo base_url('/uploads/beranda/DSCF1502.JPG'); ?>);">
                    </div>
                </div>

                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>
                <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
            </div>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- About Section -->
    <section id="aboutSection" class="services p-0">

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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-4 aos-init aos-animate p-2" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box iconbox-blue">
                            <div class="icon">
                                <img src="<?php echo base_url('/uploads/aboutus/Tech_Support@4x-8.png'); ?>" width="100"
                                    height="100">
                            </div>
                            <h4><a href="#">Tech Support</a></h4>
                            <div class="text-wrap p-4" style="width: auto;">
                                <p>Provide help regarding specific problems with a product or service in IT field</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 aos-init aos-animate p-2" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box iconbox-blue">
                            <div class="icon">
                                <img src="<?php echo base_url('/uploads/aboutus/Consulting@4x-8.png'); ?>" width="100"
                                    height="100">
                            </div>
                            <h4><a href="#">It Consulting</a></h4>
                            <div class="text-wrap p-4" style="width: auto;">
                                <p>Provides expert advice on how best to use IT in achieving your business objectives
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 aos-init aos-animate p-2" data-aos="zoom-in" data-aos-delay="300">
                        <div class="icon-box iconbox-blue">
                            <div class="icon">
                                <img src="<?php echo base_url('/uploads/aboutus/App_Dev@4x-8.png'); ?>" width="100"
                                    height="100">
                            </div>
                            <h4><a href="#">App Dev</a></h4>
                            <div class="text-wrap p-4" style="width: auto;">
                                <p>Creating, testing and programming apps for computers, mobile phones, and other types
                                    of
                                    electronic devices.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 aos-init aos-animate p-2" data-aos="zoom-in" data-aos-delay="400">
                        <div class="icon-box iconbox-blue">
                            <div class="icon">
                                <img src="<?php echo base_url('/uploads/aboutus/Training@4x-8.png'); ?>" width="100"
                                    height="100">
                            </div>
                            <h4><a href="">Training</a></h4>
                            <div class="text-wrap p-4" style="width: auto;">
                                <p>Teaching or developing any skills and knowledge that relate to IT field</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- End About Section -->

    <section id="testimonials" class="testimonials p-0">
        <div class="container-fluid aos-init aos-animate" data-aos="fade-up">
            <div class="row testimonial-item">
                <div class="col-lg-6">
                    <div class="card" style="width: auto; border: none;">
                        <iframe width="auto" height="315" src="https://www.youtube.com/embed/NOAtMfUAe5U"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                        <div class="card-body">
                            <p class="card-text">Aplikasi SIADES</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-3" style="max-width: auto; border: none;">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <iframe width="100%" height="auto" src="https://www.youtube.com/embed/AilqrFv1zj4"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <h5 class="card-title">Aplikasi BUMDES</h5>
                                    <p>Berbasis Akuntansi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3" style="max-width: auto; border: none;">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <iframe width="100%" height="auto" src="https://www.youtube.com/embed/jCzdhawRsHA"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <h5 class="card-title">Aplikasi KOPERASI</h5>
                                    <p>Manajemen Koperasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Client Section -->
    <section id="clients" class="clients p-2">
        <div class="container aos-init aos-animate" data-aos="fade-up">

            <div class="section-title">
                <h2>Users</h2>
            </div>

            <div class="row no-gutters clients-wrap clearfix aos-init aos-animate clientSlick" style="border:none;"
                id="clientsData" data-aos="fade-up">
            </div>

        </div>
    </section>
    <!-- End Client Section -->

</div>