<?php


require_once "header.php";

$answer   = "";
$pairid   = "";
$username = "";
$surveyid = "";


// connect directly to our database (notice 4th argument):
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (isset($_GET['id'])) {
    $surveyid = $_GET['id'];
    
    
    // connect directly to our database (notice 4th argument):
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    // connection failed, return an error message
    if (!$connection) {
        die("Connection failed: " . $mysqli_connect_error);
    }
    
    //Query is used to select the results portion of the website, it outputs all users responses for each survey.
    $query2 = "SELECT questionid, description, answer, questiontype, username, a.surveyid FROM answers a INNER JOIN questions USING(questionid) GROUP BY username, questionid, answer ASC HAVING a.surveyid = $surveyid AND answer IS NOT NULL;"; 
echo "hello";
    
    // this query is to count particular responses, there is much development to be done here:
    $query3 = "SELECT COUNT(answer) FROM answers WHERE answer LIKE 'Yes';";  
    
    $query4 = "SELECT COUNT(answer), surveyid FROM answers GROUP BY answer HAVING surveyid = $surveyid AND answer LIKE 'Yes';";
       
    $result2 = mysqli_query($connection, $query2);
    $result3 = mysqli_query($connection, $query3);
    $result4 = mysqli_query($connection, $query4);


    
    
    // how many rows came back?:
    
    $n2 = mysqli_num_rows($result2);
    
    if ($n2) {
        echo "<br><h4>You are currently looking at survey number: $surveyid</h4>";
        // Also declares the table header for the table created.
        echo <<<_END
   <div class= "container">
    
        <table class="table">
        <thead>
        <tr>
        <th scope="col">Question ID</th>
        <th scope="col">Description</th>
        <th scope="col">Username</th>
        <th scope="col">Answer</th>
        </tr><br>
        <tr>
        </thead>
_END;
        // loop over all rows, adding them into our array.
        for ($i = 0; $i < $n2; $i++) {
            // use the identifier to fetch one row as an associative array (elements named after columns):
            $row         = mysqli_fetch_assoc($result2);
            $description = $row['description'];
            $questionid  = $row['questionid'];
            $answer      = $row['answer'];
            $username    = $row['username'];
            
         // The form below allows the data to be produced    for the table, it also allows the information to be parsed for the select query earlier in this php file.
            echo <<<_END
   
    <form action="surveys_view.php?questionid=$questionid" method="post">
    <tbody>
    <tr>

    <th scope="row">{$row['questionid']}</th>

  <td>{$row['description']}</td>
  <td>{$row['username']}</td>
  <td>{$row['answer']}</td>
  </tr>

  </tbody>
  </form>
 
        
        
      
_END;
            
            
        }
        
        //Code to retrieve the information for both counts.
        $row = mysqli_fetch_assoc($result3);
            $count = $row['COUNT(answer)'];
        
        $row = mysqli_fetch_assoc($result4);
            $count1 = $row['COUNT(answer)'];
        
        echo <<<_END
   
    
  </table>
          For question 9, $count users have entered the response 'Yes'
          <br><br>
          
          
         <h4> A total of $count1 users have taken this survey! </h4>

</div>
        
        
        
      
_END;
        
    } 
    elseif ($surveyid == 3)
        {
        
        $query3 = "SELECT * FROM answers INNER JOIN questions ON answers.questionid=questions.questionid HAVING answers.surveyid = 3 AND answer IS NOT NULL;";   
    // this query can return data ($result is an identifier):   
    $result3 = mysqli_query($connection, $query3);
        $n3 = mysqli_num_rows($result3);
    
    if ($n3) {
        echo "<br><h4>You are currently looking at survey number: $surveyid</h4>";
        // Also declares the table header for the table created.
        echo <<<_END
   <div class= "container">
    
        <table class="table">
        <thead>
        <tr>
        <th scope="col">Question ID</th>
        <th scope="col">Description</th>
        <th scope="col">Username</th>
        <th scope="col">Answer</th>
        </tr><br>
        <tr>
        </thead>
_END;
        
        for ($i = 0; $i < $n3; $i++) {
            // use the identifier to fetch one row as an associative array (elements named after columns):
            $row         = mysqli_fetch_assoc($result3);
            $description = $row['description'];
            $questionid  = $row['questionid'];
            $answer      = $row['answer'];
            $username    = $row['username'];
            
         // The form below allows the data to be produced    for the table, it also allows the information to be parsed for the select query earlier in this php file.
            echo <<<_END
   
    <form action="surveys_view.php?questionid=$questionid" method="post">
    <tbody>
    <tr>

    <th scope="row">{$row['questionid']}</th>

  <td>{$row['description']}</td>
  <td>{$row['username']}</td>
  <td>{$row['answer']}</td>
  </tr>

  </tbody>
  </form>
 
        
        
      
_END;
            
            
        }
        
        echo <<<_END
   
    
  </table>
</div>
        
        
        
      
_END;

        }
    }
    
    else {
        
        echo "Empty Survey Results";
    }
    
    // we're finished with the database, close the connection:
    mysqli_close($connection);
    
    // if we got some results then add them all into a big array:
    
    
}
// we're finished with the database, close the connection:


// finish of the HTML for this page:
require_once "footer.php";

?>