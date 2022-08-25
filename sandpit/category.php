<?php include 'header.php' ?>
<?php include 'nav.php' ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">

<h1 class="mb-5">
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

?>


<?php
while (mysqli_stmt_fetch($stmt)):

?>

<!-- First Blog Post -->
<a class="card post-preview post-preview-featured lift mb-5" href="post.php?p_id=<?php echo $post_id; ?>">
    <div class="row no-gutters">
        <div class="col-lg-5">
            <div class="post-preview-featured-img">
                <img class="img-fluid" src="../images/<?php echo imagePlaceHolder($post_image); ?>" alt="<?php echo $post_title; ?>">
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card-body">
                <div class="py-5">
                    <h5 class="card-title"><?php echo $post_title; ?></h5>
                    <p class="card-text"><?php echo $post_content = substr($post_content, 0, 50); ?></p>
                </div>
                <hr />
                <div class="post-preview-meta">
                    <img class="post-preview-meta-img" src="assets/img/me.jpg" />
                    <div class="post-preview-meta-details">
                        <div class="post-preview-meta-details-name"><?php echo $post_user ?></div>
                        <div class="post-preview-meta-details-date">Posted on: <?php echo $post_date ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>

<hr>


<?php endwhile; mysqli_stmt_close($stmt); } ?>

<!-- Pager -->
<!-- <?php include 'pager.php' ?> -->

        </div>

        <?php include 'sidebar.php'; ?>

    </div>
</div>


<?php include 'footer.php' ?>