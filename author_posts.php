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
    $the_post_author = $_GET['author'];
}

$query = "SELECT * FROM posts WHERE post_user = '{$the_post_author}'";
$select_all_posts = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_all_posts)) {
$post_title = $row['post_title'];
$post_user = $row['post_user'];
$post_author = $row['post_author'];
$post_date = $row['post_date'];
$post_image = $row['post_image'];
$post_content = $row['post_content'];

?>

<h1 class="page-header">
Page Heading
<small>Secondary Text</small>
</h1>

<!-- First Blog Post -->
<h2>
<a href="post.php?p_id=<?php echo $the_post_id; ?>"><?php echo $post_title ?></a>
</h2>
<p class="lead">
All posts by: 
<?php
if (!empty($post_author)) {
    echo "$post_author";
} elseif (!empty($post_user)) {
    echo "$post_user";
}
?>
</p>
<p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
<hr>
<img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
<hr>
<p><?php echo $post_content ?></p>

<hr>
           
<?php }?>

<!-- Pager -->
<?php include 'includes/pager.php' ?>

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

        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
        $set_com_count_query = mysqli_query($connection, $query);

        echo "<h3 class='text-success'>Thank you for you comment it has been submitted for review.<h3>";
    } else {
        echo "<h3 class='text-danger'>All fields must be filled in.<h3>";
    }





}

?>

<!-- Footer -->

<?php include 'includes/footer.php' ?>

