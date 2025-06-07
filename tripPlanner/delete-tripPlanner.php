<?php

    require __DIR__ . "/../config/database.php";
    if (isset($_GET["deleteid"])) {
        $id = $_GET["deleteid"];

        $sql = "DELETE FROM trip_planner WHERE id = ?";
        $stmt = $mysqli->stmt_init();
        if (!$stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "Trip deleted successfully.";
            header("Location: tripPlannerMain.php");
            exit;
        } else {
            session_start();
            $_SESSION['error'] = "Error deleting trip.";
            header("Location: tripPlannerMain.php");
            exit;
        }


    }
?>