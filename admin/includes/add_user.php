<?php
if (isset($_POST['create_user'])) {

// $u_id = $_POST['u_id'];
$u_name = $_POST['u_name'];
$u_firstname = $_POST['u_firstname'];
$u_lastname = $_POST['u_lastname'];
$u_email = $_POST['u_email'];
$u_password = $_POST['u_password'];
$u_image = $_FILES['u_image']['name'];
$u_image_temp = $_FILES['u_image']['tmp_name'];
$u_role = $_POST['u_role'];
// $u_date = date('d-m-y');
// $post_comment_count = 4;

move_uploaded_file($u_image_temp, "../images/$u_image ");

$u_password = password_hash($u_password, PASSWORD_BCRYPT, array('cost' => 15));


$query = "INSERT INTO users(u_name, u_firstname, u_lastname, u_email, u_password, u_image, u_role) VALUES('{$u_name}', '{$u_firstname}', '{$u_lastname}','{$u_email}', '{$u_password}','{$u_image}','{$u_role}' ) ";

$create_user_query = mysqli_query($connection, $query);

confirmQuery($create_user_query);

echo "User Created:" . " " . "<a href='users.php'>View Users</a>";

}
?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="u_name">Username</label>
<input type="text" name="u_name" id="" class="form-control">
</div>

<div class="form-group">
<label for="u_firstname">Firstname</label>
<input type="text" name="u_firstname" class="form-control">
</div>

<div class="form-group">
<label for="u_lastname">Lastname</label>
<input type="text" name="u_lastname" class="form-control">
</div>

<div class="form-group">
<label for="u_email">Email</label>
<input type="email" name="u_email" class="form-control">
</div>

<div class="form-group">
<label for="u_password">Password</label>
<input type="password" name="u_password" class="form-control">
</div>

<div class="form-group">
<label for="u_image">User Image</label>
<input type="file" name="u_image" class="form-control">
</div>

<div class="form-group">
<label for="u_role">User Role</label>
<select class="form-control" name="u_role" id="u_role">
<option value="">--- Select Option ---</option>
<option value="Admin">Admin</option>
<option value="Contributor">Contributor</option>
<option value="Subscriber">Subscriber</option>
</select>
</div>



<div class="form-group">
<input type="submit" name="create_user" value="Create User" class="btn btn-primary">
</div>


</form>