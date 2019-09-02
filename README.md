
# Survey Website

The Calorie Counter App allows a user to recieve a personalised caloric maintenance figure, the calculation takes place one the user has registered an account on the app and entered the specified data.

## Getting Started
----
Run a server, XAMPP is recommended, load this entire folder into HTDOCS and then follow the steps below.

-> = navigate to
<h4>A survey must be taken before the results page will work!</h4>

(Regular account test. Username: "barrym", Password: "letmein".) 
Create Data -> Sign up/Sign in -> My Account -> Design and Analysis (Menu bar with toggle options for competitors)

Public Surveys -> Click on "Sample Survey" to view survey questions -> Take Survey -> Results -> "Click HERE to take the survey again" in order to re-take a survey -> Share this survey -> 

My Survey's -> Add a new survey -> Edit -> Update title/ Add Question / Update survey visibility -> Share survey -> Delete survey ->
----
(Admin account test. Username: "admin", Password: "secret".)
Create Data -> Sign in -> My Account -> Design and Analysis (Menu bar with toggle options for competitors

Public Surveys -> Click on "Sample Survey" to view survey questions -> Take survey -> Results -> "Click HERE to take the survey again" in order to re-take a survey -> Share this survey -> 

My Survey's -> Add a new survey -> Edit -> Update title/ Add Question / Update survey visibility -> Share survey -> Delete survey ->

Admin tools -> Users/Surveys (Admin has access to all surveys in this portion of the website) -> Edit/Delete surveys/users ->

 -> Sign out)

 -> Sign out

### Prerequisites
----
* XAMPP

### Installing
----

***


***


## Built With

* [Android Studio](https://developer.android.com/studio) - The IDE used to develop the app's functionality and UI.
* [Eclipse](https://maven.apache.org/) - The IDE used for the server and the RESTful functionality.


## Notes
----
* A survey must be taken before the results page will work!

Website currently has the functionality to:

* Sign up
* Sign in
User's can: 
-update all of their own account details except their username
-create survey's and add text-response questions to those surveys.
-share surveys
-delete and edit surveys (including change survey visibility and title/message of survey)
-take any public survey
-view the results of any public surveys, aswell as view the results of any surveys they have created
-update their previous answer responses on surveys.
-view the competitors analysis
Admin has access to all the same functionality of the user plus:
-able to edit/delete/share any survey created on the website
-create new users/delete or update existing users

## File Information
----
DOCUMENTATION:
...
The documentation for each file has been explained in the order which they occur, e.g. header and credentials are at the beginning of most other scripts and thus logically it is useful to explain the purpose and function of those scripts first.

Helper (The helper documents is the script used for the validation of input's on the system. E.g. when a password, or an email is entered, this script validates that input and ensures it meets the system expectations, for example ensuring that an email is longer than 8 characters but no longer than 64 characters, the same occurs for all other fields in the database to some extent of validation.)

Header (The header script runs first on almost every other script, it's purpose is to ensure that the credentials on each page are verified against the database. This script also serves the purpose of containing three navigation bars:
- One for a logged in user 
- Another for a logged out user
- A navigation bar for admin
The Header script also stores the script which powers the CSS and JavaScript functionality on the website.)

Credentials (This script allows the system to access the database to retrieve information.)

Create Data (Ensures that enough data is present for the system to work and operate, Admin account is also created at the same time with the username "admin" and the password "secret".)

Sign in (This particular script validates the details entered when the user attempts to sign in, this process occurs using the form which is embedded into the code.)

Account (The purpose of the account script is to allow users to view their own details and update everything besides their username. The script also validates and sanitises the updated information that the user is attempting to input)

Account_set (The purpose of the account script is to allow admin access to view and edit all the users' information. The script also validates and sanitises the updated information that the admin is attempting to input,)

Competitors (The competitors script holds all the information for the analysis on the competitors' websites. The entirety of these scripts are written using HTML, CSS and JavaScript. The page works based on a dropdown menu with four toggle button options for each competitor's website. All four buttons can be toggled at once to view all the competitors in a flowing document, however it is recommended to toggle a website as you are reading it, then toggle the button again for that website to disappear when you are )

Admin (The purpose of the admin script is to verify the user logged in, as well as be able to access other users' accounts in order to change their details.) In the admin area there is also access to various other scripts such as user_create, surveys, users and delete. These all provide the functionality to edit and manage the survey's and accounts of other users.

Sign out (The sign-out script executes once a user has been logged out, it ensures that the session is destroyed and an error message is displayed to the user to confirm they have been logged out.)

Footer (The footer is used to store university details and information)

About (At this current moment in time, no important data or functionality is stored in this script.)

/////////////////////////////////////////
