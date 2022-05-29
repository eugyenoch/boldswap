<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
//Require my functions.php file
include('function.php');
//Begin cookie and include the cookie file
include('cookie.php');

?>
<?php include('header.php'); ?>

<body class="page-user">
<?php include('nav.php'); ?>
 
<div>     
  <div class="page-content">
      <div class="container">
            <div class="card content-area">
                <table class="table" style="width:50% !important; margin:auto;">
<tr>
    <td class="col-md-6"> <span class="btnTarget"><center><a href="" data-toggle="modal" data-target="#view-address" class="dt-type-md"><?php if(isset($request_date)&&isset($amount)&&isset($currency)&&isset($status)){echo "<span class='btn btn-primary btn-md'>Make Payment</span>";}?></a></center></span></td>

    <td class="col-md-6"> <span class="btnTarget"><center><a href="upload-proof.php" class="dt-type-md"><?php if(isset($request_date)&&isset($amount)&&isset($currency)&&isset($status)){echo "<button class='btn btn-primary btn-md'>Upload Proof</button>";}?></a></center></span></td>
</tr>
</table>   
<div class="card-innr table-responsive">

                    <div class="card-head">
                        <!-- FUNDING TABLE -->
                         <!-- <h4 class="card-title">Latest Funding Request</h4>  -->
                    </div>
                    <?php if(isset($request_date)&&isset($amount)&&isset($currency)&&isset($status)){?>
                              <table class="data-table table table-hover dt-init user-tnx hideTb">
                        <thead>
                             
                            <tr class="data-item data-head">
                                <th class="data-col dt-tnxno">Transaction ID</th>
                                <th class="data-col dt-amount">Amount</th>
                                <th class="data-col dt-account">Status</th>
                                <th class="data-col dt-type">
                                    <div class="dt-type-text">Type</div>
                                </th>
                               <th class="data-col data-actions">
                                     <div class="dt-type-text">Payment and Proof</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                                                      <tr class="data-item">
                            <?php foreach($sql_fund_exec as $fund_info){extract($fund_info);?>
                    <td class="data-col dt-tnxno">
                        <div class="d-flex align-items-center">
      <!-- <div class="data-state data-state-pending">
                                <span class="d-none">waiting</span>
                            </div> -->
                                <div class="fake-class">
                            <span class="lead tnx-id"><?php if(isset($ftxn) && $ftxn!==null){echo $ftxn;}else{echo"No Funding Transaction Yet";}?></span>
                                <span class="sub sub-date"><?php if(isset($request_date) && $request_date!==null){echo $request_date;}?></span>
                            </div>
                        </div>
                    </td>
                                <td class="data-col dt-token">
                                    <span class="lead token-amount"><?php if(isset($fund_info['amount']) && $fund_info['amount']!==null){echo $fund_info['amount'];}?></span>
                                    <span class="sub sub-symbol"><?php if(isset($fund_info['currency']) && $fund_info['currency']!==null){echo strtoupper($fund_info['currency']);}?></span>
                                </td>
                            <td class="data-col dt-tnxno">
 <span class="lead user-info text-white text-center bg-warning w-50"><?php if(isset($fund_info['status']) && $fund_info['status']!==null){echo $fund_info['status'];}?></span>                                        </td>
                    <td class="data-col dt-type">
        <?php if(isset($request_date)&&isset($fund_info['amount'])&&isset($fund_info['currency'])&&isset($fund_info['status'])){echo "<span class='dt-type-md badge badge-outline badge-success badge-md'>Credit</span>";}?>
        <span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md ">C</span></td> 

         <td class="data-col dt-tnxno"> <span class="btnTarget"><a href="" data-toggle="modal" data-target="#view-address" class="dt-type-md"><?php if(isset($request_date)&&isset($amount)&&isset($currency)&&isset($status)){echo "<span class='btn btn-primary btn-md'>Payment and Proof</span>";}?></a></span></td>
                            </tr>
                        <?php } ?>
                                                    </tbody>
                    </table>
                <?php } ?>
                    <div class="myrow showTb">
                 <div class="mycolumn">
                      <div class="intermediate"><?php if(isset($ftxn) && $ftxn!==null){echo "Transaction ID";}?></div>
                      <div class="intermediate"><?php if(isset($ftxn) && $ftxn!==null){echo "Currency";}?></div>
                    <div class="intermediate"><?php if(isset($ftxn) && $ftxn!==null){echo "Amount";}?></div>
                        <div class="intermediate"><?php if(isset($ftxn) && $ftxn!==null){echo "Type";}?></div>
                        <div class="intermediate"><?php if(isset($ftxn) && $ftxn!==null){echo "Status";}?></div>
                 </div>
                 
                       <div class="mycolumn">
                  <div class="intermediate">  
                    <span class=""><?php if(isset($ftxn) && $ftxn!==null){echo $ftxn;}?></span>
                </div>
  
                   <div class="intermediate">  
        <span class=""><?php if(isset($fund_info['currency']) && $fund_info['currency']!==null){echo strtoupper($fund_info['currency']);}?></span>
    </div>
