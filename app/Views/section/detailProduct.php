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
                <li><a href="#">Home</a></li>
                <li><a href="#">Product</a></li>
                <li><a href="#"><?php echo $productsData['0']->name; ?></a></li>
            </ol>
        </div>

    </div>
</section>

<section id="blog" class="blog section-bg" data-aos="fade-up">

    <div class="container">
        <pre>
            <?php print_r($productsData); ?>
        </pre>

        <div class="section-title aos-init aos-animate" data-aos="fade-up" id="productDetail" data-id="<?php echo $productsData['0']->id; ?>">
            <h2><?php echo $productsData['0']->name; ?> Detail</h2>
        </div>

        <div class="member aos-init aos-animate" data-aos="fade-up">
            
            <div class="card p-3" style="width: 100%; height:85%;">   
                <iframe class="vh-100" src="<?php echo $productsData['0']->video; ?>?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                </iframe>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $productsData['0']->name; ?></h5>
                    <p class="card-text"><?php echo $productsData['0']->description; ?></p>

                    <h5 class="card-title">Other Videos <?php echo $productsData['0']->name; ?></h5>

                    <div class="container-fluid" id="carouselProduct">

                    </div>

                </div>
            </div>
            
        </div>

    </div>

</section>

<!-- End Client Section -->
<section id="portfolio" class="portfolio">

    <div class="container">
        <div class="section-title aos-init aos-animate" data-aos="fade-up">
            <h2>Other Product</h2>
        </div>

        <div class="row aos-init aos-animate" data-aos="fade-up">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">

                </ul>
            </div>
        </div>

        <div class="row d-flex justify-content-center portfolio-container aos-init aos-animate" data-aos="fade-up" id="productData">

        </div>

    </div>

</section>