<?php include "includes/header.php" ?>

<body>

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
</div>
</div>
<!-- /.row -->

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">

<?php 

if (isset($_GET['source'])) {
$source = $_GET['source'];

} else {
$source = '';
}

switch($source) {
case 'add_comment':
include './includes/add_comment.php';
break;

case 'id':
include './post_comments.php';
break;

default:
include "includes/view_comments.php";
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