<div class="intermediate">
<span class=""><?php if(isset($fund_info['amount']) && $fund_info['amount']!==null){echo $fund_info['amount'];}?></span>
                                </div>
                   <div class="intermediate">  
 <span class="user-info text-white text-center bg-warning w-50"><?php if(isset($fund_info['status']) && $fund_info['status']!==null){echo $fund_info['status'];}?></span> </div>

 <div class="intermediate">  
        <?php if(isset($request_date)&&isset($fund_info['amount'])&&isset($fund_info['currency'])&&isset($fund_info['status'])){echo "<span class=''>Credit</span>"; }?>
</div>
               </div>         
          <!-- .card -->
                </div>
            </div>
                      <!-- .card-innr -->
<!-- WITHDRAW TABLE -->
              <div class="card-innr table-responsive">
                    <div class="card-head">
                        <h4 class="card-title"> <?php if(isset($withdraw_request_date)&&isset($wamount)&&isset($wcurrency)&&isset($wstatus)){echo "<h4 class=''>Latest Withdrawal Transactions</h4>";}else{echo "";}?></h4>
                    </div>
                    <?php if(isset($withdraw_request_date)&&isset($wamount)&&isset($wcurrency)&&isset($wstatus)){?>
  <table class="data-table table table-hover dt-init user-tnx hideTb">
                        <thead>
                            <tr class="data-item data-head">
                                <th class="data-col dt-tnxno">Transaction ID</th>
                                <th class="data-col dt-amount">Amount</th>
                                <th class="data-col dt-account">Status</th>
                                <th class="data-col dt-type">
                                    <div class="dt-type-text">Type</div>
                                </th>
                                <th class="data-col data-actions">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                                        <tr class="data-item">
            <?php foreach($sql_withdraw_exec as $withdraw_info){extract($withdraw_info);?>
                <td class="data-col dt-tnxno">
                    <div class="d-flex align-items-center">
                                                                <div class="fake-class">
                        <span class="lead tnx-id"><?php if(isset($wtxn) && $wtxn!==null){echo $wtxn;} else{echo"No withdraw Transaction Yet";}?></span>
                            <span class="sub sub-date"><?php if(isset($withdraw_request_date) && $withdraw_request_date!==null){echo $withdraw_request_date;}?></span>
                        </div>
                    </div>
                </td>
                <td class="data-col dt-token">
                    <span class="lead token-amount"><?php if(isset($wamount) && $wamount!==null){echo $wamount;}?></span>
                    <span class="sub sub-symbol"><?php if(isset($wcurrency) && $wcurrency!==null){echo strtoupper($wcurrency);}?></span>
                </td>
                <td class="data-col dt-account">
<span class="lead user-info text-warning"><?php if(isset($wstatus) && $wstatus!==null){echo $wstatus;}?></span>
                                                    </td>
                <td class="data-col dt-type">
<?php if(isset($withdraw_request_date)&&isset($wamount)&&isset($wcurrency)&&isset($wstatus)){echo "<span class='dt-type-md badge badge-outline badge-error badge-md'>Debit</span>";}?>
                    <span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">D</span>
                       
                            </tr>
                        <?php } ?>
                                                    </tbody>
                    </table>
                <?php } ?>
                </div>
                              <!-- .card-innr -->
 <div class="myrow showTb">
                 <div class="mycolumn">
                      <div class="intermediate"><?php if(isset($wtxn) && $wtxn!==null){echo "Transaction ID";}?></div>
                      <div class="intermediate"><?php if(isset($wcurrency) && $wcurrency!==null){echo "Currency";}?></div>
                    <div class="intermediate"><?php if(isset($wamount) && $wamount!==null){echo "Amount";}?></div>
                    <div class="intermediate"><?php if(isset($wstatus) && $wstatus!==null){echo "Status";}?></div>
                    <div class="intermediate"><?php if(isset($withdraw_request_date)&&isset($wamount)&&isset($wcurrency)&&isset($wstatus)){echo "Type";}?></div>
                 </div>
                 
                       <div class="mycolumn">
                  <div class="intermediate">  
                    <span class=""><?php if(isset($wtxn) && $wtxn!==null){echo $wtxn;} else{echo "";}?></span>
                </div>
  
                   <div class="intermediate">  
        <span class=""><?php if(isset($wcurrency) && $wcurrency!==null){echo strtoupper($wcurrency);}else{echo "";}?></span>
    </div>
