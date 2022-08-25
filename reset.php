<?php  include "includes/header.php"; ?>
<?php  include "includes/nav.php"; ?>

<?php
if (!isset($_GET['email']) && !isset($_GET['token'])) {
    redirect("/blog/index");
}

// $email = 'steven.godson@hotmail.co.uk';
// $token = 'f7e12c66a15f895909c6852fdff574d25e6712fcc7286570639965f85cd16e77d4f572c4e05f646ea4c5ddb8ac637831f1fc';

if ($stmt = mysqli_prepare($connection, 'SELECT u_name, u_email, token FROM users WHERE token = ? ')) {
    mysqli_stmt_bind_param($stmt, 's', $_GET['token']);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $u_name, $u_email, $token);

    mysqli_stmt_fetch($stmt);

    mysqli_stmt_close($stmt);

    // if ($_GET['token'] !== $token || $_GET['email'] !== $u_email) {
    //     redirect("index");
    // }

    if (isset($_POST['password']) && isset($_POST['confirmPassword'])) {
        if ($_POST['password'] === $_POST['confirmPassword']) {
            $password = $_POST['password'];

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));

            if ($stmt = mysqli_prepare($connection, "UPDATE users SET token = '', u_password = '{$hashedPassword}' WHERE u_email = ? ")) {
                mysqli_stmt_bind_param($stmt, 's', $_GET['email']);

                mysqli_stmt_execute($stmt);
            
                if (mysqli_stmt_affected_rows($stmt) >= 1) {
                    redirect("/blog/login.php");
                }

                mysqli_stmt_close($stmt);
            }
        }
    };

}
?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Reset Password</h2>
                                <p>You can reset your new password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil color-blue"></i></span>
                                                <input id="password" name="password" placeholder="Enter Password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil color-blue"></i></span>
                                                <input id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

