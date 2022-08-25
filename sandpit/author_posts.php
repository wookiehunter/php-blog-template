<?php include 'header.php' ?>
<?php include 'nav.php' ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">

        <h1 class="mb-5">
Legendary words...
<small>from an ignoble poet...</small>
</h1>

        <?php 

if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
    $the_post_author = $_GET['author'];
}

$query = "SELECT * FROM posts WHERE post_user = '{$the_post_author}'";
$select_all_posts = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_all_posts)) {
$post_title = $row['post_title'];
$post_user = $row['post_user'];
$post_user = $row['post_user'];
$post_date = $row['post_date'];
$post_image = $row['post_image'];
$post_image_credit = $row['post_image_credit'];
$post_content = $row['post_content'];

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
           
<?php }?>

        </div>
        <?php include 'sidebar.php'; ?>
    </div>
</div>

<?php include 'footer.php' ?>