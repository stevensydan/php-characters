<?php
  // include function files for this application
  require_once('functions.php');

  //create short variable names
  $email=$_POST['email'];
  $userName=$_POST['userName'];
  $passwd=$_POST['passwd'];
  $passwd2=$_POST['passwd2'];
  // start session which may be needed later
  // start it now because it must go before headers
  session_start();
  try   {
    // check forms filled in

    if (!filled_out($_POST)) {
      throw new Exception('You have not filled the form out correctly - please go back and try again.');
    }

    // email address not valid
    if (!valid_email($email)) {
      throw new Exception('That is not a valid email address.  Please go back and try again.');
    }

    // check not a repeat email
    $conn = db_connect();
    $result = $conn->query("select * from dnd_users where userEmail='".$email."'");
    if ($result && ($result->num_rows>0)) {
      throw new Exception('Account with email address already exists. Please use a new email.');
    }

    // passwords not the same
    if ($passwd != $passwd2) {
      throw new Exception('The passwords you entered do not match - please go back and try again.');
    }

    // check password length is ok
    // ok if username truncates, but passwords will get
    // munged if they are too long.
    if ((strlen($passwd) < 6) || (strlen($passwd) > 16)) {
      throw new Exception('Your password must be between 6 and 16 characters. Please go back and try again.');
    }

    // attempt to register
    // this function can also throw an exception
    register($userName, $email, $passwd);
    // register session variable
    $_SESSION['valid_user'] = $userName;

    // provide link to members page
    do_html_header('Registration successful');    
    echo 'Your registration was successful.  Go to the homepage to start adding your characters and check your email!';
    //do_html_url('member.php', 'Go to members page');
    $verify_email = htmlspecialchars('https://formsubmit.co/'.htmlspecialchars($email));
    
   // end page
   do_html_footer();
  }
  catch (Exception $e) {
     do_html_header('Problem:');
     echo $e->getMessage();
     do_html_URL('login.php', 'Login');
     do_html_footer();
     exit;
  }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> Contact Form </title>
</head>

<body>
    <form action="https://formsubmit.co/stevensydan@gmail.com" method="POST">
        <section>
            <div class="panel panel-default">   

                <!-- Sends email to user -->
                <input type="hidden" name="email" value=<?php echo htmlspecialchars($email);?> />

                <input type="hidden" name="_replyto" placeholder=<?php echo htmlspecialchars($email);?>>

                <input type="hidden" name="_subject" value="User Registration Successful!">  

                <div class="form-group">
                    <input type="hidden" name="Username" value=<?php echo htmlspecialchars($userName);?> />
                </div>
                
                <input type="hidden" name="_next" value="http://ecs.fullerton.edu/~cs431s45/project/member.php">
                
                <input type="hidden" name="_autoresponse" value="Your user has been created and password encrypted! http://ecs.fullerton.edu/~cs431s45/project/login.php">
                
                <button type="submit"> Confirm </button> 
                </div>
                </section>
            </form>
</body>
</html>