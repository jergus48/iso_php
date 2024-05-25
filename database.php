<?php
$dbhost="localhost:5000";
$dbuser="Jergus Snahnican";
$dbpassword="2ie3-.9L9FwNX5j";
$dbname="iso";

if (!$con = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname)) {
    die("failed to connect database");
}

date_default_timezone_set('Europe/Bratislava');





// $dbhost="localhost:3307";
// $dbuser="root";
// $dbpassword="2ie3-.9L9FwNX5j";
// $dbname="iso";