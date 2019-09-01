<?php

// Things to notice:
// This is the page where each user can MANAGE their surveys


// execute the header script:
require_once "header.php";
require_once "credentials.php";



if (!isset($_SESSION['loggedInSkeleton'])) {
    // user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.<br>";
}

// gets information from the function below and stores a value into a variable which will be used later in the webpage
elseif (isset($_GET['orderSurveys'])) {
    $orderSurveys = $_GET['orderSurveys'];
} else {
    $orderSurveys = "name";
}

//call the function declared above
orderSurveys($dbhost, $dbuser, $dbpass, $dbname, $orderSurveys);

// The POST method obtains the survey ID from the form which was parsed below, this information is then used to execute a delete query
if (isset($_POST['surveydelete1'])) {
    $surveyid = ($_POST['surveydelete1']);
    
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $query2      = "DELETE from questions WHERE surveyid = '$surveyid';";
    $query1     = "DELETE from answers WHERE surveyid = '$surveyid';";
    $query      = "DELETE from surveys WHERE surveyid = '$surveyid';";
    $result2     = mysqli_query($connection, $query2);
    $result     = mysqli_query($connection, $query);
    $result1    = mysqli_query($connection, $query1);
    
    echo $query;
        echo $query1;
    
    if ($result1) {
            $result     = mysqli_query($connection, $query);

        echo "<h2>Successfully deleted, refresh the page!</h2>";
    } else {
        echo "<h2>Failed to delete</h2>";
    }
    
    
    
    // if the connection fails, we need to know, so allow this exit:
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
}




/////////// Order Surveys Function ////////////
function orderSurveys($dbhost, $dbuser, $dbpass, $dbname, $field)
{
    
    // connect to the host:
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    // exit the script with a useful message if there was an error:
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
    
    if (isset($_GET['username'])) {
        $username = $_GET['username'];
        echo $username;
    } else {
        $username = $_SESSION["username"];
        
    }
    
    // connect to our database:
    mysqli_select_db($connection, $dbname);
    // run query to obtain the information from the surveys table
    $query  = "SELECT surveyid, title, username, created, updated, visible FROM surveys WHERE username='$username'";
    // this query can return data ($result is an identifier):
    $result = mysqli_query($connection, $query);
    // how many rows came back?:
    $n = mysqli_num_rows($result);
    
    //produce a table and a layout
    
    echo <<<_END
  
    <div class= "container">
    
        <table class="table table-hover">
        <thead>
        <tr>
        <th scope="col">Survey Title</th>
        <th scope="col">Survey Creator</th>
        <th scope="col">Date Updated</th>
        <th scope="col">Public?</th>

        </tr><br>
        <tr>
        </thead>

_END;
    
    
            echo "<h4>Results will not work unless a result has been inserted!</h4>";

    if ($n > 0) {

        for ($i = 0; $i < $n; $i++) {
            $row = mysqli_fetch_assoc($result);
            echo <<<_END
              <tr><td><a href="surveys_view.php?id={$row['surveyid']}">{$row['title']}</a></td>
                <td>{$row['username']}</td>
                <td>{$row['updated']}</td>              
_END;
            
            $p = $row['visible'];
            
            
            if ($p > 0) {
                echo "<td>Yes</td>";
            } else {
                echo "<td>No</td>";
            }
            
            // The form below displays buttons in the table which facilitate the functionality for showing results, deleting surveys, sharing surveys etc. The information is parsed when each button is pressed and the function occurs.
            echo <<<_END
              
                <td><a href="surveys_edit.php?id={$row['surveyid']}" class="btn btn-warning" role="button">Edit</a></td>
                <td><a href="surveys_results.php?id={$row['surveyid']}" class="btn btn-info" role="button">Results</a></td>
                <td><a href="surveys_sharing.php?id={$row['surveyid']}" class="btn btn-success" role="button">Share this survey!</a></td>
                <td><form action="" method="POST">
                <input type="hidden" name="surveydelete1" value="{$row['surveyid']}">
                <button type="submit" class="btn btn-danger">Delete</button>
                </form></td>
                
_END;
            
            
            
        }
        
        // The button below takes the user to a different webpage where they can add a survey.

        
        echo <<<_END
      <table>
    
    <td>
    <tr><a class="btn btn-success" href="surveys_new.php" role="button">Add a new survey</a></tr></td>

        </table>
      
_END;
        
    }
    else {
        echo "";
        
        echo <<<_END
      <table>
    No information found in users table<br>
    <td>
    <tr><a class="btn btn-success" href="surveys_new.php" role="button">Add a new survey</a></tr></td>

        </table>
        </div>
      
_END;
    }
    // we're finished with the database, close the connection:
    mysqli_close($connection);
}

// a little extra text that only the admin will see!:
if ($_SESSION['username'] == "admin") {
    echo "<h3>For access to all Survey's, navigate through the admin tools.</h3>";
}



// finish off the HTML for this page:
require_once "footer.php";

?>