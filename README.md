=======
FoosRPI
=======

FoosRPI aims to put a computer inside a foosball table to record data from games, send it to an online database, 
and display it on a website in the form of a leaderboard. People sign up with their phone numbers on the website, and start a game by texting in the table id.

==============
File Structure
==============

The folder entiled "raspberrypi" contains all of the hardware files (Raspberry Pi and Arduino). All of the other files are on the remote FTP-accessable server.

=============
Website Setup
=============

All of the pages are implemented with HTML/CSS and generated with PHP code. The database is setup with MySQL and the data is accessed through SQL queries in the PHP code. Javascript, more specifically the jQuery library, is used to make the HTML dynamic. All global Javascript, PHP, Images, etc. can be found in their respective folders inside the "global_assets" folder. The API used by the hardware files can be accessed at "http://foosrpi.com/goal/." It accepts POST requests with the following variables:
 * tableId - an integer indicating the id number of the foosball table the game is being played on.
 * player - an integer indicating which side of the tabled scored the goal (1 or 2).
 All of the maintenance of the games and their scores is handled on the server in the "/goal/" API script.

==============
Hardware Setup
==============

The Arduino handles the input directly from the sensors. The Arduino then sends the data to the Raspberry Pi (when the LED light is tripped by the ball). The Raspberry Pi then makes a POST request with only the table id and the player id (1 or 2) to the "/goal/" API on the server.