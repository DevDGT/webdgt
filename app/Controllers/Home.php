<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function home()
    {
        $base_url = BASE_URL;
        $data = [
            'title' => 'Beranda',
            'pageTitle' => 'Beranda',
            'logoImg' => '',
            'logoName' => 'DGT',
            'hero' => <<<EOD
                        <section id="hero">
                            <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

                                <div class="carousel-inner" role="listbox">

                                    <!-- Slide 1 -->
                                    <div class="carousel-item active" style="background-image: url($base_url/uploads/beranda/DSCF1517.JPG);">
                                        <!-- <div class="carousel-container">
                                            <div class="carousel-content animate__animated animate__fadeInUp">
                                                <h2>Welcome to <span>Company</span></h2>
                                                <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                                                <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
                                            </div>
                                        </div> -->
                                    </div>

                                    <!-- Slide 2 -->
                                    <div class="carousel-item" style="background-image: url($base_url/uploads/beranda/DSCF1509.JPG);">
                                        <!-- <div class="carousel-container">
                                            <div class="carousel-content animate__animated animate__fadeInUp">
                                                <h2>Lorem Ipsum Dolor</h2>
                                                <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                                                <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
                                            </div>
                                        </div> -->
                                    </div>

                                    <!-- Slide 3 -->
                                    <div class="carousel-item" style="background-image: url($base_url/uploads/beranda/DSCF1502.JPG);">
                                        <!-- <div class="carousel-container">
                                            <div class="carousel-content animate__animated animate__fadeInUp">
                                                <h2>Sequi ea ut et est quaerat</h2>
                                                <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                                                <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
                                            </div>
                                        </div> -->
                                    </div>

                                </div>

                                <-- <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                                </a>

                                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                                </a>

                                <ol class="carousel-indicators" id="hero-carousel-indicators"></ol> -->

                            </div>
                        </section>
                    EOD,
            'section' => 'dashboard',
            'js' => [
                "<script src=" . base_url('assets/js/page/dashboard.js') . " defer></script>",
            ]
        ];

        echo view('front/canvas', $data);
    }

    public function aboutus()
    {
        $data = [
            'title' => 'About',
            'pageTitle' => 'About Us',
            'logoImg' => '',
            'logoName' => 'DGT',
            'section' => 'aboutus',
            'js' => 'aboutus.js'
        ];

        echo view('front/canvas', $data);
    }
}
//