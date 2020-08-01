<?php
//---------------------------------------------------DEFINE GLOBAL PATH CONSTANT
// $phpSelf = explode('/', filter_input(INPUT_SERVER, 'PHP_SELF'));
// $level = empty($level) ? 1 : $level;
//----------------------------------------------website hierachy
// $temp = "";
// for ($i = 1; $i < count($phpSelf) - $level; $i++) {
//     $temp .= "/{$phpSelf[$i]}";
// }
// define('ROOT', $temp);
//define('PATH', "{$_SERVER["REQUEST_SCHEME"]}://{$_SERVER['HTTP_HOST']}" . ROOT);
// define('PATH', "http://{$_SERVER['HTTP_HOST']}" . ROOT);

abstract class Convert {

    //<editor-fold desc="Binary-Decimal" defaultstate="collapsed">
    public static function decimal_binary($aug, $bits) {
        $digit = antiWhiteSpace($aug);  //clear any possible whitespaces from argument
        if (empty($digit)) {
            return null;
        }    //ignore whole function if test value is NULL
        else if (!is_numeric($digit)) {
            return 1;
        }
        $binary = "";   //string to be used to concatenate '1's and '0's based on exponential factors equivalent
        for ($k = 0; $k < $bits; $k++) {
            if ($digit >= pow(2, ($bits - 1) - $k)) {
                $binary .= "1";
                $digit -= pow(2, ($bits - 1) - $k);
            } else {
                $binary .= "0";
            }
        }
        return $binary;
    }

    public static function binary_decimal($binary) {
        if (!isset($binary)) {
            return NULL;
        }
        $val = 0;   //variable to be used to accumulate exponential equivalents of the '1's in the binary
        for ($k = 0; $k < strlen($binary); $k++) {
            if (substr($binary, $k, 1) == '1') {
                $val += pow(2, (strlen($binary) - 1) - $k);
            }
        }
        return $val;
    }

//</editor-fold>
}

abstract class Text {

//<editor-fold desc="Text Formatting" defaultstate="collapsed">
    public static function phone_format($text) {
        $txt = antiWhiteSpace($text);
        if (strlen($txt) == 10) {
            return "(" . substr($txt, 0, 3) . ") " . substr($txt, 3, 3) . " - " . substr($txt, 6, 4);
        }
        return $text;
    }

    public static function currency($value, $symbol) {
        $value = explode('.', $value);
        $string = "";
        $count = 0;
        for ($k = (strlen($value[0]) - 1); $k >= 0; $k--) {
            if ($count == 3) {
                $count = 0;
                $string .= " " . $value[0][$k];
            } else {
                $count++;
                $string .= $value[0][$k];
            }
        }
        $string = strrev($string);
        return "$symbol $string." . $value[1];
    }

    public static function reverse_phone_format($text) {
        $txt = antiWhiteSpace($text);
        if (strlen($txt) == 13) {
            return substr($txt, 1, 3) . substr($txt, 5, 3) . substr($txt, 9, 4);
        }
        return $text;
    }

    public static function is_email($txt) {
        if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $txt)) {
            return false;
        }
        return true;
    }
    public static function is_name($txt){
        if (!preg_match("/^([a-zA-Z' ]+)$/", $txt)) {
            return false;
        }
        return true;
    }
    public static function is_name_plus($text,$min=1,$max=20){
        $text = trim($text);
        if(strlen($text)<$min){            return "minimum character length: $min";}
        if(strlen($text)>$max){            return "maximum character length: $max";}
        if(!preg_match("/^([a-zA-Z' ]+)$/", $text)){            return "name not valid";}
        return 'success';
    }
    public static function is_alphabet($value){
        $value = strtoupper(self::anti_white_space($value));
        foreach (str_split($value) as $c){
            if(ord($c) < 65 || ord($c) > 90){                return false;}
        }
        return true;
    }
    public static function is_symbol($char){
        $char = self::anti_white_space($char);
        foreach (str_split($char) as $c){
            if(ord($c) < 48 || (ord($c) > 57 && ord($c) < 65) || (ord($c) > 90 && ord($c) < 97) || ord($c)>122){                return true;}
        }
        return false;
    }

