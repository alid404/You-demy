<?php 
require_once '../config/connection.php';
require_once '../class/Users.php';

session_start();
$newLogin = new Users();

if (isset($_POST['submit'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $newLogin->logIn($email,$password);
}

$successMessage = "";
$warningMessage = "";
$errorMessage = "";

if (isset($_SESSION['registered']) && $_SESSION['registered'] === true) {
  $successMessage = "You have been registered successfully";
  unset($_SESSION['registered']);
} elseif (isset($_SESSION['noPerm']) && $_SESSION['noPerm'] === true) {
  $warningMessage = "Your account is suspended!" . '<br>' . "for more information please contact us";
  unset($_SESSION['noPerm']);
} elseif (isset($_SESSION['false']) && $_SESSION['false'] === true) {
  $errorMessage = "Invalid email or password!";
  unset($_SESSION['false']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
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
        <h3>Login Here</h3>
        <?php 
            if(!empty($errorMessage)) {
                echo "
                    <div class='danger alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong style='color: #f26464;'>$errorMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            }
        ?>
        <?php 
            if(!empty($warningMessage)) {
                echo "
                    <div class='warning alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong style='color: #ffb648;'>$warningMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            }
        ?>
        <?php 
            if(!empty($successMessage)) {
                echo "
                    <div class='success alert alert-success alert-dismissible fade show' role='alert'>
                        <strong style='color: #4bde97;'>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            }
        ?>

        <label for="email">Email</label>
        <input name="email" type="text" placeholder="Email" id="email" required>

        <label for="password">Password</label>
        <input name="password" type="password" placeholder="Password" id="password" required>

        <button id="submitBtn" type="submit" name="submit">Log In</button>

        <div class="social">
          <div>
            <a href="../register/index.php">Create a new account</a>
          </div>
        </div>
    </form>
</body>
</html>