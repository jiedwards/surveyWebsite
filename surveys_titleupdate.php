<?php


require_once "header.php";

$questionid  = "";
$description = "";
$surveyid    = "";
$username    = "";
$answer      = "";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (isset($_GET['id'])) {
    //$surveyid = $_SESSION['id'];
    $surveyid = $_GET['id'];
    
}

if (!$connection) {
    die("Connection failed: " . $mysqli_connect_error);
}

////////Code to update the title and message of the survey begins here //////////////////

// The POST method below obtains the various information from the form which was parsed later in the document by a form, this information is then used to execute a select and an update query below.

if (isset($_POST['surveychange'])) {
    $title    = ($_POST['surveytitle']);
    $message  = ($_POST['surveymessage']);
    $surveyid = $_GET['id'];
}


$query3 = "SELECT title, message, surveyid FROM
    surveys WHERE surveyid = $surveyid;";

$titleupdate = "UPDATE surveys SET title = '$title', message = '$message' WHERE surveyid = $surveyid;";


$result1 = mysqli_query($connection, $query3);
$result2 = mysqli_query($connection, $titleupdate);

$n1 = mysqli_num_rows($result1);
//Echo's out a success message if the queries are executed correctly.
if ($n1) {
    echo "<br><br><br><br><br>";
    echo "<h4>Successfully updated the Survey title/message! Return to My Survey's.</h4>";
} else {
    echo "Failed";
}

for ($i = 0; $i < $n1; $i++) {
    // use the identifier to fetch one row as an associative array (elements named after columns):
    $row     = mysqli_fetch_assoc($result1);
    $title   = $row['title'];
    $message = $row['message'];
    
    
    
    
    
    
}

require_once "footer.php";

?>