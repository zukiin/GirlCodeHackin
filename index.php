<?php
  //  ------------------------------ make all errors and warning vissible on page
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

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
    case 'home':
        $title = 'Sizabantu | Home';
        require_once 'views/frontend/home.php';
        break;
    case 'aboutus':
        $title = 'Sizabantu | About Us';
        require_once 'views/frontend/aboutus.php';
        break;
    case 'become_a_donor':
        $title = 'Sizabantu | Become A Donor';  
        require_once 'views/frontend/becomeadonor.php';
        break;
    case 'contactus':
        $title = 'Sizabantu | Contact Us';
        require_once 'views/frontend/contactus.php';
        break;
    case 'account':
        $title = 'Sizabantu | Acoount';
        require_once  'views/frontend/account.php';
        break;
    case 'login':
        $title = 'Sizabantu | Login';
        require_once  'views/frontend/login.php';
        break;
    case 'register':
        $title = 'Sizabantu | Register';
        require_once  'views/frontend/register.php';
        break;
    default :
        $error_message = "case not handled for action '<strong>$action</strong>'";
        $error_message .= "Check if the file exist and try again. Or drop a whatsapp message ;)";
        echo $error_message;
        break;
}
?>