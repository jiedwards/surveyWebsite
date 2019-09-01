<?php

// Things to notice:
// This file is the first one we will run when we mark your submission
// Its job is to: 
// Create your database (currently called "skeleton", see credentials.php)... 
// Create all the tables you will need inside your database (currently it makes a simple "users" table, you will probably need more and will want to expand fields in the users table to meet the assignment specification)... 
// Create suitable test data for each of those tables 


// read in the details of our MySQL server:
require_once "credentials.php";

// We'll use the procedural (rather than object oriented) mysqli calls

// connect to the host:
$connection = mysqli_connect($dbhost, $dbuser, $dbpass);

// exit the script with a useful message if there was an error:
if (!$connection)
{
	die("Connection failed: " . $mysqli_connect_error);
}
  
// build a statement to create a new database:
$sql = "CREATE DATABASE IF NOT EXISTS " . $dbname;

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Database created successfully, or already exists<br>";
} 
else
{
	die("Error creating database: " . mysqli_error($connection));
}

// connect to our database:
mysqli_select_db($connection, $dbname);

///////////////////////////////////////////
////////////// USERS TABLE //////////////
///////////////////////////////////////////

// if there's an old version of our table, then drop it:
$sql = "DROP TABLE IF EXISTS users";

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Dropped existing table: users<br>";
} 
else 
{	
	die("Error checking for existing table: " . mysqli_error($connection));
}

// make our table:
$sql = "CREATE TABLE users (firstname VARCHAR(64), lastname VARCHAR(64), username VARCHAR(16), password VARCHAR(16), dob VARCHAR (16), email VARCHAR(64), phonenum VARCHAR(16), PRIMARY KEY(username))";

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Table created successfully: users<br>";
}
else 
{
	die("Error creating table: " . mysqli_error($connection));
}

// put some data in our table:
$firstname[] = 'admin'; $lastname[] = 'admin'; $usernames[] = 'admin'; $passwords[] = 'secret'; $dob[] = '0000-00-00'; $emails[] = 'admin@admin.com'; $phonenum[] = '00000000000';

$firstname[] = 'barry'; $lastname[] = 'marsden'; $usernames[] = 'barrym'; $passwords[] = 'letmein'; $dob[] = '2011-04-11'; $emails[] = 'barry@m-domain.com'; $phonenum[] = '+4407491116282';

$firstname[] = 'john'; $lastname[] = 'longlane'; $usernames[] = 'johnl'; $passwords[] = 'letmein'; $dob[] = '2011-04-11'; $emails[] = 'johnl@m-domain.com'; $phonenum[] = '07491116282';

$firstname[] = 'mark'; $lastname[] = 'longlane'; $usernames[] = 'markw'; $passwords[] = 'letmein'; $dob[] = '2011-04-11'; $emails[] = 'markw@m-domain.com'; $phonenum[] = '07491116282';




// loop through the arrays above and add rows to the table:
for ($i=0; $i<count($usernames); $i++)
{
	$sql = "INSERT INTO users (firstname, lastname, username, password, dob, email, phonenum) VALUES ('$firstname[$i]','$lastname[$i]','$usernames[$i]', '$passwords[$i]','$dob[$i]', '$emails[$i]','$phonenum[$i]')";
	
	// no data returned, we just test for true(success)/false(failure):
	if (mysqli_query($connection, $sql)) 
	{
		echo "row inserted<br>";
	}
	else 
	{
		die("Error inserting row: " . mysqli_error($connection));
	}
}

///////////////Surveys Table/////////////////

// Deletes an existing version of the table if necessary
    $sql = "DROP TABLE IF EXISTS surveys";


    if (mysqli_query($connection, $sql)) {
        echo "Dropped existing table: surveys<br>";
    } else {
        die("Error checking for existing table: " . mysqli_error($connection));
    }

