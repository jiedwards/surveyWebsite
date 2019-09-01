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
    
    
    
    if (isset($_POST['userdelete1'])) {
        $username = ($_POST['userdelete1']);
        //when the button to delete a survey is clicked, it executes this function and deletes in the appropriate order. */
        $connection    = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        $deletequery1  = "DELETE from answers WHERE username = '$username';";
        $deletequery2  = "DELETE from surveys WHERE username = '$username';";
        $deletequery   = "DELETE from users WHERE username = '$username';";
        $deleteresult1 = mysqli_query($connection, $deletequery1);
        $deleteresult2 = mysqli_query($connection, $deletequery2);
        $deleteresult  = mysqli_query($connection, $deletequery);
        
        
        
        if ($deleteresult) {
            echo "Successfully deleted a user";
        } else {
            echo "Failed to delete the user";
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
    
    // check for a row in our users table with a matching username:
    $selectquery = "SELECT * FROM users";
    
    // this query can return data ($selectresult is an identifier):
    $selectresult = mysqli_query($connection, $selectquery);
    
    // how many rows came back? (can only be 1 or 0 because username is the primary key in our table):
    $n = mysqli_num_rows($selectresult);
    //Table declaration     
    
    echo <<<_END
   
    <div class= "container">
    
        <table class="table table-hover">
        <thead>
        <tr>
        <th scope="col">Users</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Email</th>

        </tr><br>
        <tr>
        </thead>

_END;
    
    //**New Comment**For loop is used to fetch and print the usernames and other information from the database into a table.    
    for ($i = 0; $i < $n; $i++) {
        // use the identifier to fetch one row as an associative array (elements named after columns):
        $row       = mysqli_fetch_assoc($selectresult);
        $username  = $row['username'];
        $firstname = $row['firstname'];
        $lastname  = $row['lastname'];
        $email     = $row['email'];
        
        
        
        
        echo <<<_END
       <tbody>
        <tr>
    <td>{$row['username']}</td>
    <td>{$row['firstname']}</td>
    <td>{$row['lastname']}</td>
    <td>{$row['email']}</td>
    

    <td><a href="account_set.php?username={$username}" class="btn btn-warning" role="button">Edit</a></td>
    <td><form action="" method="POST">
    <input type="hidden" name="userdelete1" value="$username"><button type="submit" class="btn btn-danger">Delete</button></td>
        </form>
        </tr>
        </tbody>
        
        
      
_END;
        
        
        
    }
    echo "</table>";
    echo "<a href='admin_usercreate.php'>Add New User</a>";
    
    
    
    
    
} else {
    echo "You don't have permission to view this page...<br>";
}
mysqli_close($connection);


// finish off the HTML for this page:
require_once "footer.php";
?>