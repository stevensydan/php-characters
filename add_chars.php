<?php
 require_once('functions.php');
 session_start();

  //create short variable name
  $new_char_name = $_POST['new_char_name'];
  $new_char_lvl = $_POST['new_char_lvl'];
  $new_char_class = $_POST['new_char_class'];
  $new_char_race = $_POST['new_char_race'];
  $new_char_quest = $_POST['new_char_quest'];
  $new_char_img = $_FILES['new_char_img']['name'];

  do_html_header('Create a Character');
  try {
    // UPLOAD FILE
    if(move_uploaded_file($_FILES["new_char_img"]["tmp_name"],"uploads/".$_FILES["new_char_img"]["name"]))
    {
      //echo "Image upload success!<br>";
    }
    else { throw new Exception('Image upload failed...'); }

    check_valid_user();
    if (!filled_out($_POST)) {
      throw new Exception('Form not completely filled out.');
    }

    // try to add char
    add_char($new_char_name, $new_char_lvl, $new_char_class, $new_char_race, $new_char_quest, $new_char_img);
    echo 'Character added to profile.';

    // get the bookmarks this user has saved
    if ($char_array = get_user_chars($_SESSION['valid_user'])) {
      display_user_chars($char_array);
    }
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }
  display_user_menu();
  do_html_footer();
?>
