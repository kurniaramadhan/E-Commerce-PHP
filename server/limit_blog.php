<?php
    include('server/connection.php');

    $query_limit_blog = "SELECT * FROM blogs ORDER BY blog_date DESC LIMIT 3";

    $stmt_limit_blog = $conn->prepare($query_limit_blog);

    $stmt_limit_blog->execute();

    $limit_blog = $stmt_limit_blog->get_result();

?>