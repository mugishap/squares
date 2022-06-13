<?php

include './../controllers/operations.php';
use Controllers\Operations;

$userid = $_COOKIE['SQUARE-USERID'];
if(!(isset($_COOKIE['SQUARE-USERID']))) {
    header("Location: ./../views/login.php");
    return;
}
$operations = new Operations('users');
$user = $operations->getUser($userid);
if(!$user) {
    header("Location: ./../views/login.php");
    echo $user;
    return;
}

?>

