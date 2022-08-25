<?php include 'header.php' ?>
<?php include 'nav.php' ?>

<?php

if (isset($_POST['submit'])) {
    $to = "steven@xenos-design.co.uk";
    $subject = wordwrap($_POST['subject']);
    $message = wordwrap($_POST['message']);
    $header = "From:" . $_POST['email']; 

// send email
mail($to,$subject,$message, $header);

echo "<h3 class='text-success'>Form Submitted</h3>";
}



?>    

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="form-wrap">
                    <form class="my-10" role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        <h1 class="text-success">Contact</h1>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control form-control-solid" placeholder="Enter your email">
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">subject</label>
                            <input type="text" name="subject" id="subject" class="form-control form-control-solid" placeholder="Enter your subject">
                        </div>
                         <div class="form-group">
                            <textarea class="form-control form-control-solid" name="message" cols="30" rows="10" placeholder="Enter your message here"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-success btn-block" value="Submit">
                    </form>
                </div>
            </div> <!-- /.col-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<?php include 'footer.php' ?>