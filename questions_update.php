<?php

// execute the header script:
require_once "header.php";

// default values we show in the form:
$username = "";
$description = "";
$questionid = "";



// strings to hold any validation error messages:
$username_val = "";
$description_val = "";


// should we show the set profile form?:
$show_update_form = false;
// message to output to user:
$message = "";

if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
//Information is grabbed from the form below in order to obtain the variables which were extracted from the database
elseif (isset($_POST['questiontag']))
{

 
	// user just tried to update their profile

	// connect directly to our database (notice 4th argument) we need the connection for sanitisation:
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	// if the connection fails, we need to know, so allow this exit:
	if (!$connection)
	{
		die("Connection failed: " . $mysqli_connect_error);
	}


//**New Comment**Code to sanitise inputted data

	$description = sanitise($_POST['description'], $connection);
	
//**New Comment**Sanitised data being posted to the variable declared
    $description = $_POST['description'];
    $questionid = $_POST['questiontag'];

    

	// SERVER-SIDE VALIDATION CODE MISSING:
//**New Comment**Server side validation
 $description_val=validateString($description,1,256);
   
	$errors = "";

	// check that all the validation tests passed before going to the database:
	if ($errors == "")
	{
		// query to get all questions from the database and update them with the new information
		$query = "SELECT * FROM questions WHERE questionid='$questionid'";
        
        $query1 = "UPDATE questions SET description = '$description' WHERE questionid ='$questionid';";

		// this query can return data ($result is an identifier):
		$result = mysqli_query($connection, $query);
        $result1 = mysqli_query($connection, $query1);

		// no data returned, we just test for true(success)/false(failure):
		if ($result)
		{
			// show a successful update message:
			$message = "<br>";
		}
		else
		{
			// show the set profile form:
			$show_update_form = true;
			// show an unsuccessful update message:
			$message = "Update failed<br>";
		}
        
        if ($result1)
		{
			// show a successful update message:
			$message = "<br><h4>Successfully updated the Question Type/Question Description.</h4><br>";
		}
		else
		{
			// show the set profile form:
			$show_update_form = true;
			// show an unsuccessful update message:
			$message = "Update failed<br>";
		}
	}


	// we're finished with the database, close the connection:
	mysqli_close($connection);

}
else
{
	///////////* The code below displays the question information and update fields once it has been clicked on to edit. *///////////

	// read the username from the session:
	$username = $_SESSION["username"];

	// now read their profile data from the table...

	// connect directly to our database (notice 4th argument):
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	// if the connection fails, we need to know, so allow this exit:
	if (!$connection)
	{
		die("Connection failed: " . $mysqli_connect_error);
	}
    //obtain questionid which has been parsed through the URL
    if (!isset($_GET['questionid'])) {
    $questionid = $_GET['question'];
}

	// check for a row in our questions database with a specific questionid and extract some data
	$query = "SELECT questionid, description, questiontype FROM questions WHERE questionid = $questionid;";
    

	// this query can return data ($result is an identifier):
	$result = mysqli_query($connection, $query);

	// how many rows came back? (can only be 1 or 0 because username is the primary key in our table):
	$n = mysqli_num_rows($result);

	// if there was a match then extract their profile data:
	if ($n)
	{
		// use the identifier to fetch one row as an associative array (elements named after columns):
		$row = mysqli_fetch_assoc($result);
		// extract the data for use in the HTML to be parsed in the form:
        $questionid = $row['questionid'];
        $description = $row['description'];
        $questiontype = $row['questiontype'];


	}


	// we're finished with the database, close the connection:
	mysqli_close($connection);





//Form to display input fields, this information will then be parsed to update the specific question.
echo <<<_END
<div class="container">
<form action=questions_update.php?question=$questionid &qType=$questiontype method="post">
  Update your survey question:<br>
  Question ID: $questionid <input type="hidden" name="questiontag" maxlength="256" value="$questionid" required><br>
  Question Type: $questiontype <input type="hidden" name="questiontype" maxlength="256" value="$questiontype" required><br>
  Username: {$_SESSION['username']}<br>
  <td>Question description: <input class="form-control" type="text" name="description" maxlength="256" value="$description" required></td>$description_val

  <input type="submit" class ="btn btn-success" value="Complete updating question title">
</form>	
</div>
_END;

    
//Function to display the appropriate input type depending on which type of question is chosen by the creator
function multipleChoice($questiontype) 
{
    if (isset($_GET['surveyid'])) {
    $surveyid = $_GET['surveyid'];
}
    if (isset($_GET['question'])) {
//$surveyid = $_SESSION['id'];
    $questionid = $_GET['question'];
}
    //e.g. if questiontype = 'paragraph' then a large input type text area is displayed for the answer to fit in. 
    if ($questiontype == 'Paragraph') 
    {
        
        echo "
        <div class = 'form-group'>
        <label for='paragraphAnswer'>Answer below</label>
    <textarea class='form-control' id='paragraphAnswer' name='pganswer' rows='3'></textarea>
    </div>";
        
        
        
    }
    elseif ($questiontype == 'Text-box')
    {
        echo  "<input type='text' size=50 class='form-control' name='visible' value='0'>Enter</td>";
        
    }
    elseif ($questiontype == 'Slider')
    {
      echo"<form>
  <div class='form-group'>
    <label for='formControlRange'>Example Range input</label>
    <input type='range' class='form-control-range' id='formControlRange'>
  </div>
    </form>";

        
    }
    elseif ($questiontype == 'Radio-button')
    {
        
        echo "
<form action='surveys_edit.php' method='post'>
  <input type='hidden' name='sid' value='$surveyid' maxlength='8' value='' required>
  <br>
  <h4>Visible:</h4><input type='radio' name='visible' value='Yes'> Yes   </td>
  <input type='radio' name='visible' value='No'> No</td>
  <input type='radio' name='visible' value='Maybe' checked> Maybe</td></tr>
  <br>
  <input type='submit' class='btn btn-success' value='Finish Updating Survey Visibility'>
</form>	";
       
    }
    elseif ($questiontype == 'Multiple-Choice')
    {
        
        echo "Currently blank";
        
    }
	else
    { 
		// error message for failed attempt if the questiontype is not recognised within this function.
        return "Not this question: " . $questiontype; 
    }
	// data was valid, return an empty string:
    return ""; 
}
    //execution of the function
    echo  $checkQuestion = multipleChoice($questiontype);

echo $checkQuestion;
    }

  


// display our message to the user:
echo $message;

// finish of the HTML for this page:
require_once "footer.php";
?>
