<?php
    require __DIR__ . "/../config/database.php";
    if (isset($_GET["updateid"])) {
        $id = $_GET["updateid"];
        $sql = "SELECT * FROM trip_planner WHERE id = ?";
        $stmt = $mysqli->stmt_init();
        if (!$stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();


        $id = $row["id"];
        $city = $row["city"];
        $country = $row["country"];
        $activities = $row["activities"];
        $info = $row["info"];
        $activitiesArray = explode(", ", $activities);
        $infoArray = explode(", ", $info);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {


            $sql = "Update trip_planner SET city = ?, country = ?, activities = ?, info = ? WHERE id = ?";
            $stmt = $mysqli->stmt_init();


            if (!$stmt->prepare($sql)) {
                die("SQL error: " . $mysqli->error);
            }
            $id = $_GET["updateid"];
            $city = $_POST["city"];
            $country = $_POST["country"];
            $activities = implode(", ", $_POST["activities"]);
            $info = implode(", ", $_POST["info"]);
            
            $stmt->bind_param("ssssi", $city, $country, $activities, $info, $id);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Trip successfully updated!";
                header("Location: tripPlannerMain.php");
                exit;
            } else {
                $_SESSION['error'] = "An error occurred while planning your trip.";
                header("Location: tripPlanner.php");
                exit;
            }
        } 

    } else {
        header("Location: tripPlannerMain.php");
        $_SESSION['error'] = "No trip found to update.";
        exit;
    }
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
            <button type="submit" class="logout-btn">Logout</button>
        </form>

    </nav>

    <main>
        <div class="page-header">
            <h1>Adventure Planner</h1>
        </div>
        <div class="intro-text">
            <p>Plan your perfect adventure by telling us about your destination and activities.</p>
        </div>

    
        <div class="planner-steps">
        
            <form method="post">
                <div class="step">
                    <div class="step-header">
                        <div class="step-number">1</div>
                        <h2 class="step-title">Destination</h2>
                    </div>

                    <p class="step-description">Either select a region on the map or type it into the fields below:</p>
                    
                    <div class="map-container">
                        <img src="../assets/images/AdventureMap.gif" alt="">
                    </div>
                    
                    <div class="input-group">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                        <label for="city">City or closest major city:</label>
                        <input type="text" id="city" class="input-control" name="city" placeholder="e.g. Denver, Kathmandu" value="<?php echo htmlspecialchars($city); ?>">
                    </div>
                    
                    <div class="input-group">
                        <label for="country">Country or Region:</label>
                        <input type="text" id="country" class="input-control" name="country" placeholder="e.g. USA, Nepal" value="<?php echo htmlspecialchars($country); ?>">
                    </div>
                </div>
            
                <div class="step">
                    <div class="step-header">
                        <div class="step-number">2</div>
                        <h2 class="step-title">Activity</h2>
                    </div>

                    <p class="step-description">Tell us what kind of things you'll be doing there:</p>
                    
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="hiking" name="activities[]" value="Hiking" <?php echo in_array("Hiking", $activitiesArray) ? 'checked' : ''; ?>>
                            <label for="hiking">Hiking</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="kayaking" name="activities[]" value="Kayaking" <?php echo in_array("Kayaking", $activitiesArray) ? 'checked' : ''; ?>>
                            <label for="kayaking">Kayaking</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="fishing" name="activities[]" value="Fishing" <?php echo in_array("Fishing", $activitiesArray) ? 'checked' : ''; ?>>
                            <label for="fishing">Fishing</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="mountain-biking" name="activities[]" value="Mountain Biking" <?php echo in_array("Mountain Biking", $activitiesArray) ? 'checked' : ''; ?>>
                            <label for="mountain-biking">Mountain Biking</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="skiing" name="activities[]" value="Skiing" <?php echo in_array("Skiing", $activitiesArray) ? 'checked' : ''; ?>>
                            <label for="skiing">Skiing</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="surfing" name="activities[]" value="Surfing" <?php echo in_array("Surfing", $activitiesArray) ? 'checked' : ''; ?>>
                            <label for="surfing">Surfing</label>
                        </div>
                    </div>
                </div>
            
                <div class="step">
                    <div class="step-header">
                        <div class="step-number">3</div>
                        <h2 class="step-title">Information</h2>
                    </div>
                    <p class="step-description">What kind of information do you want about this trip?</p>
                    
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="transportation" name="info[]" value="Transportation" <?php echo in_array("Transportation", $infoArray) ? 'checked' : ''; ?>>
                            <label for="transportation">Transportation</label>
                        </div>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="weather" name="info[]" value="Weather" <?php echo in_array("Weather", $infoArray) ? 'checked' : ''; ?>>
                        <label for="weather">Weather</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="political" name="info[]" value="Political" <?php echo in_array("Political", $infoArray) ? 'checked' : ''; ?>>
                        <label for="political">Political Info</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="health" name="info[]" value="Health" <?php echo in_array("Health", $infoArray) ? 'checked' : ''; ?>>
                        <label for="health">Health</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="gear" name="info[]" value="Gear" <?php echo in_array("Gear", $infoArray) ? 'checked' : ''; ?>>
                        <label for="gear">Gear</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="activity-specific" name="info[]" value="Activity Specific" <?php echo in_array("Activity Specific", $infoArray) ? 'checked' : ''; ?>>
                        <label for="activity-specific">Activity Specific</label>
                    </div>
                </div>
                
                <div class="step">
                    <div class="step-header">
                        <div class="step-number">4</div>
                        <h2 class="step-title">Update</h2>
                    </div>
                
                    <button type="submit" class="btn btn-block">Update</button>
                </div>
            </form> 
        </div>
    </main>

</body>
</html>