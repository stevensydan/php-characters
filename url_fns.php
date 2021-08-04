<?php
require_once('db_fns.php');

function get_user_chars($username) {
  //extract from the database all the characters this user has stored

  $conn = db_connect();
  $query = "select * from dnd_chars where userName = '".$username."'";

  $result = @$conn->query($query);
  if (!$result) {
    return false;
  }
  $num_users = @$result->num_rows;
  if ($num_users == 0) {
    return false;
  }
  $result = db_result_to_array($result);
  return $result;
}

function add_char($new_char_name, $new_char_lvl, $new_char_class, $new_char_race, $new_char_quest, $new_char_img) {
  // Add new character to the database

  echo "Attempting to add ".htmlspecialchars($new_char_name)."<br />";
  $valid_user = $_SESSION['valid_user'];

  $conn = db_connect();

  // check not a repeat character name
  $result = $conn->query("select * from dnd_chars
                         where userName='$valid_user'
                         and charName='".$new_char_name."'");
  if ($result && ($result->num_rows>0)) {
    throw new Exception('Character name already exists.');
  }

  // check not a repeat character avatar name
  $result = $conn->query("select * from dnd_chars
                         where charArt='".$new_char_img."'");
  if ($result && ($result->num_rows>0)) {
    throw new Exception('File name already exists. Please rename file.');
  }

  // insert the new character
  if (!$conn->query("insert into dnd_chars values
     ('".$valid_user."', '".$new_char_name."', '".$new_char_lvl."', '".$new_char_class."', '".$new_char_race."', '".$new_char_quest."', '".$new_char_img."')")) {
    throw new Exception('Character could not be inserted.');
  }

  return true;
}

function delete_char($user, $char) {
  // delete one character from the database
  $conn = db_connect();

  // delete the character
  if (!$conn->query("delete from dnd_chars where
                     userName='".$user."' 
                    and charName='".$char."'")) {
     throw new Exception('Character could not be deleted');
  }
  return true;
}

function get_users($charid) {
 
    $conn = db_connect();
    $query = "select * from dnd_chars";
    $result = @$conn->query($query);
    if (!$result) {
      return false;
    }
    $num_chars = @$result->num_rows;
    if ($num_chars == 0) {
       return false;
    }
    $result = db_result_to_array($result);
    return $result;
}

?>