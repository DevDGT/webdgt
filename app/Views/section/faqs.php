<style>
.blog-pagination .pagination button:hover {
    background: #1bbd36;
}

.blog-pagination .pagination button a:hover {
    color: #ffffff;
}
</style>

<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Faqs</h2>
            <ol>
                <li><a href="<?php echo base_url('/home'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('/contact'); ?>">Contact</a></li>
            </ol>
        </div>

    </div>
</section>

<section id="blog" class="blog">

    <div class="container aos-init aos-animate">

        <div class="row">

            <!-- Blog entries list -->
            <div class="col-lg-12 col-md-12 col-sm-12 entries articles">

                <div id="articleSection" data-aos="fade-down" data-aos-delay="100">
                    <?php foreach ($faqData as $faq) : ?>
                    <a href="<?php echo base_url('/news/'.$faq->slug); ?>">
                        <article class="entry">
                            <h2 class="entry-title">
                                <a href="<?php echo base_url('/news/'.$faq->slug); ?>"><?php echo $faq->question; ?></a>
                            </h2>
                            <div class="entry-content">
                                <p class="p-0">
                                    <a href="<?php echo base_url('/news/'.$faq->slug); ?>" style="color: #111">
                                        <?php echo $faq->answers; ?>
                                    </a>
                                </p>
                            </div>
                        </article>
                    </a>
                    <?php endforeach; ?>
                </div>

                <a href="<?php echo base_url('/contact'); ?>" class="btn btn-success mb-4" data-aos="fade-right"
                    id="btnBackNews" data-aos-delay="200">
                    <i class="bi bi-arrow-left-circle me-2"></i>Back
                </a>

            </div>
            <!-- End blog entries list -->


        </div>

    </div>
</section>

<section id="faq" class="faq pt-0">
    <div class="container aos-init aos-animate portfolio">

        <div class="section-title" data-aos="fade-up" data-aos-delay="400">
            <h2>FAQ</h2>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-6 col-sm-6 d-flex justify-content-center" data-aos="zoom-out"
                data-aos-delay="600">
                <ul id="portfolio-flters">
                </ul>
            </div>
        </div>
        <!-- <div class="row portfolio" data-aos="fade-down" data-aos-delay="500">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                    <li data-filter="*" id="coreCategory" class="filter-active">All</li>
                    <li data-filter="*" class="options">SIAS</li>
                    <li data-filter="*" class="options">SIMS</li>
                </ul>
            </div>
        </div> -->

        <div class="row" data-aos="fade-down" data-aos-delay="600">
            <div class="faq-list">
                <ul class="border border-success" id="faqData"></ul>
                </ul>
            </div>
        </div>

    </div>
</section>