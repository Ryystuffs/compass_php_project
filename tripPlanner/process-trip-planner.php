<?php
session_start();
if (isset($_SESSION["user_id"]) && !empty($_POST["city"]) &&
    !empty($_POST["country"]) &&
    !empty($_POST["activities"]) &&
    !empty($_POST["info"])) {


        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $user_id = $_SESSION["user_id"];
            $mysqli = require __DIR__ . "/../config/database.php";

            

            $sql = "INSERT INTO trip_planner (user_id, city, country, activities, info) VALUES (?, ?, ?, ?, ?)";
            $stmt = $mysqli->stmt_init();


            if (!$stmt->prepare($sql)) {
                die("SQL error: " . $mysqli->error);
            }

            $city = $_POST["city"];
            $country = $_POST["country"];
            $activities = implode(", ", $_POST["activities"]);
            $info = implode(", ", $_POST["info"]);
            $stmt->bind_param("issss", $user_id, $city, $country, $activities, $info);
            if ($stmt->execute()) {
                $_SESSION['success'] = "Trip successfully planned!";
                header("Location: tripPlannerMain.php");
                exit;
            } else {
                $_SESSION['error'] = "An error occurred while planning your trip.";
                header("Location: tripPlanner.php");
                exit;
            }
        }   

    }else {
        $_SESSION['error'] = "The form is empty.";
        header("Location: tripPlanner.php");
        exit;
    }
?>