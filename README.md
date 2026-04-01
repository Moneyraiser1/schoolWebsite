🎓 School Website System

A complete school management web application built with PHP, MySQL, JavaScript, jQuery, and Bootstrap. This system allows administrators to manage academic activities while students can interact with learning features.

📌 Project Setup Instructions

Follow the steps below carefully to get the project running:

1. 📂 Folder Setup

* Extract the project files.
* Do NOT rename the project folder.
* Ensure the folder name remains:
    schoolWebsite
* Place the folder inside your server directory:
    For XAMPP: htdocs
    For WAMP: www

2. 🗄️ Database Setup
* Open phpMyAdmin
* Create a new database
* Import the provided .sql file

⚠️ Important Rules:

The database name MUST be the same as the SQL file name
Do not rename tables inside the SQL file

3. ⚙️ Configuration
Locate the database configuration file (inside /config)
Update the following:
$host = "localhost";
$user = "root";
$password = "";
$database = "your_database_name";

Make sure the database name matches the SQL file name exactly.

4. 🚀 Run the Project
* Start Apache and MySQL from your server (XAMPP/WAMP)
* Open your browser and go to:
    http://localhost/schoolWebsite
    🔐 Default Access (if available)

You can include this only if your system has login credentials

Admin Login:
username: STUDENT495
Password: salam123

🛠️ Features
Student management
Subject selection and testing system
Admin dashboard
Question and answer management
Result processing
Responsive design (Bootstrap 5)

⚠️ Important Notes
Do not rename the schoolWebsite folder
Ensure database name matches the SQL file name
Do not modify table names after import
Make sure your server is running before accessing the system

📞 Support

If you encounter any issues:

Check your database connection
Ensure the SQL file is properly imported
Confirm folder name is unchanged
