<?php
//Require my functions.php file
include('function.php');
//Begin cookie and include the cookie file
include('cookie.php');
if(isset($_POST['proceedRoom'])){
  //Lead variable
  //$eEmail = $_POST['eEmail'];

  //Extract variables from user input
  $txn = $_POST['txn'];
  $seller_email = $_POST['seller_email'];
  $buyer_email = $_POST['buyer_email'];
  $cur1 = $_POST['currency_1'];
  $cur2 = $_POST['currency_2'];  
  $seller_amount = floatval($_POST['seller_amount']);
  $buyer_amount = floatval($_POST['buyer_amount']);
  //$user_role = $_POST['user_role'];

 $sql_transact_insert = "INSERT INTO transact(txn,user_email,seller_email,buyer_email,first_cur,second_cur,seller_amount,buyer_amount)VALUES('$txn','$session_email','$seller_email','$buyer_email','$cur1','$cur2','$seller_amount','$buyer_amount')";


  /*$sql_transact_update = "UPDATE `transaction` SET `first_cur` = '$cur1', `second_cur` = '$cur2',`seller_amount` = '$seller_amount', `buyer_amount` = '$buyer_amount',`role` = '$user_role' WHERE `transaction`.`user_email` = '$user_email'";
*/
  if($con->query($sql_transact_insert) === TRUE){
    $toast = "success";
    header('Location:room.php');}
  else{$toast = "fail";}
}
?>
<?php include('header.php'); ?>

<body class="page-user">
<?php include('nav.php'); ?>
  <div>
    <div class="page-content">
      <div class="container">
        <div class="row">
          <div class="main-content col-lg-8">
            <div class="d-lg-none">
              <div class="gaps-1x mgb-0-5x d-lg-none d-none d-sm-block"></div>
            </div>
            
                        <div class="content-area card">
              <form action="<?= htmlentities($_SERVER['PHP_SELF']);?>" method="post" accept-charset="utf-8">
                 <input value="<?= 'TXN'.mt_rand(100000,999999);?>" name="txn" type="hidden">
                 <br>
                 <input value="<?php if(isset($session_email) && $session_email!==null){echo $session_email;}?>" name="eEmail" type="hidden">
                <div class="card-innr">
                  <div class="card-head">
                    
                    <h4 class="card-title">Create Trade</h4>
                  </div>
                  <div class="card-text">
                    <p>
                      Before you can carry out any transaction, your account must have
                      been funded to support that trade.
                    </p>
                  </div>
                  <div class="token-currency-choose">

                    <div class="row guttar-15px">
                                              <div class="col-md-4">
                          <div class="pay-option">
                            <input checked class="pay-option-check" type="radio" id="payMATIC"
                              name="balance" value="51">
                            <label class="pay-option-label" for="payMATIC">
                              <span class="pay-title">
                                
                                <span class="pay-cur"><?php if(isset($currency) && $currency==='BTC'){echo $currency;} ?></span>
                              </span>
                              <span class="pay-amount"><?php
    $total_deposit = "SELECT sum(amount) AS totalsum FROM fund WHERE user_email='$session_email' AND status='approved'";
    $total_deposit_query = $con->query($total_deposit);
    $total_deposit_display = mysqli_fetch_assoc($total_deposit_query);
  
   if($total_deposit_display){
    $sum_of_rows = $total_deposit_display['totalsum'];
    //if(isset($withdraw_info['wstatus']) && $withdraw_info['wstatus']==="approved"){
   //foreach($total_deposit_display as $total){extract($total)
echo $sum_of_rows;} ?></span>
                            </label>
                          </div>
                        </div>
                                          </div><!-- .row -->
                  </div>

                  <br />

                  <div class="card-head">
                    <span class="card-sub-title text-primary font-mid">Step 1</span>
                    <h4 class="card-title">Seller</h4>
                    <label>Seller Name:</label><br> <span><input type="text" name="seller_name" class="input-bordered"></span>
                    <br>
                    <label>Seller Email:</label><br> <span><input type="email" name="seller_email" class="input-bordered"></span>
                    <br>
                </div>
                   <label>Cryptocurrency:</label><br><select name="currency_1" required class="input-bordered ">
                    <?php foreach($sql_addresses_exec as $addresses_info){extract($addresses_info);?><option value="<?= $addresses_info['wallets'];?>"><?= $addresses_info['wallets'];?></option><?php }?> 
                  </select>
                  <div class="note note-plane text-muted note-sm  pl-0">
                    <p class="text-muted">
                      This is the currency that is being exchanged for the original cryptocurrency,
                      this can be either a cryptocurrency or a local currency.
                    </p>
                  </div>
                  <br>
                   <label>Amount:</label><br>
                    <input value="" type="text" class="input-bordered " name="seller_amount" required>
                    <div class="note note-plane text-muted note-sm  pl-0">
                      <p class="text-muted">The total amount which the seller is sending.</p>
                    </div><br>
                     <div class="token-calc-note note note-plane">
                      <em class="fas fa-times-circle text-success"></em>
                      <span class="note-text text-light">
                        Escrow Fee: 10.00% of transaction
                      </span>
                    </div>

                 
                  <br /> <br />

                  <div class="card-head">
                    <span class="card-sub-title text-primary font-mid">Step 2</span>
                    <h4 class="card-title">Buyer</h4>
                  </div>
                  <div class="token-contribute">
                      <p><label>Buyer Name:</label><br> <span><input type="text" name="buyer_name" class="input-bordered"></span>
                        <br>
                    <label>Buyer Email:</label><br> <span><input type="email" name="buyer_email" class="input-bordered"></span>
                    <br><br>

                     <label>Cryptocurrency:</label><br><select name="currency_2" required class="input-bordered">
                     <?php foreach($sql_addresses_exec as $addresses_info){extract($addresses_info);?><option value="<?= $addresses_info['wallets']?>"><?= $addresses_info['wallets']?></option><?php }?> </select>
                    
                    <br><br>

                    <label>Amount:</label><br><input value="" type="text" class="input-bordered" name="buyer_amount" required>
                    <div class="note note-plane text-muted note-sm  pl-0">
                      <span class="text-muted">The total amount which the buyer is sending.</span>
                    </div>
                    <br>

                   <!--  <select name="user_role" required class="input-bordered ">
                      <option value="">Select your role</option>
                      <option value="seller" >I am Selling</option>
                      <option value="buyer" >I am Buying</option>
                    </select> 
                    <br />
                    <br />
                    -->

                    <div class="token-calc-note note note-plane">
                      <em class="fas fa-times-circle text-success"></em>
                      <span class="note-text text-light">
                        Escrow Fee: 10.00% of transaction
                      </span>
                    </div>

                  </div>
                  
                  <div class="pay-buttons">
                    <div class="pay-button">
                      <?php if($sum_of_rows>0){?>
                      <button type="submit" class="btn btn-primary btn-between w-100" name="proceedRoom">Proceed to Trading Room&nbsp;<i class="fa fa-forward"></i></button>
                    <?php }else{echo "<big>You have no active balance!</big>";} ?>
                    </div>
                  </div>
                  
                </div> <!-- .card-innr -->
              </form>
            </div> <!-- .content-area -->
          </div><!-- .col -->

          <div class="aside sidebar-right col-lg-4">
    
    <div class="token-sales card">
        <div class="card-innr">
            <div class="card-head">
                <h5 class="card-title card-title-sm">Cryptocurrency Calculator</h5>
            </div>
            <div class="token-rate-wrap row">
                <div
                    style="
                        width: 100%;
                        height:335px;
                        background-color: #FAFAFA;
                        overflow:hidden;
                        box-sizing: border-box;
                        border: 1px solid #56667F;
                        border-radius: 4px;
                        text-align: right;
                        line-height:14px;
                        block-size:335px;
                        font-size: 12px;
                        box-sizing:content-box;
                        font-feature-settings: normal;
                        text-size-adjust: 100%;
                        box-shadow: inset 0 -20px 0 0 #56667F;
                        margin: 0;width: 100%;
                        padding:1px;padding: 0px;
                        margin: 0px;
                    ">
                    <div style="height:315px;">
                        <iframe 
                            src="https://widget.coinlib.io/widget?type=converter&amp;theme=light"
                            scrolling="auto" 
                            marginwidth="0" 
                            marginheight="0" 
                            border="0" 
                            style="border:0;margin:0;padding:0;"
                            width="100%"
                            height="310"
                            frameborder="0"
                        ></iframe>
                    </div>
                    <div
                        style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing:content-box; margin: 3px 6px 10px 0px; font-family: Verdana, Tahoma, Arial, sans-serif;">
                        powered by&nbsp;<a href="/" target="_blank"
                style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size: 11px;">Boldswap</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="sap"></div>

    </div>
