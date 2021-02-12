Main
-------------------
# What SLS Stand For
Sign Up Login System
# What is the main idea of this
I'm Trying To Make Sign Up And Login Systems as easy as possible to all developers for no time wasting 
# Supported Databases:
SQLite Using signup method MySQL using signupmysqlmethod Now!!! Login Systems works For Mysql use loginmysql and for Sqlite use login
# New Features
check method to check the data in SQLite Database
>
require "S&LS.php";
$log = new Unit();
$log->check("sqlite", "name the database file", "name of the table");
echo $log->state;
# Usage:
you will need to use unit function! by requiring the php file 
now you will need The Table Name & Database File & The Database should equal to sqlite example code
> $UM = $_POST['Usernameinputnamehere'];
$PW = $_POST['Passwordinputnamehere'];
$EM = $_POST['Emailinputnamehere'];
$DM = "sqlite";
$DMF = "database.db";
$TN = "the table name here";
$log = new Unit();
$log->($UM, $PW, $EM, $DM, $DMF, $TN);
> // after that it should do it the trick with setting the cookie for user called UID
# You Can Use Non Composer Version!
