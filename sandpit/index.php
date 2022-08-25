<?php include 'header.php';?>
<?php include 'nav.php';?>

<div id="layoutDefault">
<div id="layoutDefault_content">
    <main> 
        <!-- Page Header-->
        <?php include 'page_header.php';?>

<!-- Content -->
<section class="bg-light py-10">
    <div class="container">
    <div class="row">
    
<div class="col-md-8">
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

<?php } } ?>    
    
</div>

<?php include "sidebar.php"; ?>    
    
    </div>



<?php include "pager.php"; ?>

</div>


<div class="svg-border-rounded text-dark">
<!-- Rounded SVG Border--><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
</div>
</section>
</main>
</div>

    

<?php include 'footer.php';?>