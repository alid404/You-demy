<?php 
require_once '../config/connection.php';
require_once '../class/Users.php';

session_start();
$newUser = new Users();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $newUser->register($name,$email,$password, $role);

    $_SESSION['registered'] = true;
    header("location: ../login/index.php");
}

$errorMessage = "";

if (isset($_SESSION['already']) && $_SESSION['already'] === true) {
    $errorMessage = "User is already exist";
    unset($_SESSION['already']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--Stylesheet-->
    <link rel="stylesheet" href="../src/css/loginStyle.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <span class="hamburger-btn material-symbols-rounded">menu</span>
            <a href="../index.php" class="logo">
                <img src="../src/img/logo.jpg" alt="logo">
                <h2>Youdemy</h2>
            </a>
            <ul class="links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">Courses</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact us</a></li>
            </ul>
            <span></span>
        </nav>
    </header>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <form method="POST">
        <h3>Create your account</h3>

        <?php 
          if(!empty($errorMessage)) {
              echo "
                  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                      <strong style='color: #ffb648;'>$errorMessage</strong>
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>
              ";
          }
        ?>

        <label for="name">Name</label>
        <input name="name" type="text" placeholder="Enter you full name" id="name" required>

        <label for="role">Role</label>
        <select name="role" id="role" required>
            <option value="" disabled selected>Select your role</option>
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
        </select>

        <label for="email">Email</label>
        <input name="email" type="text" placeholder="Enter you email" id="email" required>

        <label for="password">Password</label>
        <input name="password" type="password" placeholder="Enter your password" id="password" required>

        <button id="submitBtn" type="submit" name="submit">REGISTER</button>

        <div class="social">
          <div>
            <a href="../login/index.php">Already have an account</a>
          </div>
        </div>
    </form>
</body>
</html>