<?php

// execute the header script:
require_once "header.php";

echo <<<_END
 
<div id="aboutpage">
<p>6G5Z2107 - 2CWK50 - 2018/19 </p>
<p><Jacob Edwards> </p>
<p><17093475> </p>

<h4>Website Testing Protocol</h4>

<p>SETUP: </p>

<p>-> = navigate to </p>
--------------------------------------
<h4>A survey must be taken before the results page will work!</h4>
<br>
<p>(Regular account test. Username: "barrym", Password: "letmein".) </p>

<p>Create Data -> Sign up/Sign in -> My Account -> Design and Analysis (Menu bar with toggle options for competitors) -> 
<br><br>
Public Surveys -> Click on "Sample Survey" to view survey questions -> Take Survey -> Results -> "Click HERE to take the survey again" in order to re-take a survey -> Share this survey -> 
<br><br>

My Survey's -> Add a new survey -> Edit -> Update title/ Add Question / Update survey visibility -> Share survey -> Delete survey ->

<br><br>
->  Sign out </p>
--------------------------------------
<p>(Admin account test. Username: "admin", Password: "secret". </p>

<p>Create Data -> Sign in -> My Account -> Design and Analysis (Menu bar with toggle options for competitors) ->
<br><br>
Public Surveys -> Click on "Sample Survey" to view survey questions -> Take survey -> Results -> "Click HERE to take the survey again" in order to re-take a survey -> Share this survey -> 
<br><br>

My Survey's -> Add a new survey -> Edit -> Update title/ Add Question / Update survey visibility -> Share survey -> Delete survey ->

<br><br>
Admin tools -> Users/Surveys (Admin has access to all surveys in this portion of the website) -> Edit/Delete surveys/users ->

<br><br>
Sign out) </p>

<h3>/////////////////*All other survey's have text-only responses.*//////////////////</h3>
<br>

<h4>Website currently has the functionality to:</h4>

Sign up
Sign in
User's can:
<li>-update all of their own account details except their username</li>
<li>-create survey's and add text-response questions to those surveys.</li>
<li>-share surveys</li>
<li>-delete and edit surveys (including change survey visibility and title/message of survey)</li>
<li>-take any public survey</li>
<li>-view the results of any public surveys, aswell as view the results of any surveys they have created</li>
<li>-update their previous answer responses on surveys.</li>
<li>-view the competitors analysis</li>
Admin has access to all the same functionality of the user plus:
<li>-able to edit/delete/share any survey created on the website</li>
<li>-create new users/delete or update existing users</li>


<br>
--------------------------------------
<p>DOCUMENTATION: </p>
<p>...</p>
<p>The documentation for each file has been explained in the order which they occur, e.g. header and credentials are at the beginning of most other scripts and thus logically it is useful to explain the purpose and function of those scripts first.</p>

<p>- Helper (The helper documents is the script used for the validation of input's on the system. E.g. when a password, or an email is entered, this script validates that input and ensures it meets the system expectations, for example ensuring that an email is longer than 8 characters but no longer than 64 characters, the same occurs for all other fields in the database to some extent of validation.)</p>

<p>- Header (The header script runs first on almost every other script, it's purpose is to ensure that the credentials on each page are verified against the database. This script also serves the purpose of containing three navigation bars: </p>
<ul>
<li>- One for a logged in user </li> 
<li>- Another for a logged out user </li>
<li>- A navigation bar for admin </li>
</ul>
<p>The Header script also stores the script which powers the CSS and JavaScript functionality on the website.) </p>



<p>- Credentials (This script allows the system to access the database to retrieve information.) </p>

<p>- Create Data (Ensures that enough data is present for the system to work and operate, Admin account is also created at the same time with the username "admin" and the password "secret".) </p>

<p>- Sign in (This particular script validates the details entered when the user attempts to sign in, this process occurs using the form which is embedded into the code.) </p>

<p>- Account (The purpose of the account script is to allow users to view their own details and update everything besides their username. The script also validates and sanitises the updated information that the user is attempting to input) </p>

<p>- Account_set (The purpose of the account script is to allow admin access to view and edit all the users' information. The script also validates and sanitises the updated information that the admin is attempting to input,) </p>

<p>- Competitors (The competitors script holds all the information for the analysis on the competitors' websites. The entirety of these scripts are written using HTML, CSS and JavaScript. The page works based on a dropdown menu with four toggle button options for each competitor's website. All four buttons can be toggled at once to view all the competitors in a flowing document, however it is recommended to toggle a website as you are reading it, then toggle the button again for that website to disappear when you are ) </p>

<p>- Admin (The purpose of the admin script is to verify the user logged in, as well as be able to access other users' accounts in order to change their details.) In the admin area there is also access to various other scripts such as user_create, surveys, users and delete. These all provide the functionality to edit and manage the survey's and accounts of other users. </p>

<p>- Sign out (The sign-out script executes once a user has been logged out, it ensures that the session is destroyed and an error message is displayed to the user to confirm they have been logged out.) </p>

<p>- Footer (The footer is used to store university details and information) </p>

<p>- About (At this current moment in time, no important data or functionality is stored in this script.) </p>
<br>
///////////////* In no particular order after this point is *///////////// <br>

<br><p>- Questions_update - (This script file contains the information and queries to execute updates on questions when they are being edited by their creator or admin.)</p>

<p>- Responses_delete - (This script file contains the information and queries to execute an update to their previous survey's responses if that particular user wants to retake a survey.)</p>

<p>- Surveys_titleupdate - (This script file contains the information and queries to execute an update to the title of a survey.)  </p>

<p>- Surveys_edit - (This script file contains the information and queries to execute edit's and modifications to a survey's properties, such as survey visibility, adding questions etc.) </p>

<p>- Surveys_manage - (This script file contains queries which produces the information on the My Survey's section of the website, it also contains forms with information that is parsed to be able to delete a survey, share a survey, edit a survey etc.)</p>

<p>- Surveys_new - (This script file contains the functionality which allows the website to create a new survey.)</p>

<p>- Surveys_public - (Similar to Surveys_manage, this script file contains queries which produces the information on the Public Surveys section of the website, it also contains forms with information that is parsed to be able to take a survey, re-take a survey, share a survey etc.)</p>

<p>- Surveys_results - (This script file contains the functionality which allows the website to produce the results and responses for each survey taken on the website)</p>

<p>- Surveys_sharing - (This script file contains the functionality which allows the website to produce a link in order to share the survey.)</p>

<p>- Surveys_view - (This script file contains the functionality which displays the questions on each survey. Essentially allowing a user to view a survey before they decide to complete it.)</p>

</div>
_END;
require_once "footer.php";

?>