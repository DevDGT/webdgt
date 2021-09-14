<footer id="footer">

    <div class="footer-top">
        <div class="container">

            <div class="row justify-content-evenly">

                <div class="col-lg-4 col-md-8 col-sm-12 footer-contact">
                    <div class="container">
                        <div class="clearfix">

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="logo"
                                        class="img-fluid px-2 me-1 float-start" width="60" height="60">
                                    <h4>DIAN GLOBAL TECH</h4>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p class="text-lg-center fs-6">
                                        Tech Suppport - IT Consulting
                                    </p>
                                    <p class="text-lg-center fs-6">
                                        App Dev - Training
                                    </p>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col-lg-12 col-md-12 col-sm-12 social-links">
                                    <div class="d-flex flex-row justify-content-center">
                                        <a href="https://bit.ly/35Fqhft" target="_blank" class="instagram">
                                            <i class="bx bxl-instagram"></i>
                                        </a>
                                        <a href="https://bit.ly/35FkiHm" target="_blank" class="youtube">
                                            <i class="bx bxl-youtube"></i>
                                        </a>
                                        <a href="https://bit.ly/3vg1A3u" target="_blank" class="whatsapp">
                                            <i class="bx bxl-whatsapp"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-8 col-sm-12 footer-newsletter">
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="fs-6">
                                    <i class="bi bi-house-door mx-2"></i>
                                    <a href="https://goo.gl/maps/5GdkD4qeCv7a6TP5A" target="_blank">
                                        Jl.Saturnus
                                        Timur III BLOK 9 R No 7, Margayu Raya, Bandung
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="fs-6">
                                    <i class="bi bi-house-door mx-2"></i>
                                    <a href="https://goo.gl/maps/5GdkD4qeCv7a6TP5A" target="_blank">
                                        Jl.Neptunus
                                        Timur IV A 27 No 10, Margayu Raya, Bandung
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="fs-6"><i class="bi bi-phone mx-2"></i>
                                    <a href="tel:+628-1721-5496">+628-1721-5496</a>
                                    /
                                    <a href="tel:+628-1220-8717-67">+628-1220-8717-67</a>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="fs-6"><i class="bi bi-telephone mx-2"></i>
                                    <a href="tel:+62 22-875-13118">+62 22-875-13118</a>
                                    /
                                    <a href="tel:+62 22-751-3012">+62 22-751-3012</a>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="fs-6"><i class="bi bi-envelope mx-2"></i>
                                <a href="mailto:info@dianglobaltech.co.id">info@dianglobaltech.co.id</a>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-md-8 col-sm-12 footer-contact">
                    <div class="container">
                        <form action="<?php echo base_url('/sendmail'); ?>" method="post" style='background: inherit;' id="formInbox">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <input type="text" class="form-control form-control-sm" name="name" placeholder="Full Name"
                                        aria-label="Full Name" required>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <input type="email" class="form-control form-control-sm" name="emails" placeholder="Email"
                                        aria-label="Email" required>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" class="form-control form-control-sm" name="subject" placeholder="Subject"
                                        aria-label="Subject" required>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea class="form-control" name="message" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="g-recaptcha" class="form-control" data-sitekey="6LffYGYcAAAAACv3uDAkyBvQZBV71IkT_Quq0jUc"></div>  
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-primary btn-sm btn-block" id="sendMail" role="status">
                                            <i class="bi bi-envelope status"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                Copyright &copy;<strong><span>2021 Dian Global Tech</span></strong>. All Rights Reserved
            </div>
        </div>

    </div>

</footer>