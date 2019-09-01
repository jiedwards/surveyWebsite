<?php

// Things to notice:
// The main job of this script is to execute an INSERT statement to add the submitted username, password and email address
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
$firstname = "";
$lastname = "";
$email = "";
$phonenum = "";
$dob = "";

// strings to hold any validation error messages:
$username_val = "";
$password_val = "";
$firstname_val = "";
$lastname_val = "";
$email_val = "";
$phonenum_val = "";
$dob_val = "";

// should we show the signup form?:
$show_signup_form = false;
// message to output to user:
$message = "";

if (isset($_SESSION['loggedInSkeleton']))
{
	// user is already logged in, just display a message:
	echo "You are already logged in, please log out if you wish to create a new account<br>";
	
}
elseif (isset($_POST['username']))
{
	// user just tried to sign up:
	
	// connect directly to our database (notice 4th argument) we need the connection for sanitisation:
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	// if the connection fails, we need to know, so allow this exit:
	if (!$connection)
	{
		die("Connection failed: " . $mysqli_connect_error);
	}	
	
	// SANITISATION (see helper.php for the function definition)
	
	// take copies of the credentials the user submitted, and sanitise (clean) them:
	$username = sanitise($_POST['username'], $connection);
	$password = sanitise($_POST['password'], $connection);
    $firstname = sanitise($_POST['firstname'], $connection);
    $lastname = sanitise($_POST['lastname'], $connection);
    $email = sanitise($_POST['email'], $connection);
    $phonenum = sanitise($_POST['phonenum'], $connection);
    $dob = sanitise($_POST['dob'], $connection);


	// VALIDATION (see helper.php for the function definitions)
	
	// now validate the data (both strings must be between 1 and 16 characters long):
	// (reasons: we don't want empty credentials, and we used VARCHAR(16) in the database table for username and password)
    // firstname is VARCHAR(32) and lastname is VARCHAR(64) in the DB
    // email is VARCHAR(64) and telephone is VARCHAR(16) in the DB
	$username_val = validateString($username, 5, 16);
	$password_val = validateString($password, 8, 16);
    $firstname_val = validateString($firstname, 1, 64);
    $lastname_val = validateString($lastname, 1, 64);
    //the following line will validate the email as a string, but maybe you can do a better job...
    $phonenum_val = validatephoneNum($phonenum, 11, 14);
    $email_val = validateEmail($email, 1, 64);
    $dob_val = validateString($dob, 1, 16);
	
	// concatenate all the validation results together ($errors will only be empty if ALL the data is valid):
	$errors = $username_val . $password_val . $email_val . $phonenum_val . $dob_val. $firstname_val . $lastname_val;
	
	// check that all the validation tests passed before going to the database:
	if ($errors == "")
	{
		
		// try to insert the new details:
		$selectquery = "INSERT INTO users (username, password, firstname, lastname, email, phonenum, dob) VALUES ('$username', '$password', '$firstname', '$lastname', '$email', '$phonenum', '$dob');";
		$selectresult = mysqli_query($connection, $selectquery);
		
		// no data returned, we just test for true(success)/false(failure):
		if ($selectresult) 
		{
			// show a successful signup message:
			$message = "Signup was successful, please sign in<br>";
		} 
		else 
		{
			// show the form:
			$show_signup_form = true;
			// show an unsuccessful signup message:
			$message = "Sign up failed! Username may already be in use. Please try again with an alternative username.<br>";
		}
			
	}
	else
	{
		// validation failed, show the form again with guidance:
		$show_signup_form = true;
		// show an unsuccessful signin message:
		$message = "Sign up failed, please check the errors shown above and try again<br>";
	}
	
	// we're finished with the database, close the connection:
	mysqli_close($connection);

}
else
{
	// just a normal visit to the page, show the signup form:
	$show_signup_form = true;
	
}

if ($show_signup_form)
{
// show the form that allows users to sign up
// Note we use an HTTP POST request to avoid their password appearing in the URL:	
echo <<<_END
<form action="sign_up.php" method="post">
  Please choose a username and password:<br>
  Username: <input type="text" name="username" maxlength="16" value="$username" placeholder="Jacob1234" required> $username_val
  <br>
  Password: <input type="password" name="password" maxlength="16" value="$password" placeholder="*********"  required> $password_val
  <br>
  First Name: <input type="text" name="firstname" maxlength="64" value="$firstname"placeholder="Jacob"  required> $firstname_val
  <br>
  Last Name: <input type="text" name="lastname" maxlength="64" value="$lastname" placeholder="Edwards"  required> $lastname_val
  <br>
  Email: <input type="email" name="email" maxlength="64" value="$email" placeholder="Jacob@testemail.com"  required> $email_val
  <br>
  Phone Number: <input type="text" name="phonenum" minlength="11" maxlength="14" value="$phonenum" placeholder="07777777777"  required> $phonenum_val<br>
  Date of Birth: <input type="date" name="dob" title="Date format follows: dd/mm/yyyy" value="$dob" placeholder="10/06/1995"  required> $dob_val
  <br>
  <input type="submit" value="Submit">
</form>	
_END;
}

// display our message to the user:
echo $message;

// finish off the HTML for this page:
require_once "footer.php";

?>