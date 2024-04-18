<?php
session_start();
if(!isset($_SESSION['user'])) header('location: login.php');

$_SESSION['table']='users';
$_SESSION['redirect_to']='users-add.php';

$show_table='users';
$users=include('database/show.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS Dashboard</title>
    <link rel="stylesheet" href="login.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/css/bootstrap-dialog.min.css" integrity="sha512-PvZCtvQ6xGBLWHcXnyHD67NTP+a+bNrToMsIdX/NUqhw+npjLDhlMZ/PhSHZN4s9NdmuumcxKHQqbHlGVqc8ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       
</head>
<body>
    <div id="dashboardmaincontainer">
        <?php include('partials/app-sidebar.php')?>
        <div class="dasboardcontentcontainer">
        <?php include('partials/app-topnav.php')?>      
            <div class="dashboardcontent">
                <div class="dashboardontentmain">
                <div class="row">
                    <div class=" column column-5">
                        <h1 class="section_header"><i class="fa fa-plus"></i>CREATE USER</h1>
                    <div class="useraddformcontainer">
                    <form action="database/add.php" class="appform" method="POST">
                        <div class="appforminputcontainer">
                            <label for="firstname">First Name</label>
                            <input type="text" class="appforminput" id="firstname" name="firstname"/>
                        </div>
                        <div class="appforminputcontainer">
                            <label for="lastname">Last Name</label>
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
                    <div class="column column-7">
                    <h1 class="section_header"><i class="fa fa-list"></i>List Of users</h1>
                    <div class="section_content">
                        <div class="users">
                            <table>
                                <thead>
                                    
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        foreach($users as $index=>$user){?>
                                        <tr>
                                        <td><?= $index + 1 ?></td>        
                                    <td class="firstname"><?= $user['firstname'] ?></td>
                                    <td class="lastname"><?= $user['lastname'] ?></td>
                                    <td class="email"><?= $user['email'] ?></td>
                                    <td><?= $user['created_at'] ?></td>
                                    <td><?= $user['updated_at'] ?></td>
                                    <td>
                                        
                                        <a href="" class="deleteuser" data-userid="<?= $user['id'] ?>" data-fname="<?= $user['firstname']?>" data-lname="<?= $user['lastname']?>">
                                        <i class="fa fa-trash"></i>Delete</a>
                                    </td>
                                </tr>
                                        <?php } ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <script src="js/jquery/jquery-3.7.1.min.js"></script>
    <!-- Latest compiled and minified CSS -->

    <script>
    function script(){
        this.initialize=function(){
            this.registerEvents();
        },
        this.registerEvents=function(){
            document.addEventListener('click',function(e){
                targetElement=e.target;
                classList= targetElement.classList;

                if(classList.contains('deleteuser')){
                    e.preventDefault();
                    userid=targetElement.dataset.userid
                    fname=targetElement.dataset.fname
                    lname=targetElement.dataset.lname

                    if(window.confirm('Are you Sure to delete?')){
                        $.ajax({
                            method:'POST',
                            data:{
                                id: userid,
                                table:'users',
                                
                            },
                            url:'database/delete.php',
                            dataType:'json',
                            success:function(data){
                                
                                message=data.success ?
                                fname + 'successfully deleted':'Error processing your request';

                                if (data.success) {
                                    if (window.confirm(message)) {
                                        location.reload();
                                    }
                                    else{
                                        window.alert(message);
                                    }
                                }
                            }
                        })
                    }
                    else{
                        console.log('will not delete');
                    }
                }
                
                    });
                }
            
        }
    

    var script = new script;
    script.initialize();
</script>


</body>
</html>
