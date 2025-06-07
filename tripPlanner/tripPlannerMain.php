<?php
session_start();
$mysqli = require __DIR__ . "/../config/database.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit;
}
    $user_id = $_SESSION["user_id"];
        $sql = "SELECT name FROM user WHERE ID = ?";
        $stmt = $mysqli->stmt_init();

        if (!$stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }

        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user_name = $result->fetch_assoc();
                
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
            <a href="../pages/compassHome.php"><img src="../assets/images/compass_logo.gif" alt="Compass Logo" /></a>
    </header>

    <nav>
        <a href="tripPlanner.php"><img src="../assets/images/MenuTripPlanner.gif" alt="Trip Planner"></a>
        <a href="../pages/destination.php"><img src="../assets/images/MenuDestinations.gif" alt="Destinations"></a>
        <a href="../pages/travelLog.php"><img src="../assets/images/MenuTravelLogs.gif" alt="Travel Logs"></a>
        <form action="logout.php" method="post" class="logout-form">
            <button class="logout-btn" >Logout</button>
        </form>
    </nav>

    <main>
        <div class="page-header">
            <h1>Welcome! <?php echo htmlspecialchars($user_name['name'])?></h1>
        </div>
        <div class="intro-text">
            <p>Plan your perfect adventure by telling us about your destination and activities.</p>
        </div>


        <div class="trip-table-container" style="overflow-x:auto;">
            <table class="trip-table">
                <thead>
                    <tr>
                        <th scope="col">City</th>
                        <th scope="col">Country</th>
                        <th scope="col">Activities</th>
                        <th scope="col">Info</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                
            

                <?php
                    if (isset($_SESSION['success'])) {
                            echo "<p style='color: red; margin: 15px 15px;'>{$_SESSION['success']}</p>";
                            unset($_SESSION['success']);
                    }
                    

                    if (isset($_SESSION["user_id"])){
                        $user_id = $_SESSION["user_id"];
                        
                        

                        $sql = "SELECT * FROM trip_planner WHERE user_id = ?";
                        $stmt = $mysqli->stmt_init();

                        if (!$stmt->prepare($sql)) {
                            die("SQL error: " . $mysqli->error);
                        }

                        $stmt->bind_param("i", $user_id);

                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {

                            $id = $row["id"];
                            $city = $row["city"];
                            $country = $row["country"];
                            $activities = $row["activities"];
                            $info = $row["info"];
                            echo "<tr scope='row'>";
                            echo "<td>" . htmlspecialchars($city) . "</td>";
                            echo "<td>" . htmlspecialchars($country) . "</td>";
                            echo "<td>" . htmlspecialchars($activities) . "</td>";
                            echo "<td>" . htmlspecialchars($info) . "</td>";
                            echo '<td>
                                <a class="trip-table-btn" href="update-tripPlanner.php?updateid=' . $id . '">UPDATE</a>
                                <a class="trip-table-btn" href="delete-tripPlanner.php?deleteid=' . $id . '">DELETE</a>
                            </td>';
                            echo "</tr>"; 
                        }
                    } else {
                        echo "<p>Please log in to view your trips.</p>";

                    }

                ?>
            </table>
        </div>

    </main>


</body>
</html>