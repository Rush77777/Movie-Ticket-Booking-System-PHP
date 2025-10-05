<?php
include('connection.php');

if (isset($_POST['register'])) {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']); // Not hashed

    if (empty($name) || empty($email) || empty($password)) {
        echo "<script>alert('Please fill in all fields.');</script>";
    } else {
        // Check if email already exists
        $check = $con->prepare("SELECT * FROM users1 WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $checkResult = $check->get_result();

        if ($checkResult->num_rows > 0) {
            echo "<script>alert('Email already registered. Please use another one.');</script>";
        } else {
            // Insert new user
            $stmt = $con->prepare("INSERT INTO users1 (name, email, password, roletype) VALUES (?, ?, ?, ?)");
            $roletype = 2;
            $stmt->bind_param("sssi", $name, $email, $password, $roletype);

            if ($stmt->execute()) {
                echo "<script>window.location.href='login2.php';</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        }

        $check->close();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f2f2f2;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .register-box {
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      background: #fff;
      border: 2px solid #dc3545; /* Red border */
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(220, 53, 69, 0.2);
    }
    .register-box h2 {
      margin-bottom: 25px;
      text-align: center;
      color: #dc3545;
    }
    .form-label {
      font-weight: 500;
    }
    .btn-primary {
      background-color: #dc3545;
      border: none;
    }
    .btn-primary:hover {
      background-color: #bb2d3b;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="register-box">
    <h2>Register</h2>
    
    <form action="register.php" method="post">
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" id="name" required placeholder="Enter your name">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="email" required placeholder="Enter your email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" required placeholder="Enter your password">
      </div>
      <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
    </form>
     <div class="login-link">
      Already registered? <a href="login2.php">Login here</a>
    </div>
  </div>
</div>

</body>
</html>
