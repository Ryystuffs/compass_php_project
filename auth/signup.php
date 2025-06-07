<?php
// signup.php
// This file handles the signup process for new users.
// It includes the necessary database connection and processes the form submission.
$is_invalid = false;
$errormsg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {




    // Validate the form data
    if (empty($_POST["name"])) {
        $errormsg = "Name is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errormsg = "Invalid email format.";
    } elseif (empty($_POST["username"])) {
        $errormsg = "Username is required.";
    } elseif (strlen($_POST["password"]) < 8) {
        $errormsg = "Password must be at least 8 characters long.";
    } elseif (!preg_match("/[a-z]/i", $_POST["password"])) {
        $errormsg = "Password must contain at least one letter.";
    } elseif (!preg_match("/[0-9]/", $_POST["password"])) {
        $errormsg = "Password must contain at least one number.";
    } elseif ($_POST["password"] !== $_POST["password-confirmation"]) {
        $errormsg = "Passwords must match.";
    } elseif (!isset($_POST["terms"])) {
        $errormsg = "You must agree to the Terms of Service and Privacy Policy.";
    }
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    if ($errormsg == "") {

        $is_invalid = true;

        if ($is_invalid == true) {

            $mysqli = require __DIR__ . "/../config/database.php";

            $sql = "INSERT INTO user(name, email, username, password_hash) VALUES (?, ?, ?, ?)";
            $stmt = $mysqli->stmt_init();
            if (!$stmt->prepare($sql)) {
                $errormsg = "SQL error: " . $mysqli->error;
            }
            $stmt->bind_param("ssss", $_POST["name"], $_POST["email"], $_POST["username"], $password_hash);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit;
            } else {
                if ($mysqli->errno === 1062) {
                    $errormsg = "Email or Username already taken.";
                } else {
                    $errormsg = $mysqli->error . " " . $mysqli->errno;
                }
            }
        } else {
            $errormsg = $mysqli->error . " " . $mysqli->errno;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>

<body>

    <div id="terms-modal" class="modal">
        <div class="modal-content">
            <span class="close" id="close-terms">&times;</span>
            <div class="terms-container">
                <!-- Place your terms and conditions content here -->
                <h1>Terms and Conditions</h1>
                <p class="last-updated">Last updated: June 15, 2023</p>
                <p>Welcome to COMPASS! These terms and conditions outline the rules and regulations for the use of our website and services.</p>

                <h2>1. Acceptance of Terms</h2>
                <p>By accessing this website, we assume you accept these terms and conditions. Do not continue to use COMPASS if you do not agree to all of the terms and conditions stated on this page.</p>

                <h2>2. User Responsibilities</h2>
                <p>As a user of our website, you agree to:</p>
                <ul>
                    <li>Provide accurate and complete information when creating an account</li>
                    <li>Maintain the confidentiality of your account credentials</li>
                    <li>Not use our services for any illegal or unauthorized purpose</li>
                    <li>Not violate any laws in your jurisdiction</li>
                </ul>

                <h2>3. Intellectual Property</h2>
                <p>Unless otherwise stated, COMPASS and/or its licensors own the intellectual property rights for all material on this website. You may access this for your own personal use subjected to restrictions set in these terms and conditions.</p>

                <h2>4. Privacy Policy</h2>
                <p>Your use of our website is also governed by our Privacy Policy, which explains how we collect, use, and protect your personal information. Please review our <a href="privacy.html" style="color: var(--primary);">Privacy Policy</a>.</p>

                <h2>5. Service Modifications</h2>
                <p>COMPASS reserves the right to:</p>
                <ul>
                    <li>Modify or discontinue any service with or without notice</li>
                    <li>Change pricing for any paid services</li>
                    <li>Refuse service to anyone for any reason at any time</li>
                </ul>

                <h2>6. Limitation of Liability</h2>
                <p>In no event shall COMPASS, nor any of its officers, directors, and employees, be held liable for anything arising out of or in any way connected with your use of this website.</p>

                <h2>7. Governing Law</h2>
                <p>These terms shall be governed by and construed in accordance with the laws of the State of California, without regard to its conflict of law provisions.</p>

                <h2>8. Changes to Terms</h2>
                <p>We reserve the right to modify these terms at any time. We will notify users of any changes by posting the new terms on this page. Your continued use of the service after any changes constitutes acceptance of the new terms.</p>

                <!-- ...rest of your terms... -->
            </div>
        </div>
    </div>

    <div class="intro-header">
        <h1>Welcome to Compass</h1>
        <p class="intro-description">Welcome to Compass — your adventure planner. Sign up to explore destinations, manage your itineraries, and turn your travel dreams into reality.</p>
        <div class="login-form">
            <h2>Signup</h2>
            <?php if ($errormsg): ?>
                <em>
                    <div class="form-group" style="color: #e74c3c;"><?= $errormsg ?></div>
                </em>
            <?php endif; ?>
            <div class="form-box">
                <form action="signup.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Username">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="password-confirmation">Repeat Password</label>
                        <input type="password" id="password-confirmation" name="password-confirmation" placeholder="Repeat Password">
                    </div>
                    <div class="show-password">
                        <input type="checkbox" id="show-password" class="show-password-checkbox">Show Password
                    </div>
                    <label class="options">
                        <input type="checkbox" name="terms" value="1">
                        I agree to the <a href="#" id="open-terms">Terms of Service</a> and <a href="#" id="open-terms">Privacy Policy</a>.
                    </label>
                    <button>Sign up</button>




                </form>

                <div class="options">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>



            </div>
        </div>
    </div>


    <script>
        // Get the modal
        var modal = document.getElementById("terms-modal");

        // Get the button that opens the modal
        var btn = document.getElementById("open-terms");

        // Get the <span> element that closes the modal
        var span = document.getElementById("close-terms");

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        document.getElementById('show-password').addEventListener('change', function() {
            const passwordField = document.getElementById('password');
            const passwordConfirmationField = document.getElementById('password-confirmation');
            if (this.checked) {
                passwordField.setAttribute('type', 'text');
                passwordConfirmationField.setAttribute('type', 'text');
            } else {
                passwordField.setAttribute('type', 'password');
                passwordConfirmationField.setAttribute('type', 'password');
            }   
        });
    </script>
</body>

</html>