<?php require_once "../Controller/customer_rent_car_controller.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Rent a Car</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            width: 50%;
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

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 18px;
            color: #333;
        }

        select, input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .no-cars {
            text-align: center;
            color: #d9534f;
        }

        .success-message {
            text-align: center;
            color: #28a745;
            margin-bottom: 20px;
        }

        .error-message {
            color: #d9534f;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Available Cars</h1>

        <?php if (isset($_SESSION['success'])): ?>
            <p class="success-message"><?= $_SESSION['success']; ?></p>
            <?php unset($_SESSION['success']);  ?>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if ($result->num_rows > 0): ?>
            <form method="POST">
                <label>Select a car:</label>
                <select name="car_id">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>" <?= $car_id == $row['id'] ? 'selected' : '' ?>>
                            <?= $row['car_model'] ?> (<?= $row['car_plate'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select>

                <label>Customer Name:</label>
                <input type="text" name="customer_name" placeholder="Enter your name" value="<?= $customer_name ?>" >

                <label>Customer Phone:</label>
                <input type="text" name="customer_phone" placeholder="Enter your phone number" pattern="01[0-9]{9}"
                       title="Phone number must start with 01 and be 11 digits long" value="<?= $customer_phone ?>" >

                <label>Return Date:</label>
                <input type="date" name="return_date" value="<?= $return_date ?>" >

                <button type="submit">Rent Car</button>
            </form>
        <?php else: ?>
            <p class="no-cars">No cars available for rent.</p>
        <?php endif; ?>
    </div>
    <form method="post" action="../Controllers/logCheckController.php">
    <button name="logout">Logout</button>
  </form>
</body>
</html>
