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
            <h2>Product</h2>
            <ol>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li>Product</li>
            </ol>
        </div>

    </div>
</section>

<section id="services" class="services section-bg">

    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-title aos-init aos-animate" data-aos="fade-up">
            <h2>The Problems</h2>
        </div>
        <div class="row">

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch aos-init aos-animate p-2" data-aos="zoom-in"
                data-aos-delay="100">
                <div class="card shadow" style="width: 30rem; border: none;">
                    <img src="<?php echo base_url('/uploads/produk/Productivity.png'); ?>" class="card-img-top"
                        alt="...">
                    <div class="card-body">
                        <p class="card-text">
                        <h4 class="text-center">Less Productivity</h4>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch aos-init aos-animate p-2" data-aos="zoom-in"
                data-aos-delay="200">
                <div class="card shadow" style="width: 30rem; border: none;">
                    <img src="<?php echo base_url('/uploads/produk/User_Frustation.png'); ?>" class="card-img-top"
                        alt="...">
                    <div class="card-body">
                        <p class="card-text">
                        <h4 class="text-center">User Frustation</h4>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch aos-init aos-animate p-2" data-aos="zoom-in"
                data-aos-delay="300">
                <div class="card shadow" style="width: 30rem; border: none;">
                    <img src="<?php echo base_url('/uploads/produk/Price.png'); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">
                        <h4 class="text-center">Expensive Price</h4>
                        </p>
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
            <h2>The Solutions</h2>
        </div>

        <div class="row aos-init aos-animate" data-aos="fade-up">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">

                </ul>
            </div>
        </div>

        <div class="row d-flex justify-content-center portfolio-container aos-init aos-animate" data-aos="fade-up"
            id="productData">

        </div>

    </div>
</section>

<!-- Client Section -->
<section id="clients" class="clients section-bg">
    <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
            <h2>Users</h2>
        </div>

        <div class="row no-gutters clients-wrap clearfix aos-init aos-animate userProduct" id="clientsData"
            data-aos="fade-up">

        </div>

    </div>
</section>