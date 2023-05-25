<?php
session_start();

// Comprobar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuari']) || !isset($_SESSION['contrasenya'])) {
    header("Location: inici.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tancar_sessio'])) {
    // Destruir la sesión y redirigir al usuario a la página acomiadament.php
    session_destroy();
    header("Location: acomiadament.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Final</title>
</head>
<body>
    <header>
        <h1>Benvingut, <?php echo $_SESSION['usuari']; ?>!</h1>
        <form method="POST" action="">
            <input type="submit" name="tancar_sessio" value="Tanca sessió">
        </form>
    </header>

    <h2>Respostes del formulari:</h2>

    <p>Correu electrònic: <?php echo $_SESSION['correu']; ?></p>
    <p>Data: <?php echo $_SESSION['data']; ?></p>
    <p>Opció de radio seleccionada: <?php echo $_SESSION['radio']; ?></p>
    <p>Opcions de checkbox seleccionades:</p>
    <ul>
        <?php foreach ($_SESSION['checkbox'] as $checkbox): ?>
            <li><?php echo $checkbox; ?></li>
        <?php endforeach; ?>
    </ul>
    <p>Opcions de selecció múltiple seleccionades:</p>
    <ul>
        <?php foreach ($_SESSION['select'] as $select): ?>
            <li><?php echo $select; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
