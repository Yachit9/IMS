<?php
include('connection.php');
// Check if 'id' parameter is provided and is a valid integer
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    echo "Invalid product ID";
    exit;
}

$id = $_GET['id'];

try {
    // Prepare SQL query
    $stmt = $conn->prepare("
        SELECT supplier_name, suppliers.id
        FROM suppliers, productsuppliers
        WHERE productsuppliers.product = :id
        AND productsuppliers.supplier = suppliers.id
    ");

    // Bind parameter
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute query
    $stmt->execute();

    // Fetch results
    $suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output results for debugging
    
} catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
    exit;
}
