<?php include 'includes/header.php' ?>

<body>

<?php include 'includes/nav.php' ?>

<!-- Page Content -->
<div class="container">

<div class="row">

<!-- Blog Entries Column -->
<div class="col-md-8">

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
$post_content = $row['post_content'];

?>

<h1 class="page-header">
    Words of genius...
<small>from the mouth of a fool...</small>
</h1>

<!-- First Blog Post -->
<h2>
<?php echo $post_title ?>
</h2>
<p class="lead">
by <a href="/blog/index">

<?php
    if (!empty($post_author)) {
        echo "$post_author";
    } elseif (!empty($post_user)) {
        echo "$post_user";
    }

?></a>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
<hr>
<img class="img-responsive img-rounded" src="/blog/images/<?php echo imagePlaceHolder($post_image); ?>" alt="">
<hr>
<p><?php echo $post_content ?></p>

<!-- <hr> -->
           
<?php } ?>

<!-- Pager -->
<!-- <?php include 'includes/pager.php' ?> -->

</div>

<!-- Blog Sidebar Widgets Column -->
<?php include 'includes/sidebar.php' ?>

</div>
<!-- /.row -->

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
<a class="pull-left" href="#">
<img class="media-object" src="http://placehold.it/64x64" alt="">
</a>
<div class="media-body">
<h4 class="media-heading"><?php echo $com_author ; ?>
<small> <?php echo $com_date ; ?></small>
</h4>
<?php echo $com_content; ?>
</div>
</div>

<?php } } } else {
    header("Location: index.php");
}?>




</div>
<!-- Footer -->

<?php include 'includes/footer.php' ?>