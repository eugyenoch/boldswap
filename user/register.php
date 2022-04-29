<?php
    //Form validation
//Import my security function from function.php
include 'function.php';
//Define empty variables
$fname = $lname = $email = $pass = $cpass = "";

//Define empty error variables
$fnameErr = $lnameErr = $emailErr = $passErr = $cpassErr = $cpassesErr = $checkErr = ""; 

//Test for valid(empty) and invalid(non-empty) form fields
if($_SERVER['REQUEST_METHOD']=="POST"){
  if(empty($_POST['fname'])){
    $fnameErr = "Firstname is required";
  }
  else{
    $fname = sanitize($_POST['fname']);
  }

  if(empty($_POST['lname'])){
    $lnameErr = "Lastname is required";
  }
  else{
    $lname = sanitize($_POST['lname']);
  }

  if(empty($_POST['email'])){
    $emailErr = "Email is required";
  }
  else{
    $email = sanitize($_POST['email']);
  }

  if(empty($_POST['pwd'])){
    echo "<style>.note{display:none !important;</style>";
    $passErr = "Password is required";
  }
  else{
    $pass = md5($_POST['pwd']);
  }

  if(empty($_POST['cpwd'])){
    echo "<style>.note{display:none !important;</style>";
    $cpassErr = "Confirm password is required";
  }
  else{
    $cpass = md5($_POST['cpwd']);
  }

  if($pass !== $cpass){
    $cpassesErr = "Both passwords do not match";
  }

  if(!isset($_POST['agreement'])){
    $checkErr = "Please agree to our terms";
  }
}
?>
<?php
if(isset($_POST['reg'])){
  //$affid = $_POST['affid'];
  if($pass===$cpass){
    $active = "<a href='https://boldswap.org/user/admin/login.php'>Login</a>";
    $sql_check_email_exists = "SELECT * FROM users WHERE user_email = '$email'";
    $sql_check_email_exec = $con->query($sql_check_email_exists);
    if(mysqli_num_rows($sql_check_email_exec)>0){$toast = "email";}
    else{
  $sqlIns = "INSERT INTO users(firstname,lastname,user_email,user_pass)VALUES('$fname','$lname','$email','$cpass')";
  $sqlC = $con->query($sqlIns);

  $sqlIns2 = "INSERT INTO fund(user_email,amount,status)VALUES('$email',50,'approved')";
  $sqlC2 = $con->query($sqlIns2);
 if($sqlC){$toast = "success";header("Refresh:1,url=preloader.php?fn=$fname&em=$email");
}else{$toast = "fail";} 
}
} }
$con->close();
?>

<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="../images/favicon.png">
    <!-- Site Title  -->
    <title>Register a new account | Boldswap</title>
    <!-- Bundle and Base CSS -->
    <link rel="stylesheet" href="../assets/css/vendor.bundle.css?ver=200">
    <link rel="stylesheet" href="../assets/css/style.css?ver=200">
    <!-- Extra CSS -->
    <link rel="stylesheet" href="../assets/css/theme.css?ver=200">

    <link rel="stylesheet" type="text/css" href="./assets/css/custom.css">
    <style>
        .err{color:red;}
    </style>
</head>

