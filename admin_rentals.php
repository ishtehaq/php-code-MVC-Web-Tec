<?php require_once "../Controller/admin_rentals_controller.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - View Rentals</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #c3e6cb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            color: #d9534f;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .no-rentals {
            text-align: center;
            color: #d9534f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Rented Cars</h1>

        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='message'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
        ?>

        <?php if ($rentals->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Car Model</th>
                    <th>Car Plate</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Rent Date</th>
                    <th>Return Date</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = $rentals->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['car_model'] ?></td>
                        <td><?= $row['car_plate'] ?></td>
                        <td><?= $row['customer_name'] ?></td>
                        <td><?= $row['customer_phone'] ?></td>
                        <td><?= $row['rent_date'] ?></td>
                        <td><?= $row['return_date'] ?></td>
                        <td><a href="admin_rentals.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p class="no-rentals">No rented cars found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
