<?php

require_once dirname(__FILE__, 2) . '/config/dbhandler.php';
require_once dirname(__FILE__, 2) . '/logic/lightlitha.php';

abstract class Account
{
  public static function register($http_request)
  {
    $name = Text::is_name(filter_input(INPUT_POST, 'name')) ? filter_input(INPUT_POST, 'name') : '';
    $surname = Text::is_name(filter_input(INPUT_POST, 'surname')) ? filter_input(INPUT_POST, 'surname') : '';
    $email = Text::is_email(filter_input(INPUT_POST, 'email')) ? filter_input(INPUT_POST, 'email') : '';
    $companyname = Text::is_name(filter_input(INPUT_POST, 'companyname')) ? filter_input(INPUT_POST, 'companyname') : '';
    $contype = Text::is_name(filter_input(INPUT_POST, 'contype')) ? filter_input(INPUT_POST, 'contype') : '';
    $psw = filter_input(INPUT_POST, 'psw');
    $psw_repeat = filter_input(INPUT_POST, 'psw_repeat');

    if(strlen($psw) < 8 || $psw !== $psw_repeat) { 
      return false;
    }

    if(empty($name) || empty($surname) || empty($email) || empty($companyname) || empty($contype)) {
      return false;
    }
    $sql =  "INSERT INTO user (name, surname, email, companyname, contype, password) VALUES ('$name', '$surname', '$email', '$companyname', '$contype', '$psw')";
    DBHandler::DMLi($sql);
    return true;
  }

  public static function login($http_request)
  {
    $email = Text::is_email(filter_input(INPUT_POST, 'email')) ? filter_input(INPUT_POST, 'email') : '';
    $password = filter_input(INPUT_POST, 'psw'); 

    if(strlen($password) < 8 || empty($email) ) { 
      return false;
    }
    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = DBHandler::DQLqi("$sql");

    if(!empty($result['name'])) {
      $_SESSION['name'] = $result['name'];
      $_SESSION['surname'] = $result['surname'];
      $_SESSION['email'] = $result['email'];
      $_SESSION['companyname'] = $result['companyname'];
      return true;
    }

    return false;
  }
}