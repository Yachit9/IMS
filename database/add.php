<?php
session_start();

$table_name=$_POST['table'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$password=$_POST['password'];
$encrypted=password_hash($password,PASSWORD_DEFAULT);

$command="INSERT INTO $table_name(firstname,lastname,email,password) VALUES ('".$firstname."','".$lastname."','".$email."','".$encrypted."' )";


try {
    include('connection.php');
    $conn->exec($command);
    $response=[
        'success'=>true,
        'message' =>$firstname . ' ' . $lastname . 'successfully added to the system'
    ];
} catch(PDOException $e) {
   $response=[ 
    'success'=>false,
    'message' => $e->getMessage()
];
}
$_SESSION['response']=$response; 
header('location: ../users-add.php');
?>