<?php
session_start();

include('table_columns.php');

$table_name=$_SESSION['table'];
$columns=$table_columns_mapping[$table_name];


$db_array=[];
$user=$_SESSION['user'];
foreach($columns as $column){
    if(in_array($column,['created_at','updated_at'])) $value=date('Y-m-d H:i:s');
    else if($column == 'created_by') $value=$user['id'];
    else $value = isset($_POST[$column])?$_POST[$column]:'';
    $db_array[$column]=$value;
}
        

$table_properties=implode(",",array_keys($db_array));
$table_placeholders=':'. implode(",:",array_keys($db_array));


// $table_name=$_POST['table'];
// $firstname=$_POST['firstname'];
// $lastname=$_POST['lastname'];
// $email=$_POST['email'];
// $password=$_POST['password'];





try {
    $sql="INSERT INTO $table_name($table_properties) VALUES ($table_placeholders)";

    include('connection.php');
    $stmt=$conn->prepare($sql);
    $stmt->execute($db_array);

    $product_id=$conn->lastInsertId();
    if($table_name=='products'){
        $suppliers= isset($_POST['suppliers']) ? $_POST['suppliers'] : [];

        if ($suppliers) {
            foreach($suppliers as $supplier){
                $supplier_data=[
                    'supplier_id'=>$supplier,
                    'product_id'=>$product_id,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ];

                $sql="INSERT INTO productsuppliers(supplier,product,created_at,updated_at) VALUES (:supplier_id,:product_id,:created_at,:updated_at)";

                 
                 $stmt=$conn->prepare($sql);
                 $stmt->execute($supplier_data);
            }

        }
    }
    


    $response=[
        'success'=>true,
        'message' =>'successfully added to the system'
    ];
} catch(PDOException $e) {
   $response=[ 
    'success'=>false,
    'message' => $e->getMessage()
];
}
$_SESSION['response']=$response; 
header('location: ../' .$_SESSION['redirect_to']);
?>