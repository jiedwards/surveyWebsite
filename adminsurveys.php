<?php

require_once "header.php";

$orderSurveys = "username";

$displaySurveys = true;

if ($_SESSION['username'] == "admin") {
    
    if (isset($_GET['orderSurveys'])) {
        $orderSurveys = $_GET['orderSurveys'];
    } else if (isset($_GET['action']) && (isset($_GET['id']))) {
        
        if ($_GET['action'] == "delete") {
            deleteSurveys($dbhost, $dbuser, $dbpass, $dbname, $_GET['id']);
            $displaySurveys = true;
        }
        
    }
    if ($orderSurveys) {
        orderSurveys($dbhost, $dbuser, $dbpass, $dbname, $orderSurveys);
    }
    
}

else {
    echo "For admin's viewing only.";
}



/////////////* Below is the function to sort the surveys and display them on the page*////////////
function orderSurveys($dbhost, $dbuser, $dbpass, $dbname, $field)
{
    
    // connect to the host:
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    // exit the script with a useful message if there was an error:
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
    
    // connect to our database:
    mysqli_select_db($connection, $dbname);
    // run query to get the contents of the surveys table
    $selectquery  = "SELECT * FROM surveys ORDER BY $field";
    // this query can return data ($selectresult is an identifier):
    $selectresult = mysqli_query($connection, $selectquery);
    // how many rows came back?:
    $n            = mysqli_num_rows($selectresult);
    
    echo <<<_END
   
    <div class= "container">
    
        <table class="table table-hover">
        <thead>
        <tr>
        <th scope="col">Survey ID</th>
        <th scope="col">Survey Creator</th>
        <th scope="col">Survey Name</th>
        <th scope="col">Public?</th>
        <th scope="col">Last Updated</th>

        </tr><br>
        <tr>
        </thead>

_END;
    
    
    
    
    if ($n > 0) {
        
        for ($i = 0; $i < $n; $i++) {
            $row = mysqli_fetch_assoc($selectresult);
            
            echo <<<_END
               <tr><td>{$row['surveyid']}</td><td>{$row['username']}</td><td>{$row['title']}</td>
_END;
            
            $vis = $row['visible'];
            
            //Code below displays the boolean value of whether survey is publically available or not. In the database, the value is stored as 0 = No it is not available, or 1 as being available. Using a simple if/else statement allows for the information to be retrieved and displayed differently.
            if ($vis > 0) {
                echo "<td>Yes</td>";
            } else {
                echo "<td>No</td>";
            }
            //Displays the surveys on the webpage and contains the functionality for the buttons displayed.
            echo <<<_END
               
                <td>{$row['updated']}</td>
                <td><a href="surveys_edit.php?id={$row['surveyid']}" class="btn btn-warning" role="button">Edit</a> <td>
                <td><a href="surveys_results.php?id={$row['surveyid']}" class="btn btn-info" role="button">Results</a></td>
                <td><a href="surveys_sharing.php?id={$row['surveyid']}" class="btn btn-success" role="button">Share this survey!</a></td>
                <td> <a href="adminsurveys.php?action=delete&id={$row['surveyid']}" class="btn btn-danger" role="button">Delete</a></td></tr>
           
                
_END;
            
            
        }
        //Button to add a new survey
        echo <<<_END
               
                <a href="surveys_new.php" class="btn btn-success" role="button">Add New Survey</a> </tr><br>           
_END;
        
        
        
    }
    
    else {
        echo "Failed to locate the information requested";
    }
    // we're finished with the database, close the connection:
    mysqli_close($connection);
}


/* Delete Surveys functionality, when the button to delete a survey is clicked, it executes this function and deletes in the appropriate order. */

function deleteSurveys($dbhost, $dbuser, $dbpass, $dbname, $field)
{
    
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
    
    mysqli_select_db($connection, $dbname);
    //Query to delete the specified information from the answers database
    $query2      = "DELETE from questions WHERE surveyid = '$field';";
    
    $result2     = mysqli_query($connection, $query2);
    
    $deletequery  = "DELETE FROM answers WHERE surveyid='$field'";
    $deleteresult = mysqli_query($connection, $deletequery);
    if ($deleteresult) {
        echo "Successfully deleted ";
    } else {
        echo "Failed ";
    }
    //Query to delete the specified information from the surveys database
    $deletequery2  = "DELETE FROM surveys WHERE surveyid='$field'";
    $deleteresult2 = mysqli_query($connection, $deletequery2);
    if ($deleteresult2) {
        echo "deleted the survey!";
    } else {
        echo "to delete the survey!";
    }
    mysqli_close($connection);
}


// we're finished with the database, close the connection:




// finish of the HTML for this page:
require_once "footer.php";

?>