<?php  include "./includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "./includes/nav.php"; ?>
    


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

    if (strlen($u_name) < 4) {
        $error['username'] = "Username must be a minimum of 5 characters";
    }
    if ($u_name == '') {
        $error['username'] = "Username must be filled out";
    }
    if (user_exists($u_name)) {
        $error['username'] = "Username already exists, choose another";
    }
    if (email_exists($u_email)) {
        $error['username'] = "Email already exists, choose another or <a href='index.php'>Login</a>";
    }
    if ($u_email == '') {
        $error['email'] = "Email must be filled out";
    }
    if ($u_password == '') {
        $error['password'] = "Password must be filled out";
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
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>

                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
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
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>


    <!-- // $query = "SELECT randSalt FROM users";
    // $select_randsalt_query = mysqli_query($connection, $query);

    // if (!$select_randsalt_query) {
    //     die('Query failed ' . mysqli_error($connection));
    // }

    // $row = mysqli_fetch_array($select_randsalt_query);

    // $salt = $row['randSalt'];

    // $u_password = crypt($u_password, $salt); -->

<?php include "./includes/footer.php";?>
