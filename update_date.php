<?php
include("database.php");


$db = new Database();


$isodocerkid = $_POST['isodocerkid'];


$query = "UPDATE tbiso_doc_erk SET dateink = NOW() WHERE isodocerkid = ?";
$stmt = $db->prepare( $query);
$stmt->bind_param( "i", $isodocerkid);
$stmt->execute();


$stmt->close();
$db->close();

?>