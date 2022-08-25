<?php
if (isset($_GET['edit_users'])) {
    $the_user_id = $_GET['edit_users'];

    $query = "SELECT * FROM users WHERE u_id = $the_user_id";
    $select_user_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $the_user_id = $row['u_id'];
        $the_user_name = $row['u_name'];
        $the_user_firstname = $row['u_firstname'];
        $the_user_lastname = $row['u_lastname'];
        $db_user_password = $row['u_password'];
        $the_user_image = $row['u_image'];
        $the_user_role = $row['u_role'];
        $the_user_email = $row['u_email'];
    }
}
?>

<?php

if (isset($_POST['update_user'])) {

$u_name = $_POST['u_name'];
$u_firstname = $_POST['u_firstname'];
$u_lastname = $_POST['u_lastname'];
$u_email = $_POST['u_email'];
$u_password = $_POST['u_password'];
// $u_image = $_FILES['u_image']['name'];
// $u_image_temp = $_FILES['u_image']['tmp_name'];
$u_role = $_POST['u_role'];


// move_uploaded_file($u_image_temp, "../images/$u_image ");

// if ($u_password !== $db_user_password) {
// $query = "SELECT randSalt FROM users";
// $select_randsalt_query = mysqli_query($connection, $query);

// if (!$select_randsalt_query) {
//     die('Query failed ' . mysqli_error($connection));
// }

// $row = mysqli_fetch_array($select_randsalt_query);

// $salt = $row['randSalt'];

// $hashed_password = crypt($u_password, $salt);  
// } else {
//     $hashed_password = $u_password;
// }

if (!empty($u_password)) {
    $query_password = "SELECT u_password FROM users WHERE u_id = $the_user_id";
    $get_user = mysqli_query($connection, $query_password);
    confirmQuery($get_user);

    $row = mysqli_fetch_array($get_user);

    $db_user_password = $row['u_password'];

    if ($db_user_password != $u_password) {
        $hashed_password = password_hash($u_password, PASSWORD_BCRYPT, array('cost' => 15));
    }

    $query = "UPDATE users SET ";
    $query .= "u_name = '{$u_name}', ";
    $query .= "u_firstname = '{$u_firstname}', ";
    $query .= "u_lastname = '{$u_lastname}', ";
    $query .= "u_email = '{$u_email}', ";
    $query .= "u_password = '{$hashed_password}', ";
    // $query .= "u_image = '{$u_image}', ";
    $query .= "u_role = '{$u_role}' ";
    $query .= "WHERE u_id = {$the_user_id} ";


    $edit_user_query = mysqli_query($connection, $query);

    confirmQuery($edit_user_query);

}


echo "User Updated" . " <a href='users.php'>View Users?</a>";

}
?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="u_name">Username</label>
<input value="<?php echo $the_user_name; ?>" type="text" name="u_name" id="" class="form-control">
</div>

<div class="form-group">
<label for="u_firstname">Firstname</label>
<input value="<?php echo $the_user_firstname; ?>" type="text" name="u_firstname" class="form-control">
</div>

<div class="form-group">
<label for="u_lastname">Lastname</label>
<input value="<?php echo $the_user_lastname; ?>" type="text" name="u_lastname" class="form-control">
</div>

<div class="form-group">
<label for="u_email">Email</label>
<input value="<?php echo $the_user_email; ?>" type="email" name="u_email" class="form-control">
</div>

<div class="form-group">
<label for="u_password">Password</label>
<input autocomplete="off" value="<?php echo $the_user_password; ?>" type="password" name="u_password" class="form-control">
</div>

<div class="form-group">
<label for="u_image">User Image</label>
<input value="<?php echo $the_user_image; ?>" type="file" name="u_image" class="form-control">
</div>

<div class="form_group">
<h5><strong>Current Role: </strong><?php echo $the_user_role; ?></h5>
</div>

<div class="form-group">
<label for="u_role">User Role</label>
<select class="form-control" name="u_role" id="u_role">
<option value="<?php echo $the_user_role; ?>"><?php echo $the_user_role; ?></option>
<?php
if ($the_user_role === 'Admin') {
    echo "<option value='Subscriber'>Subscriber</option>";
} else {
    echo "<option value='Admin'>Admin</option>";
}
?>
</select>
</div>



<div class="form-group">
<input type="submit" name="update_user" value="Update User" class="btn btn-primary">
</div>


</form>