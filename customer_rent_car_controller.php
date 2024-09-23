<?php

require_once "../Model/db.php";

$errors = [];
$car_id = $customer_name = $customer_phone = $return_date = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_id = $_POST['car_id'];
    $customer_name = trim($_POST['customer_name']);
    $customer_phone = trim($_POST['customer_phone']);
    $return_date = $_POST['return_date'];

    if (empty($customer_name)) {
        $errors[] = "Customer name is required.";
    }

    if (!preg_match("/^01[0-9]{9}$/", $customer_phone)) {
        $errors[] = "Phone number must be 11 digits and start with '01'.";
    }

    $current_date = date('Y-m-d');
    if (empty($return_date) || $return_date <= $current_date) {
        $errors[] = "Return date must be a future date.";
    }

    if (empty($errors)) {
        $rent_date = $current_date;

        $connection->query("INSERT INTO rentals (car_id, customer_name, customer_phone, rent_date, return_date)
                            VALUES ('$car_id', '$customer_name', '$customer_phone', '$rent_date', '$return_date')");

        $connection->query("UPDATE cars SET status = 'rented' WHERE id = '$car_id'");

        $_SESSION['success'] = "Car rented successfully!";

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

$result = $connection->query("SELECT * FROM cars WHERE status = 'available'");
?>
