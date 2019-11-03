<?php

$ip = $_SERVER["REMOTE_ADDR"];
if (isset($ip)) {
    $ip = htmlspecialchars($ip, ENT_QUOTES, 'UTF-8');
    echo $ip;
}


?>