<?php


require_once "header.php";

$questionid  = "";
$description = "";
$surveyid    = "";
$username    = "";
$answer      = "";



//This code is repeating throughout the php file, it grabs the Survey ID from the URL to be used within this PHP file.

/////////////* BEGINNING *////////////
if (isset($_GET['surveyid'])) {
    $surveyid = $_GET['id'];
}

//Post method obtains the data submitted from the form below
if (isset($_POST['surveyid5'])) {
    $description     = ($_POST['description']);
    $newquestiontype = ($_POST['newquestiontype']);
    
    $surveyid   = ($_POST['surveyid5']);
    $questionid = ($_POST['questionid']);
    $username   = $_SESSION['username'];
    
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
   //Insert statement inputs data into the specific database columns 
    $query = "INSERT INTO questions (questionid, questiontype, description, surveyid) VALUES ('$questionid','$newquestiontype','$description','$surveyid');";
    
    $result = mysqli_query($connection, $query);
    
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    $query2 = "SELECT * FROM questions WHERE description = '$description' AND surveyid = $surveyid";
    
    $result2 = mysqli_query($connection, $query2);
    
    $n3 = mysqli_num_rows($result2);
    
    for ($i = 0; $i < $n3; $i++) {
        $row          = mysqli_fetch_assoc($result2);
        $questiontype = $row['questiontype'];
        $description  = $row['description'];
        $surveyid     = $row['surveyid'];
        $questionid   = $row['questionid'];
    }
    
    //Inserts questions into the answers table with a null value, which will then be replaced when a survey is taken.
    $query1 = "INSERT INTO answers (pairid, surveyid, questionid, username, answer) VALUES (0, $surveyid, $questionid, '$username', null);";
    
    
    $result1 = mysqli_query($connection, $query1);
    
    
    if ($result) {
        echo "<h4>Successfully added the question to the questions </h4>";
    } else {
        echo "Failed";
    }
    
    
    
    
    
    if ($result1) {
        echo "<h4>and answer table!</h4>";
    } 
    else 
    {
        echo "Failed";
    }
    
    
    
    // if the connection fails, we need to know, so allow this exit:
    
    
    mysqli_close($connection);
    
 
}

//Post method obtains the data submitted from the form below and allows a delete query to be exectued in order to delete questions from specific surveys.

if (isset($_POST['questiondelete1'])) {
    if (isset($_POST['questiondelete2'])) {
        $questionid = ($_POST['questiondelete1']);
        $surveyid   = ($_POST['questiondelete2']);
        
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        
        
        //Questions are being deelted from both the questions table and the answers table which is a foreign key.
        
        $query = "DELETE from answers WHERE questionid = '$questionid' AND surveyid = '$surveyid';";
        $query1     = "DELETE from questions WHERE questionid = '$questionid';";
        
        $result  = mysqli_query($connection, $query);
        $result1 = mysqli_query($connection, $query1);
     
        if ($result) {
            echo "<h4>Successfully";
        } else {
            echo "<h4>Failed";
        }
        
        if ($result1) {
            echo " deleted a question from the survey!</h4>";
        } else {
            echo " to delete a question from the survey!</h4>";
        }
        
        
        
        // if the connection fails, we need to know, so allow this exit:
        if (!$connection) {
            die("Connection failed: " . $mysqli_connect_error);
        }
    }

}

//Post method obtains the data submitted from the form below and allows an update to be executed which toggles the visibility of a survey

if (isset($_POST['visible'])) {
    $surveyid   = ($_POST['sid']);
    $visible    = ($_POST['visible']);
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    if (isset($_POST['visible'])) {
        $visible;
    }
    
    
    $query = "UPDATE surveys SET visible = '$visible' WHERE surveyid = '$surveyid';";
    
    $result = mysqli_query($connection, $query);

    //message to verify whether the query has been successful in its execution or not.
    if ($result) {
        echo "<h4>Successfully Updated Survey Visibility.</h4>";
    } else {
        echo "<h4>Failed to Update Survey Visibility.</h4>";
    }
    
    // error message checking
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
}



// connect directly to our database (notice 4th argument):
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//surveyID is obtained from URL
if (isset($_GET['id'])) {
    //$surveyid = $_SESSION['id'];
    $surveyid = $_GET['id'];
}

if (!$connection) {
    die("Connection failed: " . $mysqli_connect_error);
}

////////Code to update the title and message of the survey begins here //////////////////


//Post method obtains the data submitted from the form below and allows a select query to be executed to obtain specific information from a certain survey.
if (isset($_POST['surveychange'])) {
    $title    = ($_POST['surveytitle']);
    $message  = ($_POST['surveymessage']);
    $surveyid = $_GET['id'];
}

if (isset($_GET['id'])) {
    //$surveyid = $_SESSION['id'];
    $surveyid = $_GET['id'];
}

