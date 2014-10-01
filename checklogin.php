<?php
session_start();

// username and password sent from form 
$username = $_POST['username'];
$password = $_POST['password'];

if($_POST['remember']) {
    setcookie('remember_me', $_POST['username'], $year);
}
elseif(!$_POST['remember']) {
    if(isset($_COOKIE['remember_me'])) {
        $past = time() - 100;
        setcookie(remember_me, gone, $past);
    }
}

$result = checkLogin($username, $password);

if($result){
    $_SESSION['login'] = "true";
    header("location:index.php");
}
else {
    $_SESSION['error']='Invalid username or password';
    exit(header("Location:login.php"));
}

function checkLogin($username, $password) {
    $loginData = simplexml_load_file("xml/login.xml");
    if ($username == $loginData->login[0]->username && $password == $loginData->login[0]->password)
        return true;
    else
        return false;
}
?>