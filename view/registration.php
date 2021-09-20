<?php
require "../config/database.php";
require "../config/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../design/css/responsive.css">
    <link rel="stylesheet" href="../design/css/styles.css">
</head>
<body>
<?php include "../design/index/header.html"; ?>
    <main>
        <div class="main-container">
            <div>
            <span>Sign Up</span>
            <form action="registration.php" method="post">
                <div>
                  <br>
                  <input class="main-input" type="text" name="reg_name" placeholder="Username" required>
                </div>
                <br>

                <div>
                  <input class="main-input" type="email" name="reg_email" placeholder="Email" required>

<?php createRows(); ?>
                </div>
                <br>

                <div>
                  <input class="main-input" type="password" name="reg_password" minlength="6" placeholder="Password" required>
                </div>
                <br>
                <div>
                  <input class="main-button" type="submit" name="reg_submit" value="Sign Up">
                </div>
            </form>
            <br>
              <p class="privacy-policy">By signing up, you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy.</a></p>
            <br>
              <p class="login-signup-link">Already have an account? <a href="login.php">Log In!</a></p>
            </div>
        </div>
    </main>

<?php include "../design/index/footer.html"; ?>
<script src="../design/js/basic.js" charset="utf-8"></script>

</body>
</html>
