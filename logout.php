<?php

session_start();

if(isset($_SESSION['empid']))
{
	unset($_SESSION['empid']);

}

header("Location: /");
die;