<?php
session_start();
$is_invalid = false;
$errormsg = "";
if (!isset($_SESSION['login_attempts'])) {

    $_SESSION['login_attempts'] = 0;
}


if (isset($_SESSION['locked']) && time() < $_SESSION['locked']) {
    $errormsg = "Too many failed login attempts. Please try again after " . ceil(($_SESSION['locked'] - time())/60) . " minute(s).";
} else {
    $errormsg = "";
    if (isset($_SESSION['locked'])) {
        // If the user is locked out, check if the lockout period has expired
        // If it has, reset the login attempts
        $_SESSION['login_attempts'] = 0; // reset attempts
        // and remove the lock
        unset($_SESSION['locked']); // unlock after 1 minute
    }   
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $mysqli = require __DIR__ . "/../config/database.php";
        $login_input = $mysqli->real_escape_string($_POST["email"]);
        $sql = "SELECT * FROM user WHERE email = '$login_input' OR username = '$login_input'";

        $result = $mysqli->query($sql);
        $user = $result->fetch_assoc();
        
        if (!empty($_POST["email"]) && !empty($_POST["password"])){
            if ($user && password_verify($_POST["password"], $user["password_hash"])){

                session_regenerate_id();
                $_SESSION["user_id"] = $user["ID"];
                
                $_SESSION['login_attempts'] = 0; // reset on success
                unset($_SESSION['locked']); 
                header("Location: ../pages/CompassHome.php");
                exit;

            }else{
                $_SESSION['login_attempts']++;
                if ($_SESSION['login_attempts'] >= 3) {
                    $_SESSION['locked'] = time() + 60 * 1; // lock for 1 minute
                    $errormsg = "Too many failed login attempts. Please try again after 1 minute.";
                    
                } else {
                    $remaining = 3 - $_SESSION['login_attempts'];
                    $errormsg = "Login failed. You have $remaining attempt(s) left.";
                    
                }
            }

        }else {
            $is_invalid = true;
        }

    }
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

    <div class="intro-header">
        <h1>Welcome to Compass</h1>
        <p class="intro-description">Welcome back to Compass — your adventure planner. Log in to explore destinations, manage your itineraries, and turn your travel dreams into reality.</p>
        <div class="login-form">
            <h2>Login</h2>
            <form action="" method="post">

                <div class="form-group">
                    <label for="email">Email or Username</label>
                    <input type="text" name="email" id="email"
                    value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" placeholder="Email or Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password"> 
                </div>
                <div class="show-password">
                    <input type="checkbox" id="show-password" class="show-password-checkbox">Show Password 
                </div>

                    <button>Login</button>

                <?php if ($is_invalid):?>
                    <em>Fill up fields</em>
                <?php endif; ?>    

                <?php if ($errormsg): ?>
                    <em><div class="form-group" style="color: #e74c3c;"><?= $errormsg ?></div></em>
               <?php endif; ?>
                
            </form>
            <div class="options">
                <p>Don't have an account? <a href="signup.php">Sign up</a></p>

                <p>Forgot your password? <a href="forgot-password.php">Reset it</a></p>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('show-password').addEventListener('change', function() {
            const passwordField = document.getElementById('password');
            if (this.checked) {
                passwordField.setAttribute('type', 'text');
            } else {
                passwordField.setAttribute('type', 'password');
            }   
        });
    </script>
</body>
</html>