<?php

//registration
function createRows() {

    if(isset($_POST['reg_submit'])){
        global $link;

        $name = $_POST['reg_name'];
        $email = $_POST['reg_email'];
        $password = $_POST['reg_password'];
        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users(name,email, password) ";
        $query .= "VALUES ('$name', '$email','$password')";

        $result = mysqli_query($link, $query);

        if(!$result) {
        echo '<p style="color:red;">This email address is already registered!</p>';
        } else {
            //This script alert doesn't work
            //echo '<script>alert("Succesful registration! Let\'s Sign In!");</script>';
            header('location: login.php');
        }
        }
}


function uploadCode(){

    if(isset($_POST['code_upload_submit'])){
        global $link;

        $email = $_SESSION['userdata']['email'];
        $name = $_SESSION['userdata']['name'];
        $code = $_POST['code_input_field'];
        $code = strtoupper($code);

        $query = "INSERT INTO codes(email, name, code) ";
        $query .= "VALUES ( '$email','$name','$code') ";

        $result = mysqli_query($link, $query);
        if(!$result) {
            //die('query failed' . mysqli_error($link));
            // if the code already have in the database
            echo "Let's try again :)";
            echo '<script>alert("This code is uploaded already. Please, check your code, and try to upload again the correct version!");</script>';
        } else {
            echo "Code uploaded! :)";
        }
        }

}


function showCode(){

    global $link;
    $email = $_SESSION['userdata']['email'];

        $qry = "SELECT name,email,code FROM codes WHERE email = '$email'";
        $result = mysqli_query($link, $qry) or die(mysqli_error($link));

        $table = '<br><br><p style="border-bottom:1px solid black;">My Uploaded Codes:</p><br>
            <ol>';
        while ($row = mysqli_fetch_row($result)) {
            // take hyphen between characters
            $row[2]= "".substr($row[2], 0, 6)."-".substr($row[2], 6, 6)."-".substr($row[2],12,6)."-".substr($row[2],18,6); // 111111-111111-111111-111111
            $table .= '<li>' . $row[2] . '</li>';
        }
        $table .= '</ol>';

        echo $table;

  }



function login()
{
    global $link;

    $email = mysqli_real_escape_string($link, filter_input(INPUT_POST, 'log_in_email'));
    $password = filter_input(INPUT_POST, 'log_in_password');

    $qry = "SELECT password,id,name
                 FROM users
                 WHERE email = '$email'
                 LIMIT 1";
    $result = mysqli_query($link, $qry) or die(mysqli_error($link));
    $row = mysqli_fetch_row($result);

    if ($row !== null && password_verify($password, $row[0])) {

        //from session
        $stime = time();//timestamp
        $sid  = session_id();
        $spass = md5( $sid . $row[1] . SECRET_KEY);
        $_SESSION['userdata'] = [
               'id' => $row[1],
                'name' => $row[2],
                'email' => $email,
            ];
            //var_dump($sid,$spass,$stime);
            //damage earlier sessions
        $_SESSION['id'] = $sid;
            mysqli_query($link, "DELETE FROM sessions WHERE sid = '$sid' LIMIT 1") or die(mysqli_error($link));
            //login recording in "sessions" table
            $qry = "INSERT
                        INTO sessions(`sid`,`spass`,`stime`)
                        values('$sid','$spass','$stime')";
            mysqli_query($link, $qry) or die(mysqli_error($link));

            return true;
        }

        return false;
    }


/**
 * Login authentication
 * @return bool
 */

function auth(){

    global $link;
    $now = time();
    $expired = $now - (60*15);//15 minutes
    //damage earlier sessions
    mysqli_query($link, "DELETE FROM sessions WHERE stime < $expired") or die(mysqli_error($link));

    $sid = session_id();
    $qry = "SELECT spass FROM sessions WHERE sid = '$sid' LIMIT 1";
    $result = mysqli_query($link, $qry) or die(mysqli_error($link));
    $row = mysqli_fetch_row($result);
    //var_dump($row);

    if(
        isset($_SESSION['userdata']['id'])
    &&
        $row[0] === md5($_SESSION['id'] . $_SESSION['userdata']['id'] . SECRET_KEY)
    ) {

    mysqli_query($link,"UPDATE sessions SET stime = $now WHERE sid = '$sid' LIMIT 1") or die(mysqli_error($link));
        return true;
    }

    return false;
}


function logout(){
    //damage session
    global $link;
    mysqli_query($link,"DELETE FROM sessions WHERE sid = '{$_SESSION['id']}' LIMIT 1") or die(mysqli_error($link));
    $_SESSION = [];
    session_destroy();
}


/**
 * @param $fieldName
 * @param $rowData
 * @return mixed
 */

function getValue($fieldName, $rowData = []){
    if(filter_input(INPUT_POST, $fieldName) !== null){//ha létezik az elem akkor visszatér vele (akkor is ha üres)
        return filter_input(INPUT_POST, $fieldName);
    }
    //ha van DB adat akkor azzal térünk vissza
     if(array_key_exists($fieldName,$rowData)){
        return $rowData[$fieldName];
    }

    return '';
}


/**
* echo errors
* @param $fieldName
* @return mixed|string
*/
function getError($fieldName){
    global $errors;

    if(isset($errors[$fieldName])){
    return $errors[$fieldName];
    }
    return '';//if there isn't item such like this, return empty message
}
