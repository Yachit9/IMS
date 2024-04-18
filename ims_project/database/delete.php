<?php
$data = $_POST;
$id = (int)$data['id'];
$table = $data['table'];

try {
    include('connection.php');
    
    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM $table WHERE id = :id");
    $stmt->bindParam(':id', $id);
    
    // Execute the statement
    $stmt->execute();
    
    // Check if any rows were affected
    $success = $stmt->rowCount() > 0;

    echo json_encode([
        'success' => $success
    ]);
} catch (PDOException $e) {
    // Output the error message
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage() // Output the error message for debugging
    ]);
}
?>
