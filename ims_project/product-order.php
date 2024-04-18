<?php
session_start();
if(!isset($_SESSION['user'])) header('location: login.php');

$_SESSION['table']='order_product';
$show_table='order_product';
$_SESSION['redirect_to']='product-order.php';

$order_product=include('database/show.php');

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
                        <h1 class="section_header"><i class="fa fa-plus"></i>ADD Order</h1>
                    <div class="useraddformcontainer">
                    <form action="database/add.php" class="appform" method="POST">
                        <div class="appforminputcontainer">
                            <label for="quantity_ordered"> Quantity Ordered</label>
                            <input type="text" class="appforminput" id="quantity_ordered" name="quantity_ordered"/>
                        </div>
                        <div class="appforminputcontainer">
                            <label for="quantity_recieved">Quantity Recieved</label>
                            <input type="text" class="appforminput" id="quantity_recieved" name="quantity_recieved"/>
                        </div>
                        <div class="appforminputcontainer">
                        <label for="supplier">Supplier id</label>
                            <input type="number" class="appforminput" id="supplier" name="supplier"/>                         
                           
                        </div>
                        <div class="appforminputcontainer">
                        <label for="product">Product id</label>
                            <input type="number" class="appforminput" id="product" name="product"/>                         
                           
                        </div>
                        
                       
                        
                        <button type="submit" class="appbtn"><i class="fa fa-plus"></i>Add </button>
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
                    <h1 class="section_header"><i class="fa fa-list"></i>List Of Orders</h1>
                    <div class="section_content">
                        <div class="users">
                            <table>
                                <thead>
                                    
                                <tr>
                                    <th>#</th>
                                    <th>quantity ordered</th>
                                    <th>quantity recieved</th>
                                    <th>Created_by</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        foreach($order_product as $index=>$product){?>
                                        <tr>
                                        <td><?= $index + 1 ?></td>        
                                    <td class="quantity_ordered"><?= $product['quantity_ordered'] ?></td>
                                    <td class="quantity_recieved"><?= $product['quantity_recieved'] ?></td>
                                    <td><?= $product['created_by'] ?></td>
                                    <td><?= $product['created_at'] ?></td>
                                    <td><?= $product['updated_at'] ?></td>
                                    <td>
                                        
                                        <a href="" class="deleteorder" data-pid="<?= $product['id'] ?>" data-ordered="<?= $product['quantity-ordered'] ?>" data-recieved="<?= $product['quantity_recieved']?>">
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

                if(classList.contains('deleteorder')){
                    e.preventDefault();
                    pid=targetElement.dataset.pid;
                     ordered=targetElement.dataset.ordered;
                     recieved=targetElement.dataset.recieved;

                    if(window.confirm('Are you Sure to delete?')){
                        $.ajax({
                            method:'POST',
                            data:{
                                id: pid,
                                table:'order_product'
                            },
                            url:'database/delete.php',
                            dataType:'json',
                            success:function(data){
                                message=data.success ?
                                pid + 'successfully deleted':'Error processing your request';

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
