<?php
// include function files for this application
require_once('functions.php');
session_start();

if (!isset($_SESSION['valid_user']))  { 
  //create short variable names
  if (!isset($_POST['userName']))  {
    //if not isset -> set with dummy value 
    $_POST['userName'] = " "; 
  }
  $userName = $_POST['userName'];
  if (!isset($_POST['passwd']))  {
    //if not isset -> set with dummy value 
    $_POST['passwd'] = " "; 
  }
  $passwd = $_POST['passwd'];

  if ($userName && $passwd) {
  // they have just tried logging in
    try  {
      login($userName, $passwd);
      // if they are in the database register the user id
      $_SESSION['valid_user'] = $userName;
    }
    catch(Exception $e)  {
      // unsuccessful login
      do_html_header('Problem:');
      echo 'You could not be logged in.<br>
            You must be logged in to view this page.';
      do_html_url('login.php', 'Login');
      do_html_footer();
      exit;
    }
  }
}

do_html_header('Your Characters');
check_valid_user();

// get the characters this user has saved
if ($char_array = get_user_chars($_SESSION['valid_user'])) {
  display_user_chars($char_array);
}
// give menu of options
display_user_menu();

do_html_footer();
?>
