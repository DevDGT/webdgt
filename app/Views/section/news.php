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
            <h2>News</h2>
            <ol>
                <li><a href="<?php echo base_url('/home'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('/news'); ?>">News</a></li>
            </ol>
        </div>

    </div>
</section>

<section id="blog" class="blog">

    <div class="container aos-init aos-animate">

        <div class="row">

            <!-- Blog entries list -->
            <div class="col-lg-8 entries articles">

                <div id="articleSection" data-aos="fade-down" data-aos-delay="100">
                    <?php foreach ($newsData as $news) : ?>
                    <a href="<?php echo base_url('/news/'.$news->slug); ?>">
                        <article class="entry" id="<?php echo $news->id; ?>">
                            <div class="entry-img coverGan h-100">
                                <img src="<?php echo base_url('/uploads/cover/'.$news->cover); ?>" alt="cover"
                                    class="img-fluid" style="object-fit: cover; margin: auto; display: block;">
                            </div>
                            <h2 class="entry-title">
                                <a href="<?php echo base_url('/news/'.$news->slug); ?>"><?php echo $news->title; ?></a>
                            </h2>
                            <div class="entry-meta">
                                <ul class="d-flex align-items-start">
                                    <li>
                                        <i class="bi bi-person"></i>
                                        <a href="<?php echo base_url('teams/?name='.$newsData[0]->username.'&onweb=true'); ?>"
                                            target="_blank">
                                            <?php echo $news->author; ?>
                                        </a>
                                    </li>
                                    <li>
                                        <i class="bi bi-clock"></i>
                                        <a href="#"><?php echo date('Y-m-d', strtotime($news->created_at)); ?></a>
                                    </li>
                                    <li>
                                        <i class="bi bi-tag"></i>
                                        <a href="<?php echo base_url('news/category/'.$news->category_slug); ?>">
                                            <?php echo $news->category; ?>
                                        </a>
                                    </li>
                                    <!-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="#">12 Comments</a></li> -->
                                </ul>
                            </div>
                            <div class="entry-content">
                                <p class="p-0">
                                    <a href="<?php echo base_url('/news/'.$news->slug); ?>" style="color: #111">
                                        <?php echo $news->description; ?>
                                    </a>
                                </p>
                            </div>
                        </article>
                    </a>
                    <?php endforeach; ?>
                </div>

                <div class="blog-pagination w-100">
                    <div class="pagination d-flex justify-content-center">
                        <li class="btn <?php echo $page['current'] == 1 ? 'disabled' : ''; ?>">
                            <a
                                href="<?php echo str_replace('#page', (intval($page['current']) - 1), $page['url']); ?>">Back</a>
                        </li>
                        <li class="btn disabled">
                            <a href="#"><?php echo $page['current']; ?></a>
                        </li>
                        <li class="btn <?php echo $page['next'] == 0 ? 'disabled' : ''; ?>">
                            <a class="disabled"
                                href="<?php echo str_replace('#page', (intval($page['current']) + 1), $page['url']); ?>">Next
                                <i class="fas fa-next"></i>
                            </a>
                        </li>
                    </div>
                </div>

            </div>
            <!-- End blog entries list -->

            <!-- Blog sidebar -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="sidebar" data-aos="fade-left" data-aos-delay="200">

                    <?php require 'sidebar.php'; ?>

                </div>
            </div>
            <!-- End blog sidebar -->

        </div>

    </div>
</section>