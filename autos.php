<?php
// Use pdo.php, assignment requirement
require_once "pdo.php";

$failure = false;
$success = false;

//Testing for trying to get into autos.php without login - assignment requirement
if (!isset($_GET['name']))
{
    die("Name parameter missing");
}

//Test logging out and get redirect to index.php
elseif (isset($_POST['logout']) && $_POST['logout'] == 'Logout')
{
    header('Location: index.php');
}

//Input Validation on mileage and year, message if is_numeric fails - assignment requirement

elseif (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']))
    {
    if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage']))
        {
          $failure = 'Mileage and year must be numeric';
        }
//Input validation on make (less than 1 character) - assignment requirement
    elseif (strlen($_POST['make']) < 1 )
        {
          $failure = 'Make is required';
        }
//Validation has passed, inserting makem year and mileage into the database - assignment requirement
    else
        {
        $stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage) VALUES ( :make, :year, :mileage)');
        $stmt->execute(array(
                ':make' => $_POST['make'],
                ':year' => $_POST['year'],
                ':mileage' => $_POST['mileage'])
        );
//Successfull Insert - assignment requirement
        $success = 'Record inserted';
        }
      }

        $stmt = $pdo->query("SELECT make, year, mileage FROM autos order by make asc");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once "bootstrap.php"; ?>
    <title>Autos DB - Adam Hosa</title>
</head>
<body>
<div class="container">
    <h1>Tracking Autos for <?php echo $_GET['name']; ?></h1>
    <?php
    if ($failure !== false) {
        // Look closely at the use of single and double quotes
        echo('<p style="color: red;">' . htmlentities($failure) . "</p>\n");
    }
    if ($success !== true) {
        // Look closely at the use of single and double quotes
        echo('<p style="color: green;">' . htmlentities($success) . "</p>\n");
    }
    ?>
    <form method="post">
        <p>Make:
            <input type="text" name="make" size="60"/></p>
        <p>Year:
            <input type="text" name="year"/></p>
        <p>Mileage:
            <input type="text" name="mileage"/></p>

        <input type="submit" value="Add">
        <input type="submit" name="logout" value="Logout">
    </form>

    <h2>Automobiles</h2>
    <ul>

        <?php
        foreach ($rows as $row) {
            echo '<li>';
            echo htmlentities($row['make']) . ' ' . $row['year'] . ' / ' . $row['mileage'];
        };
        echo '</li><br/>';
        ?>
    </ul>
</div>
</body>
