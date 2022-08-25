<?php  include "header.php"; ?>
<?php  include "nav.php"; ?>

    <!-- Page Content -->
    <div class="container">

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $u_name = trim($_POST['username']);
    $u_email = trim($_POST['email']);
    $u_password = trim($_POST['password']);

    $error = [
        'username' => '',
        'email' => '',
        'password' => ''
    ];


    if (strlen($u_name) < 5) {
        $error['username'] = "<h6 class='text-danger'>Username must be a minimum of 5 characters</h6>";
    }
    if ($u_name == '') {
        $error['username'] = "<h6 class='text-danger'>Username must be filled out</h6>";
    }
    if (user_exists($u_name)) {
        $error['username'] = "<h6 class='text-danger'>Username already exists, choose another</h6>";
    }
    if (email_exists($u_email)) {
        $error['username'] = "<h6 class='text-danger'>Email already exists, choose another or <a href='index.php'>Login</a></h6>";
    }
    if ($u_email == '') {
        $error['email'] = "<h6 class='text-danger'>Email must be filled out</h6>";
    }
    if ($u_password == '') {
        $error['password'] = "<h6 class='text-danger'>Password must be filled out</h6>";
    }

    foreach($error as $key => $value){
        if (empty($value)) {
            unset($error[$key]);
            
            // loginUser($u_name, $u_password);
        }
    } // foreach

    if (empty($error)) {
        registerUser($u_name, $u_email, $u_password);

        loginUser($u_name,$u_password);

    }

}


?>    

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-12">
                    <form class="my-10" role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h1 class="my-4">Register</h1>                    
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on" >
                            <p><?php echo isset($error['username']) ? $error['username'] : ''; ?></p>
                        </div>
                        
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" >
                            <p><?php echo isset($error['email']) ? $error['email'] : ''; ?></p>
                        </div>
                        
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            <p><?php echo isset($error['password']) ? $error['password'] : ''; ?></p>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="form-control btn btn-success" value="Register">
                    </form>
            </div> <!-- /.col-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div>
</section>


<?php  include "footer.php"; ?>