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
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="inici.css">
    style
    
.login { 
	position: absolute;
	top: 50%;
	left: 50%;
	margin: -150px 0 0 -150px;
	width:300px;
	height:300px;
}
.login h1 { color: #fff; text-shadow: 0 0 10px rgba(0,0,0,0.3); letter-spacing:1px; text-align:center; }

input { 
	width: 100%; 
	margin-bottom: 10px; 
	background: rgba(0,0,0,0.3);
	border: none;
	outline: none;
	padding: 10px;
	font-size: 13px;
	color: #fff;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
	border: 1px solid rgba(0,0,0,0.3);
	border-radius: 4px;
	box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
	-webkit-transition: box-shadow .5s ease;
	-moz-transition: box-shadow .5s ease;
	-o-transition: box-shadow .5s ease;
	-ms-transition: box-shadow .5s ease;
	transition: box-shadow .5s ease;
}
input:focus { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }

button { 
	width: 100%; 
	margin-bottom: 10px; 
	background: rgba(0,0,0,0.3);
	border: none;
	outline: none;
	padding: 10px;
	font-size: 13px;
	color: #fff;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
	border: 1px solid rgba(0,0,0,0.3);
	border-radius: 4px;
	box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
	-webkit-transition: box-shadow .5s ease;
	-moz-transition: box-shadow .5s ease;
	-o-transition: box-shadow .5s ease;
	-ms-transition: box-shadow .5s ease;
	transition: box-shadow .5s ease;
}
input:focus { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }


    
</head>
<body>
    <?php if (isset($missatgeError)): ?>
        <p style="color: red;"><?php echo $missatgeError; ?></p>
    <?php endif; ?>
    <div class="login">
	<h1>Login</h1>
    <form method="POST" action="inici.php">
        <label>Nom d'usuari:</label>
        <input type="text" name="nom_usuari" required><br>

        <label>Contrasenya:</label>
        <input type="password" name="contrasenya" required><br>

        <input type="submit" value="Iniciar sessió">
    </form>
</div>
</body>
</html>
