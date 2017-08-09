#!/bin/bash

# This script can be used to bulk execute commands in SQL

USER="$1"
#PASSWORD="$2"
DATABASENAME="$2"
USERS_INPUT_FILE="$3"
PROJECTS_INPUT_FILE="$4"



# Format for adding a new user..
# INSERT INTO users(username, password, name, email, about, twitter, instagram, facebook, github);

# Delete from tables first in order to avoid duplicate error messages (Do so at your own risk) 
mysql -u $USER -p -D $DATABASENAME -e "DELETE from projects"
mysql -u $USER -p -D $DATABASENAME -e "DELETE from users"


while read -r line
 do
	mysql -u $USER -p -D $DATABASENAME -e "$line"; 
 done < "$USERS_INPUT_FILE"


# This will read the projects data file and load it into the appropriate table
while read -r line
 do
	mysql -u $USER -p -D $DATABASENAME -e "$line";
 done < "$PROJECTS_INPUT_FILE"




