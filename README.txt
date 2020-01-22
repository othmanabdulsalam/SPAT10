How to run:

Local:
This can be run with a php interpreter and then accessed via a web browser with the url "localhost".
If you have php installed, you can follow these instructions: https://www.php.net/manual/en/features.commandline.webserver.php

Server:
Our code is also hosted on the poseidon webserver at "http://hackcamp10.poseidon.salford.ac.uk/"

dependencies:
The website relies on the underlying database to function, the database is also hosted on poseidon, if you
were to run it locally, you still won't need to know the login details as they are hard coded into the
"Database.php" class.
if you wanted to create your own version of the database for some reason, you'd need to create a mySQL
server and run the "DatabaseDump.sql" file to replicate the schema and data from our database.