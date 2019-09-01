<?php

// Things to notice:
// This script will let a logged-in user VIEW their account details and allow them to UPDATE those details
// The main job of this script is to execute an INSERT or UPDATE statement to create or update a user's account information...
// ... but only once the data the user supplied has been validated on the client-side, and then sanitised ("cleaned") and validated again on the server-side

// execute the header script:
require_once "header.php";

// default values we show in the form:
$username  = "";
$password  = "";
$firstname = "";
$lastname  = "";
$dob       = "";
$email     = "";
$phonenum  = "";


// strings to hold any validation error messages:
$username_val  = "";
$password_val  = "";
$firstname_val = "";
$lastname_val  = "";
$dob_val       = "";
$email_val     = "";
$phonenum_val  = "";

// should we show the set profile form?:
$show_account_form = false;
// message to output to user:
$message           = "";

if (!isset($_SESSION['loggedInSkeleton'])) {
    // user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.<br>";
}

/*else*/

elseif (isset($_POST['email'])) {
    //**New Comment**Code which retrieves the username based on the admin href, essentially says if name is set, retrieve username details and set as $username
    if (isset($_GET['username'])) {
        $username = $_GET['username'];
        echo $username;
    } else {
        $username = $_SESSION["username"];
        echo $username;
    }
    // user just tried to update their profile
    
    // connect directly to our database (notice 4th argument) we need the connection for sanitisation:
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    // if the connection fails, we need to know, so allow this exit:
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
    
    // SANITISATION CODE MISSING:
    
    // ...
    
    //**New Comment**Code to sanitise the inputted data
    $password  = sanitise($_POST['password'], $connection);
    $firstname = sanitise($_POST['firstname'], $connection);
    $lastname  = sanitise($_POST['lastname'], $connection);
    $dob       = sanitise($_POST['dob'], $connection);
    $email     = sanitise($_POST['email'], $connection);
    $phonenum  = sanitise($_POST['phonenum'], $connection);
    
    //**New Comment**Data being posted
    $password  = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $dob       = $_POST['dob'];
    $email     = $_POST['email'];
    $phonenum  = $_POST['phonenum'];
    
    // SERVER-SIDE VALIDATION CODE MISSING:
    //**New Comment**Server side validation of the values
    $password_val  = validateString($password, 1, 16);
    $firstname_val = validateString($firstname, 1, 64);
    $lastname_val  = validateString($lastname, 1, 64);
    $dob_val       = validateDate($dob);
    $email_val     = validateEmail($email, 1, 64);
    $phonenum_val  = validatephoneNum($phonenum, 11, 14);
    
    // ...
    
    $errors = "";
    
    // check that all the validation tests passed before going to the database:
    if ($errors == "") {
        
        
        // now write the new data to our database table...
        
        // check to see if this user already has account data present
        $selectquery = "SELECT * FROM users WHERE username='$username'";
        
        // this query can return data ($selectresult is an identifier):
        $selectresult = mysqli_query($connection, $selectquery);
        
        // how many rows came back? (can only be 1 or 0 because username is the primary key in our table):
        $n = mysqli_num_rows($selectresult);
        
        
        // if there was a match then UPDATE their profile data, otherwise INSERT it:
        if ($n > 0) {
            // we need an UPDATE:
            //**New Comment**update query to replace existing values with new ones.
            $updatequery  = "UPDATE users SET password = '$password', firstname='$firstname', lastname='$lastname', dob='$dob', email='$email', phonenum='$phonenum' WHERE username='$username'";
            $updateresult = mysqli_query($connection, $updatequery);
            
        }
        
        
        // no data returned, we just test for true(success)/false(failure):
        if ($updateresult) {
            // show a successful update message:
            $message = "<br>Profile successfully updated<br>";
        } else {
            // show the set profile form:
            $show_account_form = true;
            // show an unsuccessful update message:
            $message           = "<br>Update failed<br>";
        }
    } else {
        // validation failed, show the form again with guidance:
        $show_account_form = true;
        // show an unsuccessful update message:
        $message           = "<br>Update failed, please check the errors above and try again<br>";
    }
    
    // we're finished with the database, close the connection:
    mysqli_close($connection);
    
} else {
    // arrived at the page for the first time, show any data already in the table:
    
    // read the username from the session:
    $username = $_GET["username"];
    
    // now read their profile data from the table...
    
    // connect directly to our database (notice 4th argument):
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    // if the connection fails, we need to know, so allow this exit:
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
    
    // check for a row in our profiles table with a matching username:
    $selectquery2 = "SELECT * FROM users WHERE username='$username'";
    
    // this query can return data ($result is an identifier):
    $selectresult2 = mysqli_query($connection, $selectquery2);
    
    // how many rows came back? (can only be 1 or 0 because username is the primary key in our table):
    $n = mysqli_num_rows($selectresult2);
    
    // if there was a match then extract their profile data:
    if ($n > 0) {
        // use the identifier to fetch one row as an associative array (elements named after columns):
        $row       = mysqli_fetch_assoc($selectresult2);
        // extract their profile data for use in the HTML:
        $username  = $row['username'];
        $password  = $row['password'];
        $firstname = $row['firstname'];
        $lastname  = $row['lastname'];
        $dob       = $row['dob'];
        $email     = $row['email'];
        $phonenum  = $row['phonenum'];
        
    }
    
    // show the set profile form:
    $show_account_form = true;
    
    // we're finished with the database, close the connection:
    mysqli_close($connection);
    
}

if ($show_account_form) {
    echo <<<_END
<!--**New Comment**Form to handle and store the new information being entered, is also being validated upon input -->

<form action="account_set.php?username=$username" method="post">
  Update your profile info:<br>
  Username: $username<br>
  Password: <input type="password" name="password" minlength="8" maxlength="16" value="$password" required> $password_val
  <br>
  First Name: <input type="text" name="firstname" minlength="2"  maxlength="64" value="$firstname" required> $firstname_val
  <br>
  Last Name: <input type="text" name="lastname" minlength="2" maxlength="64" value="$lastname" required> $lastname_val
  <br>
  Email: <input type="email" name="email" minlength="8" maxlength="64" value="$email" required> $email_val
  <br>
  Phone Number: <input type="text" name="phonenum" minlength="11" maxlength="14" value="$phonenum" required> $phonenum_val<br>
  Date of Birth: <input type="date" max="23/01/2003" name="dob" title="Date format follows: dd/mm/yyyy" value="$dob" required> $dob_val
  <br>
  <input type="submit" value="Submit">
</form>    
_END;
}

// display our message to the user:
echo $message;

// finish of the HTML for this page:
require_once "footer.php";
?>