<div class="intermediate">
<span class=""><?php if(isset($wamount) && $wamount!==null){echo $wamount;}else{echo "";}?></span>
                                </div>
                   <div class="intermediate">  
 <span class="user-info text-white text-center bg-warning w-50"><?php if(isset($wstatus) && $wstatus!==null){echo $wstatus;}else{echo "";}?></span> </div>

 <div class="intermediate">  
        <?php if(isset($withdraw_request_date)&&isset($wamount)&&isset($wcurrency)&&isset($wstatus)){echo "<span class=''>Debit</span>";}else{echo "";}?>
</div>
               </div>         
          <!-- .card -->
                </div>
                
                <!--Investment Table -->
                <!-- .card-innr -->
                <!-- TRANSACTIONS TABLE -->
              <div class="card-innr table-responsive">
                    <div class="card-head">
                        <h4 class="card-title"> <?php if(isset($transact_date)&&isset($package)&&isset($duration)&&isset($interest)){echo "<h4 class=''>Latest Trading Transactions</h4>";}else{echo "";}?></h4>
                    </div>

    <?php if(isset($transact_date)&&isset($package)&&isset($duration)&&isset($interest)){?>
  <table class="data-table table table-hover dt-init user-tnx hideTb">
                        <thead>
                            <tr class="data-item data-head">
                                <th class="data-col dt-tnxno">Transaction ID</th>
                                <th class="data-col dt-amount">Package</th>
                                <th class="data-col dt-amount">Amount</th>
                                <th class="data-col dt-amount">Duration</th>
                               <th class="data-col dt-amount">Due date</th>
                                <th class="data-col dt-account">Status</th>
                                <th class="data-col dt-type">
                                    <div class="dt-type-text">Type</div>
                                </th>
                                <th class="data-col data-actions">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
        

                                        <tr class="data-item">
        <?php foreach($sql_exec4 as $transact_info){extract($transact_info);?>
                <td class="data-col dt-tnxno">
                    <div class="d-flex align-items-center">
                                                                <div class="fake-class">
                        <span class="lead tnx-id"><?php if(isset($txn) && $txn!==null){echo $txn;} else{echo"No Trade Transactions Yet";}?></span>
                            <span class="sub sub-date"><?php if(isset($transact_date) && $transact_date!==null){echo $transact_date;}?></span>
                        </div>
                    </div>
                </td>
                  <td class="data-col dt-account">
<span class="lead user-info text-warning"><?php if(isset($package) && $package!==null){echo $package;}?></span>
                                                    </td>
                <td class="data-col dt-token">
                    <span class="lead token-amount"><?php if(isset($transact_info['amount']) && $transact_info['amount']!==null){echo $transact_info['amount'];}?></span>
                    <span class="sub sub-symbol"><?php if(isset($transact_info['currency']) && $transact_info['currency']!==null){echo strtoupper($transact_info['currency']);}?></span>
                </td>
                  <td class="data-col dt-account">
<span class="lead user-info"><?php if(isset($duration) && $duration!==null){echo $duration . 'days';}?></span>
                                                    </td>
        <td class="data-col dt-account">
            <span class="lead user-info"><?php if(isset($transact_date) && isset($duration)){echo date('Y-m-d', strtotime($transact_date . + ($duration - 2) .'days'));}?></span>
        </td>
                <td class="data-col dt-account">
<span class="lead user-info text-warning"><?php if(isset($transact_info['status']) && $transact_info['status']!==null){echo $transact_info['status'];}?></span>
                                                    </td>
                                            
                <td class="data-col dt-type">
<?php if(isset($transact_date)&&isset($transact_info['amount'])&&isset($transact_info['currency'])&&isset($transact_info['status'])){echo "<span class='dt-type-md badge badge-outline badge-error badge-md'>Trade</span>";}?>
                    <span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">T</span>
                       </td>

                            </tr>
                        <?php } ?>
                                                    </tbody>
                    </table>
                <?php } ?>
                </div>



                  <!-- ESCROW TRANSACT TABLE -->
              <div class="card-innr table-responsive">
                    <div class="card-head">
                        <h4 class="card-title"> <?php if(isset($transaction_info['id_no'])&&isset($transaction_info['user_email'])&&isset($transaction_info['txn'])&&isset($transaction_info['transact_date'])){echo "<h4 class=''>Latest Escrow Trades</h4>";}else{echo "";}?></h4>
                    </div>

    <?php if(isset($transaction_info['id_no'])&&isset($transaction_info['user_email'])&&isset($transaction_info['txn'])&&isset($transaction_info['transact_date'])){?>
  <table class="data-table table table-hover dt-init user-tnx">
                        <thead>
                            <tr class="data-item data-head">
                                <th class="data-col dt-tnxno">Transaction ID</th>
                                <th class="data-col dt-amount">Seller Email</th>
                                <th class="data-col dt-amount">Seller Amount</th>
                                 <th class="data-col dt-amount">Buyer Email</th>
                                <th class="data-col dt-amount">Buyer Amount</th>
                               <th class="data-col dt-amount">Date</th>
                                <th class="data-col dt-account">Status</th>
                                <th class="data-col dt-type">
                                    <div class="dt-type-text">Type</div>
                                </th>
                                <th class="data-col data-actions">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
        

                                        <tr class="data-item">
        <?php foreach($sql_transact_exec as $transaction_info){extract($transaction_info);?>
                <td class="data-col dt-tnxno">
                    <div class="d-flex align-items-center">
                                                                <div class="fake-class">
                        <span class="lead tnx-id"><?php if(isset($transaction_info['txn']) && $transaction_info['txn']!==null){echo $transaction_info['txn'];} else{echo"No Trade Transactions Yet";}?></span>
                            <span class="sub sub-date"><?php if(isset($transaction_info['transact_date']) && $transaction_info['transact_date']!==null){echo $transaction_info['transact_date'];}?></span>
                        </div>
                    </div>
                </td>
                  <td class="data-col dt-account">
<span class="lead user-info text-warning"><?php if(isset($transaction_info['seller_email']) && $transaction_info['seller_email']!==null){echo $transaction_info['seller_email'];}?></span>
                                                    </td>
                <td class="data-col dt-token">
                    <span class="lead token-amount"><?php if(isset($transaction_info['seller_amount']) && $transaction_info['seller_amount']!==null){echo $transaction_info['seller_amount'];}?></span>
                    <span class="sub sub-symbol"><?php if(isset($transaction_info['first_cur']) && $transaction_info['first_cur']!==null){echo strtoupper($transaction_info['first_cur']);}?></span>
                </td>
                  <td class="data-col dt-account">
<span class="lead user-info"><?php if(isset($transaction_info['buyer_email']) && $transaction_info['buyer_email']!==null){echo $transaction_info['buyer_email'];}?></span>
                                                    </td>
        <td class="data-col dt-account">
            <span class="lead user-info"><?php if(isset($transaction_info['buyer_amount']) && isset($transaction_info['buyer_amount'])){echo $transaction_info['buyer_amount'];}?></span>
            <span class="sub sub-symbol"><?php if(isset($transaction_info['second_cur']) && $transaction_info['second_cur']!==null){echo strtoupper($transaction_info['second_cur']);}?></span>
        </td>
         <td class="data-col dt-account">
<span class="lead user-info"><?php if(isset($transaction_info['transact_date']) && $transaction_info['transact_date']!==null){echo $transaction_info['transact_date'];}?></span>
                                                    </td>
                <td class="data-col dt-account">
<span class="lead user-info text-warning"><?php if(isset($transaction_info['status']) && $transaction_info['status']!==null){echo $transaction_info['status'];}?></span>
                                                    </td>
                                            
                <td class="data-col dt-type">
<?php if(isset($transaction_info['id_no'])&&isset($transaction_info['user_email'])&&isset($transaction_info['txn'])&&isset($transaction_info['transact_date'])){echo "<span class='dt-type-md badge badge-outline badge-error badge-md'>Escrow Trade</span>";}?>
                    <span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">Es</span>
                       </td>

                            </tr>
                        <?php } ?>
                                                    </tbody>
                    </table>
                <?php } ?>
                </div>


                              <!-- .card-innr -->
 <!-- .card-innr -->
 <div class="myrow showTb">
                 <div class="mycolumn">
                      <div class="intermediate"><?php if(isset($transact_info['txn']) && $transact_info['txn']!==null){echo "Transaction ID";}?></div>
                      <div class="intermediate"><?php if(isset($package) && $package!==null){echo "Package";}?></div>
                    <div class="intermediate"><?php if(isset($transact_info['amount']) && $transact_info['amount']!==null){echo "Amount";}?></div>
                    <div class="intermediate"><?php if(isset($duration) && $duration!==null){echo "Duration";}?></div>
                    <div class="intermediate"><?php if(isset($transact_date) && $transact_date!==null){echo "Due date";}?></div>
                    <div class="intermediate"><?php if(isset($transact_info['status']) && $transact_info['status']!==null){echo "Status";}?></div>
                    <div class="intermediate"><?php if(isset($transact_date)&&isset($transact_info['amount'])&&isset($transact_info['currency'])&&isset($transact_info['status'])){echo "Type";}?></div>
                 </div>
                 
                       <div class="mycolumn">
                  <div class="intermediate">  
                    <span class=""><?php if(isset($transact_info['txn']) && $transact_info['txn']!==null){echo $transact_info['txn'];} else{echo "";}?></span>
                </div>
  
                   <div class="intermediate">  
        <span class=""><?php if(isset($package) && $package!==null){echo strtoupper($package);}else{echo "";}?></span>
    </div>
