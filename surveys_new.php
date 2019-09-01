<?php

// execute the header script:
require_once "header.php";


$displaySurveys = false;

//declares the validation for the webpage
$validation = $title_validation = $message_validation = $username_validation = $visible_validation = "";


if (!isset($_SESSION['loggedInSkeleton'])) {
    // user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.<br>";
} else
// only display the page content if this is the admin account (all other users get a "you don't have permission..." message):
    if ($_SESSION['loggedInSkeleton']) {
    
    echo "Implement the admin tools here... See the assignment specification for more details.<br>";
    
    // The double POST method obtains the various information from the form which was parsed below, this information is then used to execute an insert query below, and toggle the visibility state.
    if (isset($_POST['newSurvey'])) {
        $title    = $_POST['title'];
        $message  = $_POST['message'];
        $username = ($_POST['username']);
        $visible  = false;
        
        if (isset($_POST['visible'])) {
            $visible = true;
        } else {
            $visible = false;
        }
        
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        
        if (!$connection) {
            die("Connection failed: " . $mysqli_connect_error);
        }
        
        
        /* Server side validation */
        
        //The input is being sanitised using the functions from the helper which were called initially using the "require once header.php" call. It is first being sanitised(cleaned), then it is being validated against the desired parameters in the helper.php
        $title    = sanitise($title, $connection);
        $message  = sanitise($message, $connection);
        $username = sanitise($username, $connection);

        
        $title_validation    = validateString($title, 1, 64);
        $message_validation  = validateString($message, 1, 256);
        $username_validation = validateString($username, 1, 32);
        
        $validation = $title_validation . $message_validation . $username_validation;
        
        if ($validation == "") {
            $surveyDate = date("Y-m-d");
            //this query inserts a new survey into the database using the information which is entered on the form below.
            $query = "INSERT INTO surveys (title, message, username, created, updated, visible) VALUES ('$title', '$message', '$username', '$surveyDate', '$surveyDate', '$visible')";
            
            $result = mysqli_query($connection, $query);
            
            if ($result) {
                echo "<h3>Sucess! New Survey Created. Head back to My Survey's to see the result.</h3>";
                $displaySurveys = true;
            } 
            //error message checking
            else {
                die("Error inserting row: " . mysqli_error($connection));
            }
            mysqli_close($connection);
        } else {
            
            $displaySurveys = true;
        }
    }
    
    else {
        $displaySurveys = true;
    }
}
//This message below is displayed when the user isn't registered on the survey website.
else {
    echo "You have no access to this page, please <a href='sign_in.php'>login</a> or be a registered account to use this feature.<br> <a href='sign_up.php'>Sign up now</a>";
}


if ($displaySurveys) {
    //this form displays the information to add a new survey, the information is then parsed and will be used in the insert query declared earlier in this php file.
    echo <<<_END

        <form action="surveys_new.php" method="POST" id="newSurvey" enctype="multipart/form-data">
        
             <div class="generalInfo"><fieldset><h2>Add a new survey</h2><table>

             <tr><th align="right">Survey Title</th><td><input size="40" type="text" name="title" minlength="1" maxlength="64" required><b>{$title_validation}</b></td></tr>
             
             <tr><th align="right">Message</th><td><input size="40" type="text" name="message" minlength="1" maxlength="256" required><b>{$message_validation}</b></td></tr>
             
_END;
    
    if ($_SESSION['username'] == "admin") {
        // CONNECT TO DATABASE TO GET LIST OF USERNAMES
        // connect to the host:
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        // exit the script with a useful message if there was an error:
        if (!$connection) {
            die("Connection failed: " . $mysqli_connect_error);
        }
        // connect to our database:
        mysqli_select_db($connection, $dbname);
        // run query to get the contents from the users table
        $query  = "SELECT username FROM users";
        // this query can return data ($result is an identifier):
        $result = mysqli_query($connection, $query);
        // how many rows came back?:
        $n = mysqli_num_rows($result);
        echo "<tr><th align=\"left\">Creator</th><td><select name=\"username\" required>";
        if ($n > 0) {
            for ($i = 0; $i < $n; $i++) {
                $row = mysqli_fetch_assoc($result);
                echo "<option value = \"{$row['username']}\">{$row['username']}</option>";
                
            }
            echo "</select>";
        }
    }
    
    else {
        echo "<tr><th align=\"right\">Creator</th><td><input size=\"40\" type=\"text\" name=\"username\" minlength=\"1\" maxlength=\"32\" value=\"{$_SESSION['username']}\" readonly required>";
    }
    
    // End of the form which allows a user to insert a new survey. Also lets a user choose whether they want the survey to be publically available immediately.
    echo <<<_END
               
            <b>{$username_validation}</b></td></tr>
             
             <tr><th align="right">Public?</th><td><input type="checkbox" name="visible" value="1">Yes</td></tr>
             </table>
                <input type="submit" class="btn btn-success" name="newSurvey" value="Completed! Add new survey">        
        </form>
_END;
}

// finish of the HTML for this page:
require_once "footer.php";

?>