<!DOCTYPE html>
<html lang="en">

<?php include 'header.php'; ?>

<body data-aos-easing="ease-in-out" data-bs-duration="1000" data-aos-delay="0">

    <!-- ======= Header ======= -->
    <?php include 'navbar.php'; ?>
    <!-- End Header -->

    <!-- Main Section -->
    <main id="main">

        <?php echo view('section/'.$section ?? '404.php'); ?>

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include 'footer.php'; ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

</body>

</html>