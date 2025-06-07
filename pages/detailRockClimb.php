<?php
session_start();
if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Devils Tower Getaway | Compass</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #fefefe;
      color: #222;
      line-height: 1.6;
    }

    header {
      background-color: #000;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 1rem 0;
    }

    header img {
      height: 36px;
    }

    nav {
      background-color: #222;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 2rem;
      padding: 0.75rem 0;
    }

    nav a img {
      height: 24px;
      transition: transform 0.2s ease;
    }

    nav a:hover img {
      transform: scale(1.1);
    }

    .logout-form {
      display: flex;
      align-items: center;
      height: 24px;
    }

    .logout-btn {
      background: #ffcc66;
      color: #222;
      font-weight: bold;
      border: none;
      padding: 0.25rem 0.75rem;
      font-size: 14px;
      border-radius: 4px;
      cursor: pointer;
      transition: background 0.3s ease, color 0.3s ease;
      height: 100%;
    }

    .logout-btn:hover {
      background: #ffa94d;
      color: #000;
    }

    main {
      max-width: 1100px;
      margin: 2rem auto;
      padding: 1rem;
      display: flex;
      gap: 2rem;
    }

    .content {
      flex: 3;
    }

    .sidebar {
      flex: 1;
    }

    .page-header {
      margin-bottom: 1.5rem;
    }

    .page-header h1 {
      color: #cc5500;
      margin-bottom: 0.5rem;
    }

    .price-tag {
      background: #cc5500;
      color: white;
      padding: 0.3rem 0.8rem;
      border-radius: 20px;
      font-weight: bold;
      display: inline-block;
      margin-bottom: 1rem;
    }

    .package-details {
      background: #fff8f0;
      border: 1px solid #ffd9a0;
      border-radius: 10px;
      padding: 1.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .included-features {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    .feature-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .feature-icon {
      width: 24px;
      height: 24px;
      background-color: #ffcc66;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.8rem;
    }

    .photo-gallery {
      background: #fff3d6;
      border: 1px solid #f7c778;
      border-radius: 10px;
      padding: 1.5rem;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .photo-gallery h3 {
      color: #b35200;
      margin-top: 0;
    }

    .gallery-thumbnail {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 5px;
      margin-bottom: 1rem;
    }

    .btn {
      display: inline-block;
      background-color: #cc5500;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.9rem;
      transition: all 0.3s;
      border: none;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #b13d00;
      transform: translateY(-2px);
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .activity-image {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 5px;
      margin: 1rem 0;
    }

    @media (max-width: 768px) {
      main {
        flex-direction: column;
      }

      nav {
        flex-wrap: wrap;
        gap: 1rem;
      }

      .included-features {
        grid-template-columns: 1fr;
      }
    }
  </style>
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
    <div class="content">
      <div class="page-header">
        <h1>Devils Tower Getaway</h1>
        <div class="price-tag">$740 - 5 Days</div>
      </div>

      <div class="package-details">
        <p>Wyoming's climbing Mecca, Devil's Tower, stands at 865 feet and offers the beginner or the expert climber 200 fun and challenging routes. (In fact, a 6-year-old boy conquered the Tower in 1994.) The array of cracks in the walls allows you to use your imagination as you test your climbing skills.</p>

        <p>President Teddy Roosevelt named Devils Tower the first national monument in 1906. Today, the park hosts approximately 450,000 visitors annually. And 5,000 of those visitors are climbers. But beware, environmentalists are trying to limit that number, so treat the park with respect.</p>

        <h3>Package Includes:</h3>
        <div class="included-features">
          <div class="feature-item">
            <div class="feature-icon">✈️</div>
            <span>Airfare</span>
          </div>
          <div class="feature-item">
            <div class="feature-icon">🏨</div>
            <span>Lodging</span>
          </div>
          <div class="feature-item">
            <div class="feature-icon">🍽️</div>
            <span>Food</span>
          </div>
          <div class="feature-item">
            <div class="feature-icon">🧭</div>
            <span>Local Guide</span>
          </div>
        </div>
      </div>
    </div>

    <div class="sidebar">
      <div class="photo-gallery">
        <h3>OTHER THINGS TO DO</h3>
        <img src="../assets/images/viewPhotos_off.gif" alt="New Zealand photos" class="gallery-thumbnail">
        <p>Take a look at our slide show. We've got several snap shots of the area around your hotel, including some great places to eat, drink, or just hang out.</p>
      </div>
    </div>
  </main>
</body>

</html>