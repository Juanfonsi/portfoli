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
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="inici.css">
</head>
<body>
    <div class= login>
    <h1>Fins a un altre <?php echo $_SESSION['usuari']; ?>.</h1>
    <button onclick="window.location.href='inici.php'">Torna a Inici</button>
    <?php session_destroy();?>

    </div>
</body>
</html>
