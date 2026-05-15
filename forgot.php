<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="forgotpass.css" type="text/css" rel="stylesheet">
    <title>Forgot Password</title>
</head>
<body>
<div class="card">
        <p class="lock-icon"><i class="fas fa-lock"></i></p>
        <h1>Forgot Password</h1>
        <p>You can reset your Password here</p><br>
        <form method="post" action="sendPassword.php">
        <label for="email">Email</label>
        <input type="email" name="email" style="width: 250px;"><br>
        <input type="submit" value="Send Link" name="forgotpass">
    </form>
</body>
</html>