<?php

require_once "../Model/db.php";

if (isset($_GET['delete'])) {
    $rental_id = $_GET['delete'];

    $car_id_result = $connection->query("SELECT car_id FROM rentals WHERE id = '$rental_id'");
    $car = $car_id_result->fetch_assoc();

    $connection->query("UPDATE cars SET status = 'available' WHERE id = '{$car['car_id']}'");

    $connection->query("DELETE FROM rentals WHERE id = '$rental_id'");

    $_SESSION['message'] = "Rental record deleted successfully!";

    header("Location: admin_rentals.php");
    exit();
}

$rentals = $connection->query("SELECT rentals.id, cars.car_model, cars.car_plate, rentals.customer_name, rentals.customer_phone, rentals.rent_date, rentals.return_date
                               FROM rentals
                               JOIN cars ON rentals.car_id = cars.id");
?>
