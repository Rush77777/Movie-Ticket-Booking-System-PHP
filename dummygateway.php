<?php
// dummy_gateway.php
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dummy Payment Gateway</title>
  <style>
    body { font-family: Arial, sans-serif; width: 400px; margin: 40px auto; line-height: 1.6; }
    input, select, button { width: 100%; padding: 8px; margin: 8px 0; }
    .status { background: #f4f4f4; padding: 8px; margin: 8px 0; }
  </style>
</head>
<body>
  <h2>Dummy Payment Dashboard</h2>
  <form method="POST" action="dummygateway.php">
    <label>Order ID:</label>
    <input type="text" name="ORDERID" value="<?php echo $_POST['ORDERID'] ?? 'ORDER'.rand(1000,9999); ?>" required>

    <label>Customer ID:</label>
    <input type="text" name="CUST_ID" value="<?php echo $_POST['CUST_ID'] ?? 'CUST'.rand(100,999); ?>" required>

    <label>Amount (₹):</label>
    <input type="number" step="0.01" name="TXNAMOUNT" value="<?php echo $_POST['TXNAMOUNT'] ?? '100.00'; ?>" required>

    <label>Select Status:</label>
    <select name="STATUS">
      <option value="TXN_SUCCESS">Success</option>
      <option value="TXN_FAILURE">Failure</option>
      <option value="TXN_PENDING">Pending</option>
    </select>

    <button type="submit" name="simulate" value="1">Proceed to Platform</button>
  </form>

  <?php if (isset($_POST['simulate'])): ?>
    <?php
      // After choosing, the form POSTS dummy data to the response handler
      $data = [
        'ORDERID' => $_POST['ORDERID'],
        'CUST_ID' => $_POST['CUST_ID'],
        'TXNAMOUNT' => $_POST['TXNAMOUNT'],
        'STATUS' => $_POST['STATUS'],
        'CHECKSUMHASH' => 'DUMMY_HASH'
      ];
    ?>
    <div class="status">
      <strong>Data Sent to Platform:</strong><br>
      <?php foreach ($data as $k => $v): ?>
        <?php echo "$k : $v"; ?><br>
      <?php endforeach; ?>
    </div>
    <form method="POST" action="pgResponse.php">
      <?php foreach ($data as $k => $v): ?>
        <input type="hidden" name="<?php echo $k; ?>" value="<?php echo $v; ?>">
      <?php endforeach; ?>
      <button type="submit">Continue to Booking System</button>
    </form>
  <?php endif; ?>
</body>
</html>
