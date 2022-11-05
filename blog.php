<?php
    include('server/connection.php');

    $query_blogs = "SELECT * FROM blogs ORDER BY blog_id";

    $stmt_blogs = $conn->prepare($query_blogs);

    $stmt_blogs->execute();

    $blogs = $stmt_blogs->get_result();

?>

<?php include('layouts/header.php'); ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-blog set-bg" data-setbg="assets/img/breadcrumb-bg1.jpg">
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <?php foreach($blogs as $blog) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg" data-setbg="<?php echo 'assets/img/blog/'.$blog['blog_image']; ?>"></div>
                            <div class="blog__item__text">
                                <span><i class="fas fa-calendar-alt"></i> <?php echo date('d F Y', strtotime($blog['blog_date'])); ?></span>
                                <h5><?php echo $blog['blog_title']; ?></h5>
                                <a href="<?php echo "blog-details.php?blog_id=" . $blog['blog_id']; ?>">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

<?php include('layouts/footer.php'); ?>