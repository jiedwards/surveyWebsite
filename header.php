<?php

// Things to notice:
// This script is called by every other script (via require_once)
// It begins the HTML output, with the customary tags, that will produce each of the pages on the web site
// It starts the session and displays a different set of menu links depending on whether the user is logged in or not...
// ... And, if they are logged in, whether or not they are the admin
// It also reads in the credentials for our database connection from credentials.php

// database connection details:
require_once "credentials.php";

// our helper functions:
require_once "helper.php";

// start/restart the session:
session_start();

if (isset($_SESSION['loggedInSkeleton'])) {
    // THIS PERSON IS LOGGED IN
    // show the logged in menu options:
    //**New Comment** This php file is at the top of each page and thus ensures the credentials and other importants aspects of the website such as the CSS run each time a page loads. The choice of CSS is a combination of bootstrap and a custom style sheet.
    echo <<<_END
<!DOCTYPE html>
<html>
<head><title>A Survey Website</title>
<link rel="stylesheet" href="web/styles.css" type="text/css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="web/script.js"></script>

</head>


<body>
  <div class="container">


<nav class="w-25 container navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="about.php">Jacob's Smashing Survey's <span class="    glyphicon glyphicon-list-alt"</a>
    </div>
    <ul class="nav navbar-nav">
      <li class=""><a href="about.php">About</a></li>
      <li class=""><a href="account.php">My Account</a></li>
      <li class=""><a href="surveys_public.php">Public Survey's</a></li>
      <li class=""><a href="surveys_manage.php">My Survey's</a></li>
      <li class=""><a href="competitors.php">Design and Analysis</a></li>

    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="sign_out.php"><span class="glyphicon glyphicon-log-out"></span> Logout ({$_SESSION['username']})</a></li>

</body>
</nav>


_END;
    // add an extra menu option if this was the admin:
    if ($_SESSION['username'] == "admin") {
        
        echo <<<_END
                
                <a class="btn btn-info btn-lg btn-block" href="admin.php" role="button">Admin Tools</a>

                
                </div>
                </nav>
                </html>
_END;
        
    }
} else {
    // THIS PERSON IS NOT LOGGED IN
    // show the logged out menu options:
    
    echo <<<_END
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="web/styles.css" type="text/css">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="web/script.js"></script>
</head>
<body>

<nav class="w-25 container navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="about.php">Jacob's Smashing Survey's <span class="    glyphicon glyphicon-list-alt"</a>
    </div>
    <ul class="nav navbar-nav">
      <li class=""><a href="about.php">Home</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    
      <li><a href="sign_up.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="sign_in.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>

</body>
_END;
}
echo <<<_END
<br>
<h1>2CWK50: A Survey Website</h1>
_END;
?>