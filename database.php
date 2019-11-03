<?php
define("DBHOST","127.0.0.1");
define("DBUSER","root");
define("DBPASS", "");

$conn = new mysqli(DBHOST, DBUSER, DBPASS);
if ($conn->connect_error) {
    die("Connection Failed: ".$conn->connect_error);
}else {
    $db = "CREATE DATABASE GetIp";
    if ($conn->query($db) === TRUE) {   
        define("DBNAME", "GetIp");  
       $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

       if ($conn->connect_error) {
        die("Connection to Database Failed: ".$conn->connect_error);
    }else {

        $sql_table0 = "CREATE TABLE user_ip(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            FirstName TEXT(50) NOT NULL,
            LastName TEXT(50) NOT NULL,
            ip VARCHAR(20),
            Reg_Time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ";


            if ($conn->query($sql_table0) === FALSE) {
                echo "Unable to create table".$conn->error;
            }
         
            
       } 
    } 
} 


$conn->close();

?>