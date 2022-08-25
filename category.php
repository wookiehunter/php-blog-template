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

if (isset($_GET['category'])) {
$post_category = $_GET['category'];

if (isAdmin()) {
   $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_user, post_date, post_image, post_content FROM posts WHERE post_category_id = ?" );
} else {
   $stmt2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_user, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ? ");

   $approved = 'Approved';
}

if (isset($stmt1)) {
   mysqli_stmt_bind_param($stmt1, "i", $post_category);

   mysqli_stmt_execute($stmt1);

   mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_user, $post_date, $post_image, $post_content);

   $stmt = $stmt1;

} else {
   mysqli_stmt_bind_param($stmt2, "is", $post_category, $approved);

   mysqli_stmt_execute($stmt2);

   mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_user, $post_date, $post_image, $post_content);

   $stmt = $stmt2;


}

   // if (mysqli_stmt_num_rows($stmt) < 1) {
   //    echo "<h1 class='text-secondary text-center'>No Posts Available!</h1>";
   //    }
?>


<?php
while (mysqli_stmt_fetch($stmt)):

?>

<!-- First Blog Post -->
<h2>
<a href="/blog/post/<?php echo $post_id; ?>"><?php echo $post_title ?></a>
</h2>
<p class="lead">
by <a href="/blog/index"><?php echo $post_user ?></a>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
<hr>
<img class="img-responsive img-rounded" src="/blog/images/<?php echo imagePlaceHolder($post_image); ?>" alt="">
<hr>
<p><?php echo $post_content ?></p>
<!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

<hr>


<?php endwhile; mysqli_stmt_close($stmt); } ?>

<!-- Pager -->
<!-- <?php include 'includes/pager.php' ?> -->

</div>

<!-- Blog Sidebar Widgets Column -->
<?php include 'includes/sidebar.php' ?>

</div>
<!-- /.row -->

<!-- <hr> -->

<!-- Footer -->

<?php include 'includes/footer.php' ?>
