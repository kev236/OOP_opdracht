<?php
// wasmachine.php

session_start(); // Start de sessie om gegevens tussen pagina's op te slaan

// Controleer of de Wasmachine klasse bestaat, anders include het bestand
require_once '../app/Wasmachine.php';

// Maak een instantie van de Wasmachine klasse
$wasmachine = new Wasmachine();

// Sla de status van de wasmachine en het programma op in de sessie als deze bestaan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['toggle_on_off'])) {
        // Zet de wasmachine aan of uit
        $_SESSION['wasmachine_status'] = ($_SESSION['wasmachine_status'] == 'on') ? 'off' : 'on';
    }

    // Verander het programma
    if (isset($_POST['set_program'])) {
        $_SESSION['huidig_programma'] = $_POST['programma'];
    }
}

// Zorg ervoor dat de status van de wasmachine en het programma in de sessie zijn opgeslagen
$wasmachineStatus = $_SESSION['wasmachine_status'] ?? 'off';
$huidigProgramma = $_SESSION['huidig_programma'] ?? 'Geen programma ingesteld';

// Maak de Wasmachine klasse aan met de juiste status en programma
$wasmachine->setStatus($wasmachineStatus);
$wasmachine->kiesProgramma($huidigProgramma);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wasmachine Besturing</title>
    <link rel="stylesheet" href="../css/appstyle.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Wasmachine Besturing</h1>
        </header>

        <section class="device-control">
            <img src="../img/washing-machine-svgrepo-com.svg" alt="Wasmachine Icon" class="device-icon">

            <form method="post" class="control-form">
                <button type="submit" name="toggle_on_off" class="toggle-button">
                    <?php echo $wasmachineStatus == 'on' ? 'Zet Uit' : 'Zet Aan'; ?>
                </button>
            </form>

            <form method="post" class="control-form">
                <div class="select-group">
                    <label for="programma">Kies Programma:</label>
                    <select name="programma" id="programma" class="select-dropdown">
                        <option value="Katoen" <?php echo $huidigProgramma == 'Katoen' ? 'selected' : ''; ?>>Katoen</option>
                        <option value="Synthetisch" <?php echo $huidigProgramma == 'Synthetisch' ? 'selected' : ''; ?>>Synthetisch</option>
                        <option value="Fijn" <?php echo $huidigProgramma == 'Fijn' ? 'selected' : ''; ?>>Fijn</option>
                        <option value="Eco" <?php echo $huidigProgramma == 'Eco' ? 'selected' : ''; ?>>Eco</option>
                    </select>
                </div>
                <button type="submit" name="set_program" class="set-button">Set Programma</button>
            </form>

            <div id="status" class="status <?php echo $wasmachineStatus; ?>">
                <p><?php echo $wasmachineStatus == 'on' ? 'Wasmachine is AAN' : 'Wasmachine is UIT'; ?></p>
                <strong>Huidig Programma:</strong> <?php echo $huidigProgramma; ?>
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
