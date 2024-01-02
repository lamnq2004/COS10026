<?php

// action required on all the below constants, these will be filled with the values you assign when you create the database on phpmyadmin.
// They should then be useful when connecting to the database and adding additional validation records on processEOI.php
// EOI_COL, REF_COL, FNAME_COL, LNAME_COL ect will be filled with the actual anmes you assign to columns 

// [ACTION REQUIRED]
define('DB_NAME', '');
// [ACTION REQUIRED]
define('SERVER_NAME', '');
// [ACTION REQUIRED]
define('USERNAME', '');
// [ACTION REQUIRED]
define('PWD', '');
// [ACTION REQUIRED]
define('TABLENAME', '');
// [ACTION REQUIRED]
define('EOI_COL', '');
// [ACTION REQUIRED]
define('REF_COL', '');
// [ACTION REQUIRED]
define('FNAME_COL', '');
// [ACTION REQUIRED]
define('LNAME_COL', '');
// [ACTION REQUIRED]
define('ADDRESS_COL', '');
// [ACTION REQUIRED]
define('EMAIL_COL', '');
// [ACTION REQUIRED]
define('PHNUM_COL', '');
// [ACTION REQUIRED]
define('SKILLS_COL', '');
// [ACTION REQUIRED] INPUT REQUIRED FOR ''
define('OTHER_COL', '');


// If you prefer we can use the alternative formating below:

    $db_name =''; 
    $server_name ='';
    $username ='';
    $pwd ='';
    $table_name ='';
    $eoi_column ='';
    $ref_column ='';
    $firstname_column ='';
    $lastname_column ='';
    $address_column ='';
    $email_column ='';
    $phone_number_column ='';
    $skills_column ='';
    $other_column = '';

    $host = "feenix-mariadb.swin.edu.au";
	$user = "s104477381"; // your user name
	$pwd = "150805"; // your password (date of birth ddmmyy unless changed)
	$sql_db = "s104477381_db"; // your database
	
	$conn = @mysqli_connect($host, $user, $pwd, $sql_db);


?>