<?php


// execute the header script:
require_once "header.php";

$first_name = "";
$last_name  = "";
$email      = "";


if (!isset($_SESSION['loggedInSkeleton'])) {
    // user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.<br>";
} elseif ($_SESSION['username'] == "admin") {
    //if username = admin then the information below is displayed.
    echo <<<_END
    <div class="container">

        <table>
    
    <td>
    <tr><a class="btn btn-primary btn-lg btn-block" href="adminusers.php" role="button">Users</a></tr></td>
    <br>
    <td><tr><a class="btn btn-warning btn-lg btn-block" href="adminsurveys.php" role="button">Surveys</a></tr></td>
    <br>

        </table>
        </div>
      
_END;
    
    echo "Implement the admin tools here... See the assignment specification for more details.<br>";
    
} else {
    echo "You don't have permission to view this page...<br>";
}


// finish off the HTML for this page:
require_once "footer.php";
?>