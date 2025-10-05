<?php
include 'connection.php'; // Your DB connection file

if (isset($_POST['pay'])) {
    // Generate Order ID
    $order_id = "ORD" . rand(1000, 9999);

    // Dummy Insert
    $insert = "INSERT INTO bookingtable (
        ORDERID, movieID, bookingFName, bookingLName,
        bookingPNumber, bookingEmail, bookingDate, bookingTheatre,
        bookingType, bookingTime, amount, `DATE-TIME`
    ) VALUES (
        '$order_id', 3, 'Test', 'User',
        '9876543210', 'test@example.com', CURDATE(), 'PVR',
        '3D', '7:00 PM', 250, NOW()
    )";

    if (mysqli_query($con, $insert)) {
        // Redirect to receipt page
        header("Location: reciept.php?id=$order_id");
        exit();
    } else {
        echo "Database Error: " . mysqli_error($con);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dummy Payment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .payment-form {
      max-width: 600px;
      margin: 40px auto;
      padding: 30px;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .form-section {
      border-bottom: 1px solid #ddd;
      padding-bottom: 20px;
      margin-bottom: 20px;
    }
    .form-section:last-child {
      border: none;
      margin-bottom: 0;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="payment-form">
    <h3 class="mb-4 text-center">Select Payment Method</h3>

    <form method="post" action="">
      <!-- Card Section -->
      <div class="form-section">
        <h5>Pay with Card</h5>
        <div class="mb-3">
          <label for="card_number" class="form-label">Card Number</label>
          <input type="text" class="form-control" name="card_number" id="card_number" maxlength="16" required>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="expiry" class="form-label">Expiry Date</label>
            <input type="text" class="form-control" name="expiry" id="expiry" placeholder="MM/YY" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="password" class="form-control" name="cvv" id="cvv" maxlength="3" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="card_name" class="form-label">Name on Card</label>
          <input type="text" class="form-control" name="card_name" id="card_name" required>
        </div>
      </div>

      <!-- UPI Section -->
      <div class="form-section">
        <h5>OR Pay via UPI</h5>
        <div class="mb-3">
          <label for="upi_id" class="form-label">UPI ID</label>
          <input type="text" class="form-control" name="upi_id" id="upi_id" placeholder="example@upi">
        </div>
      </div>

      <!-- Net Banking Section -->
      <div class="form-section">
        <h5>OR Pay via Net Banking</h5>
        <div class="mb-3">
          <label for="bank" class="form-label">Select Bank</label>
          <select class="form-select" name="bank" id="bank">
            <option value="">Choose Bank</option>
            <option value="sbi">State Bank of India</option>
            <option value="hdfc">HDFC Bank</option>
            <option value="icici">ICICI Bank</option>
            <option value="axis">Axis Bank</option>
          </select>
        </div>
      </div>

      <div class="d-grid">
        <button type="submit" name="pay" class="btn btn-primary">Make Dummy Payment</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>
