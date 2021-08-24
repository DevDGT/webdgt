<style>
.item-card {
    bottom: 10px;
    opacity: 0;
    transition: 0.5s all;
}

.item-card:hover {
    opacity: 0.8;
}

.clients .client-logo img {
    height: -webkit-fill-available;
}

.clients .client-logo {
    height: 7rem;
}
</style>

<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Product</h2>
            <ol>
                <li><a href="<?php echo base_url('/home'); ?>">Home</a></li>
                <li><a href="#">Product</a></li>
            </ol>
        </div>

    </div>
</section>

<!-- Service Section -->
<section id="services" class="services pb-0">

    <div class="container aos-init aos-animate">
        <div class="section-title" data-aos="fade-up" data-aos-delay="100">
            <h2>The Problems</h2>
            <p class="lead">Lorem ipsum</p>
        </div>
        <div class="container">
            <div class="row aos-init aos-animate">
                <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-row justify-content-around">
                    <div class="card" style="width: 15rem; border: none;" data-aos="fade-right" data-aos-delay="200">
                        <img src="<?php echo base_url('/uploads/produk/Productivity.png'); ?>" class="card-img-top"
                            alt="Productivity">
                        <div class="card-body">
                            <p class="card-text text-wrap text-center fw-bold px-0">Less Productivity
                            </p>
                        </div>
                    </div>
                    <div class="card" style="width: 15rem; border: none;" data-aos="fade-up" data-aos-delay="300">
                        <img src="<?php echo base_url('/uploads/produk/User_Frustation.png'); ?>" class="card-img-top"
                            alt="User_Frustation">
                        <div class="card-body">
                            <p class="card-text text-wrap text-center fw-bold px-0">User Frustation
                            </p>
                        </div>
                    </div>
                    <div class="card" style="width: 15rem; border: none;" data-aos="fade-left" data-aos-delay="400">
                        <img src="<?php echo base_url('/uploads/produk/Price.png'); ?>" class="card-img-top"
                            alt="Price">
                        <div class="card-body">
                            <p class="card-text text-wrap text-center fw-bold px-0">Expensive Price
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- End Service Section -->

<!-- End Client Section -->
<section id="portfolio" class="portfolio pb-0 pt-4">

    <div class="container aos-init aos-animate">
        <div class="section-title" data-aos="fade-up" data-aos-delay="500">
            <h2>The Solutions</h2>
        </div>

        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center" data-aos="zoom-out" data-aos-delay="600">
                <ul id="portfolio-flters">
                </ul>
            </div>
        </div>

        <div id="productData" class="row d-flex justify-content-center portfolio-container" data-aos="zoom-in"
            data-aos-delay="600">
        </div>

    </div>

</section>

<!-- Client Section -->
<section id="clients" class="clients pt-0">

    <div class="container aos-init aos-animate">
        <div class="section-title" data-aos="fade-up" data-aos-delay="800">
            <h2>Users</h2>
        </div>

        <div class="row no-gutters clients-wrap clearfix userProduct" style="border:none;" id="clientsData"
            data-aos="fade-up" data-aos-delay="900">
        </div>

    </div>

</section>
<!-- End Client Section -->