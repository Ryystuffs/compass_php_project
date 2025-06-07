<?php

// Get search parameters
$query = $_GET['query'] ?? '';
$budget = $_GET['budget'] ?? '';
$duration = $_GET['duration'] ?? '';
$activity = $_GET['activity'] ?? '';

// In a real application, you would query your database here
// This is just a placeholder structure
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results | Compass</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <a href="compassHome.php"><img src="../assets/images/compass_logo.gif" alt="Compass Logo" /></a>
    </header>

    <nav>
        <a href="tripPlanner.php"><img src="../assets/images/MenuTripPlanner.gif" alt="Trip Planner"></a>
        <a href="destination.php"><img src="../assets/images/MenuDestinations.gif" alt="Destinations"></a>
        <a href="travelLog.php"><img src="../assets/images/MenuTravelLogs.gif" alt="Travel Logs"></a>

        <form action="../auth/logout.php" method="post" class="logout-form">
            <button class="logout-btn">Logout</button>
        </form>
    </nav>


    <main>
        <div class="page-header">
            <h1>Search Results</h1>
        </div>

        <div class="search-info">
            <?php if ($query): ?>
                <p>Showing results for: <strong>"<?= htmlspecialchars($query) ?>"</strong></p>
            <?php endif; ?>

            <?php
            $filters = [];
            if ($budget) $filters[] = "Budget: $budget";
            if ($duration) $filters[] = "Duration: $duration";
            if ($activity) $filters[] = "Activity: $activity";

            if (!empty($filters)): ?>
                <p>Filters: <?= implode(', ', $filters) ?></p>
            <?php endif; ?>
        </div>

        <div class="destinations">
            <!-- Example of a filtered result - in reality you would loop through database results -->
            <?php if ($activity === 'surfing' || (!$activity && !$query)): ?>
                <div class="destination-card">
                    <div class="destination-header">
                        <h2 class="destination-title">California Surfing</h2>
                        <span class="destination-price">$960</span>
                    </div>
                    <div class="destination-content">
                        <div class="destination-icon">🏄</div>
                        <div class="destination-description">
                            Be ready to go on a moment's notice. We will call you when the surf is pumping and fly you out for five mornings of hurricane inspired summertime swells.
                        </div>
                    </div>
                    <img src="images/surf.jpg" alt="Surfing in California" class="destination-image">
                    <p class="destination-includes">Includes lodging, food and airfare.</p>
                    <a href="detailSurf.php" class="btn">More Details</a>
                </div>
            <?php endif; ?>

            <?php if ($activity === 'california' || (!$activity && !$query)): ?>
                <div class="destination-card">
                    <div class="destination-header">
                        <h2 class="destination-title">California Surfing</h2>
                        <span class="destination-price">$960</span>
                    </div>
                    <div class="destination-content">
                        <div class="destination-icon">🏄</div>
                        <div class="destination-description">
                            Be ready to go on a moment's notice. We will call you when the surf is pumping and fly you out for five mornings of hurricane inspired summertime swells.
                        </div>
                    </div>
                    <img src="images/surf.jpg" alt="Surfing in California" class="destination-image">
                    <p class="destination-includes">Includes lodging, food and airfare.</p>
                    <a href="detailSurf.php" class="btn">More Details</a>
                </div>
            <?php endif; ?>

            <?php if ($activity === 'mountain biking' || (!$activity && !$query)): ?>
                <div class="destination-card">
                    <div class="destination-header">
                        <h2 class="destination-title">New Zealand Mountain Biking</h2>
                        <span class="destination-price">$1490</span>
                    </div>
                    <div class="destination-content">
                        <div class="destination-icon">🚵</div>
                        <div class="destination-description">
                            Beautiful scenery combined with steep inclines and fast roads allowed for some great cycling. Don't forget the helmet!!
                        </div>
                    </div>
                    <img src="images/mountains.jpg" alt="Mountain biking in New Zealand" class="destination-image">
                    <p class="destination-includes">Includes lodging, food and airfare.</p>
                    <a href="detailMtBike.php" class="btn">More Details</a>
                </div>
            <?php endif; ?>

            <?php if ($activity === 'new zealand' || (!$activity && !$query)): ?>
                <div class="destination-card">
                    <div class="destination-header">
                        <h2 class="destination-title">New Zealand Mountain Biking</h2>
                        <span class="destination-price">$1490</span>
                    </div>
                    <div class="destination-content">
                        <div class="destination-icon">🚵</div>
                        <div class="destination-description">
                            Beautiful scenery combined with steep inclines and fast roads allowed for some great cycling. Don't forget the helmet!!
                        </div>
                    </div>
                    <img src="images/mountains.jpg" alt="Mountain biking in New Zealand" class="destination-image">
                    <p class="destination-includes">Includes lodging, food and airfare.</p>
                    <a href="detailMtBike.php" class="btn">More Details</a>
                </div>
            <?php endif; ?>

            <?php if ($activity === 'rock climbing' || (!$activity && !$query)): ?>
                <div class="destination-card">
                    <div class="destination-header">
                        <h2 class="destination-title">Devil's Tower Climbing</h2>
                        <span class="destination-price">$740</span>
                    </div>
                    <div class="destination-content">
                        <div class="destination-icon">🧗</div>
                        <div class="destination-description">
                            In this three day trip you'll scale the majestic cliffs of beautiful Devil's Tower, Wyoming.
                        </div>
                    </div>
                    <img src="images/climber_small.jpg" alt="Climbing Devil's Tower" class="destination-image">
                    <p class="destination-includes">Includes lodging, food and airfare.</p>
                    <a href="detailRockClimb.php" class="btn">More Details</a>
                </div>
            <?php endif; ?>

            <?php if ($activity === 'Wyoming' || (!$activity && !$query)): ?>
                <div class="destination-card">
                    <div class="destination-header">
                        <h2 class="destination-title">Devil's Tower Climbing</h2>
                        <span class="destination-price">$740</span>
                    </div>
                    <div class="destination-content">
                        <div class="destination-icon">🧗</div>
                        <div class="destination-description">
                            In this three day trip you'll scale the majestic cliffs of beautiful Devil's Tower, Wyoming.
                        </div>
                    </div>
                    <img src="images/climber_small.jpg" alt="Climbing Devil's Tower" class="destination-image">
                    <p class="destination-includes">Includes lodging, food and airfare.</p>
                    <a href="detailRockClimb.php" class="btn">More Details</a>
                </div>
            <?php endif; ?>

        </div>
    </main>
</body>

</html>