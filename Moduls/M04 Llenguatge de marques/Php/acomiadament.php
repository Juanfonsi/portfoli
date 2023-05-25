<?php
session_start();
if (!isset($_SESSION['usuari'])) {
    header("Location: inici.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Acomiadament</title>
    <style>
        .message {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Fins a un altre <?php echo $_SESSION['usuari']; ?>.</h1>
    <button onclick="window.location.href='inici.php'">Torna a Inici</button>
</body>
</html>