# Weather Closet
Weather Closet is a website application that will give clothing recommendations according to the weather conditions in your desired city. The application will allow the user to save favorite locations, clothing preferences, and create iteneraries, and even plan a whole trip. This project will be utilizing the following:
	
	- Frontend: PHP, HTML
	- Backend: PHP, Python 
	- Technologies: RabbitMQ, MySQL 
	- API: OpenWeatherMap
	
Weather Closet is in very early stages of development. Currently, the user is able to register an account, log into the application, and enter their desired city to pull its weather data.

The following are explainations for every file that is currently provided in this branch.

# connection.php
This is the script that will connect the user to the MySQL database, pulling the necessary information for send.php

# loggedin.php
Contains the bulk of the weather information, calling the weather API and the clothing database. Here, the user is prompted to enter their desired city. The script will then pull and display the condition, temperature, and wind speed of the city. This script will also provide a clothing recommendation from the database according to this information. After a user successfully logs in, they will have access to these features.

# login.php
The login page of the application. Prompts the user for their username and password as well as a register button for new users.

# newuser.php
The registration page for creating a new user. Prompts the user to create a username and password, as well as provide a name and email. If it meets the necessary requirements, the information is then stored into the database and passwords are hashed. 

# receive.php
The script that connects to RabbitMQ and waits for any incoming messages from send.php

# send.php
Sends many of the scripts above through RabbitMQ. It will also send error messages if the information sent is incorrect.

#somename.txt
Events are written into this log file. Contains the date, time, account, and whether or not the login was successful or not.