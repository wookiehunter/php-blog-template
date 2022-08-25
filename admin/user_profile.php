<?php include "includes/header.php"; ?>

<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE u_name = '{$username}'";
    $select_user_profile = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_user_profile)) {
        $the_u_id = $row['u_id'];
        $the_u_name = $row['u_name'];
        $the_u_firstname = $row['u_firstname'];
        $the_u_lastname = $row['u_lastname'];
        $the_u_email = $row['u_email'];
        $the_u_image = $row['u_image'];
        $the_u_role = $row['u_role'];
        $db_user_password = $row['u_password'];
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
$u_image = $_FILES['u_image']['name'];
$u_image_temp = $_FILES['u_image']['tmp_name'];


move_uploaded_file($u_image_temp, "../images/$u_image ");

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

// $query = "UPDATE users SET ";
// $query .= "u_name = '{$u_name}', ";
// $query .= "u_firstname = '{$u_firstname}', ";
// $query .= "u_lastname = '{$u_lastname}', ";
// $query .= "u_email = '{$u_email}', ";
// $query .= "u_password = '{$hashed_password}', ";
// $query .= "u_image = '{$u_image}', ";
// $query .= "u_role = '{$u_role}' ";
// $query .= "WHERE u_name = '{$username}' ";


// $create_user_query = mysqli_query($connection, $query);

// confirmQuery($create_user_query);

if (!empty($u_password)) {
    $query_password = "SELECT u_password FROM users WHERE u_id = $the_u_id";
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
    $query .= "u_password = '{$hashed_password}' ";
    // $query .= "u_image = '{$u_image}', ";
    // $query .= "u_role = '{$u_role}' ";
    $query .= "WHERE u_id = {$the_u_id} ";


    $edit_user_query = mysqli_query($connection, $query);

    confirmQuery($edit_user_query);

}


echo "User Updated" . " <a href='/blog/'>Home</a>";

}
?>


<div id="wrapper">

<!-- Navigation -->
<?php include "includes/nav.php"; ?>


<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">
Welcome to Admin

<small><?php echo $_SESSION['username']; ?></small>
<small> - Role is: <?php echo $_SESSION['role']; ?></small>
</h1>
</div>
</div>
<!-- /.row -->


<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<div class="text-center">
<?php
if (isset($_POST['update_user'])) {
    echo "<strong>Profile Updated</strong>";
    if ($the_u_role == 'Admin') {
        header("Location: /blog/admin");
    } else {
        header("Location: /blog/");
    }
    
}
?>
</div>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group mt-2">
<label for="u_name">Username</label>
<input type="text" value="<?php echo $the_u_name; ?>" name="u_name" id="" class="form-control">
</div>

<div class="form-group">
<label for="u_firstname">Firstname</label>
<input value="<?php echo $the_u_firstname; ?>" type="text" name="u_firstname" class="form-control">
</div>

<div class="form-group">
<label for="u_lastname">Lastname</label>
<input value="<?php echo $the_u_lastname; ?>" type="text" name="u_lastname" class="form-control">
</div>

<div class="form-group">
<label for="u_email">Email</label>
<input value="<?php echo $the_u_email; ?>" type="email" name="u_email" class="form-control">
</div>

<div class="form-group">
<label for="u_password">Password</label>
<input value="<?php echo $the_u_password; ?>" type="password" name="u_password" class="form-control">
</div>

<div class="form-group">
<label for="u_image">User Image</label>
<input value="<?php echo $the_u_image; ?>" type="file" name="u_image" class="form-control">
</div>

<!-- <div class="form-group">
<label for="u_role">User Role</label>
<select class="form-control" name="u_role" id="u_role">
<option value="<?php echo $the_u_role; ?>"><?php echo $the_u_role; ?></option>
<?php
if ($the_u_role == 'Admin') {
    echo "<option value='Subscriber'>Subscriber</option>";
} else {
    echo "<option value='Admin'>Admin</option>";
}
?>
</select>
</div> -->


<div class="form-group">
<input type="submit" name="update_user" value="Update Your Profile" class="btn btn-primary">
</div>


</form>

</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/footer.php"; ?>