<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<?php  include "header.php"; ?>
<?php  include "nav.php"; ?>

<?php 

//Load Composer's autoloader
require '../vendor/autoload.php';
// require './classes/config.php';

// if (!isset($_GET['forgot']) ) {
//     redirect('index');
// }

if (ifItIsMethod('post')) {
    if (isset($_POST['u_email'])) {
        $u_email = $_POST['u_email'];

        $length = 50;

        $token = bin2hex(openssl_random_pseudo_bytes($length));

        if (email_exists($u_email)) {
            if ($stmt = mysqli_prepare($connection, "UPDATE users SET token='$token' WHERE u_email = ?")) {
                mysqli_stmt_bind_param($stmt, "s", $u_email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                //Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer();

                $mail->isSMTP();
                $mail->Host       = Config::SMTP_HOST;
                $mail->SMTPAuth   = true;
                $mail->Username   = Config::SMTP_USER;
                $mail->Password   = Config::SMTP_PASSWORD;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = Config::SMTP_POST; 
                $mail->isHTML(true);
                $mail->CharSet = 'utf-8';

                $mail->setFrom('steven@xenos-design.co.uk', 'Boss');
                $mail->addAddress($u_email);
                $mail->Subject = 'Test email';
                $mail->Body = '<h3>Please click <a href="http://localhost/blog/reset.php?email='.$u_email.'&token='.$token.' ">here<a/> to reset your password.</h3>';

                if ($mail->send()) {
                    $emailSent = true;
                }
                
            }
        }
    }
}
?>

<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center my-10">
                    <?php if(!isset($emailSent)): ?>
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">

                            <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="email" name="u_email" placeholder="email address" class="form-control"  type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="recover-submit" class="btn btn-lg btn-success btn-block" value="Reset Password" type="submit">
                                </div>

                                <input type="hidden" class="hide" name="token" id="token" value="">
                            </form>

                        </div><!-- Body-->
                    <?php else: ?>
                        <h2>Please check your email</h2>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php  include "footer.php"; ?>