//</editor-fold>
//<editor-fold desc="Integral Validation" defaultstate="collapsed">
    public static function is_int($txt) {
        $txt = self::anti_white_space($txt);    //remove whitspaces, for they have an ASCII equivalent of 32
        if (empty($txt)) {
            return false;
        }    //exit function if value is left NULL
        foreach (str_split($txt) as $a) {
            if (ord($a) < 48 || ord($a) > 57) {
                return false;
            }
        }   //break string into array to test characters at a time. ASCII numeric range 48 - 57
        return true;
    }

    public static function contains_int($text) {
        foreach (str_split($text . "") as $a) {
            if (ord($a) >= 48 && ord($a) <= 57) {
                return true;
            }
        }   //break string into array to test characters at a time. ASCII numeric range 48 - 57
        return false;
    }

//</editor-fold>
//<editor-fold desc="antiWhiteSpace" defaultstate="collapsed">
    /* -These Functions perform whitespace bypassing tasks
     * -Remove white-spaces from string
     */
    public static function anti_white_space($text) {  //take string as a parameter, remove white-spaces, then return it
        if (empty($text)) {
            return NULL;
        }    //exit function if argument is not initialized
        $txt = "";
        foreach (str_split($text) as $a) {
            if (ord($a) != 32) {
                $txt .= $a;
            }
        } //break string into array to test characters at a time. Append char to running string if !whitespace
        return $txt;
    }

    public static function text_length($text) {  //count string length excluding white-spaces
        $txt = "";
        foreach (str_split($text . "") as $a) {
            if (ord($a) != 32) {
                $txt .= $a;
            }
        } //break string into array to test characters at a time. Append char to running string if !whitespace
        return strlen($txt);
    }

    public static function is_null($text) {
        if (strlen($text) < 1) {
            return true;
        } else {
            return false;
        }
    }

//</editor-fold>
//<editor-fold desc="crypt" defaultstate="collapsed">
    public static function encrypt($data,$key){
        $encryption_key = base64_decode($key);  //  ---------------------------- remove base64 encodeing from key
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher="AES-256-CBC")); //  generate an initialization vector
        $encrypted = openssl_encrypt($data,$cipher,$encryption_key,0,$iv);  //-- encrypt data using AES 256 encryption in CBC mode using encryption key and initialization vector.
        return base64_encode($encrypted.'::'.$iv);
    }
    public static function decrypt($data,$key){
        $encryption_key = base64_decode($key);  //  ---------------------------- remove base64 encodeing from key
        list($encryption_data,$iv) = explode('::',base64_decode($data),2);  //-- split encrypted data from IV - unique seperator used was '::'
        return openssl_decrypt($encryption_data,'AES-256-CBC',$encryption_key,0,$iv);
    }
//</editor-fold>
    public static function in_multi_dim($val,$array) {
        foreach ($array as $item) {
            if (is_array($item)) {
                return in_array($val, $item);
            } else {
                return in_array($val, $array);
            }
        }
        return false;
    }
    public static function key_in_multi_dim($key,$array) {
        foreach ($array as $item) {
            if (is_array($item)) {
                return array_key_exists($key, $item);
            } else {
                return array_key_exists($key, $array);
            }
        }
        return false;
    }
    public static function bool($value){
        $bool = ['true'=>1,'false'=>0];
        return $bool[strtolower($value)];
    }
}

abstract class Filter {

    // replace any non-ascii character with its hex code.
    public static function escape($string) {
        $return = '';
        for ($i = 0; $i < strlen($string); ++$i) {
            $char = $string[$i];
            $ord = ord($char);
            if ($char !== "'" && $char !== "\"" && $char !== '\\' && $ord >= 32 && $ord <= 126) {
                $return .= $char;
            } else {
                $return .= '\\x' . dechex($ord);
            }
        }
        return $return;
    }

    public static function format_escape($string) {
        return str_replace('\xd\xa',"\r\n",$string);
    }

    public static function html_escape($html_escape) {
        $html_escape = htmlspecialchars($html_escape, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        return $html_escape;
    }

}

abstract class Dates {

    const MONTH = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

