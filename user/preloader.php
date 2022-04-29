<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Require my functions.php file
include 'function.php';
include 'header.php'; 

require 'admin/vendor/phpmailer/src/Exception.php';
require 'admin/vendor/phpmailer/src/PHPMailer.php';
require 'admin/vendor/phpmailer/src/SMTP.php';

if(isset($_GET['fn']) && isset($_GET['em'])){
    $fn = $_GET['fn']; $em = $_GET['em']; 
    $active = "<p>Welcome! If you are receiving this mail then your account has been successfully activated and you can proceed to transact and trade on the platform.<br> We offer 24/7 live support for safe transactions/disputes settling.<br> Any issues encountered kindly contact support for further assistance</p>";

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
     $mail->SMTPDebug = 0;    //Enable verbose debug output SMTP::DEBUG_SERVER
    $mail->isSMTP();  //Send using SMTP
    $mail->Host       = 'boldswap.org';   //Set the SMTP server to send through
    $mail->SMTPAuth   = true;    //Enable SMTP authentication
    $mail->Username   = 'noreply@boldswap.org';   //SMTP username
    $mail->Password   = 'MAILnoreply2002';    //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  //Enable implicit TLS encryption
    $mail->Port       = 465;   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('noreply@boldswap.org', 'Boldswap');
    $mail->addAddress($_GET['em'], $_GET['fn']);     //Add a recipient

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Your Email Verification';
    $mail->Body    = $active;
    $mail->AltBody = $active;

    $mail->send();
     $toast= "success"; echo "<script>location.href='login.php'</script>";
 } catch (Exception $e){echo "We could not verify that info";}
}
else{echo "<script>location.href='login.php'</script>";}
?>
<body class="page-user" style="background-color: #fff !important;">
    <div class="row">
 <div class="col-12">
    <p><big>Welcome to Boldswap <span class="orange">Services</span>!<br>
Kindly check your mail inbox for the welcome mail to certify verification.<br> 
Safe trade, swift and secure transactions.</big></p>
</div></div>
 
    <!-- jQuery 3 --> 
<script src="dist/js/jquery.min.js"></script> 

<!-- v4.0.0-alpha.6 --> 
<script src="dist/bootstrap/js/bootstrap.min.js"></script> 

<!-- template --> 
<script src="dist/js/niche.js"></script> 

<!-- jQuery UI 1.11.4 --> 
<script src="dist/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Toastr -->
<script src="dist/js/toastr.min.js"></script>
    </body>
    </html>
    <?php
if(isset($toast) && $toast==='success'){echo "<script>toastr.success('You will be redirected to login to continue.', 'Successful Verification')</script>";}
?>

