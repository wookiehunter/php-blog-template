<?php
if (isset($_POST['create_post'])) {


$post_title = $_POST['title'];
$post_user = $_POST['post_user'];
$post_category = $_POST['post_category'];
$post_status = $_POST['post_status'];

$post_image = $_FILES['post_image']['name'];
$post_image_temp = $_FILES['post_image']['tmp_name'];

$post_tags = $_POST['post_tags'];
$post_content = $_POST['post_content'];
$post_date = date('d-m-y');
// $post_comment_count = 4;

move_uploaded_file($post_image_temp, "../images/$post_image ");

$query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_content, post_tags, post_status) VALUES({$post_category}, '{$post_title}', '{$post_user}',now(),'{$post_content}','{$post_tags}','{$post_status}' ) ";

$create_post_query = mysqli_query($connection, $query);

confirmQuery($create_post_query);

$the_post_id = mysqli_insert_id($connection);

echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";

}
?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="title">Post Title</label>
<input type="text" name="title" id="" class="form-control">
</div>

<div class="form-group">
<label for="post_category">Post Categories</label>
<select class="form-control" name="post_category" id="post_category">
<option value="">--- SELECT CATEGORY ---</option>
<?php 
$query = "SELECT * FROM categories ";
$select_categories = mysqli_query($connection,$query);         

confirmQuery($select_categories);

while($row = mysqli_fetch_assoc($select_categories )) {
$cat_title = $row['cat_title'];
$cat_id = $row['cat_id'];

echo "<option value='{$cat_id}'>$cat_title</option>";
}
?>
</select>
</div>

<div class="form-group">
<label for="post_user">Post User</label>
<select class="form-control" name="post_user" id="post_user">
<option value="">--- SELECT USER ---</option>
<?php 
$query = "SELECT * FROM users ";
$select_users = mysqli_query($connection,$query);         

confirmQuery($select_users);

while($row = mysqli_fetch_assoc($select_users )) {
$u_name = $row['u_name'];
$u_id = $row['u_id'];

echo "<option value='{$u_name}'>$u_name</option>";
}
?>
</select>
</div>

<div class="form-group">
<label for="post_status">Status</label>
<select class="form-control" name="post_status" id="">
<option value="Draft">--- SELECT STATUS ---</option>
<option value="Draft">Draft</option>
<option value="Approved">Approved</option>
</select>
</div>

<div class="form-group">
<label for="post_image">Post Image</label>
<input type="file" name="post_image" class="form-control">
</div>

<div class="form-group">
<label for="post_tags">Post Tags</label>
<input type="text" name="post_tags" class="form-control">
</div>

<div class="form-group">
<label for="post_content">Post Content</label>
<textarea name="post_content" class="form-control" id="editor" cols="30" rows="10"></textarea>
</div>


<div class="form-group">
<input type="submit" name="create_post" value="Publish Post" class="btn btn-primary">
</div>


</form>

