<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$checkSum = "";
$paramList = array();

// Get values from POST
$ORDER_ID = $_POST["ORDER_ID"];
$CUST_ID = $_POST["CUST_ID"];
$INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
$CHANNEL_ID = $_POST["CHANNEL_ID"];
$TXN_AMOUNT = $_POST["TXN_AMOUNT"];

// Prepare parameters for checksum
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
$paramList["CALLBACK_URL"] = "http://localhost/xceller%20project/movie_ticket_booking_system_php-main/pgResponse.php"; // Use ngrok if needed

// Generate checksum
$checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);
?>

<html>
<head>
    <title>Redirecting to Paytm...</title>
</head>
<body>
    <center><h1>Please do not refresh this page...</h1></center>
    <form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="paytm_form">
        <?php
        foreach ($paramList as $name => $value) {
            echo "<input type='hidden' name='" . $name . "' value='" . $value . "'>";
        }
        ?>
        <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
    </form>
    <script type="text/javascript">
        document.paytm_form.submit();
    </script>
</body>
</html>
