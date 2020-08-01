<?php

//  ------------------------------ make all errors and warning vissible on page
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once dirname(__FILE__) . '/model.php';

$phpSelf = explode(DIRECTORY_SEPARATOR, filter_input(INPUT_SERVER, 'PHP_SELF'));
if (empty($level)){$level=1;}   // website hierachy
$temp = "";
for($k=1;$k<count($phpSelf)-$level;$k++){
    $temp .= DIRECTORY_SEPARATOR.$phpSelf[$k];
};
define('PATH', $temp);

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

//  global variables
$session = 'offline';
$uname = $uid = null;  //  currently logged in user

if (isset($_SESSION['id'])) {
    $uname = $_SESSION['uname'];
    $uid = $_SESSION['id'];
    $session = 'online';
}

//  start controller
$action = NULL;
$methods = [INPUT_POST, INPUT_GET];

for ($i = 0; empty($action) && $i < count($methods); $i++) {
    $method = $methods[$i];
    $action = filter_input($method, 'q');
}
if (empty($action)) {$action = 'home';}

switch ($action) {
  case 'register':
      if( Account::register($_REQUEST) ) {
        header("location: ..?q=account&success=Account Created You may log in now.");
      } else {
        header("location: ..?q=account&error=failed to register user, make certain that all fields are correct");
      }
    break;

  case 'login':
      if( Account::login($_REQUEST) ) {
        header("location: ..?q=dashboard&success=You are now logged in as " . $_SESSION['name'] . ' ' . $_SESSION['surname'] );
      } else {
        header("location: ..?q=account&error=failed to login email or password incorrect");
      }
    break;

  default:
    break;
}
?>