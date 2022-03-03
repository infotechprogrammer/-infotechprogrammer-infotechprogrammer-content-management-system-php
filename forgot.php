<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php include "includes/navigation.php"?>
<?php 

require './vendor/autoload.php';

 ?>
<?php 

if(!isset($_GET['forgot'])){

header("Location:/mycms/");

}


if(isset($_POST['email'])){


  $email = $_POST['email'];  

  $lenght = 50;

  $token = bin2hex(openssl_random_pseudo_bytes($lenght));

  if(email_exists($email)){


   $stmt = mysqli_prepare($connection, "UPDATE users SET token = '{$token}' WHERE user_email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $mail = new PHPMailer;

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = Config::SMTP_HOST;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = Config::SMTP_USER;                 // SMTP username
    $mail->Password = Config::SMTP_PASSWORD;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = Config::SMTP_PORT;       
    $mail->CharSet = 'UTF-8';                             // TCP port to connect to

    $mail->setFrom('sahilbatra158@gmail.com', 'Sahil Batra');
    $mail->addAddress($email); 

    $mail->isHTML(true);

    $mail->Subject = 'Reset Password';
    $mail->Body    = '<p>Please Click to reset password :</p>

    <b><a href="http://localhost/mycms/reset.php?email='.$email.'&token='.$token.' ">CLICK HERE</a></b>

    ';


    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        $emailSent= true;
    }
 


    /**
    *
    * configure PHPMailer
    *
    */


  }


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

                            <?php if(!isset($emailSent)): ?>

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                                <?php else: ?>

                                    <h3>Please Check your Email</h3>

                                <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

