<?php // Do not put any HTML above this line

if ( isset($_POST['logout'] ) )
{
    // Redirect the browser to autos.php
    header("Location: index.php");
    return;
}

//salt and hash from previous assignment
$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123
$md5 = hash('md5', 'XyZzy12*_php123');
$failure = false;  // If we have no POST data

// Check to see if we have some POST data, if we do process it

if (isset($_POST['cancel']) && $_POST['cancel'] == 'cancel')
{
    header('Location: index.php');
}

if (isset($_POST['who']) && isset($_POST['pass']) )
{
    if (strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1 )
    {
        //Error checking on blank email and pass, assignment requirement
        $failure = "Email and password are required";
    }
    else
    {
      //use htmlentities, assignment requirement:
      $pass = htmlentities($_POST['pass']);
      $email = htmlentities($_POST['who']);
      $check = hash('md5', $salt.$pass);

      //check for @ symbol in email address, assignment requirement
      if ((strpos($email, '@') === false))
        {
            $failure = "Email must have an at-sign (@)";
        }
        else
            //$check = hash('md5', $salt.$pass);
            if ($check == $stored_hash)
            {
              //Redirect to autos.php on match and login success, assignment requirement
              //Log the success, assignment requirement
              error_log("Login success ".$email);
              header("Location: autos.php?name=".urlencode($email));
              return;
            }
             //Log the failiure, assignment requirement
            else
            {
                error_log("Login fail ".$pass." $check");
                $failure = "Incorrect password";
            }
        }
    }


// Fall through into the View
?>




<!DOCTYPE html>
<html>
    <head>
      <?php require_once "bootstrap.php"; ?>
      <title>Autos Login - Adam Hosa</title>
    </head>
    <body>
        <div class="container">
            <h1>Please Log In</h1>
            <?php

            if ( $failure !== false )
            {
                // Look closely at the use of single and double quotes
                echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
            }
?>

<form method="POST">
  <label for="nam">Email Address</label>
    <input type="text" name="who" id="nam"><br/>
  <label for="id_1723">Password</label>
    <input type="text" name="pass" id="id_1723"><br/>

<input type="submit" value="Log In">
<input type="submit" name="cancel" value="Cancel">

</form>
<p>
For a password hint, view source and find a password hint
in the HTML comments.
<!-- Hint: The password is the 3 letters of this programming  (all lower case) followed by 123. -->
</p>
</div>
</body>
