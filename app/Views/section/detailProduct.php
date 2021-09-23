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
            <h2>Detail Product</h2>
            <ol>
                <li><a href="<?php echo base_url('/home'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('/product'); ?>">Product</a></li>
                <li><a href="#"><?php echo $productsData['0']->name; ?></a></li>
            </ol>
        </div>
    </div>

</section>

<section id="blog" class="blog aos-init aos-animate">

    <div class="container" data-aos="fade-up" data-aos-delay="1000" >

        <div class="section-title" id="productDetail"
            data-id="<?php echo $productsData['0']->id ?? ''; ?>">
            <h2><?php echo $productsData['0']->name ?? ''; ?> Detail</h2>
        </div>

        <div class="member">

            <div class="container-fluid">
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
                        <h5 class="card-title mt-4">Download Catalog</h5>
                        <div class="d-flex flex-row" id="catalogProduct"></div>
                    </div>
                </div>
                <div class="row justify-content-center testimonials mt-4" id="productClient">
                </div>
            </div>

        </div>

    </div>

</section>

<section id="portfolio" class="portfolio aos-init aos-animate">

    <div class="container" data-aos="fade-up" data-aos-delay="1500">

        <div class="section-title">
            <h2>Other Products</h2>
        </div>

        <div class="row" data-aos="fade-up">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">

                </ul>
            </div>
        </div>

        <div class="row d-flex justify-content-center portfolio-container" id="productData">

        </div>

    </div>

</section>
