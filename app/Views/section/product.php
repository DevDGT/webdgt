<style>
.my-card {
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    background-color: #fff;
    background-clip: border-box;
    box-shadow: 0px 0px 2px;
    /* margin-bottom: 28px; */
    border-radius: 50px 0;
    overflow: hidden;
    transition: .5s
}

.my-card:hover {
    box-shadow: 0px 0px 4px #1BBD36
}

.my-card img {
    max-height: 160px;
    /* width: 100% */
    object-fit:scale-down;
}

.my-card-body {
    padding: 20px;
    margin-bottom: 5px
}

.my-card-body h5 {
    text-transform: capitalize;
    line-height: 25px;
    font-size: 25px
}

.my-card-body p {
    margin: 10px 0;
    color: #f7941d
}

/* .social-icons {
    margin-bottom: 25px
}

.social-icons a {
    margin-right: 22px;
    color: #363842;
    font-size: 16px
}

.social-icons a:hover {
    color: #c81a3b
} */

.my-card-btn {
    color: rgb(231, 231, 231);
    background-color: #1BBD36;
    padding: 10px 28px;
    text-decoration: none;
    text-transform: capitalize;
    border-radius: 10px 0;
    transition: .5s
}

.my-card-btn:hover {
    color: rgb(15, 15, 15)
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
<section id="services" class="services aos-init aos-animate">

    <div class="container" data-aos="fade-up" data-aos-delay="1000">
        <div class="section-title">
            <h2>The Problems</h2>
            <p class="lead">Modern <strong>Problem</strong> Require Modern <strong>Solutions</strong></p>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 d-flex flex-row justify-content-around">
                    <div class="card" style="width: 15rem; border: none;">
                        <img src="<?php echo base_url('/uploads/produk/Productivity.png'); ?>" class="card-img-top"
                            alt="Productivity">
                        <div class="card-body">
                            <p class="card-text text-wrap text-center fw-bold px-0">Less Productivity
                            </p>
                        </div>
                    </div>
                    <div class="card" style="width: 15rem; border: none;">
                        <img src="<?php echo base_url('/uploads/produk/User_Frustation.png'); ?>" class="card-img-top"
                            alt="User_Frustation">
                        <div class="card-body">
                            <p class="card-text text-wrap text-center fw-bold px-0">User Frustation
                            </p>
                        </div>
                    </div>
                    <div class="card" style="width: 15rem; border: none;">
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

<section id="portfolio" class="portfolio aos-init aos-animate">

    <div class="container" data-aos="fade-up" data-aos-delay="1500">

        <div class="section-title">
            <h2>The Solutions</h2>
        </div>

        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                </ul>
            </div>
        </div>

        <div id="productData" class="row d-flex justify-content-center portfolio-container">
        </div>

    </div>

</section>

<!-- Client Section -->
<section id="clients" class="clients aos-init aos-animate">

    <div class="container" data-aos="fade-up" data-aos-delay="2000">
        
        <div class="section-title">
            <h2>Users</h2>
        </div>

        <div class="row no-gutters clients-wrap clearfix userProduct" style="border:none;" id="clientsData">
        </div>

    </div>

</section>
<!-- End Client Section -->