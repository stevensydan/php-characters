<?php

require_once('db_fns.php');

function register($userName, $userEmail, $userPass) {
// register new person with db
// return true or error message

  // connect to db
  $conn = db_connect();

  // check if userName is unique
  $result = $conn->query("select * from dnd_users where userName='".$userName."'");
  if (!$result) {
    throw new Exception('Could not execute query');
  }

  if ($result->num_rows>0) {
    throw new Exception('That username is taken - go back and choose another one.');
  }

  // if ok, put in db
  $result = $conn->query("insert into dnd_users values
                         ('".$userName."', sha1('".$userPass."'), '".$userEmail."')");
  if (!$result) {
    throw new Exception('Could not register you in database - please try again later.');
  }

  return true;
}

function login($userName, $userPass) {
// check username and password with db
// if yes, return true
// else throw exception

  // connect to db
  $conn = db_connect();

  // check if username is unique
  $result = $conn->query("select * from dnd_users
                         where userName='".$userName."'
                         and userPass = sha1('".$userPass."')");
  if (!$result) {
     throw new Exception('Could not log you in.');
  }

  if ($result->num_rows>0) {
     return true;
  } else {
     throw new Exception('Could not log you in.');
  }
}

function check_valid_user() {
// see if somebody is logged in and notify them if not
  if (isset($_SESSION['valid_user']))  {
      echo "Logged in as ".$_SESSION['valid_user'].".<br>";
  } else {
     // they are not logged in
     do_html_header('Problem:');
     echo 'You are not logged in.<br>';
     do_html_url('login.php', 'Login');
     do_html_footer();
     exit;
  }
}

?>
