<?php 

if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
$select_posts_by_id = mysqli_query($connection,$query);         

while($row = mysqli_fetch_assoc($select_posts_by_id )) {
$post_id = $row['post_id'];
$post_user = $row['post_user'];
$post_title = $row['post_title'];
$post_date = $row['post_date'];
$post_image = $row['post_image'];
$post_comment_count = $row['post_comment_count'];
$post_tags = $row['post_tags'];
$post_status = $row['post_status'];
$post_category_id = $row['post_category_id'];
$post_content = $row['post_content'];
}

if(isset($_POST['update_post'])) {
        
        
    // $post_user           =  $_POST['post_user'];
    $post_title          =  $_POST['title'];
    $post_category_id    =  $_POST['post_category'];
    $post_status         =  $_POST['post_status'];
    $post_image          =  $_FILES['post_image']['name'];
    $post_image_temp     =  $_FILES['post_image']['tmp_name'];
    $post_content        =  $_POST['post_content'];
    $post_tags           =  $_POST['post_tags'];
    $post_user           =  $_POST['post_user'];
    
    
    move_uploaded_file($post_image_temp, "../images/$post_image"); 
    
    if(empty($post_image)) {
    
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
    $select_image = mysqli_query($connection,$query);
        
    while($row = mysqli_fetch_array($select_image)) {
        
       $post_image = $row['post_image'];
    
    }
    
    
}
    $post_title = mysqli_real_escape_string($connection, $post_title);

    
      $query = "UPDATE posts SET ";
      $query .="post_title  = '{$post_title}', ";
      $query .="post_category_id = '{$post_category_id}', ";
      $query .="post_date   =  now(), ";
      $query .="post_user = '{$post_user}', ";
      $query .="post_status = '{$post_status}', ";
      $query .="post_tags   = '{$post_tags}', ";
      $query .="post_content= '{$post_content}', ";
      $query .="post_image  = '{$post_image}' ";
      $query .= "WHERE post_id = {$the_post_id} ";
    
    $update_post = mysqli_query($connection,$query);
    
    confirmQuery($update_post);
    
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";
    



}

?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="title">Post Title</label>
<input value="<?php echo $post_title; ?>" type="text" name="title" id="" class="form-control">
</div>

<div class="form-group">
<label for="post_category">Post Categories</label>
<select class="form-control" name="post_category" id="post_category">

<?php 

$query = "SELECT * FROM categories ";
$select_categories = mysqli_query($connection,$query);         

confirmQuery($select_categories);

while($row = mysqli_fetch_assoc($select_categories )) {
$cat_title = $row['cat_title'];
$cat_id = $row['cat_id'];

if ($cat_id == $post_category_id) {
    echo "<option selected value='{$cat_id}'>$cat_title</option>";
} else {
    echo "<option value='{$cat_id}'>$cat_title</option>";
}

}
?>
</select>

</div>

<div class="form-group">
<label for="post_user">Post User</label>
<select class="form-control" name="post_user" id="post_user">
<!-- <option value="<?php echo $post_user; ?>">--- SELECT USER ---</option> -->
<?php 
$query = "SELECT * FROM users ";
$select_users = mysqli_query($connection,$query);         

confirmQuery($select_users);

while($row = mysqli_fetch_assoc($select_users )) {
$u_name = $row['u_name'];
$u_id = $row['u_id'];

if ($u_id == $post_user) {
    echo "<option selected value='{$u_name}'>$u_name</option>";
} else {
    echo "<option value='{$u_name}'>$u_name</option>";
}

}
?>
</select>
</div>

<!-- <div class="form-group">
<label for="author">Post Author</label>
<input value="<?php echo $post_author; ?>" type="text" name="author" class="form-control">
</div> -->

<div class="form-group">
<?php echo "Current Status " . "<strong>$post_status</strong>"; ?>
<br>
<label for="post_status">Select New Status</label>
<select class="form-control" name="post_status" id="">
<option value="Draft">Draft</option>
<option value="Rejected">Rejected</option>
<option value="Approved">Approved</option>
</select>
<!-- <input value="<?php echo $post_status; ?>" type="text" name="post_status" class="form-control"> -->
</div>

<div class="form-group">
<img src="../images/<?php echo $post_image; ?>" alt="image" width="200px">
<!-- <input value="<?php echo $post_image; ?>" type="file" name="post_image" class="form-control"> -->
</div>

<div class="form-group">
<label for="post_image">Post Image</label>
<input type="file" name="post_image" class="form-control">
</div>

<div class="form-group">
<label for="post_tags">Post Tags</label>
<input value="<?php echo $post_tags; ?>" type="text" name="post_tags" class="form-control">
</div>

<div class="form-group">
<label for="post_content">Post Content</label>
<textarea id="editor" type="text" name="post_content" class="form-control"><?php echo str_replace('\r\n', '<br>', $post_content); ?></textarea>
</div>

<div class="form-group">
<input type="submit" name="update_post" value="Update Post" class="btn btn-primary">
</div>

</form>