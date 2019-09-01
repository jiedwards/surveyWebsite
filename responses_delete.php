<?php


require_once "header.php";

$answer     = "";
$pairid     = "";
$username   = "";
$surveyid   = "";
$questionid = "";
$result24   = "";

/////////* Code to display questions *///////////


$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);



if (isset($_GET['id'])) {
    $surveyid = $_GET['id'];
    
    // connect directly to our database (notice 4th argument):
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    // connection failed, return an error message
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }

    //query displays answers on webpage based on specified filters
    $selectquery = "SELECT DISTINCT * FROM answers INNER JOIN questions ON questions.questionid = answers.questionid WHERE questions.surveyid = $surveyid AND username = '{$_SESSION['username']}' AND answer IS NOT NULL;";
    
    
    
    // this query can return data ($result is an identifier):
    $selectresult = mysqli_query($connection, $selectquery);
    
    
    // how many rows came back?:
    $n1 = mysqli_num_rows($selectresult);
    
    
    if ($n1) {
        echo "<br><h4>You are currently looking at survey number: $surveyid</h4>";
        // loop over all rows, adding them into our array:
        for ($i = 0; $i < $n1; $i++) {
            // use the identifier to fetch one row as an associative array (elements named after columns):
            $row          = mysqli_fetch_assoc($selectresult);
            $questiontype = $row['questiontype'];
            $description  = $row['description'];
            $questionid   = $row['questionid'];
            $surveyid     = $row['surveyid'];
            $username     = $row['username'];
            $answer       = $row['answer'];
            $pairid       = $row['pairid'];
            
            
        //form below displays the boxes for answers to be entered, then parses the information to be recieved in a query.
            echo <<<_END
       <table>
        <tr>

    
    <form action="responses_delete.php?surveyid=$surveyid" method="post"><br>
  Question ID: $questionid   <input type="hidden" name="questionid[]" value="$questionid">
<br>
  Question Type: $questiontype   <input type="hidden" name="questiontype" value="$questiontype">
<br>
  Question: $description   <input type="hidden" name="description" value="$description">
<br>

  <input type="hidden" name="surveyid" value="$surveyid">
  <input type="text" name="answer[]" value="$answer">
  <input type="hidden" name="username" value="$username"><input type="hidden" name="pairid" value="$pairid"></td><br>
        
        
      
_END;
            
            
        }
        
        
        
    } else {
        echo "Empty response table";
    }
    
    // we're finished with the database, close the connection:
    mysqli_close($connection);   
}


////////* Code starts to update functionality here *//////////

if (isset($_GET['id'])) {
    //$surveyid = $_SESSION['id'];
    $surveyid = $_GET['id'];

    // connect directly to our database (notice 4th argument):
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    // connection failed, return an error message
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }

    echo <<<_END
       
  <button type="submit" name="submit" value="Submit" class="btn btn-success">Update Survey Responses</button>
</form>    

        </tr>
        </table>
        
        
      
_END;
    
    
    
    // we're finished with the database, close the connection:
    mysqli_close($connection);
    
    //below is where the information for the form above was retrieved, and checked in the forloop to define the appropriate amount of times for a count.
       
} else if (isset($_POST['submit'])) {
    for ($i = 0; $i < sizeof($_POST['answer']); $i++) {
        if (is_array($_POST['answer'])) {
            $response   = $_POST['answer'];
            $questions  = $_POST['questionid'];
            $answerDate = date("Y-m-d");
            
    // the array is then checked and loops the appropriate amount of times for the answers to be updated in the database.   
            
            if (is_array($response)) {
                
                $updatequery = "UPDATE answers SET
   surveyid ='$_GET[surveyid]', username = '{$_SESSION['username']}', answer = '$response[$i]' where surveyid = $_GET[surveyid] AND questionid = '$questions[$i]' AND username = '{$_SESSION['username']}';";
                
                $updateresult = mysqli_query($connection, $updatequery);
                
                
            }
        }
    }
    //error message checking
    
    if ($updatequery) {
        echo "Successfully updated answers from previous responses!";
    } else {
        echo "Failed to update!";
    }
    
}


// finish of the HTML for this page:
require_once "footer.php";

?>