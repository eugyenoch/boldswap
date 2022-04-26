<?php
//Require my functions.php file
include('function.php');
//Begin cookie and include the cookie file
include('cookie.php');

//Build the login script
if(isset($_POST['signin'])){
  //Extract the user input and assign to variables
  $user = sanitize($_POST['user']);
  $pass = md5($_POST['pwd']);

  //Search DB for the entered data above
  $sqlCheck = "SELECT * FROM users WHERE user_email = '$user' AND user_pass='$pass'";
  
  //Execute the mysqli query
  $sqlDo = $con->query($sqlCheck);

  //count the number of rows that contain the data
    $rowCount = mysqli_num_rows($sqlDo);

    //Check if there is no matching row with the user data
    if($rowCount<=0){
      $toast = "fail";
    }
    else{
      $toast = "success";
        //$_SESSION['email'] = $user;
        header("Refresh:1,url=./user-area.php");
    }
}
else{
  //header('Location:login.php');
}

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
    <title>Login | Boldswap</title>
    <!-- Bundle and Base CSS -->
    <link rel="stylesheet" href="../assets/css/vendor.bundle.css?ver=200">
    <link rel="stylesheet" href="../assets/css/style.css?ver=200">
    <!-- Extra CSS -->
    <link rel="stylesheet" href="../assets/css/theme.css?ver=200">

    <link rel="stylesheet" type="text/css" href="./assets/css/custom.css">
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
                            <?php include('../nav.php');?>
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
                                <h5 class="ath-heading title">Sign In<small class="tc-default">with your Boldswap credentials</small></h5>
                                <form action="<?= htmlentities($_SERVER['PHP_SELF']);?>" method="post" name="loginForm">
                                    <div class="field-item">
                                        <div class="field-wrap">
                                            <input type="text" class="input-bordered" placeholder="Your Email" name="user" title="Username is required" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];}?>" required>
                                        </div>
                                    </div>
                                    <div class="field-item">
                                        <div class="field-wrap">
                                            <input type="password" class="input-bordered" placeholder="Password" name="pwd" title="Password is required" value="<?php if(isset($_COOKIE['pwd'])){echo $_COOKIE['pwd'];}?>" required>
                                        </div>
                                    </div>
                                    <div class="field-item d-flex justify-content-between align-items-center">
                                        <div class="field-item pb-0">
                                            <input class="input-checkbox" id="remember-me-100" type="checkbox" name="checkbox">
                                            <label for="remember-me-100">Remember Me</label>
                                        </div>
                                        <div class="forget-link fz-6">
                                            <a href="./check.php">Forgot password?</a>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block btn-md" name="signin">Sign In</button>
                                </form>
                                <div class="sap-text"><span>Or Sign In With</span></div>
                                <ul class="row gutter-20px gutter-vr-20px">
                                    <li class="col"><a href="#" class="btn btn-md btn-facebook btn-block"><em class="icon fab fa-facebook-f"></em><span>Facebook</span></a></li>
                                    <li class="col"><a href="#" class="btn btn-md btn-google btn-block"><em class="icon fab fa-google"></em><span>Google</span></a></li>
                                </ul>
                                <div class="ath-note text-center"> Don’t have an account? <a href="./register.php"> <strong>Sign up here</strong></a>
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
  echo "<script>toastr.success('You will be redirected shortly', 'Success')</script>";
}

if(isset($toast) && $toast==='fail'){
  echo "<script>toastr.error('We cannot log you in', 'Wrong credentials')</script>";
}
?>