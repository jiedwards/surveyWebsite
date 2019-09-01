<?php


// execute the header script:
require_once "header.php";

$first_name = "";
$last_name  = "";
$email      = "";


if (!isset($_SESSION['loggedInSkeleton'])) {
    // user isn't logged in, display a message saying they must be:
    echo "You must be logged in to view this page.<br>";
} else
// only display the page content if this is the admin account (all other users get a "you don't have permission..." message):
    if ($_SESSION['username'] == "admin") {
        //if username = admin then the information below is displayed and the page will allow a delete query to be executed.
    
    echo "Implement the admin tools here... See the assignment specification for more details.<br>";
    
    if (isset($_POST['userdelete1'])) {
        $username = ($_POST['userdelete1']);
        
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        echo $username;
        $deletequery = "DELETE from users WHERE username = $username";
        echo $deletequery;
        $deleteresult = mysqli_query($connection, $deletequery);
        echo $deleteresult;
        
        
        if ($result) {
            echo "Success";
        } else {
            echo "Failed";
        }
        
        
        
        // if the connection fails, we need to know, so allow this exit:
        if (!$connection) {
            die("Connection failed: " . $mysqli_connect_error);
        }

    }
    
    
    // now read their account data from the table...
    // connect directly to our database (notice 4th argument):
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    // if the connection fails, we need to know, so allow this exit:
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
    
    // check for a row in our profiles table with a matching username:
    $query = "SELECT * FROM users";
    
    // this query can return data ($result is an identifier):
    $result = mysqli_query($connection, $query);
    
    // how many rows came back? (can only be 1 or 0 because username is the primary key in our table):
    $n = mysqli_num_rows($result);
    //Table declaration     
    echo "<table>
        <tr>
        <th>Users</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        </tr>";
    //**New Comment**For loop is used to fetch and print the usernames from the database.    
    for ($i = 0; $i < $n; $i++) {
        // use the identifier to fetch one row as an associative array (elements named after columns):
        $row       = mysqli_fetch_assoc($result);
        $username  = $row['username'];
        $firstname = $row['firstname'];
        $lastname  = $row['lastname'];
        $email     = $row['email'];
        
        echo <<<_END
       <table>
        <tr>
    <!-- This particular code is to href the fetched names to their individual profiles -->
    <td>{$row['username']}
    {$row['firstname']}
    {$row['lastname']}
    {$row['email']}</td>

    <td><a href="account_set.php?username={$username}" class="btn btn-warning" role="button">Edit</a></td>
    <td><form action="" method="POST">
        <input type="hidden" name="userdelete1" value="$username">
        <button type="submit" class="btn btn-danger">Delete</button>
        </form></td>
        </tr>
        </table>
      
_END;
        
        
        
    }
    
    
} else {
    echo "You don't have permission to view this page...<br>";
}
mysqli_close($connection);


// finish off the HTML for this page:
require_once "footer.php";
?>