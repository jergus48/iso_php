

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoznam Pracovnikov</title>
    <link rel="icon" type="image/png" href="/static/assets/icon.png">
    <link rel="shortcut icon" href="iso/static/assets/icon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/css/style.css">
</head> 
<body>
    <br>
    <div class="navbar search">
        <input type="text" id="searchInput" oninput="searchNames()" placeholder="Vyhľadajte vaše meno...">
    </div>
    <br>
    <table class="table table-dark mb-0 zamestnanci" id="isoDocTable">
        <thead style="background-color: #393939;">
            <tr>
                <th scope="col" style="text-align: center;">Meno Pracovníka</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($this->users) {
                while ($row = $this->users->fetch_assoc()) { ?>
                    <tr onclick="window.location='/login.php/?user=<?php echo $row['empid']; ?>'">
                        <td style="text-align: center;"><?php echo htmlspecialchars($row['empname']); ?></td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td style="text-align: center;">No records found</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script src="/static/js/name.js"></script>
</body>
</html>
