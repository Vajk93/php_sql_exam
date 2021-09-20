<?php
include "../config/database.php";
include "../config/functions.php";
include "../config/settings.php";

session_start();

//log out if need
if(filter_input(INPUT_GET, 'logout') !== null){
    logout();
}

$auth = auth();

if(!$auth){
    header('location: login.php');
    exit();
}

$userbar = '<div class="userbar"><b>Welcome '
    . $_SESSION['userdata']['name'] . '!</b> </div><div> <!--<a
href="?logout">Logout <i class="fas fa-sign-out-alt"></i></a>--></div>';


?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coupons</title>
    <link rel="stylesheet" href="../design/css/responsive.css">
    <link rel="stylesheet" href="../design/css/styles.css">
</head>
<body>

<?php include "../design/index/header.html"; ?>

    <main>
        <div class="main-container">
            <div class="welcome-message">
<?php echo $userbar; ?>
              <br>
              <p>Please, upload your code!</p>
              <br>
              <p class="code-description">The code should be <b>24 characters </b>which <br>contains <b>letters</b> from the English ABC and whole <b>numbers</b></p>
            <form action="index.php" method="post">
                <input class="main-input" style="width:330px;" type="text" minlength="24" maxlength="24" pattern="[a-zA-Z0-9]{1,}" required name="code_input_field" placeholder="Code">
                <button class="main-button upload-code-button" type="submit" name="code_upload_submit">Upload</button>
            </form>
              <br>

<?php
if(isset($_POST['code_upload_submit'])){
uploadCode();
}
showCode();
?>

            </div>
        </div>
    </main>

<?php include "../design/index/footer.html"; ?>
<script src="../design/js/basic.js" charset="utf-8"></script>

</body>
</html>
