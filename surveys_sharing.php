<?php


require_once "header.php";

$answer   = "";
$pairid   = "";
$username = "";
$surveyid = "";


// connect directly to our database (notice 4th argument):
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (isset($_GET['id'])) {
    //$surveyid = $_SESSION['id'];
    $surveyid = $_GET['id'];
    
    // connect directly to our database (notice 4th argument):
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    // connection failed, return an error message
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
    //Echo's out the message which is actually displayed on the page, also obtains the survey ID which is necessary for the link which is shared.
    echo <<<_END
   
    <h4>Your shareable personalised link for survey $surveyid is: </h4><br>
    <td><input size="75" type="text" name="surveytitle" value="http://localhost:8080/skeleton/surveys_complete.php?id=$surveyid"></td><br>
  </tr><br>
    <h4>Copy and paste it!</h4>
    
_END;
      
    // we're finished with the database, close the connection:
    mysqli_close($connection);
    
    // if we got some results then add them all into a big array:  
}

// finish of the HTML for this page:
require_once "footer.php";

?>