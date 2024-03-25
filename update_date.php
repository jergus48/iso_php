<?php
include("database.php");
if (!$con) {
    die("failed to connect database");
}

$isodocerkid = $_POST['isodocerkid'];


$query = "UPDATE tbiso_doc_erk SET dateink = NOW() WHERE isodocerkid = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $isodocerkid);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

mysqli_close($con);
?>