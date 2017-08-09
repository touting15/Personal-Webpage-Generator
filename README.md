# Description of System: #
Resume/Blog Platform Generator which relies on form based input to create its output.

Project Proposal: Our group proposes to create a resume blog generator. Our goal is to allow users to use a form to define their interests, hobbies, skills, and other things they identify with to define a website totally dedicated to themselves. We hope our website will at minimum include an “about me page”, a pdf view of the users resume, a page with an interactive view of our users social media, and an easy to read blog page. Our page will use bootstrap for easy scalability across all devices. All user information with be stored using MariaDB.

Our long term goals may extend to allowing users to customize a particular theme to associate with their webpage, downloadable zip files of the webpage they just customized, and a live messenger chat to allow site visitors to communicate with their users.

## Requirements: ##
OOP Php
MySQL/MariaDB , at least 1 table
Access data using PHP
Store some large object in the db
Javascript/jQuery for client side data validation 
Bootstrap
Forms

<b>Front End Pieces:</b>
<ul>
<li>Templates</li>
	Appearance of the Page : HTML/Javascript
	Inputting Data from MySQL into the Template
<li>Fetching Information and Inputting into the Templates</li>
<li>Styling Templates</li>
<li>PDF View Page</li>
<li>Logged in User Admin Page (Personal Page Customization)</li>
</ul>

<b>Back End Pieces:</b>
<ul>
<li>PHP Script that fetches data from MySQL</li>
<li>PHP Script that inputs data to MySQL</li>
<li>Script for generating tables for MySQL</li>
<li>Javascript/JQuery for validating the data (Connecting front end to backend)</li>
</ul>


Validation should be done in Javascript
About Me Page:
Name
Academic Experience
Work Experience
Extracurriculars ?
Projects Page:
Class Work
Personal Work
Hackathons?
Resume Page:
Load Resume View
Button that allows download of pdf/docx
Manage Profile Page (Logged in User view only):
Edit About me Page
Edit name, academic experience...etc
Edit projects page
Add projects, edit existing project descriptions
Change theme
Add banner, Change colors, change font

Home Page:
Login Button
Browse Users button



<b>Databases Setup</b>
------------------------------------------------------------------------------------------------
Users Table
Name (String)
Username (String)
About (String)
Email (String)
Links to Social Media Accounts: Twitter, Instagram, Facebook, Github (Separate columns for each media account)

Projects Table
User ID (Username)
Project Name
Project Description
Project Images