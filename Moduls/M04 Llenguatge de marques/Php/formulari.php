<?php
session_start();
caducarSessio();

if (!isset($_SESSION['usuari']) || !isset($_SESSION['contrasenya'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['enviar'])) {
    $email = $_POST['email'];
    $date = $_POST['date'];
    $radio = $_POST['radio'];
    $checkbox = isset($_POST['checkbox']) ? $_POST['checkbox'] : array();
    $select = isset($_POST['select']) ? $_POST['select'] : array();

    if (verificarCorreu($email)) {
        $_SESSION['email'] = $email;
        $_SESSION['date'] = $date;
        $_SESSION['radio'] = $radio;
        $_SESSION['checkbox'] = $checkbox;
        $_SESSION['select'] = $select;
        header('Location: final.php');
        exit();
    } else {
        $error = "L'adreça de correu no és correcta.";
    }
}
function verificarCorreu($email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return false;
    }
    return true;
  }
function caducarSessio() {
    $inactivitat = 300;
    if (isset($_SESSION['temps']) && (time() - $_SESSION['temps']) > $inactivitat) {
        session_unset();
        session_destroy();
        header('Location: inici.php?caducada=true');
        exit();
    }
    $_SESSION['temps'] = time();
}

function tancarSessio() {
    session_unset();
    session_destroy();
    header('Location: acomiadament.php');
    exit();
  }

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 300)) {
    session_unset();
    session_destroy();
    header("Location: index.php?caducada");
    exit();
}

$_SESSION['last_activity'] = time();

if (!isset($_SESSION['usuari'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['tancar'])) {
    tancarSessio();
    exit();
}
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>Formulari</title>
</head>

<body>
    <header>
        <h1>Benvingut,
            <?php echo $_SESSION['usuari']; ?>
        </h1>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="formulari.css">
        <div class="login">
    <form method="post" action="acomiadament.php">
        <button type="submit" name="tancar">Tancar Sessió</button>
    </form>
    </div>
    </header>

    

<?php if (isset($error)): ?>
    <p style="color:red;">
        <?php echo $error; ?>
    </p>
<?php endif; ?>


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="email">Correu electrònic:</label>
        <input required type="text" name="email" id="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"><br><br>
        <label for="date">Data:</label>
        <input type="date" name="date" id="date" value="<?php echo isset($_SESSION['date']) ? $_SESSION['date'] : ''; ?>"><br><br>

        <fieldset>
            <legend>Radios:</legend>
            <label><input type="radio" name="radio" value="radio1" <?php if (isset($_SESSION['radio']) && $_SESSION['radio'] == 'radio1')
                echo 'checked'; ?>>Opció 1</label><br>
            <label><input type="radio" name="radio" value="radio2" <?php if (isset($_SESSION['radio']) && $_SESSION['radio'] == 'radio2')
                echo 'checked'; ?>>Opció 2</label><br>
            <label><input type="radio" name="radio" value="radio3" <?php if (isset($_SESSION['radio']) && $_SESSION['radio'] == 'radio3')
                echo 'checked'; ?>>Opció 3</label><br>
            <label><input type="radio" name="radio" value="radio4" <?php if (isset($_SESSION['radio']) && $_SESSION['radio'] == 'radio4')
                echo 'checked'; ?>>Opció 4</label><br>
            <label><input type="radio" name="radio" value="radio5" <?php if (isset($_SESSION['radio']) && $_SESSION['radio'] == 'radio5')
                echo 'checked'; ?>>Opció 5</label><br>
        </fieldset><br>
<fieldset>
            <legend>Checkboxs:</legend>
            <label><input type="checkbox" name="checkbox[]" value="check1" <?php if (isset($_SESSION['checkbox']) && in_array('check1', $_SESSION['checkbox']))
                echo 'checked'; ?>>Opció 1</label><br>
            <label><input type="checkbox" name="checkbox[]" value="check2" <?php if (isset($_SESSION['checkbox']) && in_array('check2', $_SESSION['checkbox']))
                echo 'checked'; ?>>Opció 2</label><br>
            <label><input type="checkbox" name="checkbox[]" value="check3" <?php if (isset($_SESSION['checkbox']) && in_array('check3', $_SESSION['checkbox']))
                echo 'checked'; ?>>Opció 3</label><br>
            <label><input type="checkbox" name="checkbox[]" value="check4" <?php if (isset($_SESSION['checkbox']) && in_array('check4', $_SESSION['checkbox']))
                echo 'checked'; ?>>Opció 4</label><br>
            <label><input type="checkbox" name="checkbox[]" value="check5" <?php if (isset($_SESSION['checkbox']) && in_array('check5', $_SESSION['checkbox']))
                echo 'checked'; ?>>Opció 5</label><br>
        </fieldset><br>

        <label for="select">Select:</label><br>
        <select name="select[]" id="select" multiple>
            <option value="option1" <?php if (isset($_SESSION['select']) && in_array('option1', $_SESSION['select']))
                echo 'selected'; ?>>Opció 1</option>
            <option value="option2" <?php if (isset($_SESSION['select']) && in_array('option2', $_SESSION['select']))
                echo 'selected'; ?>>Opció 2</option>
            <option value="option3" <?php if (isset($_SESSION['select']) && in_array('option3', $_SESSION['select']))
                echo 'selected'; ?>>Opció 3</option>
            <option value="option4" <?php if (isset($_SESSION['select']) && in_array('option4', $_SESSION['select']))
                echo 'selected'; ?>>Opció 4</option>
            <option value="option5" <?php if (isset($_SESSION['select']) && in_array('option5', $_SESSION['select']))
                echo 'selected'; ?>>Opció 5</option>
        </select>

        <button type="submit" name="enviar">Enviar</button>
    </form>
</body>

</html>
