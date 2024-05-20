<?php

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $tracking_number = $_POST['tracking_number'];
    $tracking_link = $_POST['tracking_link'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE orders SET tracking_number=?, tracking_link=?, status=? WHERE id=?");
    $stmt->bind_param("sssi", $tracking_number, $tracking_link, $status, $id);

    if ($stmt->execute() === TRUE) {
        echo "Record updated successfully";
    } 
    else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: dispatch_panel.php");
}
?>
