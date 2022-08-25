<?php include 'includes/header.php' ?>

<body>

<?php include 'includes/nav.php' ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
            Words of foolishness...
            <small>from the mouth of a genius...</small>
            </h1>

            <?php 

            $per_page = 5;

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = '';
            }

            if ($page === "" || $page === 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * $per_page) - $per_page;
            }

            if (isAdmin()) {
                $select_post_query_count = "SELECT * FROM posts ";
             } else {
                $select_post_query_count = "SELECT * FROM posts WHERE post_status = 'Approved' ";
             }

            $find_count = mysqli_query($connection,$select_post_query_count);
            $count = mysqli_num_rows($find_count);

            if ($count < 1) {
                echo "<h1 class='text-center'>No Posts Available!</h1>";
            } else {
            $count = ceil($count / $per_page);

            if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
                $query = "SELECT * FROM posts LIMIT $page_1, $per_page ";
             } else {
                $query = "SELECT * FROM posts WHERE post_status = 'Approved' LIMIT $page_1, $per_page ";
             }

            $select_all_posts = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 50);
                $post_status = $row['post_status'];

                ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post/<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php if (!empty($post_author)) {
                        echo "$post_author";
                    } elseif (!empty($post_user)) {
                        echo "$post_user";
                    }?>&p_id=<?php echo $post_id; ?>">
                    <?php
                    
                    if (!empty($post_author)) {
                        echo "$post_author";
                    } elseif (!empty($post_user)) {
                        echo "$post_user";
                    }
                    
                    ?>
                    </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive img-rounded" src="images/<?php echo imagePlaceHolder($post_image); ?>" alt=""></a>
               
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>


           <?php } } ?>


                <!-- Pager -->
                <?php include 'includes/pager.php' ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php' ?>

        </div>
        <!-- /.row -->

        <hr>

        <ul class="pager">

        <?php 


$number_list = array();


for($i =1; $i <= $count; $i++) {


if($i == $page) {

     echo "<li '><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";


}  else {

    echo "<li '><a href='index.php?page={$i}'>{$i}</a></li>";        
 

}
   
}






 ?>
        </ul>

        <!-- Footer -->

    <?php include 'includes/footer.php' ?>
