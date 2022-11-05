<?php
    include('server/connection.php');

    if (isset($_GET['blog_id'])) {
        $blog_id = $_GET['blog_id'];

        $query_blog = "SELECT b.blog_title AS title, b.blog_tags AS tags, b.blog_date AS b_date, 
            b.blog_description AS b_description, b.blog_quotes AS quotes, b.blog_quotes_writer AS quote_writer,
            b.blog_image2 AS big_blog_image, a.admin_name AS writer, a.admin_photo AS photo 
            FROM blogs b, admins a 
            WHERE blog_id=$blog_id AND b.admin_id = a.admin_id";

        $stmt_blog = $conn->prepare($query_blog);

        $stmt_blog->execute();

        $blog_detail = $stmt_blog->get_result();
        
    } else {
        // no product id was given
        header('location: index.php');
    }
?>

<?php include('layouts/header.php'); ?>

    <?php while ($row = $blog_detail->fetch_assoc()) { ?>
        <!-- Blog Details Hero Begin -->
        <section class="blog-hero spad">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-9 text-center">
                        <div class="blog__hero__text">
                            <h2><?php echo $row['title']; ?></h2>
                            <ul>
                                <li>By <?php echo $row['writer']; ?></li>
                                <li><?php echo date('d F Y', strtotime($row['b_date'])); ?></li>
                                <li>8 Comments</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog Details Hero End -->

        <!-- Blog Details Section Begin -->
        <section class="blog-details spad">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-12">
                        <div class="blog__details__pic">
                            <img src="<?php echo 'assets/img/blog/details/'.$row['big_blog_image']; ?>" alt="">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="blog__details__content">
                            <div class="blog__details__share">
                                <span>share</span>
                                <ul>
                                    <li><a href="https://web.facebook.com/"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="https://twitter.com/" class="twitter"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.youtube.com/" class="youtube"><i class="fab fa-youtube"></i></a></li>
                                    <li><a href="https://www.linkedin.com/" class="linkedin"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <div class="blog__details__text">
                                <p><?php echo $row['b_description']; ?></p>
                            </div>
                            <div class="blog__details__quote">
                                <i class="fa fa-quote-left"></i>
                                <p><?php echo $row['quotes']; ?></p>
                                <h6><?php echo $row['quote_writer']; ?></h6>
                            </div>
                            <div class="blog__details__option">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="blog__details__author">
                                            <div class="blog__details__author__pic">
                                                <img src="<?php echo 'assets/img/blog/details/'.$row['photo']; ?>" alt="">
                                            </div>
                                            <div class="blog__details__author__text">
                                                <h5><?php echo $row['writer']; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="blog__details__tags">
                                            <a href="#"><?php echo $row['tags']; ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blog__details__comment">
                                <h4>Leave A Comment</h4>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <input type="text" placeholder="Name">
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <input type="text" placeholder="Email">
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <input type="text" placeholder="Phone">
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <textarea placeholder="Comment"></textarea>
                                            <button type="submit" class="site-btn">Post Comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog Details Section End -->
    <?php } ?>
<?php include('layouts/footer.php'); ?>