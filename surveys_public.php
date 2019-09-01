<?php

// execute the header script:
require_once "header.php";
require_once "credentials.php";

$deletepreviousdata = "";


if (!isset($_SESSION['loggedInSkeleton'])) {
    // user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.<br>";
}

elseif (isset($_GET['orderSurveys1'])) {
    $orderSurveys1 = $_GET['orderSurveys1'];
}

else {
    $orderSurveys1 = "name";
}

//call the function to populate the table
orderSurveys1($dbhost, $dbuser, $dbpass, $dbname, $orderSurveys1);


//////////* Order Surveys Function *///////////
function orderSurveys1($dbhost, $dbuser, $dbpass, $dbname, $field)
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
    $query  = "SELECT surveyid, title, username, created, updated FROM surveys WHERE visible=true";
    // this query can return data ($result is an identifier):
    $result = mysqli_query($connection, $query);
    // how many rows came back?:
    $n      = mysqli_num_rows($result);
    
    /* Delete button to prevent multiple events of the same person taking the survey multiple times and their results 
    being constantly displayed, the information for this is obtained by the form below, when it is submitted and the form is parsed. */ 
    
    if (isset($_POST['responsesdelete'])) {
        $surveyid = $_POST['surveyid'];

        $query3 = "DELETE FROM answers WHERE username='{$_SESSION['username']}' AND surveyid = $surveyid;";
        
        $result2 = mysqli_query($connection, $query3);
        echo $query3;
        
        
        // this query can return data ($result is an identifier):
        $result = mysqli_query($connection, $query);
        // how many rows came back?:
        // this query can return data ($result is an identifier):
        $deletepreviousdata = mysqli_query($connection, $query3);
        // how many rows came back?:
        $n = mysqli_num_rows($result);
        
        echo $deletepreviousdata;
        echo $query2;
    }
    
    
    //format a table and the headers for the table
    
    echo <<<_END
   
    <div class= "container">
    
        <table class="table table-hover">
        <thead>
        <tr>
        <th scope="col">Survey Title</th>
        <th scope="col">Survey Creator</th>
        <th scope="col">Date Updated</th>
        </tr><br>
        <tr>
        </thead>

_END;
    
    
    //The forloop allows surveys to be displayed, the form below also contains all the information which is parsed when the buttons are pressed.
    if ($n > 0) {
        echo "<h4>Results will not work unless a result has been inserted!</h4>";
        
        for ($i = 0; $i < $n; $i++) {
            $row      = mysqli_fetch_assoc($result);
            $surveyid = $row['surveyid'];
            echo <<<_END
               <tr><td><a href="surveys_view.php?id={$row['surveyid']}">{$row['title']}</a></td><td>{$row['username']}</td>
                <td>{$row['updated']}</td>
                <td><a href="surveys_complete.php?id=$surveyid" class="btn btn-success" role="button">Take Survey</a></td>
                
                <td><a href="surveys_sharing.php?id={$row['surveyid']}" value="" class="btn btn-warning" role="button">Share this survey!</a></td>
                
                <td><form action="" method="POST">
                <input type="hidden" name="responsesdelete" value="$surveyid">
                <a href="responses_delete.php?id=$surveyid" class="btn btn-danger" role="button">CLICK HERE to take the survey again!</a></td>
                <td><a href="surveys_results.php?id={$row['surveyid']}" class="btn btn-info" role="button">Results</a></td>
                </form></tr>

        

_END;
            
            
        }
        // complete formatting, end of the table
        echo "</table>";
        
        echo <<<_END
       <table>
    
    <td>

        </table>
      
_END;
        
    }
    
    
    else {
        echo "No information found in users table";
    }
    // we're finished with the database, close the connection:
    mysqli_close($connection);
}



// finish off the HTML for this page:
require_once "footer.php";

?>