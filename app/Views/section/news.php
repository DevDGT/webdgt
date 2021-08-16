<style>
.blog-pagination .pagination button:hover {
    background: #1bbd36;
}

.blog-pagination .pagination button a:hover {
    color: #fff;
}

.imageCover {
    /* align-items: center; */
    object-fit: cover;
    margin: auto;
    display: block;
}
</style>

<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>News</h2>
            <ol>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url('/news/'); ?>">News</a></li>
            </ol>
        </div>

    </div>
</section>

<section id="blog" class="blog">
    <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-8 entries articles">

                <div id="articleSection">
                    <?php foreach ($newsData as $news) : ?>
                    <a href="<?= base_url('/news/'.$news->slug); ?>">

                        <article class="entry" id="<?= $news->id; ?>">
                            <div class="entry-img coverGan vh-100">
                                <img src="<?= base_url('/uploads/cover/'.$news->cover); ?>" alt="cover"
                                    class="img-fluid imageCover">
                            </div>

                            <h2 class="entry-title">
                                <a href="<?= base_url('/news/'.$news->slug); ?>"><?= $news->title; ?></a>
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-person"></i><a href="#"><?= $news->author; ?></a>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-clock"></i><a
                                            href="#"><?php echo date('Y-m-d', strtotime($news->created_at)); ?></a>
                                    </li>
                                    <!-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="#">12 Comments</a></li> -->
                                </ul>
                            </div>

                            <div class="entry-content">
                                <p class="m-0 p-0">
                                    <a href="<?= base_url('/news/'.$news->slug); ?>" style="color: #111">
                                        <?= $news->description; ?>
                                    </a>
                                </p>
                            </div>
                        </article>
                    </a>
                    <?php endforeach; ?>
                </div>

                <div class="blog-pagination w-100">
                    <div class="pagination d-flex justify-content-center">
                        <li class="btn <?= $page['current'] == 1 ? 'disabled' : ''; ?>"><a
                                href="<?= str_replace('#page', (intval($page['current']) - 1), $page['url']); ?>">Back</a>
                        </li>
                        <li class="btn disabled"><a href="#"><?= $page['current']; ?></a></li>
                        <li class="btn <?= $page['next'] == 0 ? 'disabled' : ''; ?>"><a class="disabled"
                                href="<?= str_replace('#page', (intval($page['current']) + 1), $page['url']); ?>">Next
                                <i class="fas fa-next"></i> </a></li>
                    </div>
                </div>

            </div><!-- End blog entries list -->

            <div class="col-lg-4 col-md-6 col-sm-12">

                <div class="sidebar">

                    <?php require 'sidebar.php'; ?>

                </div>

            </div><!-- End blog sidebar -->

        </div>

    </div>
</section>