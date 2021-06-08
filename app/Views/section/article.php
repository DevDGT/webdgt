<style>
    .newsContent img {
        width: 100% !important;
        height: 100% !important;
    }
</style>
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>News</h2>
            <ol class="newsRoti">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url('/news'); ?>">News</a></li>
            </ol>
        </div>

    </div>
</section>

<section id="blog" class="blog">
    <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-8 entries">

                <article class="entry entry-single">

                    <div class="entry-img">
                        <img src="" alt="" class="img-fluid newsCover">
                    </div>

                    <h2 class="entry-title newsTitle">
                        <a href="blog-single.html"></a>
                    </h2>

                    <div class="entry-meta">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi bi-person newsAuthor"></i> <a href="blog-single.html"></a></li>
                            <li class="d-flex align-items-center"><i class="bi bi-clock newsTime"></i> <a href="blog-single.html"><time datetime="2020-01-01"></time></a></li>
                            <!-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">12 Comments</a></li> -->
                        </ul>
                    </div>

                    <div class="entry-content newsContent">

                    </div>

                    <div class="entry-footer">
                        <i class="bi bi-folder"></i>
                        <ul class="cats">
                            <li><a href="#">Business</a></li>
                        </ul>

                        <i class="bi bi-tags"></i>
                        <ul class="tags">
                            <li><a href="#">Creative</a></li>
                            <li><a href="#">Tips</a></li>
                            <li><a href="#">Marketing</a></li>
                        </ul>
                    </div>

                </article>
                <!-- End blog entry -->

                <div class="blog-author d-flex align-items-center">
                    <img src="assets/img/blog/blog-author.jpg" class="rounded-circle float-left" alt="">
                    <div>
                        <h4 class="newsAuthor"></h4>
                        <div class="social-links">
                            <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
                            <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                            <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                        </div>
                        <p>
                            Itaque quidem optio quia voluptatibus dolorem dolor. Modi eum sed possimus accusantium. Quas repellat voluptatem officia numquam sint aspernatur voluptas. Esse et accusantium ut unde voluptas.
                        </p>
                    </div>
                </div><!-- End blog author bio -->

            </div><!-- End blog entries list -->

            <div class="col-lg-4">

                <div class="sidebar">

                    <?php require 'sidebar.php' ?>

                </div><!-- End sidebar -->

            </div><!-- End blog sidebar -->

        </div>

    </div>
</section>