// make our table:
    $sql = "CREATE TABLE surveys (surveyid INT NOT NULL AUTO_INCREMENT, title VARCHAR(64), message VARCHAR(256), username VARCHAR(32),
    created DATE, updated DATE, visible BOOLEAN, PRIMARY KEY (surveyid), FOREIGN KEY (username) REFERENCES users(username))";

// no data returned, we just test for true(success)/false(failure):
    if (mysqli_query($connection, $sql)) {
        echo "Table created successfully: surveys<br>";
    } else {
        die("Error creating table: " . mysqli_error($connection));
    }

// put some data in our table:
    $titles = $message = $usernames = $created = $updated = $visibles = array(); // clear this array (as we already used it above)

    $titles[] = "Fruit?"; $message[] = "A simple survey designed to understand a persons relationship with fruit"; $usernames[] = "markw"; $created[] = $updated[] = "2018-12-01"; $visibles[] = true;

    $titles[] = "Games?"; $message[] = "A simple survey designed to understand a persons relationship with games"; $usernames[] = "johnl"; $created[] = $updated[] = "2018-12-01"; $visibles[] = true;

    $titles[] = "Sample Survey?"; $message[] = "A simple survey designed to understand a persons relationship with university"; $usernames[] = "johnl"; $created[] = $updated[] = "2018-12-01"; $visibles[] = true;
    

// loop through the arrays above and add rows to the table:
    for ($i = 0; $i < count($titles); $i++) {
        $sql = "INSERT INTO surveys (title, message, username, created, updated, visible) VALUES ('$titles[$i]', '$message[$i]', '$usernames[$i]', '$created[$i]', '$updated[$i]', '$visibles[$i]')";

        // no data returned, we just test for true(success)/false(failure):
        if (mysqli_query($connection, $sql)) {
            echo "row inserted<br>";
        } else {
            die("Error inserting row: " . mysqli_error($connection));
        }
    }


//////////////// Questions table /////////////////


// if there's an old version of our table, then drop it:
    $sql = "DROP TABLE IF EXISTS questions";

// no data returned, we just test for true(success)/false(failure):
    if (mysqli_query($connection, $sql)) {
        echo "Dropped existing table: questions<br>";
    } else {
        die("Error checking for existing table: " . mysqli_error($connection));
    }

// make our table:
    $sql = "CREATE TABLE questions (questionid INT NOT NULL AUTO_INCREMENT, questiontype VARCHAR(64), description VARCHAR(256), surveyid INT NOT NULL, PRIMARY KEY (questionid), FOREIGN KEY (surveyid) REFERENCES surveys(surveyid))";

// no data returned, we just test for true(success)/false(failure):
    if (mysqli_query($connection, $sql)) {
        echo "Table created successfully: questions<br>";
    } else {
        die("Error creating table: " . mysqli_error($connection));
    }

    $questiontype[] = "Radio-button"; $description[]= "Do you like fruit?"; $surveyid[] = 1;

    $questiontype[] = "Paragraph"; $description[]= "Explain why enjoy fruit?"; $surveyid[] = 1;

    $questiontype[] = "Text-box"; $description[]= "What time of day do you like to eat fruit the most?"; $surveyid[] = 1;

    $questiontype[] = "Slider"; $description[]= "On a scale of 1 to 10 how much do you like fruit?"; $surveyid[] = 1;

    $questiontype[] = "Radio-button"; $description[]= "Do you like to play games?"; $surveyid[] = 2;

    $questiontype[] = "Paragraph"; $description[]= "What do you like about playing games?"; $surveyid[] = 2;

    $questiontype[] = "Text-box"; $description[]= "What console do you like to play games on?"; $surveyid[] = 2;

    $questiontype[] = "Slider"; $description[]= "On a scale of 1-10 how much do you like games?"; $surveyid[] = 2;

    $questiontype[] = "Radio-button"; $description[]= "Do you like University?"; $surveyid[] = 3;

    $questiontype[] = "Multiple-Choice"; $description[]= "What do you study?"; $surveyid[] = 3;

    $questiontype[] = "Text-box"; $description[]= "Which University do you attend?"; $surveyid[] = 3;



