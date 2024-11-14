<?php
session_start(); // Start de sessie om gegevens tussen pagina's op te slaan

// Controleer of de Koffieapparaat klasse bestaat, anders include het bestand
require_once '../app/Koffieapparaat.php';

// Maak een instantie van de Koffieapparaat klasse
$koffieapparaat = new Koffieapparaat();

// Sla de status van het koffieapparaat en de instellingen op in de sessie als deze bestaan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['toggle_on_off'])) {
        // Zet het koffieapparaat aan of uit
        if (isset($_SESSION['koffieapparaat_status']) && $_SESSION['koffieapparaat_status'] == 'on') {
            $_SESSION['koffieapparaat_status'] = 'off'; // Zet uit
        } else {
            $_SESSION['koffieapparaat_status'] = 'on'; // Zet aan
        }
    }

    // Verander de koffie sterkte
    if (isset($_POST['set_strength'])) {
        $_SESSION['koffie_sterkte'] = $_POST['sterkte'];
    }

    // Verander de koffie grootte
    if (isset($_POST['set_size'])) {
        $_SESSION['koffie_grootte'] = $_POST['grootte'];
    }
}

// Zorg ervoor dat de status van het koffieapparaat en de instellingen in de sessie zijn opgeslagen
$koffieapparaatStatus = isset($_SESSION['koffieapparaat_status']) ? $_SESSION['koffieapparaat_status'] : 'off';
$huidigeSterkte = isset($_SESSION['koffie_sterkte']) ? $_SESSION['koffie_sterkte'] : 'Medium';
$huidigeGrootte = isset($_SESSION['koffie_grootte']) ? $_SESSION['koffie_grootte'] : 'Regulier';

// Maak de Koffieapparaat klasse aan met de juiste status en instellingen
$koffieapparaat->setStatus($koffieapparaatStatus);
$koffieapparaat->stelSterkteIn($huidigeSterkte);
$koffieapparaat->stelGrootteIn($huidigeGrootte);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koffieapparaat Web App</title>
    <link rel="stylesheet" href="../css/appstyle.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Koffieapparaat Besturing</h1>
        </header>

        <section class="device-control">
            <!-- Koffieapparaat Icon -->
            <img src="../img/coffee-machine-svgrepo-com.svg" alt="Koffieapparaat Icon" class="device-icon">

            <!-- Toggle Button (Power On/Off) -->
            <form method="post" class="control-form">
                <button type="submit" name="toggle_on_off" class="toggle-button">
                    <img src="../img/power-button-svgrepo-com.svg" alt="Power Button Icon" class="power-icon">
                    <?php echo $koffieapparaatStatus == 'on' ? 'Zet Uit' : 'Zet Aan'; ?>
                </button>
            </form>

            <!-- Strength Selection -->
            <form method="post" class="control-form">
                <div class="select-group">
                    <label for="sterkte" class="select-label">Kies Koffie Sterkte:</label>
                    <select name="sterkte" id="sterkte" class="select-dropdown">
                        <option value="Zwak" <?php echo $huidigeSterkte == 'Zwak' ? 'selected' : ''; ?>>Zwak</option>
                        <option value="Medium" <?php echo $huidigeSterkte == 'Medium' ? 'selected' : ''; ?>>Medium</option>
                        <option value="Sterk" <?php echo $huidigeSterkte == 'Sterk' ? 'selected' : ''; ?>>Sterk</option>
                    </select>
                </div>
                <button type="submit" name="set_strength" class="set-button">Set Sterkte</button>
            </form>

            <!-- Size Selection -->
            <form method="post" class="control-form">
                <div class="select-group">
                    <label for="grootte" class="select-label">Kies Koffie Grootte:</label>
                    <select name="grootte" id="grootte" class="select-dropdown">
                        <option value="Regulier" <?php echo $huidigeGrootte == 'Regulier' ? 'selected' : ''; ?>>Regulier</option>
                        <option value="Klein" <?php echo $huidigeGrootte == 'Klein' ? 'selected' : ''; ?>>Klein</option>
                        <option value="Groot" <?php echo $huidigeGrootte == 'Groot' ? 'selected' : ''; ?>>Groot</option>
                    </select>
                </div>
                <button type="submit" name="set_size" class="set-button">Set Grootte</button>
            </form>

            <!-- Current Status -->
            <div id="status" class="status <?php echo $koffieapparaatStatus; ?>">
                <p><span class="status-icon"><?php echo $koffieapparaatStatus == 'on' ? '🟢' : '🔴'; ?></span>
                <?php echo $koffieapparaatStatus == 'on' ? 'Koffieapparaat is AAN' : 'Koffieapparaat is UIT'; ?></p>
                <strong>Huidige Sterkte:</strong> <?php echo $huidigeSterkte; ?>
                <br>
                <strong>Huidige Grootte:</strong> <?php echo $huidigeGrootte; ?>
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
