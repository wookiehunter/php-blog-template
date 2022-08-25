
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../admin/">Admin McAdams</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <!-- <li><a href="">Users Online: <?php echo users_online(); ?></a></li> -->
        <li><a href="">Users Online: <span class="usersonline"></span></a></li>
        <li><a href="/blog/index">Home Page</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="user_profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <?php 
            if (isAdmin()) {
                echo "<li>
                <a href='../admin/index.php'><i class='fa fa-fw fa-dashboard'></i>All Data</a>
                </li>
                <li>
                <a href='javascript:;' data-toggle='collapse' data-target='#posts'><i class='fa fa-fw fa-arrows-v'></i> Posts <i class='fa fa-fw fa-caret-down'></i></a>
                <ul id='posts' class='collapse'>
                    <li>
                        <a href='../admin/posts.php'>View All Posts</a>
                    </li>
                    <li>
                        <a href='posts.php?source=add_post'>Add Posts</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href='../admin/categories.php'><i class='fa fa-fw fa-wrench'></i> Categories</a>
            </li>
            <li>
                <a href='javascript:;' data-toggle='collapse' data-target='#users'><i class='fa fa-fw fa-users'></i> Users <i class='fa fa-fw fa-caret-down'></i></a>
                <ul id='users' class='collapse'>
                    <li>
                        <a href='users.php'>View All Users</a>
                    </li>
                    <li>
                        <a href='users.php?source=add_user'>Add Users</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href='../admin/comments.php'><i class='fa fa-fw fa-comments'></i> Comments</a>
            </li>                
                
                ";
            }
            
            ?>

            <li>
                <a href="user_profile.php"><i class="fa fa-fw fa-user"></i>Profile</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>