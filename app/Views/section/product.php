<style>
.item-card {
    bottom: 10px;
    opacity: 0;
    transition: 0.5s all;
}

.item-card:hover {
    opacity: 0.8;
}

.clients .client-logo img{
    height: -webkit-fill-available;
}

.clients .client-logo{
    height: 7rem;
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

<section id="services" class="services">

    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-title aos-init aos-animate" data-aos="fade-up">
            <h2>The Problems</h2>
            <p class="lead">Lorem ipsum</p>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 d-inline-flex flex-row justify-content-around">
                    <div class="card aos-init aos-animate" style="width: 15rem; border: none;" data-aos="zoom-in" data-aos-delay="100">
                        <img src="<?php echo base_url('/uploads/produk/Productivity.png'); ?>" class="card-img-top"
                            alt="Productivity">
                        <div class="card-body">
                            <p class="card-text">
                            <h5 class="text-center">Less Productivity</h5>
                            </p>
                        </div>
                    </div>
                    <div class="card aos-init aos-animate" style="width: 15rem; border: none;">
                        <img src="<?php echo base_url('/uploads/produk/User_Frustation.png'); ?>" class="card-img-top"
                            alt="User_Frustation">
                        <div class="card-body">
                            <p class="card-text">
                            <h5 class="text-center">User Frustation</h5>
                            </p>
                        </div>
                    </div>
                    <div class="card aos-init aos-animate" style="width: 15rem; border: none;">
                        <img src="<?php echo base_url('/uploads/produk/Price.png'); ?>" class="card-img-top" alt="Price">
                        <div class="card-body">
                            <p class="card-text">
                            <h5 class="text-center">Expensive Price</h5>
                            </p>
                        </div>
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

        <div class="row d-flex justify-content-center portfolio-container aos-init aos-animate" data-aos="fade-up" id="productData">

        </div>

    </div>
</section>

<!-- Client Section -->
<section id="clients" class="clients">
    <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
            <h2>Users</h2>
        </div>

        <div class="row no-gutters clients-wrap clearfix aos-init aos-animate userProduct" style="border:none;"  id="clientsData" data-aos="fade-up">
        </div>

    </div>
</section>
<!-- End Client Section -->