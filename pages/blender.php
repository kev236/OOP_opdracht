<?php
// blender.php

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
    <title>Blender Instellingen</title>
    <link rel="stylesheet" href="../css/appstyle.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Blender Besturing</h1>
        </header>
        
        <section class="device-control">
            <!-- SVG Icon -->
            <img src="../img/blender-2-svgrepo-com.svg" alt="Blender Icon" class="device-icon">

            <!-- Blender Control Form -->
            <form id="blenderForm" method="post" class="control-form">
                <!-- Toggle button (Aan/Uit) -->
                <button type="submit" name="toggle_on_off" class="toggle-button">
                    <?php echo $blenderStatus == 'on' ? 'Zet Uit' : 'Zet Aan'; ?>
                </button>
            </form>

            <!-- Snelheid input -->
            <form method="post" class="control-form">
                <div class="select-group">
                    <label for="speed">Set Snelheid (1-10):</label>
                    <input type="number" name="speed" id="speed" value="<?php echo $snelheid; ?>" min="1" max="10" class="input-field">
                </div>

                <!-- Set Snelheid button -->
                <button type="submit" name="set_speed" class="set-button">Set Snelheid</button>
            </form>

            <!-- Tijd input -->
            <form method="post" class="control-form">
                <div class="select-group">
                    <label for="time">Set Tijd (seconden):</label>
                    <input type="number" name="time" id="time" value="<?php echo $tijd; ?>" min="1" max="300" class="input-field">
                </div>

                <!-- Set Tijd button -->
                <button type="submit" name="set_time" class="set-button">Set Tijd</button>
            </form>

            <!-- Status bericht -->
            <div id="status" class="status <?php echo $blenderStatus; ?>">
                <?php echo $blenderStatus == 'on' ? 'Blender is AAN' : 'Blender is UIT'; ?>
                <br>
                <strong>Snelheid:</strong> <?php echo $snelheid; ?>
                <br>
                <strong>Tijd:</strong> <?php echo $tijd; ?> seconden
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