<?php
// magnetron.php

session_start(); // Start de sessie om gegevens tussen pagina's op te slaan

// Controleer of de Magnetron klasse bestaat, anders include het bestand
require_once '../app/Magnetron.php';

// Maak een instantie van de Magnetron klasse
$magnetron = new Magnetron();

// Sla de status van de magnetron en de instellingen op in de sessie als deze bestaan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['toggle_on_off'])) {
        // Zet de magnetron aan of uit
        if (isset($_SESSION['magnetron_status']) && $_SESSION['magnetron_status'] == 'on') {
            $_SESSION['magnetron_status'] = 'off'; // Zet uit
        } else {
            $_SESSION['magnetron_status'] = 'on'; // Zet aan
        }
    }

    // Verander het vermogen
    if (isset($_POST['set_power'])) {
        $_SESSION['magnetron_vermogen'] = $_POST['vermogen'];
    }

    // Verander de tijd
    if (isset($_POST['set_time'])) {
        $_SESSION['magnetron_tijd'] = $_POST['tijd'];
    }
}

// Zorg ervoor dat de status van de magnetron en de instellingen in de sessie zijn opgeslagen
$magnetronStatus = isset($_SESSION['magnetron_status']) ? $_SESSION['magnetron_status'] : 'off';
$huidigVermogen = isset($_SESSION['magnetron_vermogen']) ? $_SESSION['magnetron_vermogen'] : 5;
$huidigeTijd = isset($_SESSION['magnetron_tijd']) ? $_SESSION['magnetron_tijd'] : 30;

// Maak de Magnetron klasse aan met de juiste status en instellingen
$magnetron->setStatus($magnetronStatus);
$magnetron->stelVermogenIn($huidigVermogen);
$magnetron->stelTijdIn($huidigeTijd);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magnetron Web App</title>
    <link rel="stylesheet" href="../css/appstyle.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Magnetron Besturing</h1>
        </header>

        <section class="device-control">
            <img src="../img/microwave-oven-svgrepo-com.svg" alt="Magnetron Icon" class="device-icon">

            <form method="post" class="control-form">
                <button type="submit" name="toggle_on_off" class="toggle-button">
                    <?php echo $magnetronStatus == 'on' ? 'Zet Uit' : 'Zet Aan'; ?>
                </button>
            </form>

            <form method="post" class="control-form">
                <div class="select-group">
                    <label for="vermogen">Kies Vermogen:</label>
                    <select name="vermogen" id="vermogen" class="select-dropdown">
                        <option value="1" <?php echo $huidigVermogen == 1 ? 'selected' : ''; ?>>1</option>
                        <option value="2" <?php echo $huidigVermogen == 2 ? 'selected' : ''; ?>>2</option>
                        <option value="3" <?php echo $huidigVermogen == 3 ? 'selected' : ''; ?>>3</option>
                        <option value="4" <?php echo $huidigVermogen == 4 ? 'selected' : ''; ?>>4</option>
                        <option value="5" <?php echo $huidigVermogen == 5 ? 'selected' : ''; ?>>5</option>
                    </select>
                </div>
                <button type="submit" name="set_power" class="set-button">Set Vermogen</button>
            </form>

            <form method="post" class="control-form">
                <div class="time-input">
                    <label for="tijd">Kies Tijd (seconden):</label>
                    <input type="number" name="tijd" id="tijd" value="<?php echo $huidigeTijd; ?>" class="input-field">
                </div>
                <button type="submit" name="set_time" class="set-button">Set Tijd</button>
            </form>

            <div id="status" class="status <?php echo $magnetronStatus; ?>">
                <?php echo $magnetronStatus == 'on' ? 'Magnetron is AAN' : 'Magnetron is UIT'; ?>
                <br>
                <strong>Huidig Vermogen:</strong> <?php echo $huidigVermogen; ?>
                <br>
                <strong>Huidige Tijd:</strong> <?php echo $huidigeTijd; ?> seconden
            </div>
        </section>

        <section class="back-button">
            <a href="../index.php">
                <button class="back-home-button">Terug naar Home</button>
            </a>
        </section>
    </div>
</body>
</html>
