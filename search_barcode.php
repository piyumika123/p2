<?php
if (isset($_GET['barcode_number']) && strlen($_GET['barcode_number']) == 13) {
    $barcode = $_GET['barcode_number'];
    $conn = new mysqli("localhost", "username", "password", "database_name");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Search for the barcode
    $sql = "SELECT * FROM supermarket_stock WHERE barcode_number = ? ORDER BY barcode_number ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $barcode);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        // Display item_name ordered by item_name
        $sql2 = "SELECT item_name FROM supermarket_stock WHERE barcode_number = ? ORDER BY item_name ASC";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("s", $barcode);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        while ($row2 = $result2->fetch_assoc()) {
            echo "Item Name: " . htmlspecialchars($row2['item_name']) . "<br>";
        }
        $stmt2->close();
    } else {
        echo "No item found for this barcode.";
    }
    $stmt->close();
    $conn->close();
}
?>