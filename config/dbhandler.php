<?php

abstract class DBHandler {
  private static $connection;
  private static $dbhost = 'localhost';
  private static $dbuser = 'root';
  private static $dbpass = '';
  private static $db = 'together1';

  private static function GetConnection() {
    self::$connection = mysqli_connect(self::$dbhost, self::$dbuser, self::$dbpass);
    if (!self::$connection){
        die("Database Connection Failed" . mysqli_error(self::$connection));
    }
    $select_db = mysqli_select_db(self::$connection, self::$db);
    if (!$select_db){
        die("Database Selection Failed" . mysqli_error(self::$connection));
    }
    return self::$connection;
  }

  public static function DQLi($sql, $params = null) {
      try {
          $conn = self::GetConnection();
          $stmt = mysqli_query($conn, $sql);
          $rslt = array();
              while($result = mysqli_fetch_assoc($stmt)){
                  $rslt[] = $result;
              }
          return $rslt;
      } catch (Exception $ex) {
          return array('Error' => true, 'Message' => $ex->getMessage());
      }
  }
    
    public static function DQLqi($sql, $params = null) {
        try {
            $conn = self::GetConnection();
            $stmt = mysqli_query($conn, $sql);
            return mysqli_fetch_array($stmt);
        } catch (Exception $ex) {
            return array('Error' => true, 'Message' => $ex->getMessage());    
        }
    }

    public static function DMLi($sql, $params = null) {
    	try {
    		$conn = self::GetConnection();
        $result = mysqli_query($conn, $sql) or die("Insert Not Succeesful ". mysqli_error($conn));
    	} catch(Exception $ex) {
    		return array('Error' => true, 'Message' => $ex->getMessage());
    	}
    }
}

?>