<?php

// Things to notice:
// You need to add your Analysis and Design element of the coursework to this script
// There are lots of web-based survey tools out there already.
// It’s a great idea to create trial accounts so that you can research these systems. 
// This will help you to shape your own designs and functionality. 
// Your analysis of competitor sites should follow an approach that you can decide for yourself. 
// Examining each site and evaluating it against a common set of criteria will make it easier for you to draw comparisons between them. 
// You should use client-side code (i.e., HTML5/JavaScript/jQuery) to help you organise and present your information and analysis 
// For example, using tables, bullet point lists, images, hyperlinking to relevant materials, etc.

// execute the header script:
require_once "header.php";

if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
else
{

    echo <<<_END
<!DOCTYPE html>
<html>
<head><title>A Survey Website</title>

</head>
<body>
<!-- **New Comment**Data is being stored in a div to serve as a container to help align the information. The information has been categorised based on the individual competitor, they have been stored in a menu which operates based on a toggle function, ensuring that once a button has been pressed that information will stay present on the page until that specific button is toggled again.-->
		<div id="outermenu">
			<h1><font color="red">Menu</font></h1>
			<ul class="menu">
				<li id="googleforms">Google Forms</li>
				<li id="surveymonkey">Survey Monkey</li> 
				<li id="typeform">Typeform</li> 
				<li id="zohosurvey">Zoho Survey</li> <br>
			</ul>
		</div>
		
		<div id="googleforms">
			<h1>Google Forms</h1>
            
        <h3>Layout</h3>
            
            <img class="img-responsive" src="images/Google_Forms/Google_Forms_Homepage_2.png" width="70%" height="70%"  alt="Homepage">
            
            <img class="img-responsive" src="images/Google_Forms/Google_Forms_Mobile.png" width="30%" height="30%" alt="Homepage">      
            
			<p>Google Forms' homepage is exactly what you should expect from a modern website, responsive and dynamic to different devices without any glitches or notches. Appears incredibly attractive, simple with very little clutter or unnecessary images or ads. 10/10 for the landing page.</p>
          
        <h3>Sign-up process</h3>
        
            <img class="img-responsive" src="images/Google_Forms/Google_signup.png" width="70%" height="70%" alt="Homepage">
            
            <p>In order to sign up and use Google Forms the website requires you to create a google account, which is useful as it includes access to other useful tools, such as Google Sheets which you can use to analyse data and produce visual data representations. The data they require to sign up is as follows:</p>     
            <ul>
            <li>	First name </li>
            <li>	Last name </li>
            <li>	Username (which will be turned into an email address) </li>
            <li>	Password </li>
            <li>	Phone number to confirm the identity </li>
            </ul>
            <p>All in all, it takes roughly 2-3 minutes to sign up and the amount of data they expect is reasonable considering the service they are providing.</p>
            
            
        <h3>Sign-in process</h3>
        

            <p>Logging into Google in order to use the service is a very simple process, they effectively remember and store log-in information based on if the device is recognised, to log in all they require is the username and password created during the sign-up process. However, for an extra layer of security if the device isn't recognised they offer to text/call the mobile number entered upon registration to confirm the account holder.</p>
            
            
        <h3>Ease of use</h3>
        
            <img class="img-responsive" src="images/Google_Forms/Google_help.png"  width="70%" height="70%" alt="Homepage">
            
            <p>The features included with the account are easily accessible and readily available on the account created, there are no ads present and Google Forms has readily available sections on the website to provide tours (guide on how to use Google Forms), along with help/support for where the short-and-sweet tour may fall short of answers.</p>

            <p>As mentioned as part of the sign-up portion of the analysis, there are no debit/credit details taken, so there is no risk of being charged e.g. after a trial period.</p>

            <p>The option to create a new form/survey is immediately available and noticeable once you are logged in, it is almost the only option available and all text leads towards creating a survey or using a template.
            </p>


        <h3>Survey Features</h3>
        
            <img class="img-responsive" src="images/Google_Forms/Google_answer_choice.png" width="70%" height="70%" alt="Responses">
            
            <p>As part of the survey creation process you have access to a variety of features and functionality in order to enhance the survey experience for the user and diversify the range and type of results to analyse.</p>

            <p>Below are the features available on Google Forms compared to the features expected:</p>
            
            <ul>
            <li>Images for survey: Yes</li>
            <li>Limited Functionality based on account type: No</li>
            <li>Different types of questions (e.g. numeric, text, checkbox etc): Yes</li>
            <li>Variety of answers (checkbox, multiple choice, linear answer scale, paragraph, drop-down answers etc): Yes</li>
            <li>Device compatibility (No extra cost to build or complete a survey on other devices): Yes</li>
            </ul>
            
            
            <img class="img-responsive" src="images/Google_Forms/Google_templates.png" width="70%" height="70%" alt="Responses">
            
            <p>A variety of templates are available for free, although they are not specifically used or developed for survey's, so a considerable amount of editing is required to use any of them as a survey.</p>
            
            <img class="img-responsive" src="images/Google_Forms/Google_link.png" width="70%" height="70%" alt="Sharing">
            
            <img class="img-responsive" src="images/Google_Forms/Google_emailform.png" width="70%" height="70%" alt="Sharing">
            
            <p>Arguably the best and most convenient feature of the whole process is the ease and ability to share the survey via URL or e-mail. It is as simple as two clicks, with the option to add a message if sending via email, or shorten the link if sharing via URL.</p>


        <h3>Analysis of data functionality</h3>
        
            <img class="img-responsive" src="images/Google_Forms/Google_analysis.png" width="70%" height="70%" alt="Analysis">
            
            <p>The ability to analyse data is an included feature within Google Forms, although there isn't an option to choose which data representation is chosen for each question (e.g. it appears impossible to display all information using pie charts, unless you personally produced them via using the spreadsheets)</p>

            <img class="img-responsive" src="images/Google_Forms/Google_export.png" width="70%" height="70%" alt="Export">
            
            <p>The option to export data is ready and present, there is no hassle involved in retrieving the information, it is exported as a simple CSV file straight to your device, ready to be utilised however the user wishes.</p>
            
            
        <h3>Account capabilities and features</h3>
        

            <p>Account features are clearly listed to an extent, they list the basic user expectations of the website clear on the landing page, which are:</p>
            
            <ul>
            <li>Create forms</li>
            <li>Edit forms e.g. include images, logos, choose survey responses</li>
            <li>Available forms are responsive</li>
            <li>Ability to produce visual representation of data</li>
            </ul>
            
            <p>However, because there are no premium options it is not exactly clear what is available to use until you toggle all the options and see what is available, e.g. the features do not mention being able to share the form, templates also aren't mentioned.</p>
            
            <p>The features available on the account at Google Forms are exceptional, especially when compared to the free options available from their competitors.</p>
            
        <h3>Summary of website</h3>
        

            <p>Google Forms is most certainly a website to be recommended to anybody and looked upon favourably, it is free and an incredibly useful tool to have as a business, student, professional etc.</p>

            <p>The feature which is incredibly impressive is the responsiveness of the website, regardless of device it is just as simple and easy to create, complete or edit a survey on a mobile as it is on a laptop.</p>
            
            <p>It was amazingly difficult to find much negative comments with regards to say about Google Forms, the only improvement which could be considered is the degree of customisation they could allow to be implemented within their forms.</p>

            <p>Rating for features accessible on a scale of 1 to 5: 4.5</p>
            <p>Rating for display and presentation on a scale of 1 to 5: 5</p>
            
            <p>Combined rating on a scale of 1 to 10: 9.5</p>
		</div>
		
		<div id="surveymonkey">
			<h1>Survey Monkey</h1>
            
        <h3>Layout</h3>

            <img class="img-responsive" src="images/Survey_Monkey/SurveyMonkey_homepage1.png" width="70%" height="70%" alt="Homepage">
            
            <img class="img-responsive" src="images/Survey_Monkey/SurveyMonkey_mobile.png" width="30%" height="30%" alt="Homepage">

			<p>The presentation of the website is pretty incredible. It is extremely responsive and dynamic, but more importantly it is straight to the point. Survey Monkey immediately mention "Global leader in survey software", so with that information it is clear you're at the right place and the sign-up option is also immediately available, the website looks great on either a mobile or a different device.</p>
          
        <h3>Sign-up process</h3>
        
            <img class="img-responsive" src="images/Survey_Monkey/SurveyMonkey_signup.png" width="50%" height="50%" alt="Signup">
            
            <img class="img-responsive" src="images/Survey_Monkey/SurveyMonkey_preferences.png" width="50%" height="50%" alt="Signup">
            
            <img class="img-responsive" src="images/Survey_Monkey/SurveyMonkey_preferences2.png" width="50%" height="50%" alt="Signup">
            
            <p>The information Survey Monkey required to sign up initially is a regular amount, comparable with the other companies which have been analysed, they require:</p>     
            <ul>
            <li>Username </li>
            <li>Password </li>
            <li>Email </li>
            <li>First name</li>
            <li>Last name</li>
            </ul>
            <p>Survey Monkey also has the added benefit of allowing you to sign up with other social media accounts such as: Google, LinkedIn and Facebook. It takes roughly a minute or two to enter your initial information. Following the sign-up, the next page you are redirected to is to personalise your account, by choosing the type of user you are e.g. personal, professional or student etc. and also why you require the services of the website, with this information you are now recommended suggestions on which type of templates they will commonly display for you.</p>
            
            
        <h3>Sign-in process</h3>
        
            <img class="img-responsive" src="images/Survey_Monkey/SurveyMonkey_signin.png" width="70%" height="70%" alt="Signin">

            <p>The log-in process is as simple as a Username and Password, the option for the website to remember your data based on the device is as an added benefit, which reduces the time spent on the log-in process. Survey Monkey also has the added benefit of allowing you to log-in via other social media platforms, which also reduces time spent entering details.</p>
            
            
        <h3>Ease of use</h3>
            
            <p>The website and process to create a survey is impressive e.g. when developing a survey, there is a flow chart displaying which step you are on, and what else is involved. This particular feature of the website clarifies where you are at all times, thus making the process simple, with no added surprises. The option to share the survey is also impressive, there is a wider range of options to share a survey than any other competitor has to offer, they offer methods such as:</p>
            
            <ul>
            <li>Facebook Messenger </li>
            <li>Sharing on Social Media </li>
            <li>URL Link </li>
            <li>QR Code</li>
            <li>Buy responses</li>
            </ul>

            <p>The buying responses is the most impressive option available, if for example there was some information a user wanted to find out but didn't have enough recipients to share the data with, buying responses is a useful way to receive unbiased data responses.</p>
            
            <img class="img-responsive" src="images/Survey_Monkey/SurveyMonkey_URLandQR.png" width="70%" height="70%" alt="Sharing">
            
            <img class="img-responsive" src="images/Survey_Monkey/SurveyMonkey_shareableoptions.png" width="70%" height="70%" alt="Sharing">

        <h3>Survey Features</h3>
        
            <img class="img-responsive" src="images/Survey_Monkey/SurveyMonkey_responses.png" width="70%" height="70%" alt="Shaing">
            
            <img class="img-responsive" src="images/Survey_Monkey/SurveyMonkey_responsevariance.png" width="70%" height="70%" alt="Sharing">
        
            <p>The features offered by Survey Monkey are actually incredible, especially when compared to the competitors which have been reviewed. A plethora of survey response options are available at the consumer's use such as: </p>
            
            <ul>
            <li>Multiple Choice </li>
            <li>Checkboxes </li>
            <li>File Upload </li>
            <li>Dropdown</li>
            <li>Single text box response</li>
            </ul>
            
            <p>Listed above are a only a few of the options for responses are available at no extra cost. The survey also has additional features which are available such as; changing the colour of the text on individual response options, including images in responses and much more.</p>
            
            <p>Two standout features which are provided are:</p>
            
            <ul>
            <li>Survey Monkey has an algorithm which processes the question you input into the question field, the algorithm then produces the type of survey response they predict you will likely choose, thus saving the user time in creating the survey </li>
            <li>Secondly, in the column on the left hand side when creating the survey, there is a pre-set variety of questions you can choose and use depending on the survey category.</li>
            </ul>


        <h3>Analysis of data functionality</h3>
            
            <p>On Survey Monkey the options to analyse the data far excels any of the options given by the competitor websites, there is a variety of options such as:</p>
            
            <ul>
            <li>Bar Chart </li>
            <li>Pie Chart </li>
            <li>Line Chart </li>
            <li>Column Chart</li>
            </ul>
            
            <p>The transition between producing a chart is also seamless and an stress-free experience. The only negative aspect in the data analysis service provided by Survey Monkey is that there is no absolutely no option to export the data whilst on a free membership, which is a feature all of the competitors offer.</p>
            
            <img class="img-responsive" src="images/Survey_Monkey/SurveyMonkey_visualrepresentations.png" width="70%" height="70%" alt="Analysis">
            
            
        <h3>Account capabilities and features</h3>
        
            <img class="img-responsive" src="images/Survey_Monkey/SurveyMonkey_pricing.png" width="70%" height="70%" alt="Features">
        
            <p>Survey Monkey features are not clearly listed on the front-page for the free account, however, they show all the features and prices available for their paid accounts on the front-page. Only with further research, the features for the free account are available to locate. The features on the free account aren't recommended at all compared to their competitors, there are a few added benefits by opting to use Survey Monkey such as response types and pre-made questions, however they are outweighed by the lack of exporting option which would result in the user being required to manually analyse their response data. </p>
            
            <p>The strategy employed by Survey Monkey by offering a great but limited supply of the exceptional benefits is most likely a strategy to entice users into upgrading their account, in order to make full use of the benefits and the data.</p>
            
        <h3>Summary of website</h3>
        

            <p>Survey Monkey is 100% a competitor to be taken seriously and would be recommended by many. In terms of ease of use it isn't the most simple website to build a survey on due to an extremely wide array of options, however if the person is computer-savvy and/or willing to learn, Survey Monkey is arguably the best survey website currently on the market when used with an upgraded account. The free option however pales in comparison to Google Forms, who for example offer many of the benefits offered by Survey Monkey with no associated cost.</p>

            <p>The most impressive aspect's available on Survey Monkey's website is certainly the algorithm implemented to predict the type of survey response the user is likely to use, along with the other smart techniques the company are implementing in order to speed up the process of creating the survey, e.g. social media login, pre-made questions.</p>
            
            <p>The disappointing aspect of the company website is the lack of information provided to the user on what is available for a free account, the use of the immediate sign-up button on the home-screen is enticing enough to prompt a user into creating an account and developing a survey, only to find out they will have to upgrade in order to receive an analysis of their results. This may or may not be a tactic employed by the company in order to secure memberships, however it is certainly an aspect which should be addressed and clearly identified to the user.</p>

            <p>Rating for features accessible on a scale of 1 to 5: 5</p>
            <p>Rating for display and presentation on a scale of 1 to 5: 4</p>
            
            <p>Combined rating on a scale of 1 to 10: 9</p>
		</div>
		
		<div id="typeform">
			<h1>Type Form</h1>
            
        <h3>Layout</h3>
            
            <img class="img-responsive" src="images/Typeform/Typeform_homepage2.png" width="70%" height="70%" alt="Homepage">
            
            <img class="img-responsive" src="images/Typeform/Typeform_mobilehomepage.png" width="30%" height="30%" alt="Homepage">
            
			<p>The homepage provides a mixed feeling response, it is most certainly modern, responsive and dynamic. However, there is some unnecessary and hard-to-understand information present (e.g. Nuvis app which is present on the page, but with not much context).</p>
            
			<p>Ultimately, the landing page is a solid choice due to it working on all screen sizes with no present bugs, also having the sign-up option readily available is always a plus.</p>
          
        <h3>Sign-up process</h3>
        
            <img class="img-responsive" src="images/Typeform/Typeform_verification.png" width="70%" height="70%" alt="Signup">
            
            <p>The sign-up process is pretty routine and similar to the competitors' process, the information which is required to sign up is:</p>     
            <ul>
            <li>Name </li>
            <li>Email </li>
            <li>Password </li>
            <li>CAPTCHA (to ensure the account isn't a bot)</li>
            <li>E-mail verification</li>
            </ul>
            <p>The information requirement is a suitable amount of data for Typeform to collect, it should take roughly 3-4 minutes to sign up with the e-mail verification included.</p>
            
            
        <h3>Sign-in process</h3>
        
            <p>The log-in process is very simple and can be automated if the browser stores the sign-in details, all that is required to sign-in is the username and password which was chosen upon the creation of the account. Typeform also has the added option of logging in via Google, Facebook or LinkedIn.</p>
            
            
        <h3>Ease of use</h3>
        
            <img class="img-responsive" src="images/Typeform/Typeform_matching.png" width="70%" height="70%" alt="Sharing">
            
            <img class="img-responsive" src="images/Typeform/Typeform_templates.png" width="70%" height="70%" alt="templates">
            
            <p>Upon logging in for the first time, you're presented with a variety of options to choose from so Typeform can recommend specific templates depending on your reason for using the service, "personal" was chosen as it seemed like the most suitable option, a page with a wide variety of templates appeared with a dropdown menu to filter options. </p>

            <p>There was no option for Quizzes or Surveys and thus had to use the browsers search function to narrow down the options.</p>
            
            <p>Using the templates service was mildly confusing, so the option to create from scratch was selected. Not taking into account the previous step it took to appear at this stage, creating the survey from scratch was an immensely pleasant experience. All the features accessible on the free account are easily accessible and available to be utilised.</p>
            
        <h3>Survey Features</h3>
        
            <p>As part of the survey creation process you have access to a variety of features and functionality in order to enhance the survey experience for the user and diversify the range and type of results to analyse. </p>
            
            <p>Below are the features available on Typeform compared to the features expected:</p>
            
            <img class="img-responsive" src="images/Typeform/Typeform_questionvariety.png" width="70%" height="70%" alt="Questions">
            
            <ul>
            <li>Images for survey: Yes </li>
            <li>Limited Functionality based on account type: Yes, considerably</li>
            <li>Different types of questions (e.g. numeric, text, checkbox etc.): Yes</li>
            <li>Variety of answers (checkbox, multiple choice, linear answer scale, paragraph, drop-down answers etc): Yes</li>
            <li>"	Device compatibility (No extra cost to build or complete a survey on other devices): Yes</li>
            </ul>
      
            <img class="img-responsive" src="images/Typeform/Typeform_email.png" width="70%" height="70%" alt="Email">
            
            <p>The ability to share a URL was easily available and only took two clicks. However, to send an e-mail was considerably more confusing, as displayed in the image above in order to send the survey as an e-mail required the form to have no Welcome Screen present and the initial question must be an Opinion Scale question. More confusingly there was no immediate information or explanation why this was the case, to find out required having to dig through their Help Center. </p>

        <h3>Analysis of data functionality</h3>
            
            <img class="img-responsive" src="images/Typeform/Typeform_data.png" width="70%" height="70%" alt="Export">
            <br>
            <img class="img-responsive" src="images/Typeform/Typeform_export.png"  width="70%" height="70%" alt="Export">
            
            <p>There is an option readily available and present to export the data, they offer a simple download option in the form of either a CSV or XLS file.</p>

            <p>Typeform offer a very simple data analysis, they convert the results into bar-charts making the information easier to read and understand than simply seeing results, however it can be made more personalised if the option was available to see various options of visual data representation.</p>    
            
        <h3>Account capabilities and features</h3>
        
            <img class="img-responsive" src="images/Typeform/Typeform_features.png" width="70%" height="70%" alt="Features">
        
            <p>The features are clearly listed and the pricing options are also available, the features available on a free account are reasonable depending on the user's requirements, if the user only requires one survey per month or less then Typeform is more than suitable, however if the user would like to use a survey service regularly at a cheap cost then there are certainly more suitable options available to the user.</p>
            
        <h3>Summary of website</h3>
    
            <img class="img-responsive" src="images/Typeform/Typeform_integration.png" width="70%" height="70%" alt="Features">

            <p>The website is incredibly impressive in a variety of ways such as:</p>    
            <ul>
            <li>The integration tool is very useful when attempting to use the survey alongside another website, it can save a user a lot of time and improve efficiency overall.</li>
            <li>It is remarkable how seamless it is to create or complete the survey on any device.</li>
            </ul>
            <p>However, there are definitely a few areas which could be improved such as:</p>
            <ul>
            <li>Improving filter options for using templates, a template can save a user plenty of time and it would be useful to have access to these, rather than creating new survey's from scratch each time.</li>
            <li>The limited amount of features available on a free account dwindles in comparison to a competitor such as Google Forms, 100 responses per month and 10 questions per survey is not a large amount at all, however it is understandable as the website operates based on a premium account option and you pay more for extra features.</li>
            </ul>

            <p>On the basis above, I would certainly recommend the website to people who were computer-savvy and wanted to develop a survey, only if their requirements were a simple to use survey and they only plan on receiving limited responses. However, I would recommend a simpler more straight-forward website to create a survey on for someone who is deemed not computer-savvy.</p>
            
            <p>Rating for features accessible on a scale of 1 to 5: 2.5</p>
            <p>Rating for display and presentation on a scale of 1 to 5: 4.5</p>
            
            <p>Combined rating on a scale of 1 to 10: 7</p>
		</div>
        
		<div id="zohosurvey">
		<h1>Zoho Survey</h1>
            
        <h3>Layout</h3>
            
            <img class="img-responsive" src="images/Zoho_Survey/ZohoSurvey_homepage.png" width="70%" height="70%" alt="Homepage">
            
			<p>The presentation of the website is as easy to understand and as modern as you can get. The website is beautifully dynamic and responsive, it also looks excellent on various devices. An added benefit which Zoho Survey has available is the sign-up form being immediately available on the homepage, this is a feature which none of the other competitors analysed have presented. On Zoho Survey's website they also have images and screenshots of the backend working environment, this is useful for users as it provides a visual representation about the environment they will be creating their surveys on.</p>

        <h3>Sign-up process</h3>
        
            <img class="img-responsive" src="images/Zoho_Survey/ZohoSurvey_signup.png" width="70%" height="70%" alt="Signup">
            <br>
            <img class="img-responsive" src="images/Zoho_Survey/ZohoSurvey_personalemail.png" width="70%" height="70%" alt="Signup">
            
            <p>The sign up process for the website is seamless, all Zoho Survey require to register is:</p>     
            <ul>
            <li>Email </li>
            <li>Password </li>
            <li>Location</li>
            </ul>
            <p>This is a reasonable amount of data and should take less than a minute to sign up. They require the username and password, this will allow the user to log in again when necessary, it is unclear why Zoho Survey requires the location of the user. After signing up, a personal advisor from the company sent a personalised e-mail which is attached as an image above, this touch of communication adds an extra personalised feeling to the website, which may be exactly what you require if you are a business or a professional, however as a student or a person creating a survey for fun, it may be seen as an unnecessary email.</p>
            
            
        <h3>Sign-in process</h3>
        
            <img class="img-responsive" src="images/Zoho_Survey/ZohoSurvey_signin.png" width="70%" height="70%" alt="Signin">
            
            <p>The log in process is as simple as the signup process, minus requiring the location. The log-in process has the added benefit of allowing the user to stay signed in, or sign in with different social media accounts.</p>
            
            
        <h3>Ease of use</h3>
        
            <img class="img-responsive" src="images/Zoho_Survey/ZohoSurvey_sharingandbuyresponses.png" width="70%" height="70%" alt="Sharing">
            <br>
            <img class="img-responsive" src="images/Zoho_Survey/ZohoSurvey_responseconfusion.png" width="70%" height="70%" alt="templates">

            <p>Zoho Survey features are all easily accessible if the user can be considered computer-savvy. When creating the survey, the user interface is quite clunky in the way that the menu slides out to enter an input, it can almost be considered obstructive and unnecessary. There is also an unnecessary set of options on the form such as being able to choose whether the form should be displayed vertical or horizontal. It is very easy to choose the option to share it, and there are a variety of options such as email, URL etc. Interestingly, Zoho Survey also has a feature which can allow the user to decide on an end date for the survey, this feature could be useful if the user wants to receive all of their responses by a specific day. </p>
  
        <h3>Survey Features</h3>
        
            <img class="img-responsive" src="images/Zoho_Survey/ZohoSurvey_responses.png" width="70%" height="70%" alt="Templates">
            <br>
            <img class="img-responsive" src="images/Zoho_Survey/ZohoSurvey_templates.png" width="70%" height="70%" alt="Templates">
            
            <p>Zoho Survey provides a wide variety of survey responses which is impressive as it allows a user to ask a variety of questions and receive a wider data set of responses. The option to add images to the survey was not present, which is mildly confusing considering the wide variety in response types that they allow. The free account option is certainly to be considered as they do not limit the account based on functionality or features that are offered. The survey's produced are all incredibly responsive and modern, allowing them to work on any device seamlessly, however there is not a wide variety of templates offered to users.</p>

        <h3>Analysis of data functionality</h3>
            
            <img class="img-responsive" src="images/Zoho_Survey/ZohoSurvey_export.png" width="70%" height="70%" alt="Export">
            <br>
            <img class="img-responsive" src="images/Zoho_Survey/ZohoSurvey_exportoptions.png" width="70%" height="70%" alt="Export">
            
            <p>The analysis portion of Zoho Survey is particularly interesting, they offer a feature which no other competitor has provided, which is the option to export Graphs as images or pdf files. This can be a very useful feature when utilising the data, it speeds up the process of sharing data with other people, rather than having to produce the graphs manually. The website also has the option to export the data as; csv, spreadsheet and pdf. Unfortunately, the data analysis was not particularly varied and only had the option to display data as a horizontal bar chart.</p>    
            
        <h3>Account capabilities and features</h3>
        
            <img class="img-responsive" src="images/Zoho_Survey/ZohoSurvey_pricingfeatures.png" width="70%" height="70%" alt="Features">
         
            <p>The features are clearly listed with Zoho Survey along with the prices for each membership option. The features provided are extremely reasonable for a free account, especially when compared with another competitor such as Survey Monkey. The only obligation which would require a user to have to upgrade was if they needed specific integration features or a greater amount of response data.</p>
            
        <h3>Summary of website</h3>
        
            <img class="img-responsive" src="images/Zoho_Survey/ZohoSurvey_surveyviewing.png" width="70%" height="70%" alt="Features">

            <p>Zoho Survey is undoubtedly a decent free option survey website. All in all, they provide a very simplistic website to create survey's, although they have a wide array of features available, there doesn't seem to be a wide variety of survey types which are commonly created on there, thus providing a lack of templates and a slightly clunky and confusing interface when creating a survey. Zoho Survey looks and feels like an extremely professional service, especially with the added touch of a personal email from an employee of their own.</p>
            
            <p>The most impressive feature on Zoho Survey's website is the feature they provide which allows you to see what it will look like on each device, an example of this is shown on the two images above, the survey looks equally great on any device.</p>
            
            <p>The disappointing factor on Zoho Survey is the limited number of templates provided to the user, the only survey templates which seem to be available as templates are all extremely professional, it's business model doesn't leave room for a personal user to create a fun and interactive survey simply for the pleasure of it.</p>
            
            <p>Zoho Survey is certainly a website to be recommended, especially to professionals, as it is important to be clear that what the user should expect is clean and crisp survey's.</p>
            
            <p>Rating for features accessible on a scale of 1 to 5: 3.5</p>
            <p>Rating for display and presentation on a scale of 1 to 5: 4</p>
            
            <p>Combined rating on a scale of 1 to 10: 7.5</p>
		</div>
        
        <h3>Conclusion</h3>
        <div class="container">
            
            
            <p>All of the websites had different advantages and disadvantages. Rather than declaring one survey website is categorically more useful/better than another website would be incorrect. However, it is true that particular survey websites are more useful depending on the user's requirements than others.</p>
            
            <p><li><a href="https://www.google.co.uk/forms/about/">Google Forms</a> is particularly useful if the user is looking for a free, easy to create, seamless survey website where they do not require the maximum amount of customisation.
            </li></p>
            
            <p><li><a href="https://www.surveymonkey.com/">Survey Monkey</a> is particularly useful if the user is looking for highly customisable survey website, where they will have a vast range of templates, ideas, question types etc. However, using this option will incur a cost.
            </li></p>
            
            <p><li><a href="https://www.typeform.com/">Type Form</a> Very similar to the previous option, this is a particularly useful option if the user is looking for highly customisable survey website, where they will have a vast range of templates, ideas, question types etc. However, using this option will incur a cost.
            </li></p>
            
            <p><li><a href="https://www.zoho.com/survey/">Zoho Survey</a> is particularly useful if the user is looking for an incredibly professional survey website, where they will have access to a range of advice, templates and functionality. However, using this option will incur a cost.
            </li></p>
            
            <p>Overall, the analysis of the competitors has been an invaluable experience and a huge learning curve, it has aided massively in deciding which features/capabilities needed to be included in this website.</p>
            
		</div>



	</body>
</html>
</body>
</html>
_END;
}

// finish off the HTML for this page:
require_once "footer.php";
?>
