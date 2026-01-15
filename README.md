 # FEATURES:
 - hashed passwords;
 - optional account verification via email;
 - optional password reset via email - if you dont want it feel free to delete every file referencing password reset;
 - rate limiting per ip; create only one account every 5 minutes from the same ip address;
 - secure cookie - automatic login if your cookie is valid (7 days from login);
 - password lenght requirement; 8 characters;
 - password reset via email

 # HOW TO USE:

make sure that the entire backend folder is not accessible through your website!
 - fill backend/dane.php with your database credentials;
 - set a php enviroment variable called "backend" pointing to the backend directory, and enjoy!
  - include this at the top of every page that you want protected:
  ```php
    <?php
    require $_SERVER['backend'] . '/check.php';
    ?> 
``` 

 # WITH EMAIL VERIFICATION:
 - fill backend/config.php with your mail data
 - change ```ENABLE_EMAIL_VERIFICATION = 0``` to ```ENABLE_EMAIL_VERIFICATION = 1``` in backend/config.php
 - for password reset to work, you have to have email verification enabled



