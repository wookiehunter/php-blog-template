<!-- Navbar-->
<nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
    <div class="container">
        <a class="navbar-brand text-success" href="index.php">STEVEN GODSON</a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mr-lg-5">
                <li class="nav-item"><a class="nav-link text-success" href="index.php">Home </a></li>

                <li class="nav-item dropdown dropdown-xl no-caret">
                    <a class="nav-link dropdown-toggle text-success" id="navbarDropdownDemos" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories<i class="fas fa-chevron-right dropdown-arrow"></i></a>
                    <div class="dropdown-menu dropdown-menu-right animated--fade-in-up mr-lg-n25 mr-xl-n15" aria-labelledby="navbarDropdownDemos">
                        <div class="row no-gutters">
                        <!-- side image -->
                            <div class="col-lg-6 p-lg-3 bg-img-cover overlay overlay-alert overlay-70 d-none d-lg-block" style="background-image: url('assets/img/backgrounds/categories.jpg')">
                                <div class="d-flex h-100 w-100 align-items-center justify-content-center">
                                    <div class="mb-3">
                                        <h2 class="text-white text-center z-1">Article Categories</h2>
                                    </div>
                                </div>
                            </div>
                        <!-- links -->
                            <div class="col-lg-6 p-lg-5">
                                <div class="row">
                                    <div class="col-lg-6">

                                        <?php 
                                        $query = "SELECT * FROM categories";
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

                                            echo "<a class='dropdown-item' href='/blog/category/{$cat_id}'>{$cat_title}</a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php 
                    if (isLoggedIn()) {
                        echo "<li class='nav-item'>
                            <a  class='nav-link text-success' href='/blog/includes/logout.php'>Logout</a>
                        </li>";
                    } else {
                        echo "<li class='nav-item'>
                            <a  class='nav-link text-success' href='/blog/login.php'>Log In</a>
                        </li>";
                    }
                ?>

                <?php 
                    if (!isset($_SESSION['role'])) {
                        echo "<li class='nav-item'>
                            <a  class='nav-link text-success' href='/blog/registration'>Registration</a>
                        </li>";
                    }
                ?>
                <?php 
                    if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
                        echo "<li class='nav-item'>
                            <a  class='nav-link text-success' href='/blog/admin/index.php'>Admin</a>
                        </li>";
                    }
                ?>                
                <?php 
                    if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {

                        if (isset($_GET['p_id'])) {
                            $the_post_id = $_GET['p_id'];
                            echo "<li class='nav-item'><a class='nav-link text-success' href='/blog/admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                        }
                    }
                ?>
                <li class='nav-item'>
                    <a class="nav-link text-success" href='/blog/contact'>Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>