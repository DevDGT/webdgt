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
            <h2>Career</h2>
            <ol>
                <li><a href="<?php echo base_url('/home'); ?>">Home</a></li>
                <li><a href="#">Career</a></li>
            </ol>
        </div>

    </div>

</section>

<section id="portfolio" class="portfolio aos-init aos-animate">

    <div class="container" data-aos="fade-up" data-aos-delay="1500">

        <div class="section-title">
            <h2>Join Us</h2>
            <p class="lead"><strong>One Our Service</strong> is <strong>Teaching</strong> or <strong>developing</strong> any skills and knowledge that relate to IT field</p>
        </div>

    </div>

</section>

<!-- Client Section -->
<section id="clients" class="clients aos-init aos-animate">

    <div class="container" data-aos="fade-up" data-aos-delay="2000">
        
        <div class="section-title">
            <h2>Career or Internship</h2>
        </div>
        
        <div id="productData" class="row d-flex justify-content-center portfolio-container">

            <div class="card m-2" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://image.freepik.com/free-vector/illustration-social-media-concept_53876-18383.jpg" class="img-fluid rounded-start" alt="it">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text">
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Read More
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>
<!-- End Client Section -->

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel"></h5>
        </div>
        <div class="modal-body" id="staticBackdropBody">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
