<?php
include("database.php");
session_start();

if (!$con) {
    die("failed to connect database");
} 

if (isset($_SESSION['empid'])) {
    $empid = $_SESSION['empid'];
    header("Location: /docs.php/");
    exit();}

   

if(isset($_GET['user'])) {
    // Get the empid from the URL
    $empid = $_GET['user'];


    $query = "SELECT empname, pin FROM tbemp WHERE empid = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $empid); // Assuming empid is an integer
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $empname, $pin);
    
    // Fetch the result
    if (mysqli_stmt_fetch($stmt)) {
        $name = $empname;
    } else {
        echo "Employee not found.";
    }

    // Close statement
    mysqli_stmt_close($stmt);
   
} else {
    echo "No user provided in the URL.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $password=  $_POST['password'];
    if ($password == $pin){
        $_SESSION['empid'] = $empid;
        header("Location: /docs.php/");

    }
    else {
        echo "<script>alert('Nesprávne heslo');</script>";
    }




}

mysqli_close($con);
?>
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
</head>
<section class="vh-100" >

    <div class="container py-5 h-100">

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
                           
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="color:white;">Heslo</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password" style="border-color: none;box-shadow: none;"
                                    placeholder="Zadajte heslo" required> 
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary" name="Login"
                                value="Login">Prihlásiť sa</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</html>