$query3 = "SELECT title, message, surveyid FROM
    surveys WHERE surveyid = $surveyid;";


$result1 = mysqli_query($connection, $query3);



$n1 = mysqli_num_rows($result1);


//For loop is used to print out the information for each survey questions title and message.
for ($i = 0; $i < $n1; $i++) {
    // use the identifier to fetch one row as an associative array (elements named after columns):
    $row     = mysqli_fetch_assoc($result1);
    $title   = $row['title'];
    $message = $row['message'];
    
    
    echo "<br><h5>Current title: $title</h5><br>";
    echo "<h5>Current message: $message</h5><br><br>";
    
    echo <<<_END
       <div class="container">
        <table>
        

    <td><form action="surveys_titleupdate.php?id=$surveyid" method="POST">
    <input type="hidden" name="surveychange" value="">
        <tr>
        <td><th> Title </th></td>  
        <td><input size="50" type="text" name="surveytitle" value="$title"></td>
        </tr>
        
        <tr>
        <td><th> Message </th></td>
        <td><input size="50" type="text" name="surveymessage" value="$message"></td>
        </tr>
        
        
        <td><button type="submit" class="btn btn-success">Complete Updating</button></td>
        
        </form>
        
        </table>
        <br>
        </div>
          
_END;
    
}
///////////////Code for producing each survey's question on the webpage begins here /////////////

$query = "SELECT q.questionid, questiontype, description, s.surveyid, s.visible, s.username, s.title, s.message
    FROM questions q
    INNER JOIN surveys s ON s.surveyid = q.surveyid
    WHERE s.surveyid LIKE '$surveyid'";

// this query can return data ($result is an identifier):
$result = mysqli_query($connection, $query);

$n = mysqli_num_rows($result);

echo <<<_END
   
    <div class= "container">
    
        <table class="table table-hover">
        <thead>
        <tr>
        <th scope="col">Question Type</th>
        <th scope="col">Question Title</th>
        </tr><br>
        <tr>
        </thead>

_END;


//**New Comment**For loop is used to fetch and print the survey questions, and the rows to the screen.  
for ($i = 0; $i < $n; $i++) {
    // use the identifier to fetch one row as an associative array (elements named after columns):
    $row          = mysqli_fetch_assoc($result);
    $questiontype = $row['questiontype'];
    $description  = $row['description'];
    $surveyid     = $row['surveyid'];
    $questionid   = $row['questionid'];
    $visible      = $row['visible'];
    $username     = $row['username'];
    
    
    
  // The buttons which parse the information in the webpage to the POST method above, these buttons facilitate the editing and the deleting ability of each question on the webpage.   
    echo <<<_END
       <tr>

    <td>{$row['questiontype']}</td>
    <td>{$row['description']}</td>

    <td><a href="questions_update.php?question={$questionid}&surveyid={$surveyid}" class="btn btn-warning" role="button">Edit</a></td>
    <td><form action="" method="POST">
        <input type="hidden" name="questiondelete1" value="$questionid">
        <input type="hidden" name="questiondelete2" value="$surveyid">
        <button type="submit" class="btn btn-danger">Delete</button>
        </form></td>
        
        
          
_END;
    
}
echo "</table>";


    $questiontype = 'Text';
    $answer       = "";
    
    
    
    // Shows the information on the webpage which allows a new question to be added to the survey, here you can specify question description along with the chosen question type.   
    
    echo <<<_END
<form action="surveys_edit.php" method="post">
  <input type="hidden" name="questionid" maxlength="8" value="0" required>
  <br>
  <h3> Add a new question below </h3>
  Survey ID: $surveyid <input type="hidden" name="surveyid5" maxlength="256" value="$surveyid" required>
  <br>
  Question Type: <select id="qType" name="newquestiontype">
  <option value1="textbox">Text-box</option>
  <option value1="radiobtn">Radio-button</option>
  <option value1="paragraph" selected="selected">Paragraph</option>
  <option value1="slider">Slider</option>
</select>
  <br>
  Description: <input class="form-control" type="text" name="description" maxlength="256" value="" placeholder="Enter your question here?" required>
  <br>
  
  <input type="submit" class="btn btn-success" value="Finish adding question!"><br><br>
</form>    
_END;

// The form which parses the information to be able to toggle the visibility.  

echo <<<_END
<form action="surveys_edit.php" method="post">
  <input type="hidden" name="sid" value="$surveyid" maxlength="8" value="" required>
  <br>
  <h4>Visible:</h4><input type="radio" name="visible" value="1"> Yes   </td>
  <input type="radio" name="visible" value="0">   No</td></tr>
  <br>
  <input type="submit" class="btn btn-success" value="Finish Updating Survey Visibility">
</form>    
_END;




// finish of the HTML for this page:
require_once "footer.php";

?>