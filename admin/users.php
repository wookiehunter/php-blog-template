<?php include "includes/header.php" ?>

<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: index.php");
}

?>

<div id="wrapper">

<!-- Navigation -->
<?php include "includes/nav.php" ?>


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

<?php 

if (isset($_GET['source'])) {
$source = $_GET['source'];

} else {
$source = '';
}

switch($source) {
    case 'add_user';
    
     include "includes/add_user.php";
    
    break; 
    
    
    case 'edit_users';
    
    include "includes/edit_users.php";
    break;

default:
    include "includes/view_users.php";
    break;

}


?>

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