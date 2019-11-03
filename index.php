<?php
session_start();
include_once "database.php";
define("DBNAME", "GetIp");  
$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Connection to Database Failed: ".$conn->connect_error);
}else

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Get Ip</title>
</head>
<body>
<?php
# get ip -> // $ip = $_SERVER['REMOTE_ADDR'];


// get user ip Simple method..........  
$ip0 = "";

if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
    $ip0 = $_SERVER["HTTP_CLIENT_IP"];
  }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip0 = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
    $ip0 = $_SERVER['REMOTE_ADDR'];
}

?>

<?php

// get real ip address Advance methods.....

function GetUserIp()
{
    $ip = "undefined";

    if (isset($_SERVER)) {
        
        if (isset($_SERVER["REMOTE_ADDR"])) {
            $ip = $_SERVER["REMOTE_ADDR"];

        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } else if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
           $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            $ip = getenv("REMOTE_ADDR");
            if (getenv("HTTP_CLIENT_IP")) {
                $ip = getenv("HTTP_CLIENT_IP");
            } else if (getenv("HTTP_X_FORWARDED_FOR")) {
                $ip = getenv("HTTP_X_FORWARDED_FOR");
            }
        }



    }

return $ip;

}
$ip = GetUserIp();

?>











<?php
$error = false;

if (isset($_POST["btn"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];

    if (empty($fname)) {
       $error = true;

    } else {
        $sql_check = "SELECT `FirstName` FROM user_ip WHERE `FirstName`='".$fname."'";
        $result = $conn->query($sql_check);

        if ($result->num_rows >= 1) {
            $error = true;
            echo "try another name ";
        }
    }

    if (!$error) {
        $sql = "INSERT INTO user_ip(FirstName, LastName, ip)
       VALUES('$fname', '$lname', '$ip') 
        
        ";
        if ($conn->query($sql) === FALSE) {
           echo "error".$conn->error;
        } else {
            header("location: iptest.php");
        }
    }
   
}

?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

<label for="fname">First Name: </label>
<input type="text" name="fname">

<label for="lname">Last Name: </label>
<input type="text" name="lname">

<button name="btn">Submit</button>

</form>
    
</body>
</html>