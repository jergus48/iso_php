
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

        <?php if($this->documentData['dateink'] == null){?>
        <div style="padding-left: 20px; padding-right:20px;">
            <button  onclick="Agree()" class="button-72">Potvrdiť oboznámenie</button>
        </div>
        <?php } ?>
        <b style="padding-right: 20px;padding-left: 20px;"><?php echo $name; ?></b>
    </div>
<br>

<h2 style="text-align:center;"><?php echo $isodocname; ?></h2>

<table class="table table-dark mb-0" id="isoDocTable" style="width: 50%;">
                    <thead style="background-color: #393939;">
                      <tr class="text-uppercase text-success">
          
          
         
            <th>Dokument</th>
         
            
        </tr>
        </thead>

<?php foreach ($this->documentData['files_tbiso_doc'] as $tbiso_doc_file): ?>
        <tr onclick="openFile('/<?php echo $tbiso_doc_file['filepath']; ?>')">
        
       
            <td><?php echo $tbiso_doc_file['filename']; ?></td>
            
        </tr>
        
        <?php endforeach; ?>
    </tbody>
    </table>

</body>






<script src="/static/js/document.js">

</script>
<script>
    function Agree() {
    if (confirm("Potvrdzujem že som sa oboznámil s dokumentom.")) {
        var isodocerkid = <?php echo $this->documentData['isodocerkid'] ?>;
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