<div class="intermediate">
<span class=""><?php if(isset($transact_info['amount']) && $transact_info['amount']!==null){echo $transact_info['amount'] . $transact_info['currency'];}else{echo "";}?></span>
                                </div>
                   <div class="intermediate">  
 <span class="user-info text-center w-100"><?php if(isset($duration) && $duration!==null){echo $duration . 'days';}else{echo "";}?></span> </div>
<div class="intermediate">  
            <span class="user-info text-center w-100"><?php if(isset($transact_date) && isset($duration)){echo date('Y-m-d', strtotime($transact_date . + ($duration - 2) .'days'));}?></span>
        </div>
 <div class="intermediate">  
 <span class="user-info text-white text-center bg-warning w-50"><?php if(isset($transact_info['status']) && $transact_info['status']!==null){echo $transact_info['status'];}else{echo "";}?></span> </div>

 <div class="intermediate">  
        <?php if(isset($transact_date)&&isset($transact_info['amount'])&&isset($transact_info['currency'])&&isset($transact_info['status'])){echo "<span class=''>Trade</span>";}else{echo "";}?>
</div>
               </div>         
          <!-- .card -->
                </div>
                
      <!-- .container -->
  </div>
  <!-- .page-content -->
</div>


    <div class="footer-bar">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8">
                    <ul class="footer-links">
        <li><a href="https://boldswap.org/docs/terms-of-use.php">Terms of Service</a></li>
        <li><a href="https://boldswap.org/docs/about.php">About</a></li>
        <li><a href="https://boldswap.org/docs/cookie-policy.php">Cookie Policy</a></li>
        <li><a href="https://boldswap.org/docs/privacy-policy.php">Privacy Policy</a></li>
                    </ul>
                </div>
                <!-- .col -->
                <div class="col-md-4 mt-2 mt-sm-0">
                    <div class="d-flex justify-content-between justify-content-md-end align-items-center guttar-25px pdt-0-5x pdb-0-5x">
                        <div class="copyright-text"><p style="padding:10px 0 !important;"><center><small>©&nbsp;<?= date('Y');?>&nbsp;<a href="#"><span class="orange">Boldswap</span></a> | All rights reserved.&nbsp;Boldswap - The easiest place to invest bitcoin.<br>Boldswap is a registered investment platform providing digital asset investment management services to individuals, lending and investment, multicurrency and multifunctional online platform based on blockchain technology.</small></center></p></div>
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
 <script>

window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}
 </script>

</body>
</html>

