<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";

// Allow DUMMY_HASH for simulation
if ($paytmChecksum === "DUMMY_HASH") {
    $isValidChecksum = "TRUE";
} else {
    $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum);
}

if ($isValidChecksum == "TRUE") {
    echo "<b>Checksum matched and transaction details are:</b><br/>";
    
    if ($_POST["STATUS"] == "TXN_SUCCESS") {
        echo "<b>Transaction was successful</b><br/>";
        
        include "connection.php";

        $orderId = $_POST['ORDERID'];
        $amount = $_POST['TXNAMOUNT'];

        $query = "UPDATE bookingtable SET amount='$amount' WHERE ORDERID='$orderId'";
        mysqli_query($con, $query);

        header("Location: reciept.php?id=" . $orderId);
        exit;
    } else {
        echo "<b>Transaction Failed</b><br/>";
        header("Location: fail.html");
        exit;
    }
} else {
    echo "<b>Checksum mismatched.</b>";
}
