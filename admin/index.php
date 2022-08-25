<?php include "includes/header.php" ?>

<?php
$approved_posts_count = rowCountByField('posts','post_status','Approved');
$draft_posts_count = rowCountByField('posts','post_status','Draft');
$rejected_posts_count = rowCountByField('posts','post_status','Rejected');

$approved_comments_count = rowCountByField('comments','com_status','Approved');
$draft_comments_count = rowCountByField('comments','com_status','Draft');

$admin_users_count = rowCountByField('users','u_role','Admin');
$sub_users_count = rowCountByField('users','u_role','Subscriber');

?>

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
Dashboard

<small><?php echo getUsername(); ?></small>
<small> - Role is: <?php echo $_SESSION['role']; ?></small>
</h1>
</div>
</div>
<!-- /.row -->


<!-- /.row -->

<div class="row">
<div class="col-lg-3 col-md-6">
<div class="panel panel-primary">
<div class="panel-heading">
<div class="row">
<div class="col-xs-3">
<i class="fa fa-file-text fa-5x"></i>
</div>


<div class="col-xs-9 text-right">
<div class='huge'><?php echo recordCount('posts'); ?></div>
<div>Posts</div>
</div>
</div>
</div>
<?php
if (isAdmin()) {
    echo "
        <a href='posts.php'>
        <div class='panel-footer'>
        <span class='pull-left'>View Details</span>
        <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
        <div class='clearfix'></div>
        </div>
        </a>    
    ";
}
?>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="panel panel-green">
<div class="panel-heading">
<div class="row">
<div class="col-xs-3">
<i class="fa fa-comments fa-5x"></i>
</div>


<div class="col-xs-9 text-right">
<div class='huge'><?php echo $comment_count = recordCount('comments'); ?></div>
<div>Comments</div>
</div>
</div>
</div>
<?php
if (isAdmin()) {
    echo "
        <a href='comments.php'>
        <div class='panel-footer'>
        <span class='pull-left'>View Details</span>
        <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
        <div class='clearfix'></div>
        </div>
        </a>    
    ";
}
?>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="panel panel-yellow">
<div class="panel-heading">
<div class="row">
<div class="col-xs-3">
<i class="fa fa-user fa-5x"></i>
</div>


<div class="col-xs-9 text-right">
<div class='huge'><?php echo $user_count = recordCount('users'); ?></div>
<div> Users</div>
</div>
</div>
</div>
<?php
if (isAdmin()) {
    echo "
        <a href='users.php'>
        <div class='panel-footer'>
        <span class='pull-left'>View Details</span>
        <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
        <div class='clearfix'></div>
        </div>
        </a>    
    ";
}
?>
</div>
</div>
<div class="col-lg-3 col-md-6">
<div class="panel panel-red">
<div class="panel-heading">
<div class="row">
<div class="col-xs-3">
<i class="fa fa-list fa-5x"></i>
</div>


<div class="col-xs-9 text-right">
<div class='huge'><?php echo $category_counts = recordCount('categories'); ?></div>
<div>Categories</div>
</div>
</div>
</div>
<?php
if (isAdmin()) {
    echo "
        <a href='categories.php'>
        <div class='panel-footer'>
        <span class='pull-left'>View Details</span>
        <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
        <div class='clearfix'></div>
        </div>
        </a>    
    ";
}
?>
</div>
</div>
</div>


<script type="text/javascript">
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
var data = google.visualization.arrayToDataTable([
['Data', 'Count'],

<?php

$element_text = ['Approved Posts', 'Draft Posts','Rejected Posts', 'Approved Comments', 'Draft Comments', 'Admins','Subscribers', 'Category'];
$element_count = [$approved_posts_count, $draft_posts_count, $rejected_posts_count, $approved_comments_count, $draft_comments_count, $admin_users_count, $sub_users_count, $category_counts];

for($i = 0;$i < 8; $i++) {
echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
}

?>
]);

var options = {
chart: {
title: '',
subtitle: '',
}
};

var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

chart.draw(data, google.charts.Bar.convertOptions(options));
}
</script>

<div class="row">
<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

</div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->


<!-- /#wrapper -->

<?php include "includes/footer.php" ?>