<body class="nk-body body-wider bg-light-alt">
    <div class="nk-wrap">
        <header class="nk-header page-header is-transparent is-sticky is-shrink" id="header">
            <!-- Header @s -->
            <div class="header-main">
                <div class="header-container container">
                    <div class="header-wrap">
                        <!-- Logo @s -->
                        <div class="header-logo logo">
                            <a href="./" class="logo-link">
                               <!--  <img class="logo-dark" src="images/logo.png" srcset="images/logo2x.png 2x" alt="logo">
                                <img class="logo-light" src="images/logo-full-white.png" srcset="images/logo-full-white2x.png 2x" alt="logo"> -->
                            </a>
                        </div>
                        <!-- Menu Toogle @s -->
                        <div class="header-nav-toggle">
                            <a href="#" class="navbar-toggle" data-menu-toggle="header-menu">
                                <div class="toggle-line">
                                    <span></span>
                                </div>
                            </a>
                        </div>
                        <!-- Menu @s -->
                        <div class="header-navbar">
                            <?php include '../nav.php';?>
                        </div><!-- .header-navbar @e -->
                    </div>
                </div>
            </div><!-- .header-main @e -->
            <!-- Banner @s -->
            <div class="header-banner bg-theme-grad"></div>
            <!-- .header-banner @e -->
        </header>
        <main class="nk-pages">
            <div class="section">
                <div class="container">
                    <div class="nk-blocks d-flex justify-content-center">
                        <div class="ath-container m-0">
                            <div class="ath-body">
                                <h5 class="ath-heading title">Sign Up<small class="tc-default">Create a Boldswap Account</small></h5>
                                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" name="regForm">
                                    <div class="field-item">
                                        <div class="field-wrap">
                                            <input type="text" name="fname" class="input-bordered" placeholder="Firstname" required>
                                        </div>
                                        <span class="err"><?= $fnameErr; ?></span>
                                    </div>
                                    <div class="field-item">
                                        <div class="field-wrap">
                                            <input type="text" name="lname" class="input-bordered" placeholder="Lastname" required>
                                        </div>
                                        <span class="err"><?= $lnameErr; ?></span>
                                    </div>
                                    <div class="field-item">
                                        <div class="field-wrap">
                                            <input type="text" class="input-bordered"  name="email" placeholder="Email" title="Your email is your username" required>
                                        </div>
                                        <span class="err"><?= $emailErr; ?></span>  
                                    </div>
                                    <div class="field-item">
                                        <div class="field-wrap">
                                            <input name="pwd" type="password" class="input-bordered" placeholder="Password" title="choose secure password" required>
                                        </div>
                                        <span class="err"><?= $passErr; ?></span>
                                    </div>
                                    <div class="field-item">
                                        <div class="field-wrap">
                                            <input name="cpwd" type="password" class="input-bordered" placeholder="Repeat Password" title="confirm password must match password" required>
                                        </div>
                                         <span class="err"><?= $cpassErr; ?></span><br><span class="err"><?= $cpassesErr; ?></span>
                                    </div>
                                    <div class="field-item">
                                        <input class="input-checkbox" id="agree-term-2" type="checkbox" name="agreement" required>
                                        <label for="agree-term-2">I agree to Boldswap <a href="../docs/privacy-policy.php">Privacy Policy</a> &amp; <a href="../docs/terms-of-use.php">Terms</a>.</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block btn-md" name="reg">Sign Up</button>
                                </form>
                                <div class="sap-text"><span>Or Sign Up With</span></div>
                                <ul class="btn-grp gutter-20px gutter-vr-20px">
                                    <li class="col"><a href="#" class="btn btn-md btn-facebook btn-block"><em class="icon fab fa-facebook-f"></em><span>Facebook</span></a></li>
                                    <li class="col"><a href="#" class="btn btn-md btn-google btn-block"><em class="icon fab fa-google"></em><span>Google</span></a></li>
                                </ul>
                                <div class="ath-note text-center"> Already have an account? <a href="./login.php"> <strong>Sign in here</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <?php include('../footer.php');?>
    </div>
    <!-- Preloader -->
    <div class="preloader"><span class="spinner spinner-round"></span></div>
    <!-- JavaScript -->
    <script src="../assets/js/jquery.bundle.js?ver=200"></script>
    <script src="../assets/js/scripts.js?ver=200"></script>
    <script src="../assets/js/charts.js?ver=200"></script>
    <script src="../assets/js/charts.js?ver=200"></script>
</body>

</html>
<?php
if(isset($toast) && $toast==='success'){
  echo "<script>toastr.success('Be patient while we verify and create your account', 'Notice')</script>";
}

if(isset($toast) && $toast==='fail'){
  echo "<script>toastr.error('You have not been successfully registered', 'Failure')</script>";
}

if(isset($toast) && $toast==='email'){
  echo "<script>toastr.error('The email already exists', 'Failure')</script>";
}
?>