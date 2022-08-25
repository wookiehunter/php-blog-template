<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>

<div id="layoutDefault">
<section class="bg-light py-10">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
            <?php 

            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];

                $view_query  = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
                $send_query = mysqli_query($connection, $view_query);

                if (!$send_query) {
                    die("Query failed: " . mysqli_error($connection));
                }

                if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                } else {
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'Approved' ";
                } 

            $select_all_posts = mysqli_query($connection, $query);

            if (mysqli_num_rows($select_all_posts) < 1) {
                echo "<h1 class='text-secondary text-center'>No Posts Available!</h1>";
            } else {



            while ($row = mysqli_fetch_assoc($select_all_posts)) {
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_user = $row['post_user'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_image_credit = $row['post_image_credit'];
            $post_content = $row['post_content'];

            ?>
            <div class="single-post">
                <h1><?php echo $post_title; ?></h1>
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <div class="single-post-meta mr-4">
                        <img class="single-post-meta-img" src="assets/img/me.jpg" />
                        <div class="single-post-meta-details">
                            <div class="single-post-meta-details-name"><?php echo $post_user; ?></div>
                            <div class="single-post-meta-details-date"><?php echo $post_date; ?></div>
                        </div>
                    </div>
                    <div class="single-post-meta-links">
                        <a href="https://www.twitter.com/TheStevenGodson"><i class="fab fa-twitter fa-fw"></i></a>
                        <!-- <a href="#!"><i class="fab fa-facebook-f fa-fw"></i></a> -->
                        <!--  <a href="#!"><i class="fas fa-bookmark fa-fw"></i></a> -->
                    </div>
                </div>
                <img class="img-fluid mb-2" src="/blog/images/<?php echo imagePlaceHolder($post_image); ?>" />
                <?php
                if ($post_image_credit) {
                    echo "<div class='small text-gray-500 text-center'>Photo Credit: {$post_image_credit}</div>";
                }
                ?>

                <div class="single-post-text my-5">
                    <?php echo $post_content; ?>
                    
                    <?php } ?>

                    <hr>
<!-- Blog Comments -->

<?php
if (isset($_POST['create_comment'])) {
    $the_post_id = $_GET['p_id'];

    $com_author = $_POST['com_author'];
    $com_email = $_POST['com_email'];
    $com_content = $_POST['com_content'];

    if (!empty($com_author) && !empty($com_email) && !empty($com_content)) {
        
        $query = "INSERT INTO comments (com_post_id, com_author, com_email, com_content, com_status, com_date) ";
        $query .= "VALUES ($the_post_id, '{$com_author}', '{$com_email}', '{$com_content}', 'Draft', now() )";

        $create_comment = mysqli_query($connection, $query);

        if (!$create_comment) {
            die('Query Failed' . mysqli_error($connection));
        }

        // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
        // $set_com_count_query = mysqli_query($connection, $query);

        echo "<h3 class='text-success'>Thank you for you comment it has been submitted for review.<h3>";
    } else {
        echo "<h3 class='text-danger'>All fields must be filled in.<h3>";
    }
}

?>

<!-- Comments Form -->
<div class="well">
<h4>Leave a Comment:</h4>
<form role="form" method="post" action="">
<div class="form-group">
<label for="com_author">Your name</label>
<input class="form-control" type="text" name="com_author" id="">
</div>
<div class="form-group">
<label for="com_email">Your email</label>
<input class="form-control" type="email" name="com_email" id="">
</div>
<div class="form-group">
<label for="com_content">Your comment</label>
<textarea class="form-control" rows="3" name="com_content" id="editor"></textarea>
</div>
<button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
</form>
</div>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

<hr>

<!-- Posted Comments -->

<?php
$query = "SELECT * FROM comments WHERE com_post_id = {$the_post_id} ";
$query .= "AND com_status = 'APPROVED' ";
$query .= "ORDER BY com_id DESC";
$select_comments_query = mysqli_query($connection, $query);
if (!$select_comments_query) {
    die('Query Failed' . mysqli_error($connection));
}
while ($row = mysqli_fetch_assoc($select_comments_query)) {
    $com_date = $row['com_date'];
    $com_content = $row['com_content'];
    $com_author = $row['com_author'];
?>

<!-- Comment -->
<div class="media">
<!-- <a class="pull-left" href="#">
<img class="media-object mr-3" src="http://placehold.it/64x64" alt="">
</a> -->
<div class="media-body">
<h4 class="media-heading"><?php echo $com_author ; ?>
<small class="ml-3"> <?php echo $com_date ; ?></small>
</h4>
<?php echo $com_content; ?>
</div>
</div>

<?php } } } else {
    header("Location: index.php");
}?>


                    <hr class="my-5" />
                    <div class="text-center"><a class="btn btn-transparent-dark" href="/blog/">Back to Home</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="svg-border-rounded text-dark">
    <!-- Rounded SVG Border--><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
</div>
</section>


<?php include 'footer.php'; ?>