    public static function gen_date($start, $end) {
        if (($start < 1 || $start > 31) || ($end < 1 || $end > 31)) {
            return false;
        }
        $set = array();
        for ($k = $start; $k <= $end; $k++) {
            array_push($set, $k);
        }
        return $set;
    }
    public static function week(){
        $date_array = getdate(time());
        $numdays = $date_array['wday'];
        
        $startdate = date('Y-m-d',time() - ($numdays * 24*60*60));
        $enddate = date('Y-m-d',time() + ((7 - $numdays) * 24*60*60));
        
        $week['start'] = $startdate;
        $week['end'] = $enddate;
        
        return $week;
    }
    public static function weeknumber ($y, $m, $d) {
    $wn = strftime("%W",mktime(0,0,0,$m,$d,$y));
    $wn += 0; # wn might be a string value
    $firstdayofyear = getdate(mktime(0,0,0,1,1,$y));
    if ($firstdayofyear["wday"] != 1)    # if 1/1 is not a Monday, add 1
        $wn += 1;
    return ($wn);
}    # function weeknumber 
    public static function fromweek($y, $w, $o) {

        $days = ($w - 1) * 7 + $o;

        $firstdayofyear = getdate(mktime(0, 0, 0, 1, 1, $y));
        if ($firstdayofyear["wday"] == 0)
            $firstdayofyear["wday"] += 7;
# in getdate, Sunday is 0 instead of 7
        $firstmonday = getdate(mktime(0, 0, 0, 1, 1 - $firstdayofyear["wday"] + 1, $y));
        $calcdate = getdate(mktime(0, 0, 0, $firstmonday["mon"], $firstmonday["mday"] + $days, $firstmonday["year"]));

        $date["year"] = $calcdate["year"];
        $date["month"] = $calcdate["mon"];
        $date["day"] = $calcdate["mday"];

        return ($date);
    }
    public static function diff($start, $end, $differenceFormat = '%a') {
        $datetime1 = date_create($start);
        $datetime2 = date_create($end);

        $interval = date_diff($datetime1, $datetime2);
        return intval($interval->format($differenceFormat));
    }
    public static function date_add($date, $adjust) {
        $dv = explode('-', $date);
        $week = self::weeknumber($dv[0], $dv[1], $dv[2]);
        $newdate = self::fromweek($dv[0], $week, $adjust);
        $newdate['month'] = str_pad($newdate['month'], 2, STR_PAD_LEFT, '0');
        $newdate['day'] = str_pad($newdate['day'], 2, STR_PAD_LEFT, '0');

        return "{$newdate['year']}-{$newdate['month']}-{$newdate['day']}";
    }
    public static function range($start,$end){
        $count = self::diff($start, $end);
        $a = explode('-', $start);
        $w = self::weeknumber($a[0], $a[1], $a[2]);
        $dates = array();
        for($i = -1 ; $i < $count ; $i++){
            $day = self::fromweek($a[0], ($w+1), ($i));
            array_push($dates, "{$day['year']}-{$day['month']}-{$day['day']}");
        } 
        return $dates;
    }

    public static function gen_year($start, $end) {
        $set = array();
        for ($k = $start; $k <= $end; $k++) {
            array_push($set, $k);
        }
        return $set;
    }

    public static function is_leap_year($year) {
        if (($year % 400 == 0) || (($year % 4 == 0) && ($year % 100 != 0))) {
            return true;
        } else {
            return false;
        }
    }

    public static function get_days($month) {
        $days = array();
        $today = new \DateTime();

        if (Dates::is_leap_year($today->format('Y'))) {
            $days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        } else {
            $days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        }
        return $days[$month - 1];
    }

}

abstract class File {
    public static function write($file,$string){
        $files = explode('/', $file);
        $path = '';
        for($i = 0 ; $i < count($files) - 1; $i++){
            $path .= "{$files[$i]}/";
        }
        if (!is_dir($path) && !mkdir($path, 0777,TRUE)){
            return FALSE;
        }
        if(!($handle = fopen($file,'w'))){
            return FALSE;
        }
        fwrite($handle, $string);
        fclose($handle);
        return TRUE;
    }
    public static function read(&$funnel,$file) {
        if (file_exists($file) && ($handle = fopen($file, "r"))) {
            $token = fread($handle, filesize($file));
            fclose($handle);
        } else {
            array_push($funnel['content'], 'file not found');
            return FALSE;
        }
        $funnel = $token;
        return TRUE;
    }
    
