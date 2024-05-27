

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
        <a href="/logout.php/" style="padding-right: 10px;padding-left: 10px;" onclick="clearSortOrder()">Odhlásiť sa</a> <b style="padding-right: 10px;padding-left: 10px;"><?php echo $name; ?></b>
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
        <?php foreach ($this->documentData as $document): ?>
                <tr class="data-row" onclick="window.location='/document.php/?id=<?php echo $document['isodocerkid']; ?>'">
                    <td>
                        <img src="/static/assets/<?php echo $document['dateink'] === 'oboznamit sa' ? 'cross' : 'tick'; ?>.png" alt="<?php echo $document['dateink'] === 'oboznamit sa' ? 'cross' : 'tick'; ?>" style="width:20px;">
                    </td>
                    <td style="display:none;"><?php echo $document['isodocerkid']; ?></td>
                    <td><?php echo $document['row']['isodoctype']; ?></td>
                    <td><?php echo $document['row']['isodocno']; ?></td>
                    <td><?php echo $document['row']['isodocname']; ?></td>
                    <td><?php echo $document['row']['er']; ?></td>
                    <td>
                        <?php if ($document['dateink'] === "oboznamit sa"): ?>
                            <button onclick="Agreement(<?php echo $document['isodocerkid']; ?>, event)" class="button-73">Potvrdiť oboznámenie</button>
                        <?php else: ?>
                            <?php echo $document['dateink']; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>


<script src="/static/js/docs.js"></script>

<script>
function Agreement(isodocerkid,event) {
    event.stopPropagation();
    event.preventDefault();
    if (confirm("Potvrdzujem že som sa oboznámil s dokumentom.")) {
     
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


<br>
<br>