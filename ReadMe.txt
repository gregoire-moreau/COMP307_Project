All Bark No Bite
Team Members: Jen Gahrns, Grégoire Moreau, Eric Choinière
Points: 14
Browsers: Google Chrome and Mozilla Firefox.

Jen
- HTML/CSS
- JS/DOM

Eric
- JSON
- Security
- XAMPP

Grégoire
- SQL
- SLIM
- PHP

NB: 
*Eric also wrote several JavaScript functions, such as the sorting algorithm for suggested friends. 
*Grégoire also added server side security measures to protect against SQL injection, and the server side decryption/encryption.

How to run:
1. Copy the project folder into the htdocs folder of your XAMPP installation
2. Configure XAMPP to allow uploads up to 5MB (change line 818 in xampp/php/php.ini to "upload_max_filesize=5M")
3. Start Apache and MySQL in XAMPP
4. Import the database :
    i. Access localhost/phpmyadmin with your browser
    ii. Go to Import and browse to the "allbarknobite.sql" file in this folder
    iii. Uncheck the "Enable foreign key checks" options
    iv. Click Go
5. Access localhost/COMP307_Project with your browser or open CLICKME.html and click on the link
6. Sign up an account through the link on the Login page
7. Log in to your account and explore the following functionalities :
	* Upload a picture of your dog through the profile page
	* See nearby dogs with similar interests through the suggested friends section of the barks page
	* Bark at dogs you want to connect with, bark back at dogs who have barked at you if you'd like to be friends
	* View your friends and schedule playdates with your friends through the friends page
	* Use the playdate form by clicking the playdate button on one of your friends to send them a playdate request
	* Accept playdate requests and view your upcoming playdates through the playdates page.
