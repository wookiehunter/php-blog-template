<?php  include "header.php"; ?>
<?php  include "nav.php"; ?>

<section class="bg-light py-10">
<div class="container">
<div class="row">

<div class="col-md-8">

<?php
if(isset($_POST['submit'])){

$search = $_POST['search'];


$query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
$search_query = mysqli_query($connection, $query);

if(!$search_query) {

die("QUERY FAILED" . mysqli_error($connection));

}

$count = mysqli_num_rows($search_query);

if($count == 0) {

echo "<h1> NO RESULT</h1>";

} else {

while($row = mysqli_fetch_assoc($search_query)) {
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
                    <p class="card-text"><?php echo $post_content; ?></p>
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
<?php } } } ?>    

</div>


<?php include "sidebar.php"; ?>
</div>

</div>
</section>




<?php  include "footer.php"; ?>