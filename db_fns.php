<?php

function db_connect() {
   $result = new mysqli('mariadb', 'cs431s45', 'IuWaeX4w', 'cs431s45');
   if (!$result) {
     throw new Exception('Could not connect to database server');
   } else {
     return $result;
   }
}

function db_result_to_array($result) {
  $res_array = array();

  for ($count=0; $row = $result->fetch_assoc(); $count++) {
    $res_array[$count] = $row;
  }
  return $res_array;
}

?>
