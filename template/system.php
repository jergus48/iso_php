
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/static/assets/icon.png">
    <link rel="shortcut icon" href="/static/assets/icon.png">
    <title>
    Dochádzkový Systém
    </title>
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="/static/css/login.css">
</head>
<section class="vh-100" >

    <div class="container py-5 h-100" >

        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-8 col-xl-6">
                <div class="card rounded-3" style="background: #183446;">
                    <form method="post" class="card-body p-4" id="taskForm">

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h2 mb-0" style="color:white;">Priložte kartu/čip k čitačke</span>
                           
                           
                        </div>
                        <p class="text-muted pb-2">
                            <!-- <?php echo date('d/m/Y • H:i'); ?> -->
                        </p>

                        <div class="list-group rounded-0">
                        <label for="exampleInputPassword1" class="form-label" style="color:white;">Kod</label>
                            <div class="input-group mb-3">
                                
                                <input type="password" class="form-control" id="codeInput" name="code" style="border-color: none;box-shadow: none;"
                                    placeholder="Priložte kartu/čip k čitačke"  required> 
                            </div>
                           
                            <button type="submit" class="btn  btn-primary" name="Login"
                                value="Login">Prihlásiť sa</button>
    

    
                            </div>
                            
                        </div>
                        

  
  

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="/static/js/system.js">
   
</script>




</html>
