<?php 
//document
function get_name($isodocid, $con){
    $query_tbiso_doc = "SELECT isodocname FROM tbiso_doc WHERE isodocid = ?";
    $stmt_tbiso_doc_name = mysqli_prepare($con, $query_tbiso_doc);
    mysqli_stmt_bind_param($stmt_tbiso_doc_name, "i", $isodocid);
    mysqli_stmt_execute($stmt_tbiso_doc_name);
    mysqli_stmt_bind_result($stmt_tbiso_doc_name, $isodocname);

    // Fetch the result
    mysqli_stmt_fetch($stmt_tbiso_doc_name);

    // Close the statement
    mysqli_stmt_close($stmt_tbiso_doc_name);

    // Return the fetched result
    return $isodocname;
}
//document
function get_tbiso_doc_file_variables($isodocid,$con) {

    $query_tbiso_doc_file = "SELECT * FROM tbiso_doc_file WHERE isodocid = ?";
    $stmt_tbiso_doc = mysqli_prepare($con, $query_tbiso_doc_file);
    mysqli_stmt_bind_param($stmt_tbiso_doc, "i", $isodocid);
    mysqli_stmt_execute($stmt_tbiso_doc);
    $result_tbiso_doc = mysqli_stmt_get_result($stmt_tbiso_doc);
    mysqli_stmt_close($stmt_tbiso_doc);
    return $result_tbiso_doc;
}
//docs
function get_tbisodocerk_variables($empid,$con){
    $query = "SELECT isodocerkid, isodocid, dateink FROM tbiso_doc_erk WHERE empid = ?";
    $stmt = mysqli_prepare($con, $query);

    // Bind the empid parameter
    mysqli_stmt_bind_param($stmt, "i", $empid);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Bind the result variables
    mysqli_stmt_bind_result($stmt, $isodocerkid, $isodocid, $dateink);

    // Fetch the results into an array
    $results = array();
    while (mysqli_stmt_fetch($stmt)) {
        $results[] = array('isodocerkid' => $isodocerkid, 'isodocid' => $isodocid, 'dateink' => $dateink);
    }

    // Close the statement for tbiso_doc_erk
    mysqli_stmt_close($stmt);

    return $results;
}
//docs
function get_tbisodoc_variables($isodocid,$con){
    $query_tbiso_doc = "SELECT * FROM tbiso_doc WHERE isodocid = ?";
    $stmt_tbiso_doc = mysqli_prepare($con, $query_tbiso_doc);
    mysqli_stmt_bind_param($stmt_tbiso_doc, "i", $isodocid);
    mysqli_stmt_execute($stmt_tbiso_doc);
    $result_tbiso_doc = mysqli_stmt_get_result($stmt_tbiso_doc);
    mysqli_stmt_close($stmt_tbiso_doc);
    return $result_tbiso_doc;
}
//docs, document
function get_username($empid,$con){

    $query = "SELECT empname, pin FROM tbemp WHERE empid = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $empid); 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $empname, $pin);
    

    if (mysqli_stmt_fetch($stmt)) {
        $name = $empname;
    }
    mysqli_stmt_close($stmt);
    return $name;
}


?>
