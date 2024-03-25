<?php
include("database.php");
include("functions.php");
session_start();
if (!$con) {
    die("failed to connect database");
}
$isodocerkid = null; 
if (isset($_SESSION['empid'])) {
    $empid = $_SESSION['empid'];
    $results=get_tbisodocerk_variables($empid,$con);
    $username=get_username($empid,$con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumenty</title>
    <link rel="icon" type="image/png" href="/static/assets/icon.png">
    <link rel="shortcut icon" href="/static/assets/icon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/css/style.css">

</head>
<body style="overflow-y:scroll;">
    


    <br>
    <div class="navbar">
        <div style="padding-right: 10px;padding-left: 10px;">
            neprečítané dokumenty <input type="checkbox" id="oboznamitSaCheckbox" onchange="filterRows()">
        </div>
        <span id="vzostupne" style="padding-right: 10px;padding-left: 10px;" onclick="sortTableById('asc')">vzostupne</span>
        <span id="zostupne" style="padding-right: 10px;padding-left: 10px;" onclick="sortTableById('desc')">zostupne</span>
        <a href="/logout.php/" style="padding-right: 10px;padding-left: 10px;" onclick="clearSortOrder()">Odhlásiť sa</a> <b style="padding-right: 10px;padding-left: 10px;"><?php echo $username; ?></b>
    </div>
    <br>

    <table class="table table-dark mb-0" id="isoDocTable">
        <thead>
            <tr class="text-uppercase text-success">
                <th scope="col">prečítané </th>
                <th scope="col" style="display:none;">isodocerkid </th>
            
                <th scope="col">typ</th>
                <th scope="col">označenie</th>
                <th scope="col">Názov</th>
                <th scope="col">verzia/revízia</th>
                <th scope="col">dátum oboznámenia</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through the results array and generate HTML rows for each result
            foreach ($results as $result) {
                $isodocerkid = $result['isodocerkid'];
                $isodocid = $result['isodocid'];
                $dateink = $result['dateink'];
                if ($dateink == null) {
                    $dateink = "oboznamit sa";
                }

                // Prepare and execute query to select tbiso_doc records based on isodocid
                $result_tbiso_doc=get_tbisodoc_variables($isodocid,$con);

                // Fetch and display the tbiso_doc records in the table
                while ($row_tbiso_doc = mysqli_fetch_assoc($result_tbiso_doc)) {
                    ?>
            <tr class="data-row" onclick="window.location='/document.php/?id=<?php echo $isodocerkid; ?>'" >


                <td>
                    <?php if ($dateink==="oboznamit sa"){ ?>
                    <img src="/static/assets/cross.png" alt="cross" style="width:20px;">
                    <?php }else {?>
                    <img src="/static/assets/tick.png" alt="tick" style="width:20px;">
                    <?php }?>
                </td>

                <td style="display:none;">
                    <?php echo $isodocerkid; ?>
                </td>
              
                <td>
                    <?php echo $row_tbiso_doc['isodoctype']; ?>
                </td>
                <td>
                    <?php echo $row_tbiso_doc['isodocno']; ?>
                </td>
                <td>
                    <?php echo $row_tbiso_doc['isodocname']; ?>
                </td>
                <td>
                    <?php echo $row_tbiso_doc['er']; ?>
                </td>
                <td>
                    <?php if ($dateink==="oboznamit sa"){ ?>
                        <button  onclick="Agreement(<?php echo $isodocerkid ?>,event)" class="button-73">Potvrdiť oboznámenie</button>
                        <?php }else {?>
                    <?php echo $dateink; ?>
                    <?php }?>

                    
                </td>
            </tr>
            <?php
                }

                
            }
            ?>
        </tbody>
    </table>
</body>
<?php
 
} else {
    header("Location:/");
    die;
}

?>

<script src="/static/js/docs.js"></script>

<script>
function Agreement(isodocerkid,event) {
    event.stopPropagation();
    event.preventDefault();
    if (confirm("Potvrdzujem že som sa oboznámil s dokumentom.")) {
        console.log(isodocerkid);
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

<?php
    // Close the connection
    mysqli_close($con);

?>
<br>
<br>