</div><!-- .col -->        </div><!-- .container -->
      </div><!-- .container -->
    </div>
    <!-- .page-content -->
  </div>

    <div class="footer-bar">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8">
                    <ul class="footer-links">
                        
                        <li><a href="https://boldswap.org/docs/privacy-policy.php">Privacy Policy</a></li>
                        <li><a href="https://boldswap.org/docs/terms-of-use.php">Terms & Conditions</a></li>
                    </ul>
                </div>
                <!-- .col -->
                <div class="col-md-4 mt-2 mt-sm-0">
                    <div class="d-flex justify-content-between justify-content-md-end align-items-center guttar-25px pdt-0-5x pdb-0-5x">
                        <div class="copyright-text">&copy; 2021 Boldswap</div>
                    </div>
                </div>
                <!-- .col -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .footer-bar -->

    <!-- Modal Centered -->
    
    <!-- Modal End -->
    <!-- Modal Centered -->   
    <!-- JavaScript (include all script here) -->
<script src="https://transactright.com/js/app.js"></script>
    <script src="./assets/js/jquery.bundle49f7.js"></script>
    <script src="./assets/js/script49f7.js"></script>
    
 <!-- Toastr -->
<script src="dist/js/toastr.min.js"></script>
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/626683f47b967b11798c5f16/1g1g7711k';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    </body>
    </html>
    <?php
if(isset($toast) && $toast==='success'){echo "<script>toastr.success('Your transaction is pending', 'Success')</script>";}
if(isset($toast) && $toast==='fail'){echo "<script>toastr.error('We could not update that information, check if your account is funded', 'Error')</script>";}

$con->close();
?>