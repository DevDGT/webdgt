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
            <h2>Portfolio</h2>
            <ol>
                <li><a href="<?php echo base_url('/home'); ?>">Home</a></li>
                <li><a href="#">Portfolio</a></li>
            </ol>
        </div>

    </div>
    
</section>

<section id="clients" class="clients pt-3">

    <div class="container aos-init aos-animate">

        <div class="section-title" data-aos="zoom-out" data-aos-delay="100">
            <h2>Our Users</h2>
        </div>

        <div class="row no-gutters clients-wrap clearfix clientSlick" style="border:none;" id="clientsData"
            data-aos="fade" data-aos-delay="200">
        </div>

        <div class="section-title mt-4" data-aos="zoom-out" data-aos-delay="300">
            <h2>User Products</h2>
        </div>

        <div class="row testimonials" data-aos="fade" data-aos-delay="400" id="clientsDataDetails">
            <h4 class="text-center" id="titleItems">Klik user for more information</h4>
        </div>

    </div>

</section>