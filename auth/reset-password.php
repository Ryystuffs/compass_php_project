<?php
    $token = $_GET['token'];

    $token_hash = hash("sha256", $token);

    $mysqli = require __DIR__ . "/../config/database.php";
    $sql = "SELECT * FROM user WHERE reset_token_hash = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $token_hash);

    $stmt->execute();


    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user === null) {
        die("Invalid token.");
    }

    if (strtotime($user["reset_token_expires_at"]) <= time()) {
        die("Token expired.");
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
    <div class="login-form">
        <h2>Reset Password</h2>
        <div class="form-box">
            <form action="process-reset-password.php" method="POST">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" id="password">
                </div>

                <div class="form-group">
                    <label for="password-confirmation">Repeat Password</label>
                    <input type="password" name="password-confirmation" id="password-confirmation">
                </div>

                <button>Send</button>
            </form>
        </div>
    </div>
</body>
</html>