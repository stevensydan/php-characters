<?php
// include function files for this application
require_once('functions.php');
session_start();

// start output html
do_html_header('Character Creation');

check_valid_user();
display_add_char_form();

display_user_menu();
do_html_footer();

?>
