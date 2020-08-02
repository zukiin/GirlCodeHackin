<?php

require_once dirname(__FILE__, 2) . '/model.php';



if (isset($_POST['province'])) {
  $province = filter_input(INPUT_POST,'province');
  echo json_encode(array('result' => Donor::fetch_cities($province)));
} else {
    echo json_encode(array('success' => 0));
}