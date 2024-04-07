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
            <div class="dashboardtopnav">
                <a href="" id="togglebtn"><i class="fa fa-navicon"></i></a>
                <a href="database/logout.php" id="logoutbtn"><i class="fa fa-power-off">Log-Out</i></a>
            </div>
            <div class="dashboardcontent">
                <div class="dashboardontentmain">

                </div>
            </div>
        </div>
    </div>
    <script>
        var sidebarIsOpen = true;
        togglebtn.addEventListener('click', (event) => {
            event.preventDefault();
            if (sidebarIsOpen) {
                dashboardsidebar.style.width = '10%';
                dashboardmaincontainer.style.width = '90%';
                dashboardlogo.style.fontSize = '60px';
    
                menuicons = document.getElementsByClassName('menuText');
                for (var i = 0; i < menuicons.length; i++) {
                    menuicons[i].style.display = 'none'; // Hide menu icons
                }
                sidebarIsOpen = false;
            } else {
                dashboardsidebar.style.width = '20%';
                dashboardmaincontainer.style.width = '100%';
                dashboardlogo.style.fontSize = '80px';
    
                menuicons = document.getElementsByClassName('menuText');
                for (var i = 0; i < menuicons.length; i++) {
                    menuicons[i].style.display = 'block'; // Show menu icons
                }
                sidebarIsOpen = true;
            }
        });
    </script>
    

    
</body>
</html>