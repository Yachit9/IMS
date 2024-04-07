<?php

session_start();
if(isset($_SESSION['user'])) header('location: dashboard.php');


$error_message='';
if($_POST){
    include('database/connection.php');
    $username=$_POST['username'];
    $password=$_POST['password'];
    

    $query='SELECT * FROM users WHERE users.email="'.$username.'"AND users.password="'.$password.'"';

    $stmt=$conn->prepare($query);
    $stmt->execute();

    if($stmt->rowCount()>0){
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user=$stmt->fetchAll()[0];
        $_SESSION['user']=$user;
        header('Location: dashboard.php');

    }else $error_message='PLease make sure that the username and password are correct';
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <link rel="stylesheet" href="login.css">
</head>
<body id="loginBody">
    <?php
    if(!empty($error_message)){
    ?>
    <div id="errormessage">
        <p>Error: <?= $error_message ?></p>
    </div>
    <?php  }?>
    
 <div class="container">
    <div class="headings">
        
        <h1>
            IMS
        </h1>
        <h3>
            INVENTORY MANAGEMENT SYSTEM
        </h3>
    
    </div>
    <div class="form" >
        <form action="login.php" method="POST">
            <div class="ele">
            <label for="">
                Username:
            </label>
            <input type="text" placeholder="username" name="username" id="username">
            </div>
            <div class="ele">
                <label for="">
                    Password:
                </label>
                <input type="password" placeholder="password" name="password" id="password1">
            </div>
            <button class="btn">login</button>
        </form>
    </div>
 </div>

    
</body>
</html>