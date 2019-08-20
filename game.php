<?php

// Demand a GET parameter
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}

// Set up the values for the game...
// 0 is Rock, 1 is Paper, and 2 is Scissors
$names = array('Rock', 'Paper', 'Scissors');
$human = isset($_POST["human"]) ? $_POST['human']+0 : -1;

//$computer = 0; // Hard code the computer to rock
// TODO: Make the computer be random
$computer = rand(0,2);

// This function takes as its input the computer and human play
// and returns "Tie", "You Lose", "You Win" depending on play
// where "You" is the human being addressed by the computer
function check($computer, $human) {
    // Would like to make this a simpler
    if (( $human == 0 ) && ( $computer == 0)) {
        return "Tie";

    } else if (( $human == 1 ) && ( $computer == 1)) {
      return "Tie";

    } else if (( $human == 2 ) && ( $computer == 2)) {
      return "Tie";

    } else if (( $human == 0 ) && ( $computer == 1)) {
      return "You Lose"; //2

    } else if (( $human == 1 ) && ( $computer == 2)) {
      return "You Lose"; //2

    } else if (( $human == 2 ) && ( $computer == 0)) {
      return "You Lose"; //2

    } else if (( $human == 0 ) && ( $computer == 2)) {
      return "You Win"; //1

    } else if (( $human == 1 ) && ( $computer == 0)) {
      return "You Win"; //1

    } else if (( $human == 2 ) && ( $computer == 1)) {
      return "You Win"; //1
    }
    return false;
}

//Working on this function, for some reason
//Human rock computer scissors is a loss.
//theres a value of -2%3 that comes back as -2 when it should be 1
function check2($computer, $human) {

  if ($human == $computer) {
      return "Tie";

    } elseif (($human - $computer)%3 == 1) {
      return "Win";

    } elseif (($human - $computer)%3 != 1) {
      return "Loss";
    }

    return false;
}

// Check to see how the play happened
$result = check($computer, $human);

?>
<!DOCTYPE html>
<html>
<head>
<title>Rock, Paper, Scissors Game - Adam Hosa b8002139  </title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
<h1>Rock Paper Scissors</h1>
<?php
if ( isset($_REQUEST['name']) ) {
    echo "<p>Welcome: ";
    echo htmlentities($_REQUEST['name']);
    echo "</p>\n";
}
?>
<form method="post">
<select name="human">
<option value="-1">Select</option>
<option value="0">Rock</option>
<option value="1">Paper</option>
<option value="2">Scissors</option>
<option value="3">Test</option>
</select>
<input type="submit" value="Play">
<input type="submit" name="logout" value="Logout">
</form>

<pre>
<?php
if ( $human == -1 ) {
    print "Please select a strategy and press Play.\n";
} else if ( $human == 3 ) {
    for($c=0;$c<3;$c++) {
        for($h=0;$h<3;$h++) {
            $r = check($c, $h);
            print "Human=$names[$h] Computer=$names[$c] Result=$r\n";
        }
    }
} else {
    print "Your Play=$names[$human] Computer Play=$names[$computer] Result=$result\n";
}
?>
</pre>
</div>
</body>
</html>
