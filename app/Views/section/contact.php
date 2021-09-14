<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Contact</h2>
            <ol>
                <li><a href="<?php echo base_url('/home'); ?>">Home</a></li>
                <li><a href="#">Location</a></li>
            </ol>
        </div>

    </div>
</section>

<div class="map-section aos-init aos-animate" data-aos="zoom-in" data-aos-delay="800">

    <iframe style="border:0; width: 100%; height: 350px;"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.259104724501!2d107.65843140705127!3d-6.948032461914047!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTYnNTQuOCJTIDEwN8KwMzknMjcuNSJF!5e0!3m2!1sid!2sid!4v1629251925201!5m2!1sid!2sid"
        frameborder="0" allowfullscreen>
    </iframe>

</div>

<section id="contact" class="contact aos-init aos-animate">

    <div class="container" data-aos="fade-up" data-aos-delay="1000">

        <div class="section-title">
            <h2>Our Location</h2>
        </div>

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="info-wrap">
                    <div class="row">
                        <div class="col-lg-4 info">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p><a href="https://goo.gl/maps/5GdkD4qeCv7a6TP5A" target="_blank">Jl.Saturnus Timur III
                                    BLOK 9 R No 7, Margayu Raya, Bandung</a></p>
                            <p><a href="https://goo.gl/maps/5GdkD4qeCv7a6TP5A" target="_blank">Jl.Neptunus Timur III A
                                    27 No 10, Margayu Raya, Bandung</a></p>
                        </div>

                        <div class="col-lg-4 info mt-4 mt-lg-0">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@dianglobaltech.co.id</p>
                        </div>

                        <div class="col-lg-4 info mt-4 mt-lg-0">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p>+62 22 - 875 - 13118 </br>+62 22 - 751 - 3012</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="row mt-5 justify-content-center">
            <div class="col-lg-10">
                <form action="<?php echo base_url('/sendmail'); ?>" method="post" role="form" class="php-email-form" id="formInbox2">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Full Name"
                                required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="emails" id="emails" placeholder="Your Email"
                                required>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                            required>
                    </div>
                    <div class="form-group mt-3">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message"
                            required></textarea>
                    </div>
                    <div class="text-center"><button type="submit" id="sendMail2" role="status">Send Message</button></div>
                </form>
            </div>

        </div>

    </div>

</section>

<section id="faq" class="faq pt-0 aos-init aos-animate">

    <div class="container" data-aos="fade-up" data-aos-delay="1500">

        <div class="section-title">
            <h2>FAQ</h2>
        </div>

        <div class="row portfolio">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-6 col-sm-6 faq-list">
                <ul class="border border-success" id="faqData"></ul>
                </ul>
            </div>
        </div>

    </div>

</section>
