<?php


require_once "header.php";

$answer   = "";
$pairid   = "";
$username = "";
$surveyid = "";


// connect directly to our database (notice 4th argument):
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//Survey id is obtained by the URL in order to view the information a specific survey.
if (isset($_GET['id'])) {
    //$surveyid = $_SESSION['id'];
    $surveyid = $_GET['id'];
    
    // connect directly to our database (notice 4th argument):
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    // connection failed, return an error message
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
    
    // Queries both select the specific information necessary in order the survey questions to be displayed on the screen.
    
    $query = "SELECT questionid, answer, pairid, username FROM answers WHERE surveyid = $surveyid";
    
    $query1  = "SELECT * FROM questions where surveyid = $surveyid;";
    // this query can return data ($result is an identifier):
    $result  = mysqli_query($connection, $query);
    $result1 = mysqli_query($connection, $query1);
    
    // how many rows came back?:
    $n  = mysqli_num_rows($result);
    $n1 = mysqli_num_rows($result1);
    
    if ($n1) {
        echo "<br><h4>You are currently looking at survey number: $surveyid</h4>";
        // loop over all rows, adding them into our array:
        for ($i = 0; $i < $n1; $i++) {
            // use the identifier to fetch one row as an associative array (elements named after columns):
            $row          = mysqli_fetch_assoc($result1);
            $questiontype = $row['questiontype'];
            $description  = $row['description'];
            $questionid   = $row['questionid'];
                    
         //The HTML code below displays the surveys on the screen via a forloop, echoing each question as long as the forloop lasts.
            echo <<<_END
       <table>
        <tr>

    <form action="surveys_view.php?questionid=$questionid" method="post"><br>
  Question ID: {$row['questionid']}<br>
  Question Type: {$row['questiontype']}<br>
  Question: {$row['description']}<br>
  
</form>    
        </tr>
        </table>       
      
_END;
                    
        }
        
    } else {
        echo "Empty";
    }   
    // we're finished with the database, close the connection:
    mysqli_close($connection);   
}
// we're finished with the database, close the connection:

// finish of the HTML for this page:
require_once "footer.php";

?>