<style>
.newsContent img {
    width: 100% !important;
    height: 100% !important;
}

.newsCover {
    align-items: center;
    object-fit: cover;
    margin: auto;
    display: block;
}
</style>
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>News</h2>
            <ol class="newsRoti">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url('/news'); ?>">News</a></li>
                <li><a
                        href="<?php echo base_url('/news/category/'.$newsData[0]->category_slug); ?>"><?php echo $newsData[0]->category; ?></a>
                </li>
                <li><a href="#"><?php echo $newsData[0]->title; ?></a></li>
            </ol>
        </div>

    </div>
</section>

<section id="blog" class="blog">
    <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-8 entries">

                <article class="entry entry-single" id="articleDetail">

                    <div class="entry-img coverGan">
                        <img src="<?php echo base_url('/uploads/cover/'.$newsData[0]->cover); ?>" alt=""
                            class="img-fluid newsCover">
                    </div>

                    <h2 class="entry-title newsTitle text-dark">
                        <?php echo $newsData[0]->title; ?>
                    </h2>

                    <div class="entry-meta">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi bi-person newsAuthor"></i> <a
                                    href="#"><?php echo $newsData[0]->author; ?></a></li>
                            <li class="d-flex align-items-center"><i class="bi bi-clock newsTime"></i> <a href="#"><time
                                        datetime="<?php echo date('Y-m-d', strtotime($newsData[0]->created_at)); ?>"><?php echo date('Y-m-d', strtotime($newsData[0]->created_at)); ?></time></a>
                            </li>
                            <!-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">12 Comments</a></li> -->
                        </ul>
                    </div>

                    <div class="entry-content newsContent">
                        <?php echo $newsData[0]->content; ?>
                    </div>

                    <div class="entry-footer">
                        <i class="bi bi-folder"></i>
                        <ul class="cats">
                            <li><a
                                    href="<?php echo base_url('/news/category/'.$newsData[0]->category_slug); ?>"><?php echo $newsData[0]->category; ?></a>
                            </li>
                        </ul>

                        <i class="bi bi-tags"></i>
                        <ul class="tags">
                            <?php echo str_replace(' ', ', ', $newsData[0]->tags); ?>
                        </ul>
                    </div>

                </article>
                <!-- End blog entry -->

                <div class="blog-author d-flex align-items-center">
                    <img src="<?php echo $newsData[0]->author_photo == '' ? base_url('assets/img/user.png') : base_url('uploads/users/'.$newsData[0]->author_photo); ?>"
                        class="rounded float-left" alt="">
                    <div>
                        <h4 class="newsAuthor"><?php echo $newsData[0]->author; ?></h4>
                        <div class="social-links">
                            <?php foreach ($newsData[0]->socials as $social) : ?>
                            <a href="<?php echo $social->link; ?>"><i
                                    class="bi bi-<?php echo $social->social; ?>"></i></a>
                            <?php endforeach; ?>
                        </div>
                        <p>
                            <?php echo $newsData[0]->quotes; ?>
                        </p>
                    </div>
                </div><!-- End blog author bio -->

            </div><!-- End blog entries list -->

            <div class="col-lg-4">

                <div class="sidebar" id="sideBars">

                    <?php require 'sidebar.php'; ?>

                </div><!-- End sidebar -->

            </div><!-- End blog sidebar -->

        </div>

    </div>
</section>