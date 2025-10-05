<?php
session_start();
include('connection.php');

if (isset($_POST['login'])) {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Secure SQL using prepared statements
    $stmt = $con->prepare("SELECT * FROM users1 WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        $_SESSION['uid']  = $data['id'];
        $_SESSION['type'] = $data['roletype'];

        if ($data['roletype'] == 1) {
            $_SESSION['message'] = "Admin login successful";
            header("Location: admin/index.php");
            exit();
        } elseif ($data['roletype'] == 2) {
            $_SESSION['message'] = "User login successful";
            header("Location: http://localhost/php/xceller%20project/movie_ticket_booking_system_php-main/");

            exit();
        } else {
            echo "<script>alert('Unknown role');</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password');</script>";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f2f2f2;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .login-box {
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      background: #fff;
      border: 2px solid #dc3545; /* Red border */
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(220, 53, 69, 0.2);
    }
    .login-box h2 {
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
  <div class="login-box">
    <h2>Login</h2>
    <form action="login2.php" method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="email" required placeholder="Enter your email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" required placeholder="Enter your password">
      </div>
      <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</div>

</body>
</html>