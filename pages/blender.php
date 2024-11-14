<?php
session_start(); // Start de sessie om gegevens tussen pagina's op te slaan

// Controleer of de Blender klasse bestaat, anders include het bestand
require_once '../app/Blender.php';

// Maak een instantie van de Blender klasse
$blender = new Blender();

// Sla de status van de blender, snelheid en tijd op in de sessie als deze bestaan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['toggle_on_off'])) {
        // Zet de blender aan of uit
        if (isset($_SESSION['blender_status']) && $_SESSION['blender_status'] == 'on') {
            $_SESSION['blender_status'] = 'off'; // Zet uit
        } else {
            $_SESSION['blender_status'] = 'on'; // Zet aan
        }
    }

    // Verander de snelheid
    if (isset($_POST['set_speed'])) {
        $_SESSION['snelheid'] = (int)$_POST['speed'];
    }

    // Verander de tijd
    if (isset($_POST['set_time'])) {
        $_SESSION['tijd'] = (int)$_POST['time'];
    }
}

// Zorg ervoor dat de status van de blender, snelheid en tijd in de sessie zijn opgeslagen
$blenderStatus = isset($_SESSION['blender_status']) ? $_SESSION['blender_status'] : 'off';
$snelheid = isset($_SESSION['snelheid']) ? $_SESSION['snelheid'] : 5; // Default snelheid
$tijd = isset($_SESSION['tijd']) ? $_SESSION['tijd'] : 30; // Default tijd

// Maak de Blender klasse aan met de juiste status, snelheid en tijd
$blender->setStatus($blenderStatus);
$blender->stelSnelheidIn($snelheid);
$blender->stelTijdIn($tijd);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blender Besturing</title>
    <link rel="stylesheet" href="../css/appstyle.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Blender Besturing</h1>
        </header>

        <section class="device-control">
            <!-- Blender Icon -->
            <img src="../img/blender-2-svgrepo-com.svg" alt="Blender Icon" class="device-icon">

            <!-- Toggle Button (Power On/Off) -->
            <form method="post" class="control-form">
                <button type="submit" name="toggle_on_off" class="toggle-button">
                    <img src="../img/power-button-svgrepo-com.svg" alt="Power Button Icon" class="power-icon">
                    <?php echo $blenderStatus == 'on' ? 'Zet Uit' : 'Zet Aan'; ?>
                </button>
            </form>

            <!-- Speed Selection -->
            <form method="post" class="control-form">
                <div class="select-group">
                    <label for="speed" class="select-label">Kies Snelheid (1-10):</label>
                    <input type="number" name="speed" id="speed" value="<?php echo $snelheid; ?>" min="1" max="10" class="input-field">
                </div>
                <button type="submit" name="set_speed" class="set-button">Set Snelheid</button>
            </form>

            <!-- Time Selection -->
            <form method="post" class="control-form">
                <div class="select-group">
                    <label for="time" class="select-label">Kies Tijd (seconden):</label>
                    <input type="number" name="time" id="time" value="<?php echo $tijd; ?>" min="1" max="300" class="input-field">
                </div>
                <button type="submit" name="set_time" class="set-button">Set Tijd</button>
            </form>

            <!-- Current Status -->
            <div id="status" class="status <?php echo $blenderStatus; ?>">
                <p><span class="status-icon"><?php echo $blenderStatus == 'on' ? '🟢' : '🔴'; ?></span>
                <?php echo $blenderStatus == 'on' ? 'Blender is AAN' : 'Blender is UIT'; ?></p>
                <strong>Snelheid:</strong> <?php echo $snelheid; ?>
                <br>
                <strong>Tijd:</strong> <?php echo $tijd; ?> seconden
            </div>
        </section>

        <section class="back-button">
            <a href="../index.php">
                <button class="back-home-button"><span>🏠</span> Terug naar Home</button>
            </a>
        </section>
    </div>
</body>
</html>
