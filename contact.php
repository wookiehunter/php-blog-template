<?php  include "./includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "./includes/nav.php"; ?>
    


    <!-- Page Content -->
    <div class="container">

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
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>

                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                        </div>
                         <div class="form-group">
                            <textarea class="form-control" name="message" cols="30" rows="10" placeholder="Enter your message here"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "./includes/footer.php";?>
