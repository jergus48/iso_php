<?php
include("database.php");

// Check if the connection was successful
if (!$con) {
    die("failed to connect database");
}

session_start();
if (isset($_SESSION['empid'])) {
    $empid = $_SESSION['empid'];
    header("Location: /docs.php/");
    exit();}


// Query to fetch employee details
$query = "SELECT empid, empname FROM tbemp";
$result = mysqli_query($con, $query);

// Check if any rows found
if (mysqli_num_rows($result) > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoznam Pracovnikov</title>
    <link rel="icon" type="image/png" href="/static/assets//icon.png">
    <link rel="shortcut icon" href="/static/assets//icon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/css/style.css">

</head> 
<body>
    <br>
    <div class="navbar search" >
        <input type="text" id="searchInput" oninput="searchNames()" placeholder="Vyhľadajte vaše meno...">
    </div>
    <br>
    <table class="table table-dark mb-0 zamestnanci" id="isoDocTable" >
        <thead style="background-color: #393939;">
            <tr>
                <th scope="col">ID Pracovníka</th>
                <th scope="col">Meno Pracovníka</th>
            
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
    
    
   
            <tr onclick="window.location='/login.php/?user=<?php echo $row["empid"]; ?>'" >
                <td><?php echo $row["empid"]; ?></td>
                <td><?php echo $row["empname"]; ?></td>
                
            </tr>
    
      
            <?php } ?>
        </tbody>
    </table>

</body>
    
<?php
} else {
    echo "No records found";
}

// Close connection (optional)
mysqli_close($con);
?>

<script src="/static/js/index.js">

</script>
