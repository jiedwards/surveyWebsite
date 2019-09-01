<?php

// Things to notice:
// The main job of this script is to execute a SELECT statement to look for the submitted username and password in the appropriate database table
// If the submitted username and password is found in the table, then the following session variable is set: $_SESSION["loggedInSkeleton"]=true;
// All other scripts check for this session variable before loading (if it doesn't exist then the user isn't logged in and the page doesn't load)
// However... the database table isn't currently being queried (at the moment the code is only checking for a username of "barryg", "mandyb" or "admin") and it's your job to add this query in... 
//
// Other notes:
// client-side validation using "password","text" inputs and "required","maxlength" attributes (but we can't rely on it happening!)
// we sanitise the user's credentials - see helper.php (included via header.php) for the sanitisation function
// we validate the user's credentials - see helper.php (included via header.php) for the validation functions
// the validation functions all follow the same rule: return an empty string if the data is valid...
// ... otherwise return a help message saying what is wrong with the data.
// if validation of any field fails then we display the help messages (see previous) when re-displaying the form

// execute the header script:
require_once "header.php";

// default values we show in the form:
$username = "";
$password = "";
// strings to hold any validation error messages:
$username_val = "";
$password_val = "";

// should we show the signin form:
$show_signin_form = false;
// message to output to user:
$message = "";

if (isset($_SESSION['loggedInSkeleton']))
{
	// user is already logged in, just display a message:
	echo "You are already logged in, please log out first.<br>";

}
elseif (isset($_POST['username']))
{
	// user has just tried to log in:
	
	// connect directly to our database (notice 4th argument) we need the connection for sanitisation:
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	// if the connection fails, we need to know, so allow this exit:
	if (!$connection)
	{
		die("Connection failed: " . $mysqli_connect_error);
	}	

	// take copies of the credentials the user submitted and sanitise (clean) them:
	$username = sanitise($_POST['username'], $connection);
	$password = sanitise($_POST['password'], $connection);

	//validation of the variables based on the functions declared in helper.php
	$username_val = validateString($username, 1, 16);
	$password_val = validateString($password, 1, 16);
	
	// concatenate all the validation results together ($errors will only be empty if ALL the data is valid):
	$errors = $username_val . $password_val;
	
	// check that all the validation tests passed before going to the database:
	if ($errors == "")
	{

       
        //the $query stores the SQL call command to the database to retrieve the information
        $selectquery = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            
        $selectresult = mysqli_query($connection, $selectquery);
        
        $n = mysqli_num_rows($selectresult);
        
		
		// if there was a match then set the session variables and display a success message:
		if ($n > 0)
		{
			// set a session variable to record that this user has successfully logged in:
			$_SESSION['loggedInSkeleton'] = true;
			// and copy their username into the session data for use by our other scripts:
			$_SESSION['username'] = $username;
			
			// show a successful signin message:
			$message = "Hi, $username, you have successfully logged in, please <a href='account.php'>click here</a><br>";
		}
		else
		{
			// no matching credentials found so redisplay the signin form with a failure message:
			$show_signin_form = true;
			// show an unsuccessful signin message:
			$message = "Sign in failed, please try again<br>";
		}
		
	}
	else
	{
		// validation failed, show the form again with guidance:
		$show_signin_form = true;
		// show an unsuccessful signin message:
		$message = "Sign in failed, please check the errors shown above and try again<br>";
	}
	
	// we're finished with the database, close the connection:
	mysqli_close($connection);

}
else
{
	// user has arrived at the page for the first time, just show them the form:
	
	// show signin form:
	$show_signin_form = true;
}

if ($show_signin_form)
{
// show the form that allows users to log in
// Note we use an HTTP POST request to avoid their password appearing in the URL:
echo <<<_END
            <h2>Log in </h2> 


<div class="mw-50 p-3 container ">
<div class="form-group">
<form action="sign_in.php" method="post">
  <h4>Please enter your username and password:</h4>
  <br>
  <input type="text" name="username" class="form-control" maxlength="16" placeholder="username" value="$username" required> $username_val
  <br>
  <input type="password" class="form-control" name="password" maxlength="16" value="$password" placeholder="password" required> $password_val
  <br>
<button type="submit" class="btn btn-warning">Login</button>
<img class="img-responsive" src="images/Website/login1.png" width="150" height="150" alt="Homepage">

</form>	

</div>
</div>
_END;
}

// display our message to the user:
echo $message;

// finish off the HTML for this page:
require_once "footer.php";
?>