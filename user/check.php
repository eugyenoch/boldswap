<?php
//Require my functions.php file
include('function.php');

//Build the login script
if(isset($_POST['confirm'])){
  //Extract the user input and assign to variables
  $user = sanitize($_POST['user']);

  //Search DB for the entered data above
  $sql_check = "SELECT * FROM users WHERE user_email = '$user'";
  
  //Execute the mysqli query
  $sqlDo = $con->query($sql_check);

  //count the number of rows that contain the data
    $rowCount = mysqli_num_rows($sqlDo);

    //Check if there is no matching row with the user data
    if($rowCount<=0){
      $toast = "fail";
    }
    else{
      $toast = "success";
        header("Refresh:2,url=change-password.php?em=$user");
    }
}
else{
  //header('Location:login.php');
}
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
    <title>Check Email | Boldswap services</title>
    <!-- Bundle and Base CSS -->
    <link rel="stylesheet" href="../assets/css/vendor.bundle.css?ver=200">
    <link rel="stylesheet" href="../assets/css/style.css?ver=200">
    <!-- Extra CSS -->
    <link rel="stylesheet" href="../assets/css/theme.css?ver=200">
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
                                <!-- <img class="logo-dark" src="images/logo.png" srcset="images/logo2x.png 2x" alt="logo">
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
                                <h5 class="ath-heading title">Reset<small class="tc-default">with your Email</small></h5>
                                <form action="<?php htmlentities($_SERVER['PHP_SELF']);?>" method="post" name="loginForm">
                                    <div class="field-item">
                                        <div class="field-wrap">
                                            <input type="text" class="input-bordered" placeholder="Your Email" name="user" title="Enter your registered email address" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block btn-md" name="confirm">Check Email</button>
                                    <div class="ath-note text-center"> Remembered? <a href="./login.php"> <strong>Sign in here</strong></a>
                                    </div>
                                </form>
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