// loop through the arrays above and add rows to the table:
    for ($i = 0; $i < count($description); $i++) {
        $sql = "INSERT INTO questions (questiontype, description, surveyid) 
        VALUES ('$questiontype[$i]', '$description[$i]','$surveyid[$i]')";

        // no data returned, we just test for true(success)/false(failure):
        if (mysqli_query($connection, $sql)) {
            echo "row inserted<br>";
        } else {
            die("Error inserting row: " . mysqli_error($connection));
        }
    }



//////////////// Answers table /////////////////


// if there's an old version of our table, then drop it:
$sql = "DROP TABLE IF EXISTS answers";

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) {
    echo "Dropped existing table: answers<br>";
} else {
    die("Error checking for existing table: " . mysqli_error($connection));
}

// make our table:
$sql = "CREATE TABLE answers (pairid INT NOT NULL AUTO_INCREMENT, surveyid INT NOT NULL, questionid INT NOT NULL, username VARCHAR(32), answer VARCHAR(256), answerdate DATE,   PRIMARY KEY (pairid), FOREIGN KEY(surveyid) REFERENCES surveys(surveyid), FOREIGN KEY (questionid) REFERENCES questions(questionid), FOREIGN KEY (username) REFERENCES users(username))";

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) {
    echo "Table created successfully: answers<br>";
} else {
    die("Error creating table: " . mysqli_error($connection));
}

/*// put some data in our table:
$toydID = $listID = array(); // clear this array (as we already used it above)*/

// populate list 1
$surveyid[] = 1; $questionid[] = 1; $username[]= 'markw'; $answerdate[] = "2018-12-01";
$surveyid[] = 1; $questionid[] = 2; $username[]= 'markw'; $answerdate[] = "2018-12-01";
$surveyid[] = 1; $questionid[] = 3; $username[]= 'markw'; $answerdate[] = "2018-12-01";
$surveyid[] = 1; $questionid[] = 4; $username[]= 'markw'; $answerdate[] = "2018-12-01";
$surveyid[] = 2; $questionid[] = 5; $username[]= 'johnl'; $answerdate[] = "2018-12-01";
$surveyid[] = 2; $questionid[] = 6; $username[]= 'johnl'; $answerdate[] = "2018-12-01";
$surveyid[] = 2; $questionid[] = 7; $username[]= 'johnl'; $answerdate[] = "2018-12-01";
$surveyid[] = 2; $questionid[] = 8; $username[]= 'johnl'; $answerdate[] = "2018-12-01";
$surveyid[] = 2; $questionid[] = 9; $username[]= 'johnl'; $answerdate[] = "2018-12-01";
$surveyid[] = 2; $questionid[] = 10; $username[]= 'johnl'; $answerdate[] = "2018-12-01";
$surveyid[] = 2; $questionid[] = 11; $username[]= 'johnl'; $answerdate[] = "2018-12-01";
// loop through the arrays above and add rows to the table:
for ($i = 0; $i < count($questionid); $i++) {

        $sql = "INSERT INTO answers (surveyid, questionid, username, answerdate) VALUES ('$surveyid[$i]', '$questionid[$i]', '$username[$i]', '$answerdate[$i]')";
        // no data returned, we just test for true(success)/false(failure):
        if (mysqli_query($connection, $sql)) {
            echo "row inserted<br>";
        } else {
            die("Error inserting row: " . mysqli_error($connection));
        }
}






// reset checking for foreign key checks
$sql ="SET FOREIGN_KEY_CHECKS=1";
// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql))
{
    echo "Foreign key checks set to 1<br>";
}
else
{
    die("Error creating database: " . mysqli_error($connection));
}


// we're finished, close the connection:
mysqli_close($connection);
?>