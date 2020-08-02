<?php

//  ------------------------------ make all errors and warning vissible on page
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once dirname(__FILE__) . '/model.php';

$phpSelf = explode(DIRECTORY_SEPARATOR, filter_input(INPUT_SERVER, 'PHP_SELF'));
if (empty($level)) {
  $level = 1;
}   // website hierachy
$temp = "";
for ($k = 1; $k < count($phpSelf) - $level; $k++) {
  $temp .= DIRECTORY_SEPARATOR . $phpSelf[$k];
};
define('PATH', $temp);

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

//  global variables
$session = 'offline';
$uname = $uid = null;  //  currently logged in user

if (isset($_SESSION['name'])) {
  $session = 'online';
} else {
  header("location: /");
  exit();
}

//  start controller
$action = NULL;
$methods = [INPUT_POST, INPUT_GET];

for ($i = 0; empty($action) && $i < count($methods); $i++) {
  $method = $methods[$i];
  $action = filter_input($method, 'q');
}
if (empty($action)) {
  $action = 'landing';
}

switch ($action) {
  case 'landing':
    $title = 'Sizabantu | Dashboard';
    require_once 'views/landing.php';
    break;

  case 'become_a_donor':
    $title = 'Sizabantu | Dashboard';
    require_once 'views/donor/become_a_donor.php';
    break;

  case 'donor_contribution':
    $title = 'Sizabantu | Dashboard';
    $province = Donor::fetch_province();
    require_once 'views/donor/donor_contribution.php';
    break;

  case 'list_donor':
    $province = Donor::fetch_province();
    require_once 'views/donor/list_donor.php';
    break;

  case 'list_recipient':
    $title = 'Sizabantu | Dashboard';
    $province = Donor::fetch_province();
    require_once 'views/recipient/list_recipient.php';
    break;

  case 'register_recipient':
    $title = 'Sizabantu | Dashboard';
    $province = Donor::fetch_province();
    require_once 'views/recipient/register_recipient.php';
    break;

    case 'track_parcel':
      $title = 'Sizabantu | Dashboard';
      require_once 'views/parcel/track_parcel.php';
      break;
  

  default:
    $title = 'Sizabantu | Dashboard';
    require_once 'views/landing.php';
    break;
}
