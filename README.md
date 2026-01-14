FEATURES:
 - hashed passwords;
 - optional account verification via email;
 - rate limiting per ip; create only one account every 5 minutes from the same ip address;
 - secure cookie - automatic login if your cookie is valid (7 days from login);
 - password lenght requirement; 8 characters;

HOW TO USE:
make sure that the entire backend folder is not accessible through your website!
 - fill backend/dane.php with your database credentials;
 - set a php enviroment variable called "backend" pointing to the backend directory, and enjoy!

WITH EMAIL VERIFICATION:
 - fill backend/mailer.php with your mail data;
uncomment lines: 
 - 60 in backend/register.php
 - 24 in backend/login.php



