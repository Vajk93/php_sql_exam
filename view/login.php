<?php
include "../config/database.php";/** @var $link mysqli */
include "../config/functions.php";
include "../config/settings.php";

session_start();
//var_dump($_SESSION, session_id());

$info = '';
if(!empty($_POST)){
    if( login() ){
        header('location: index.php');
        exit();
    } else {
        $info = '<span style="color:red;" class="error">Invalid email address or password!</span>';
    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../design/css/responsive.css">
    <link rel="stylesheet" href="../design/css/styles.css">
</head>
<body>

<?php include "../design/index/header.html"; ?>
    <main>
        <div class="main-container">
          <div>
  <span>Log In</span><br>

<?php echo $info; ?>

                <form action="login.php" method="post">
                    <div>
                        <input class="main-input" type="email" placeholder="Email" name="log_in_email" value="<?php echo getValue('log_in_email'); ?>" required>
                    </div>
                        <br>
                    <div>
                        <input class="main-input" type="password" minlength="6" name="log_in_password" placeholder="Password" required>
                    </div>
                        <br>
                    <input class="main-button" type="submit" name="log_in_submit" value="Log In">
                </form>
                <br>
                <p class="login-signup-link">Don't have an account? <a class="reg-link-on-login" href="registration.php">Sign up</a></p>
              </div>
            </div>
        </main>

<?php include "../design/index/footer.html"; ?>
<script src="../design/js/basic.js" charset="utf-8"></script>

</body>
</html>
