<?php include "db.php" ?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/blog/index">Steven Godson</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                <?php 
                $query = "SELECT * FROM categories LIMIT 3";
                $select_all_categories = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_categories)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];

                    $category_class = '';

                    $registration_class = '';

                    $page_name = basename($_SERVER['PHP_SELF'], '.php');

                    $registration = '/blog/registration.php';

                    if (isset($_GET['category']) && $_GET['category'] === $cat_id) {
                        $category_class = 'active';
                    } elseif ($page_name === $registration) {
                        $registration_class = 'active';
                    }

                    echo "<li class='$category_class'><a href='/blog/category/{$cat_id}'>{$cat_title}</a></li>";
                }
                ?>
                <?php 
                    if (isLoggedIn()) {
                        echo "<li>
                            <a href='/blog/includes/logout.php'>Logout</a>
                        </li>";
                    } else {
                        echo "<li>
                            <a href='/blog/login.php'>Log In</a>
                        </li>";
                    }
                ?>

                <?php 
                    if (!isset($_SESSION['role'])) {
                        echo "<li>
                            <a class='$registration_class;' href='/blog/registration'>Registration</a>
                        </li>";
                    }
                ?>
                <?php 
                    if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
                        echo "<li>
                            <a href='/blog/admin/index.php'>Admin</a>
                        </li>";
                    }
                ?>                
                <?php 
                    if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {

                        if (isset($_GET['p_id'])) {
                            $the_post_id = $_GET['p_id'];
                            echo "<li><a href='/blog/admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                        }
                    }
                ?>
                <li>
                    <a class="" href='/blog/contact'>Contact</a>
                </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>