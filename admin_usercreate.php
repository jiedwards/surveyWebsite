<?php


// execute the header script:
require_once "header.php";

// default values we show in the form:
$username  = "";
$password  = "";
$firstname = "";
$lastname  = "";
$email     = "";
$phonenum  = "";
$dob       = "";

// strings to hold any validation error messages:
$username_val  = "";
$password_val  = "";
$firstname_val = "";
$lastname_val  = "";
$email_val     = "";
$phonenum_val  = "";
$dob_val       = "";

// should we show the signup form?:
$show_createuser_form = false;
// message to output to user:
$message = "";

if ($_SESSION['username'] == "admin") {
    
    // connect directly to our database (notice 4th argument) we need the connection for sanitisation:
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    // if the connection fails, we need to know, so allow this exit:
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
    
    
    if (isset($_POST['username'])) {
        
        // take copies of the credentials the user submitted, and sanitise (clean) them:
        $username  = sanitise($_POST['username'], $connection);
        $password  = sanitise($_POST['password'], $connection);
        $firstname = sanitise($_POST['firstname'], $connection);
        $lastname  = sanitise($_POST['lastname'], $connection);
        $email     = sanitise($_POST['email'], $connection);
        $phonenum  = sanitise($_POST['phonenum'], $connection);
        $dob       = sanitise($_POST['dob'], $connection);
        
        
        
        
        // validation of the strings based on the function defined in the helper.
        $username_val  = validateString($username, 1, 16);
        $password_val  = validateString($password, 1, 16);
        $phonenum_val  = validateString($phonenum, 1, 16);
        $firstname_val = validateString($firstname, 1, 64);
        $lastname_val  = validateString($lastname, 1, 64);
        //there is no special validation done on this half of the admin user create due to the admin being able to create any sort of account with any sort of data.
        $email_val = validateString($email, 1, 64);
        $dob_val = validateString($dob, 1, 16);
        
        // concatenate all the validation results together ($errors will only be empty if ALL the data is valid):
        $errors = $username_val . $password_val . $email_val . $phonenum_val . $dob_val . $firstname_val . $lastname_val;
        
        // check that all the validation tests passed before going to the database:
        if ($errors == "") {
            
            // try to insert the new details into the users database:
            $insertquery  = "INSERT INTO users (username, password, firstname, lastname, email, phonenum, dob) VALUES ('$username', '$password', '$firstname', '$lastname', '$email', '$phonenum', '$dob');";
            $insertresult = mysqli_query($connection, $insertquery);
            
            // no data returned, we just test for true(success)/false(failure):
            if ($insertresult) {
                // show a successful signup message:
                $message = "Creation of new user was successful!<br>";
            } else {
                // show the form:
                $show_createuser_form = true;
                // show an unsuccessful signup message:
                $message              = "Create user failed, please try again<br>";
            }
            
        }
    } else {
        // validation failed, show the form again with guidance:
        $show_createuser_form = true;
        // show an unsuccessful signin message:
        $message              = "Create user failed, please check the errors shown above and try again<br>";
    }
    
    // we're finished with the database, close the connection:
    mysqli_close($connection);
    
} else {
    // just a normal visit to the page, show the signup form:
    $show_createuser_form = true;
    
}

if ($show_createuser_form) {
    // show the form that allows users to sign up
    // Note we use an HTTP POST request to avoid their password appearing in the URL:    
    echo <<<_END
<form action="admin_usercreate.php" method="post">
  Please choose a username and password:<br>
  Username: <input type="text" name="username" maxlength="16" value="$username" required> $username_val
  <br>
  Password: <input type="password" name="password" maxlength="16" value="$password" required> $password_val
  <br>
  First Name: <input type="text" name="firstname" maxlength="64" value="$firstname" required> $firstname_val
  <br>
  Last Name: <input type="text" name="lastname" maxlength="64" value="$lastname" required> $lastname_val
  <br>
  Email: <input type="email" name="email" maxlength="64" value="$email" required> $email_val
  <br>
  Phone Number: <input type="text" name="phonenum" maxlength="16" value="$phonenum" required> $phonenum_val<br>
  Date of Birth: <input type="date" name="dob" title="Date format follows: dd/mm/yyyy" value="$dob" required> $dob_val
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

