<?php

include 'db_connection.php';

$sql = "SELECT * FROM orders WHERE status='confirmed'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dispatch Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #343a40;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 3px rgba(0,0,0,0.1);
            background-color: #ffffff;
        }
        th, td {
            padding: 12px;
            border: 1px solid #dee2e6;
            text-align: left;
        }
        th {
            background-color: #343a40;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 20px;
        }
        .form-container input, .form-container select {
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        .form-container input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Dispatch Panel</h1>
    <table>
        <tr>
            <th>Order Number</th>
            <th>Consumer Name</th>
            <th>Tracking Number</th>
            <th>Tracking Link</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['order_number'] . "</td>";
                echo "<td>" . $row['consumer_name'] . "</td>";
                echo "<form method='POST' action='update_order.php' class='form-container'>";
                echo "<td><input type='text' name='tracking_number' value='" . $row['tracking_number'] . "'></td>";
                echo "<td><input type='text' name='tracking_link' value='" . $row['tracking_link'] . "'></td>";
                echo "<td>
                        <select name='status'>
                            <option value='pending' " . ($row['status'] == 'pending' ? 'selected' : '') . ">Pending</option>
                            <option value='picked' " . ($row['status'] == 'picked' ? 'selected' : '') . ">Picked</option>
                            <option value='in transit' " . ($row['status'] == 'in transit' ? 'selected' : '') . ">In Transit</option>
                            <option value='delivered' " . ($row['status'] == 'delivered' ? 'selected' : '') . ">Delivered</option>
                        </select>
                      </td>";
                echo "<td><input type='hidden' name='id' value='" . $row['id'] . "'><input type='submit' value='Update'></td>";
                echo "</form>";
                echo "</tr>";
            }
        } 
        else {
            echo "<tr><td colspan='6'>No confirmed orders found</td></tr>";
        }
        ?>
    </table>
</body>
</html>


<!-- 
    http://localhost/dispatch_panel/dispatch_panel.php
-->