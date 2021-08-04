<?php
  require_once('functions.php');
  session_start();

  //create short variable names
  $del_me = $_POST['del_me'];
  $valid_user = $_SESSION['valid_user'];

  do_html_header('Deleting characters');
  check_valid_user();

  if (!filled_out($_POST)) {
    echo '<p>You have not chosen any characters to delete.<br>
          Please try again.</p>';
    display_user_menu();
    do_html_footer();
    exit;
  } else {
    if (count($del_me) > 0) {
      foreach($del_me as $char) {
        if (delete_char($valid_user, $char)) {
          echo 'Deleted '.htmlspecialchars($char).'.<br>';
        } else {
          echo 'Could not delete '.htmlspecialchars($char).'.<br>';
        }
      }
    } else {
      echo 'No character selected for deletion';
    }
  }
  // get the characters this user has saved
  if ($char_array = get_user_chars($valid_user)) {
    display_user_chars($char_array);
  }

  display_user_menu();
  do_html_footer();
?>