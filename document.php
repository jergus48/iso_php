<?php
include("database.php");
include("functions.php");
session_start();

if (!$con) {
    die("failed to connect database");
}

if (!isset($_SESSION['empid'])) {
    header("Location:/");
    die;
}
else {
    $empid = $_SESSION['empid'];
    $username=get_username($empid,$con);
}


$isodocerkid = null; 
$dateink_value = null; 
if(isset($_GET['id'])) {
    // Get the empid from the URL
    $isodocerkid = $_GET['id'];
    $query = "SELECT empid, isodocid, dateink FROM tbiso_doc_erk WHERE isodocerkid = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $isodocerkid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $empid, $isodocid, $dateink);
    $results = array();
    if (mysqli_stmt_fetch($stmt)) {
        $dateink_value=$dateink;
    }
    mysqli_stmt_close($stmt);

    $isodocname=get_name($isodocid,$con);
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isodocname; ?></title>
    <link rel="icon" type="image/png" href="/static/assets/icon.png">
    <link rel="shortcut icon" href="/static/assets/icon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/css/style.css">
    <style>
        table tr:last-child td:first-child {

            border-bottom-left-radius: 0px;
        }

        table tr:last-child td:last-child {

            border-bottom-right-radius: 0px;
        }
    </style>
</head>
<body>
    

<br>
<div class="navbar" style="width: 40%">
        
        
        
    
        
       
        <a style="padding-left: 20px;padding-right:20px;cursor:pointer;" onclick="history.back(); return false;"  >&#8592; Späť na zoznam</a>

        <?php if($dateink_value == null){?>
        <div style="padding-left: 20px; padding-right:20px;">
            <button  onclick="Agree()" class="button-72">Potvrdiť oboznámenie</button>
        </div>
        <?php } ?>
        <b style="padding-right: 20px;padding-left: 20px;"><?php echo $username; ?></b>
    </div>
<br>

<h2 style="text-align:center;"><?php echo $isodocname; ?></h2>

<table class="table table-dark mb-0" id="isoDocTable" style="width: 50%;">
                    <thead style="background-color: #393939;">
                      <tr class="text-uppercase text-success">
          
          
         
            <th>Dokument</th>
         
            
        </tr>
        </thead>
        <tbody>
<?php
    
        
        $result_tbiso_doc=get_tbiso_doc_file_variables($isodocid,$con);
        // Fetch and display the tbiso_doc records in the table
        while ($tbiso_doc_file = mysqli_fetch_assoc($result_tbiso_doc)) {
?>
        <tr onclick="openFile('/<?php echo $tbiso_doc_file['filepath']; ?>/')">
        
       
            <td><?php echo $tbiso_doc_file['filename']; ?></td>
            
        </tr>
        

<?php
        }
        

?>
    </tbody>
    </table>
<?php
    // Close the connection
   
} else {
    echo "No user provided in the URL.";
}
?>
</body>






<script src="/static/js/document.js">

</script>
<script>
    function Agree() {
    if (confirm("Potvrdzujem že som sa oboznámil s dokumentom.")) {
        var isodocerkid = <?php echo $isodocerkid ?>;
        console.log(isodocerkid)
        $.ajax({
            url: '/update_date.php/',
            type: 'POST',
            data: { isodocerkid: isodocerkid },
            success: function (response) {
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
}
</script>

<?php  mysqli_close($con); ?>