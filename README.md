# deta-task-3
Calendar application in php with meeting scheduling 
# Execute in google chrome only as datetime local is not supported in other browsers
Done with PHP Version 7.2.5 and code for accessing and manipulating database has been written in mysql procedural format.Sufficient care has been taken to prevent SQL injection.
## General Instructions To run this task
1) Install XAMPP (X- any OS A-Apache M-MySql P-PHP P-Pearl) on your laptop/pc (works on all operating systems).After installation start the apache and mysql componemts in the xampp control pannel.

2) Extract the above php and html files to the demo folder in the htdocs folder within the xampp folder in your respective localdisk eg. C:\xampp\htdocs\demo

3) Create database hari_db in http://localhost/phpmyadmin/index.php by clicking on the new icon on the left of the page.

4) Within the database create the following tables in XAMPP PHPMYADMIN SQL control pannel within the database by pasting the following sql commands in the sql command prompt.

  CREATE TABLE user ( id INT(9) AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) , email VARCHAR(255), telephone bigint(10), password       VARCHAR(255),image VARCHAR(255) );

CREATE TABLE appointments ( id INT(9) AUTO_INCREMENT PRIMARY KEY, username VARCHAR(255), title VARCHAR(255), starttime datetime, (// # don't provide    any default length)
description VARCHAR(255),endtime datetime, (// # don't provide    any default length));

5) Place the above link in your browser http://localhost/demo/login.php to run this web application.
## Features implemented in this Task
1) Users are provided with a login and signup pages where the user enters his details and creates his account.User is notified as to whether the username entered exists or not during signup .
2) Subsequently the user is redirected to the login page where he enters his details and goes to his home page. A captcha has been included for security purpose and care has been taken to prevent mysql injection.
3) When the user logs in he is given the option to edit his personal details entered during signup process,allowed to create and schedule appointments with other users and view his calendar with his appointments under the day which he clicks.(by default the appointments for current day is shown).
### P.S place your profile image in the same folder as above and upload it
