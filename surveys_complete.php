<?php


require_once "header.php";

$answer     = "";
$pairid     = "";
$username   = "";
$surveyid   = "";
$questionid = "";
$result24   = "";


/////////* Code to display questions *///////////


if (isset($_GET['id'])) {
    //$surveyid = $_SESSION['id'];
    $surveyid = $_GET['id'];
    
    
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 
    
    // connect directly to our database (notice 4th argument):
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    // connection failed, return an error message
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
    
    $query1 = "SELECT * FROM questions INNER JOIN answers ON questions.questionid = answers.questionid WHERE questions.surveyid = $surveyid AND answer IS NULL;";
    
    // this query can return data ($result is an identifier):
    $result1 = mysqli_query($connection, $query1);
    
    
    // how many rows came back?:
    $n1 = mysqli_num_rows($result1);
    
    
    if ($n1 AND $surveyid != 3) {
        echo "<br><h4>You are currently looking at survey number: $surveyid</h4>";
        
        echo "<br><h5>A survey creator must not complete their own survey, responses will not be recorded!</h5>";
        // loop over all rows, adding them into our array.
        for ($i = 0; $i < $n1; $i++) {
            // use the identifier to fetch one row as an associative array (elements named after columns):
            $row          = mysqli_fetch_assoc($result1);
            $questiontype = $row['questiontype'];
            $description  = $row['description'];
            $questionid   = $row['questionid'];
            $surveyid     = $row['surveyid'];
            $username     = $row['username'];
            $answer       = $row['answer'];
            $pairid       = $row['pairid'];
         //The form below parses the information to be retrieved and used by a query.   
           
            echo <<<_END
       <table>
        <tr>

    
    <form action="surveys_complete.php?surveyid=$surveyid" method="post"><br>
  Question ID: $questionid   <input type="hidden" name="questionid[]" value="$questionid">
<br>
  Question Type: $questiontype   <input type="hidden" name="questiontype" value="$questiontype">
<br>
  Question: $description   <input type="hidden" name="description" value="$description">
<br>

  <input type="hidden" name="surveyid" value="$surveyid">
  <input type="text" name="answer[]" value="">
  <input type="hidden" name="username" value="$username"><input type="hidden" name="pairid" value="$pairid"></td><br>
        
        
      
_END;
            
            
        }
        
        
        
    } 
    //The code below is an example for the survey with multiple input type, I haven't been able to add different question types for other surveys user responses and thus hard-coded responses for the user to be able to take a sample survey with a multiple question type variation.
    elseif ($surveyid == 3)
           {
        $row          = mysqli_fetch_assoc($result1);
            $questiontype = $row['questiontype'];
            $description  = $row['description'];
            $questionid   = $row['questionid'];
            $surveyid     = $row['surveyid'];
            $username     = $row['username'];
            $answer       = $row['answer'];
            $pairid       = $row['pairid'];
                echo <<<_END
       <table>
        <tr>

    
    <form action="surveys_complete.php?surveyid=$surveyid" method="post"><br>
  <input type="hidden" name="questionid[]" value="9">
<br>
    <input type="hidden" name="description" value="$description">
<br>
  <div class = 'form-group'>
    <label>Paragraph - Question: Do you like University? Enter "Yes", "No", or "maybe"</label>
    <textarea class='form-control' id='paragraphAnswer' name="answer[]" value="" rows='3'></textarea>
    </div>
<br>
<input type="hidden" name="questionid[]" value="10">
    <label>Radio-Button - Question: What do you study?</label>
   <input type="hidden" name="description" value="$description">
<br>
  <input type="radio" name="answer[]" value="Arts"> Arts</td>
  <br>
  <input type="radio" name="answer[]"  value="Engineering" checked> Engineering</td>
  <br>
  <input type="radio" name="answer[]"  value="Science"> Science </td>
  <br>
  <input type="radio" name="answer[]"  value="Other"> Other</td>

<br><br>
<input type="hidden" name="questionid[]" value="11">
<br>
      <label>Text-box - Question: Which University do you attend? </label>
  <input type="hidden" name="description" value="$description">
<br>
  <input type="textbox" size=75 name="answer[]" value=""><br></td>
<br>


  <input type="hidden" name="surveyid" value="$surveyid">
  <input type="hidden" name="username" value="$username"><input type="hidden" name="pairid" value="$pairid"></td><br>
        
        
      
_END;
           }
    else {
        echo "Empty! There are no questions present.";
        
        
    }
    
    
    
    // we're finished with the database, close the connection:
    mysqli_close($connection);
    
    // if we got some results then add them all into a big array:
    
    
}


////////* Code starts to insert statement here *//////////

if (isset($_GET['id'])) {
    //$surveyid = $_SESSION['id'];
    $surveyid = $_GET['id'];
    
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    
    // connect directly to our database (notice 4th argument):
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    // connection failed, return an error message
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
    
    
    //echo $_POST['answer'];
    //$query3 = "INSERT INTO answer (pairid, surveyid, questionid, username, answer) VALUES ($pairid, $surveyid, $questionid, $username, $answer) where surveyid = $surveyid;";
    
    // how many rows came back?:
    
    
    
    echo <<<_END
       
  <!-- <button type="submit" class="btn btn-success">Submit</button>-->
  <input type="submit" name="submit" value="Submit">
</form>    

        </tr>
        </table>
        
        
      
_END;
    
    
    
    // we're finished with the database, close the connection:
    mysqli_close($connection);
    
    //below is where the information for the form above was retrieved, and checked in the forloop to define the appropriate amount of times for a count.
    
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
} else if (isset($_POST['submit'])) {
    for ($i = 0; $i < sizeof($_POST['answer']); $i++) {
        if (is_array($_POST['answer'])) {
            $response   = $_POST['answer'];
            $questions  = $_POST['questionid'];
            $answerDate = date("Y-m-d");
          
            $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
     // the array is then checked and loops the appropriate amount of times for the answers to be inserted into the database.       
            
            if (is_array($response)) {
                
                $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                
                
                $query2  = "INSERT INTO answers (surveyid, questionid, username, answer, answerdate) VALUES ($_GET[surveyid],'$questions[$i]','{$_SESSION['username']}','$response[$i]', '$answerDate');";
                // this query can return data ($result2 is an identifier):
                $result2 = mysqli_query($connection, $query2);
                
                
            }
        }
    }
    //error message checking
    
    if ($query2) {
        echo "<h4>Successfully inserted information into the database! To take this survey again, click the red button in public survey's.</h4>";
    } else {
        echo "failed";
    }
    
}




// finish of the HTML for this page:
require_once "footer.php";

?>