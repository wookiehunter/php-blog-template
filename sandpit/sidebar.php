<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">


<!-- Blog Search Well -->
<div class="well">
<h4>Blog Search</h4>
<form action="/blog/search.php" method="post">
<div class="input-group">
<input name="search" type="text" class="form-control">
<span class="input-group-btn">
<button name="submit" class="btn btn-default" type="submit">
<span class="glyphicon glyphicon-search"></span>
</button>
</span>
</div>
</form><!--search form-->
<!-- /.input-group -->
</div>

<!--Login -->
<div class="well">

<?php if(isset($_SESSION['role'])): ?>

<h4>Logged in as <?php echo $_SESSION['username'] ?></h4>

<a href="/blog/includes/logout.php" class="btn btn-primary">Logout</a>
<a href="/blog/admin/user_profile.php" class="btn btn-info">Update Profile</a>

<?php else: ?>

<h4>Login</h4>

<form method="post" action="/blog/login.php">
<div class="form-group">
<input name="u_name" type="text" class="form-control" placeholder="Enter Username">
</div>

<div class="input-group">
<input name="u_password" type="password" class="form-control" placeholder="Enter Password">
<span class="input-group-btn">
<button class="btn btn-primary" name="login" type="submit">Submit
</button>
</span>

</div>

<div>
<a href="/blog/forgot.php?forgot=<?php echo uniqid() ?>" class="">Forgot Password?</a>
</div>

<!-- <div class="form-group my-3">
<a href="forgot.php?forgot=<?php echo uniqid(true); ?> ">Forgot Password</a>
</div> -->

</form><!--search form-->
<!-- /.input-group -->

<?php endif; ?>

</div>

<!-- Blog Categories Well -->
<div class="well">

<?php 
$query = "SELECT * FROM categories";
$select_categories_sidebar = mysqli_query($connection,$query);         
?>
<h4>Article Categories</h4>
<div class="row">
<div class="col-lg-12">
<ul class="list-unstyled">

<?php 

while($row = mysqli_fetch_assoc($select_categories_sidebar )) {
$cat_title = $row['cat_title'];
$cat_id = $row['cat_id'];

echo "<li><a class='text-green font-weight-600' href='/blog/category/$cat_id'>{$cat_title}</a></li>";

}

?>

</ul>
</div>

</div>
<!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "widget.php"; ?>

</div>
