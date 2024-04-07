<?php
session_start();
if(!isset($_SESSION['user'])) header('location: login.php');
$user=$_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS Dashboard</title>
    <link rel="stylesheet" href="login.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       
</head>
<body>
    <div id="dashboardmaincontainer">
        <?php include('partials/app-sidebar.php')?>
        <div class="dasboardcontentcontainer">
        <?php include('partials/app-topnav.php')?>      
            <div class="dashboardcontent">
                <div class="row">
                    <div class="column-5">
                        <h1>INSERT USER</h1>
                <div class="dashboardontentmain">
                    `<div class="useraddformcontainer">
                    <form action="database/add.php" class="appform" method="POST">
                        <div class="appforminputcontainer">
                            <label for="firstname">First Name</label>
                            <input type="text" class="appforminput" id="firstname" name="firstname"/>
                        </div>
                        <div class="appforminputcontainer">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="appforminput" id="lastname" name="lastname"/>
                        </div>
                        <div class="appforminputcontainer">
                            <label for="email">Email</label>
                            <input type="text" class="appforminput" id="email" name="email"/>
                        </div>
                        <div class="appforminputcontainer">
                            <label for="password">Password</label>
                            <input type="password" class="appforminput" id="password" name="password"/>
                        </div>
                        <input type="hidden" name="table" value="users" /> 
                        <button type="submit" class="appbtn"><i class="fa fa-plus"></i>Add User</button>
                    </form>
                    <?php
                    if (isset($_SESSION['response'])) {
                        $response_message=$_SESSION['response']['message'];
                        $is_success=$_SESSION['response']['success'];
                    
                    ?>
                    <div class="responsemessage">
                    <p class="responsemessage<?=$is_success?'responsemessage__success':'responsemessage__error'?>">
                    <?=$response_message ?>
                       </p>
                    </div>
                      <?php unset($_SESSION['response']);}?>
                </div>
                    </div>
                    <div class="column-7">

                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <script src="js/script.js">
    </script>
    

    
</body>
</html>