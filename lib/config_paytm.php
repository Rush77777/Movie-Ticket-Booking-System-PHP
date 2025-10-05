<?php
/*
Instructions:
- Set PAYTM_ENVIRONMENT to 'TEST' for staging and 'PROD' for live use.
- Use the correct MID and Merchant Key from your Paytm Dashboard.
- For testing, use 'WEBSTAGING' as the website name.
*/

define('PAYTM_ENVIRONMENT', 'TEST'); // Change to 'PROD' when going live

// ✅ Replace with your actual Paytm TEST credentials from dashboard
define('PAYTM_MERCHANT_KEY', 'bKMfNxPPf_QdZppa');
define('PAYTM_MERCHANT_MID', 'DIY12386817555501617');

define('PAYTM_MERCHANT_WEBSITE', 'WEBSTAGING');         // Use 'WEBSTAGING' in TEST, 'DEFAULT' in PROD

// Set correct Paytm URLs based on environment
if (PAYTM_ENVIRONMENT == 'PROD') {
    define('PAYTM_TXN_URL', 'https://securegw.paytm.in/theia/processTransaction');
    define('PAYTM_STATUS_QUERY_URL', 'https://securegw-stage.paytm.in/order/status');
} else {
    define('PAYTM_TXN_URL', 'https://securegw-stage.paytm.in/theia/processTransaction');
    define('PAYTM_STATUS_QUERY_URL', 'https://securegw-stage.paytm.in/merchant-status/getTxnStatus');
}

// Optional: Refund API (only needed if you're handling refunds)
define('PAYTM_REFUND_URL', '');
?>
