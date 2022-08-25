<?php include 'header.php' ?>
<?php include 'nav.php' ?>

<?php
    checkIfUserIsLoggedInAndRedirect('/blog/admin');

    if(ifItIsMethod('post')){
        if(isset($_POST['u_name']) && isset($_POST['u_password'])){
            loginUser($_POST['u_name'], $_POST['u_password']);
        }else {
            redirect('/blog/login.php');
        }
    }
?>

<div class="bg-success">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container min-vh-100">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <!-- Basic login form-->
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Login</h3></div>
                            <div class="card-body">
                                <!-- Login form-->
                                <form autocomplete="off" method="post">
                                    <!-- Form Group (email address)-->
                                    <div class="form-group">
                                        <label class="small mb-1" for="username">Username</label>
                                        <input class="form-control" id="username" type="text" name="u_name" placeholder="Enter your username" />
                                    </div>
                                    <!-- Form Group (password)-->
                                    <div class="form-group">
                                        <label class="small mb-1" for="password">Password</label>
                                        <input class="form-control" id="password" type="password" name="u_password" placeholder="Enter your password" />
                                    </div>
                                    <!-- Form Group (login box)-->
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="forgot.php">Forgot Password?</a>
                                        <input name="login" class="btn btn-primary" value="Login" type="submit">
                                        <!-- <a class="btn btn-primary" href="index.html">Login</a> -->
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="registration.php">Need an account? Register!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</div>

<!-- <?php include 'footer.php' ?> -->