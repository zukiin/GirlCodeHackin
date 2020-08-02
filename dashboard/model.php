<!--  -->

<?php

require_once dirname(__FILE__, 2) . '/config/dbhandler.php';
require_once dirname(__FILE__, 2) . '/logic/lightlitha.php';

abstract class Donor
{
  public static function fetch_province()
  {
    $sql = "SELECT DISTINCT District FROM `city` WHERE CountryCode = 'ZAF'";
    return DBHandler::DQLi($sql);
  }
}