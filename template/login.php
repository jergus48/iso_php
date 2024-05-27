
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/static/assets/icon.png">
    <link rel="shortcut icon" href="/static/assets/icon.png">
    <title>
       Login
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
                            <span class="h2 mb-0" style="color:white;"><?php echo $name ?></span>
                           
                           
                        </div>
                        <p class="text-muted pb-2">
                            <!-- <?php echo date('d/m/Y • H:i'); ?> -->
                        </p>

                        <div class="list-group rounded-0">
                        <label for="exampleInputPassword1" class="form-label" style="color:white;">Heslo</label>
                            <div class="input-group mb-3">
                                
                                <input type="password" class="form-control" id="numberInput" name="password" style="border-color: none;box-shadow: none;"
                                    placeholder="Zadajte heslo"  required> <button type="submit" class="btn btn-sm btn-primary" name="Login"
                                value="Login">Prihlásiť sa</button>
                            </div>
                            <div class="wrapper">
    <!-- ## phone area -->
    <div class="phone">
   
      <div class="phone-container">
        <!-- <input type="text" maxlength="11" class="number-input" id="numberInput" value="" placeholder="Phone Number"/>
          -->
        <div class="keyboard">
          <div class="number">
            <span data-number="1"><i>1</i></span>
            <span data-number="2"><i>2</i></span>
            <span data-number="3"><i>3</i></span>
            <span data-number="4"><i>4</i></span>
            <span data-number="5"><i>5</i></span>
            <span data-number="6"><i>6</i></span>
            <span data-number="7"><i>7</i></span>
            <span data-number="8"><i>8</i></span>
            <span data-number="9"><i>9</i></span>
            
          </div>
          <div class="number aling-right">
          <span style="opacity:0;cursor: default;" ><i style="opacity:0;cursor: default;">0</i></span>
            <span data-number="0"><i>0</i></span>
            <span id="delete" onclick="deleteLastNumberFromInput()" ><i ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="    margin-bottom: .1em;" height="40" width="30"><path d="M576 128c0-35.3-28.7-64-64-64H205.3c-17 0-33.3 6.7-45.3 18.7L9.4 233.4c-6 6-9.4 14.1-9.4 22.6s3.4 16.6 9.4 22.6L160 429.3c12 12 28.3 18.7 45.3 18.7H512c35.3 0 64-28.7 64-64V128zM271 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
</i></span>
            
          </div>
        </div>
      </div>
    </div>
    
  </div>
                            
                        </div>
                        

  
  

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="/static/js/login.js">
   
</script>




</html>