    public static function rmdir_r($dir){
        $files = array_diff(scandir($dir), ['.','..']);
        foreach ($files as $file){
            (is_dir("$dir/$file")) ? self::rmdir_r("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    public static function dir_empty($dir){
        $files = array_diff(scandir($dir), ['.','..']);
        if(count($files)>0){            return false;}
        return true;
    }
    
    public static function push_img(&$funnel, $base64,$file,$ajax = true){
        if(empty(trim($base64))){$funnel['content'][] = 'image canvas empty';return false;}
        if(!$ajax){goto img_file;}
        //  return missing '+' signs
        list($type, $base64) = explode(';', $base64);
        list(, $base64) = explode(',', $base64);
        $base64 = str_replace(' ', '+', $base64);
        
        img_file:
        $img = base64_decode($base64);
        
        //  attempt creating image file
        if(file_exists($file) && !unlink($file)){$funnel['content'][] = "failed replacing '$file'";return false;}
        if(!file_put_contents($file, $img)){$funnel['content'][] = 'couldn\' create image file';return false;}
        
        return true;
    }

    public static function upload_file($fileinput, $upload_dir, array $valid_extensions, $filename = null, $maxsize = 5000000) {
        try {
            $imgFile = $_FILES["$fileinput"]['name'];
            $tmp_dir = $_FILES["$fileinput"]['tmp_name'];
            $imgSize = $_FILES["$fileinput"]['size'];
            if (!file_exists("$upload_dir")) {
                if (!mkdir($upload_dir, 0777, true)) {
                    return array("Directory $upload_dir could not be created");
                }
            }
            if ($imgFile) {
                $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
                if ($filename === null) {
                    $filename = rand(1000, 1000000) . "." . $imgExt;
                    while (file_exists($upload_dir . $filename)) {
                        $filename = rand(1000, 1000000) . "." . $imgExt;
                    }
                } else {
                    $filename = $filename . '.' . $imgExt;
                }
                if (in_array($imgExt, $valid_extensions)) {
                    if ($imgSize < $maxsize) {
                        move_uploaded_file($tmp_dir, $upload_dir . $filename);
                    } else {
                        return array("ile Size Exceeds Maximum upload size");
                    }
                } else {
                    $extError = implode(',', $valid_extensions);
                    return array("Only $extError files are allowed");
                }
                return $filename;
            }
        } catch (RuntimeException $ex) {
            return array($ex->getMessage());
        }
    }
    
    public static function modify_ini($file,$field, $value){
        $r_handle = fopen($file,"r");
	$w_handle = fopen("temp.ini","w");
        $complete = false;
	if($r_handle){
            while(($line = fgets($r_handle)) !== false){
                $piece = explode(' = ', $line);
                $output = count($piece) === 2 && $piece[0] === $field ? "{$piece[0]} = $value\r\n" : $line;
                if(!fwrite($w_handle, $output)){return false;}
                }
                $complete = fclose($r_handle) && fclose($w_handle);
                
                unlink($file);
                rename('temp.ini', $file);
                }
        return $complete;
    }
}

abstract class WebTools {

    /**
     * 1. Get Platform (OSX, GNU/Linux, MS)
     * 2. Get Browser
     * 3. Get Browser Version
     * @return array
     */
    public static function get_browser() {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown'; // Browser name
        $platform = 'Unknown';
        $version = "";

        // First get platform
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Get the name of the user agent seperately for a good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Exporer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // Get the correct version numbers
        $known = array('Version', $ub, 'Other');
        $pattern = '#(?<browser>)' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

        /* if (!preg_match_all($pattern, $u_agent, $matches)) {
          // We have no matching number just continue
          } */

        if (!empty($matches)) {
            // See how many we remove
            $i = count($matches['browser']);

            if ($i != 1) {
                // We will have two since we are not using 'other' argument yet
                // See if version is before or after the name
                if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                    $version = $matches['version'][0];
                } else {
                    $version = $matches['version'][1];
                }
            } else {
                $version = $matches['version'][0];
            }
        }
        // Check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }
        return array('userAgent' => $u_agent, 'name' => $bname, 'version' => $version, 'platform' => $platform, 'pattern' => $pattern);
    }
    public static function get_ip(){
        //whether ip is from share internet
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   
          {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
          }
        //whether ip is from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
          {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }
        //whether ip is from remote address
        else
          {
            $ip_address = $_SERVER['REMOTE_ADDR'];
          }
        return $ip_address;
    }
    public static function get_protocol(){
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    }
}
