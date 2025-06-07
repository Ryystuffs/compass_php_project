<?php
    $token = $_POST['token'];

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


if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters long.");
}
if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter.");
}
if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least number.");
}

if ($_POST["password"] !== $_POST["password-confirmation"]) {
    die("Passwords must match.");
}
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE user
        SET password_hash = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE ID = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("ss", $password_hash, $user["ID"]);
$stmt->execute();
echo "Password reset successfully.";
header("Location: login.php");
exit;

?>
