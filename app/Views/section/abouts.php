<style>
.parallax {
    /* The image used */
    background-image: url("<?php echo base_url('uploads/beranda/DSCF1517_.JPG'); ?>");
    object-fit: scale-down;

    /* Full height */
    height: 100%;
    width: 100%;

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>

<section id="breadcrumbs" class="breadcrumbs">

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>About Us</h2>
            <ol>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="#">About Us</a></li>
            </ol>
        </div>
    </div>

</section>

<div class="parallax container-fluid" style="height:20rem;"></div>

<section id="team" class="team" data-aos="fade-up">

    <div class="container">

        <div class="section-title aos-init aos-animate" data-aos="fade">
            <h2 class="text-uppercase">
                <span class="rounded-pill">
                    Get To Know About Us
                </span>
            </h2>
        </div>

        <div id="teamCEO" class="row"></div>

        <div id="teamApi" class="row dgtTeam"></div>

        <!-- Video Line -->
        <div class="row dgtVideo mt-2">

            <div class="section-title aos-init aos-animate pt-4" data-aos="fade-up">
                <h2 class="text-uppercase">
                    <span>
                        Our <strong>History</strong>
                    </span>
                </h2>
            </div>

            <div class="col-lg-12 aos-init">
                <div class="member aos-init aos-animate" data-aos="fade-up">
                    <h2 class="text-center text-uppercase font-monospace pt-4">Dian Global Tech Is</h2>
                    <div class="container-fluid pt-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-12" style="height: 25rem;">
                                <iframe class="w-100 h-100" src="https://www.youtube.com/embed/m2dCMOed7ww"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 pt-4">
                                <div class="container-fluid">
                                    <p class="text-center font-monospace fs-5">
                                        Dian Global Tech is an INFORMATION AND TECHNOLOGY (IT)
                                        consulting services company established in October 2009
                                        by experienced practitioners in their respective fields.
                                    </p>
                                    <p class="text-center font-monospace fs-5">
                                        We start our journey in SISTEM INFORMASI MANAJEMEN SEKOLAH (SIMS) and
                                        now,
                                        we create custom made apps based on our partners and clients demands.
                                        With a wide network, professionalism and commitment, we are able to
                                        consistently
                                        provide high quality services, and CUSTOMER SATISFACTION IS EVERYTHING
                                        to us
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Video Line -->

    </div>

</section>

<section id="about-us" class="about-us">

    <div class="container" data-aos="fade-up">

        <div class="section-title aos-init aos-animate" data-aos="fade-up">
            <h2>Our <strong>Mission</strong></h2>
        </div>

        <div class="row content">
            <div class="col-lg-6 aos-init aos-animate" data-aos="fade-left">
                <h4 class="text-center"><i class="bi bi-briefcase p-2"></i><strong>Mission</strong></h4>
                <ul>
                    <li>
                        <p class="fst-italic">
                            Provide the best Information and Technology services to each of our partners and clients
                            who
                            cooperate with us.
                        </p>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 aos-init aos-animate" data-aos="fade-left">
                <h4 class="text-center"><i class="bi bi-bullseye p-2"></i><strong>Vision</strong></h4>
                <ul>
                    <li>
                        <p class="fst-italic">
                            Become the leading consultant in Information and Technology field by always providing
                            Innovative solutions to each of our partners and clients, and to compete on a national
                            and
                            international scale.
                        </p>
                    </li>
                </ul>
            </div>
        </div>

    </div>

</section>

<section id="benefits" class="about-us">
    <div class="container" data-aos="fade-up">

        <div class="section-title aos-init aos-animate" data-aos="fade-up">
            <h2 class="text-uppercase">Cooperation Benefits</h2>
        </div>
        <!-- Cooperation Line -->
        <div class="row services benefits">
            <!-- <div class="section benefits"> -->
            <div class="col-lg-3 col-md-4 d-flex justify-content-evenly" data-aos="zoom-in" data-aos-delay="100">
                <div class="card" style="width: 10rem; height:15rem; border: none;">
                    <img src="<?php echo base_url('/uploads/aboutus/Partner_Oriented@4x-8.png'); ?>" class="img-fluid"
                        alt="Oriented">
                    <div class="card-body">
                        <p class="card-text">
                        <h6 class="text-center">Partner & Client Oriented</h6>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 d-flex justify-content-evenly" data-aos="zoom-in" data-aos-delay="200">
                <div class="card" style="width: 10rem; height:15rem; border: none;">
                    <img src="<?php echo base_url('/uploads/aboutus/Eficient@4x-8.png'); ?>" class="img-fluid"
                        alt="Solution">
                    <div class="card-body">
                        <p class="card-text">
                        <h6 class="text-center">Effective & Efficient Solution</h6>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 d-flex justify-content-evenly" data-aos="zoom-in" data-aos-delay="300">
                <div class="card" style="width: 10rem; height:15rem; border: none;">
                    <img src="<?php echo base_url('/uploads/aboutus/Innovation@4x-8.png'); ?>" class="img-fluid"
                        alt="Innovative">
                    <div class="card-body">
                        <p class="card-text">
                        <h6 class="text-center">Innovative</h6>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 d-flex justify-content-evenly" data-aos="zoom-in" data-aos-delay="400">
                <div class="card" style="width: 10rem; height:15rem; border: none;">
                    <img src="<?php echo base_url('/uploads/aboutus/Service_Commitment@4x-8.png'); ?>" class="img-fluid"
                        alt="Commitment">
                    <div class="card-body">
                        <p class="card-text">
                        <h6 class="text-center">Service Commitment</h6>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 d-flex justify-content-evenly" data-aos="zoom-in" data-aos-delay="500">
                <div class="card" style="width: 10rem; height:15rem; border: none;">
                    <img src="<?php echo base_url('/uploads/aboutus/Professional_Quality@4x-8.png'); ?>"
                        class="img-fluid" alt="Quality">
                    <div class="card-body">
                        <p class="card-text">
                        <h6 class="text-center">Professional Quality</h6>
                        </p>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <!-- End Cooperation Line -->

    </div>
</section>