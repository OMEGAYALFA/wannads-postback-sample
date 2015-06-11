<?php


$secret = ""; // check your app info at www.wannads.com


$userId = isset($_GET['subId']) ? $_GET['subId'] : null;
$transactionId = isset($_GET['transId']) ? $_GET['transId'] : null;
$points = isset($_GET['reward']) ? $_GET['reward'] : null;
$signature = isset($_GET['signature']) ? $_GET['signature'] : null;
$action = isset($_GET['status']) ? $_GET['status'] : null;
$ipuser = isset($_GET['userIp']) ? $_GET['userIp'] : "0.0.0.0";


// validate signature
if (md5($userId.$transactionId.$points.$secret) != $signature){
    echo "ERROR: Signature doesn't match";
    return;
}

if($action == 2){  // action = 1 CREDITED // action = 2 REVOKED
    $points = -abs($points);
}

if(isNewTransaction($transactionId)){ // Check if the transaction is new
    processTransaction($userId, $points, $transactionId);
    echo "OK";
}else{
    // If the transaction already exist please echo DUP.
    echo "DUP";
}

?>