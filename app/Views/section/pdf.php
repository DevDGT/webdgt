<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Catalog <?php echo $productsTitle ?? '';?></h2>
            <ol>
                <li><a href="<?php echo base_url('/home'); ?>">Home</a></li>
                <li><a href="<?php echo $prev; ?>">Go Back Product</a></li>
            </ol>
        </div>

    </div>
</section>

<section id="portfolio" class="portfolio">

    <div class="container">
        <iframe style="border:0; width: 100%; min-height: 50rem;"
        src="<?php echo $productsData ?? '';?>"
        frameborder="0" allowfullscreen>
        </iframe>
    </div>

</section>
