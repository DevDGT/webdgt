<style>
.item-card {
    bottom: 10px;
    opacity: 0;
    transition: 0.5s all;
}

.item-card:hover {
    opacity: 0.8;
}
</style>

<section id="breadcrumbs" class="breadcrumbs">

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Detail Product</h2>
            <ol>
                <li><a href="<?php echo base_url('/home'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('/product'); ?>">Product</a></li>
                <li><a href="#"><?php echo $productsData['0']->name; ?></a></li>
            </ol>
        </div>
    </div>

</section>

<section id="blog" class="blog">

    <div class="container aos-init aos-animate">

        <div class="section-title" data-aos="fade-up" data-aos-delay="100" id="productDetail"
            data-id="<?php echo $productsData['0']->id ?? ''; ?>">
            <h2><?php echo $productsData['0']->name ?? ''; ?> Detail</h2>
        </div>

        <div class="member" data-aos="fade-up" data-aos-delay="200">

            <div class="container-fluid" data-aos="fade-up" data-aos-delay="300">
                <div class="row justify-content-center">
                    <div class="col-lg-10" style="height: 30rem;">
                        <iframe class="w-100 h-100" src="<?php echo $productsData['0']->video ?? ''; ?>?controls=0"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col-lg-10 col-md-10 col-sm-10">
                        <h5 class="card-title"><?php echo $productsData['0']->name ?? ''; ?></h5>
                        <p class="card-text"><?php echo $productsData['0']->description ?? ''; ?></p>
                        <h5 class="card-title"><?php echo 'Other Videos '.$productsData['0']->name ?? ''; ?></h5>
                        <div id="carouselProduct"></div>
                        <!-- <h5 class="card-title">Download Catalog</h5>
                        <div id="catalogProduct"></div> -->
                    </div>
                </div>
                <div class="row justify-content-center testimonials mt-4" id="productClient">
                </div>
            </div>

        </div>

    </div>

</section>

<!-- End Client Section -->
<section id="portfolio" class="portfolio">

    <div class="container aos-init aos-animate">

        <div class="section-title" data-aos="fade-up" data-aos-delay="400">
            <h2>Other Products</h2>
        </div>

        <div class="row" data-aos="fade-up">
            <div class="col-lg-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="500">
                <ul id="portfolio-flters">

                </ul>
            </div>
        </div>

        <div class="row d-flex justify-content-center portfolio-container" data-aos="fade-up" data-aos-delay="600"
            id="productData">

        </div>

    </div>

</section>