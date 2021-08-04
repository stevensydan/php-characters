<?php

function do_html_header($title) {
  // print an HTML header
?>
<!doctype html>
  <html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
    <style>
      body { font-family: Arial, Helvetica, sans-serif; font-size: 16px; background-color: #1C242D; color: white }
      li, td { font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: white }
      hr { color: #07C97B }
      a { color: white }
      div.formblock
         { background: #242F39; width: 300px; padding: 6px; border: 1px solid #fff;}
      div.formblock_char
         { background: #242F39; width: 500px; padding: 6px; border: 1px solid #fff;}
    </style>
  </head>
  <body>
  <div>
      <h1>D&D Character List</h1>
  </div>
  <hr />
<?php
  if($title) {
    do_html_heading($title);
  }
}

function do_html_footer() {
  // print an HTML footer
?>
  </body>
  </html>
<?php
}

function do_html_heading($heading) {
  // print heading
?>
  <link rel="stylesheet" href = "style.css">
  <h2><?php echo $heading;?></h2>
<?php
}

function do_html_URL($url, $name) {
  // output URL as link and br
?>
  <br><a href="<?php echo $url;?>"><?php echo $name;?></a><br>
<?php
}

function display_site_info() {
  // display some website info
?>
  <ul>
  <li>Create one account for all of your Characters. Do not create more than one account per person.</li>
  <li>Once you are logged in, you can add your Characters or delete your existing ones.</li>
  <li>Your Characters will be displayed to all other users!</li>
  </ul>
<?php
}

function display_login_form() {
?>
  <p><a href="register_form.php">Not a member?</a></p>
  <form method="post" action="member.php">

  <div class="formblock">
    <h2>Members Log In Here</h2>

    <p><label for="userName">Username:</label><br/>
    <input type="text" name="userName" id="userName" /></p>

    <p><label for="passwd">Password:</label><br/>
    <input type="password" name="passwd" id="passwd" /></p>

    <button type="submit">Log In</button>
  </div>

 </form>
<?php
}

function display_registration_form() {
?>
  <form method="post" action="register_new.php">

 <div class="formblock">
    <h2>Register Now</h2>

    <p><label for="email">Email Address:</label><br/>
    <input type="email" name="email" id="email" 
      size="30" maxlength="100" required /></p>

    <p><label for="userName">Preferred Username <br>(max 16 chars):</label><br/>
    <input type="text" name="userName" id="userName" 
      size="16" maxlength="16" required /></p>

    <p><label for="passwd">Password <br>(between 6 and 16 chars):</label><br/>
    <input type="password" name="passwd" id="passwd" 
      size="16" maxlength="16" required /></p>

    <p><label for="passwd2">Confirm Password:</label><br/>
    <input type="password" name="passwd2" id="passwd2" 
      size="16" maxlength="16" required /></p>


    <button type="submit">Register</button>

   </div>

  </form>
<?php

}

function display_user_chars($char_array) {
  // display the table of characters

  // set global variable, so we can test later if this is on the page
  global $char_table;
  $char_table = true;
?>
  <br>
  <form name="char_table" action="delete_chars.php" method="post">
  <table>
  <tr><td class="title"><h2>Avatar</h2></td>
  <td class="title"><h2>Name</h2></td>
  <td class="title"><h2>Level</h2></td>
  <td class="title"><h2>Class</h2></td>
  <td class="title"><h2>Race</h2></td>
  <td class="title"><h2>Quests Complete</h2></td>
  <td class="title"><h2 style="color:white;"><a href="#" onClick="char_table.submit();">Delete?</a></h2></td></tr>
  <?php
  $color = "#242F39";
  if ((is_array($char_array)) && (count($char_array) > 0)) {
    foreach ($char_array as $char)  {
      //remember to call htmlspecialchars() when we are displaying user data
      echo '<tr bgcolor='.$color.'>
            <td><img src="uploads/'.$char['charArt'].'"></td>
            <td><strong>'.htmlspecialchars($char['charName']).'</strong></td>
            <td><strong>'.htmlspecialchars($char['charLevel']).'</strong></td>
            <td><strong>'.htmlspecialchars($char['charClass']).'</strong></td>
            <td><strong>'.htmlspecialchars($char['charRace']).'</strong></td>
            <td><strong>'.htmlspecialchars($char['charQuests']).'</strong></td>
            <td><input type="checkbox" name="del_me[]" value='.$char['charName'].'></td>
            </tr>';
    }
  } else {
    echo "<tr><td>No characters on record</td></tr>";
  }
?>
  </table>
  </form>
<?php
}

function display_user_menu() {
  // display the menu options on this page
?>
<hr>
<a href="leaderboard.php">Leaderboard</a> &nbsp;|&nbsp;
<a href="member.php">Your Characters</a> &nbsp;|&nbsp;
<a href="add_char_form.php">Add Character</a> &nbsp;|&nbsp;
<a href="logout.php">Logout</a>
<hr>

<?php
}

function display_leaderboard($user_array) {
  // display the table of all characters

  //display all characters in the array passed in
  if (!is_array($user_array)) {
    echo "<p>No characters currently available in this leaderboard</p>";
  } else {
    //create table
    echo "<table>";
    echo '<tr class="title"><td class="title"><h2>Avatar</h2></td>';
    echo '<td class="title"><h2>Name</h2></td>';
    echo '<td class="title"><h2>Level</h2></td>';
    echo '<td class="title"><h2>Class</h2></td>';
    echo '<td class="title"><h2>Race</h2></td>';
    echo '<td class="title"><h2>Quests Complete</h2></td>';
    echo '<td class="title"><h2>Player</h2></td></tr>';

    //create a table row for each character
    foreach ($user_array as $row) {
      echo "<tr><td>";
      //do_html_heading(htmlspecialchars($row['charArt']));
      echo '<img src="uploads/'.$row['charArt'].'">';
      echo "</td>";

      echo "<td><strong>";
      echo htmlspecialchars($row['charName']);
      echo "</strong></td>";

      echo '<td><strong>';
      echo htmlspecialchars($row['charLevel']);
      echo "</strong></td>";

      echo "<td><strong>";
      echo htmlspecialchars($row['charClass']);
      echo "</strong></td>";

      echo "<td><strong>";
      echo htmlspecialchars($row['charRace']);
      echo "</strong></td>";

      echo '<td><strong>';
      echo htmlspecialchars($row['charQuests']);
      echo "</strong></td>";

      echo "<td><strong>";
      echo htmlspecialchars($row['userName']);
      echo "</strong></td></tr>";
    }

    echo "</table>";
  }

  echo "<hr />";
?>

<?php
}

function display_add_char_form() {
  // display the form for people to enter a new character
?>
<form name="char_table" action="add_chars.php" method="post" enctype="multipart/form-data">

 <div class="formblock_char">
    <h2>New Character</h2>

    <p><ol>
    <!--1. Character Name input-->
    <li>Name</li>
    <input type="text" name="new_char_name" id="new_char_name" 
      size="40"  maxlength="255"/>

    <!--2. Character Level input-->
    <li>Level</li>
    <input type="number" name="new_char_lvl" id="new_char_lvl" 
      min="1"  max="20"/>

    <!--3. Character Class input-->
    <li>Class</li>
    <input type="text" name="new_char_class" id="new_char_class" 
      size="40"  maxlength="255"/>

    <!--4. Character Race input-->
    <li>Race</li>
    <input type="text" name="new_char_race" id="new_char_race" 
      size="40"  maxlength="255"/>

    <!--5. Character Quest Count input-->
    <li>Quest Count</li>
    <input type="number" name="new_char_quest" id="new_char_quest" 
      min="1"/>

    <!--6. Character Avatar input-->
    <li>Image</li>
    <input type="file" name="new_char_img" id="new_char_img"/>

    <button type="submit">Add Character</button>
  </ol></p>
   </div>

</form>
<?php
}

?>