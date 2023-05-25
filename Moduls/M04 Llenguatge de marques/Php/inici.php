<?php
session_start();

// Comprovar si l'usuari ja ha iniciat sessió
if (isset($_SESSION['usuari']) && isset($_SESSION['contrasenya'])) {
    header("Location: formulari.php");
    exit;
}

// Comprovar si s'ha enviat el formulari
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtindre les dades del formulari
    $nomUsuari = $_POST['nom_usuari'];
    $contrasenya = $_POST['contrasenya'];

    // Comprovar les credencials
    $usuariValid = 'usuari'; // Nom d'usuari vàlid (modifica'l si vols)
    $contrasenyaValida = 'contrasenya'; // Contrasenya vàlida (modifica-la si vols)

    if ($nomUsuari === $usuariValid && $contrasenya === $contrasenyaValida) {
        // Credencials vàlides, iniciar sessió i redirigir a la pàgina formulari.php
        $_SESSION['usuari'] = $nomUsuari;
        $_SESSION['contrasenya'] = $contrasenya;
        header("Location: formulari.php");
        exit;
    } else {
        // Credencials no vàlides, mostrar missatge d'error
        $missatgeError = "L'usuari o contrasenya no són vàlids.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pàgina d'inici</title>
</head>
<body>
    <?php if (isset($missatgeError)): ?>
        <p style="color: red;"><?php echo $missatgeError; ?></p>
    <?php endif; ?>

    <form method="POST" action="inici.php">
        <label>Nom d'usuari:</label>
        <input type="text" name="nom_usuari" required><br>

        <label>Contrasenya:</label>
        <input type="password" name="contrasenya" required><br>

        <input type="submit" value="Iniciar sessió">
    </form>
</body>
</html>
