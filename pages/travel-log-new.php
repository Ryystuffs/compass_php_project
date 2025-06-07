<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelLog</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="intro-header">
        <h1>Welcome to Compass</h1>
        <p class="intro-description">Your adventure starts here!</p>
        <div class="login-form">
            <h2>New Travel Log</h2>
            <form action="" method="">
                <div class="form-group">
                    <input type="text" name="title" id="title" placeholder="Travel Log Title" required></input>
                </div>
                <div class="form-group">
                    <input name="description" id="description" placeholder="Describe your travel experience..." required></input>
                </div>
                <button type="submit" class="btn" id="travelLogsubmit">Submit</button>

            </form>
        </div>
    </div>
</body>
<script>
    const travelLogbtn = document.getElementById("travelLogsubmit");

    travelLogbtn.addEventListener('click', function(e){
        e.preventDefault();

        window.location.href = "travelLog.php";
    });
</script>
</html>