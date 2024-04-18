<?php
session_start();
if(!isset($_SESSION['user'])) header('location: login.php');

$_SESSION['table']='products';
$show_table='products';
$_SESSION['redirect_to']='products-add.php';

$products=include('database/show.php');

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
                        <h1 class="section_header"><i class="fa fa-plus"></i>ADD PRODUCT</h1>
                    <div class="useraddformcontainer">
                    <form action="database/add.php" class="appform" method="POST">
                        <div class="appforminputcontainer">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="appforminput" id="product_name" name="product_name"/>
                        </div>
                        <div class="appforminputcontainer">
                            <label for="description">Description</label>
                            <input type="text" class="appforminput" id="description" name="description"/>
                        </div>
                        <div class="appforminputcontainer">
                            <label for="suppliers">Suppliers</label>
                           <select name="suppliers[]" id="suppliers" multiple="">
                            <?php
                            $show_table='suppliers';
                            $suppliers=include('database/show.php');
                            foreach($suppliers as $supplier){
                                echo"<option value='".$supplier['id'] ."'> ". $supplier['supplier_name']."</option>";
                            }
                            ?>
                           
                           </select>
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
                    <h1 class="section_header"><i class="fa fa-list"></i>List Of Products</h1>
                    <div class="section_content">
                        <div class="users">
                            <table>
                                <thead>
                                    
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Created_by</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        foreach($products as $index=>$product){?>
                                        <tr>
                                        <td><?= $index + 1 ?></td>        
                                    <td class="product_name"><?= $product['product_name'] ?></td>
                                    <td class="description"><?= $product['description'] ?></td>
                                    <td><?= $product['created_by'] ?></td>
                                    <td><?= $product['created_at'] ?></td>
                                    <td><?= $product['updated_at'] ?></td>
                                    <td>
                                        
                                        <a href="" class="deleteproduct" data-name="<?= $product['product_name'] ?>" data-pid="<?= $product['id']?>">
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

                if(classList.contains('deleteproduct')){
                    e.preventDefault();
                     pid=targetElement.dataset.pid;
                     pname=targetElement.dataset.name;

                    if(window.confirm('Are you Sure to delete?')){
                        $.ajax({
                            method:'POST',
                            data:{
                                id: pid,
                                table:'products'
                            },
                            url:'database/delete.php',
                            dataType:'json',
                            success:function(data){
                                message=data.success ?
                                pname + 'successfully deleted':'Error processing your request';

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
