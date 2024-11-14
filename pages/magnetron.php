<?php
session_start();

require_once '../app/Magnetron.php';

$magnetron = new Magnetron();

// Check for POST requests to update settings
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['toggle_on_off'])) {
        $_SESSION['magnetron_status'] = $_SESSION['magnetron_status'] === 'on' ? 'off' : 'on';
    }
    if (isset($_POST['set_power'])) {
        $_SESSION['magnetron_vermogen'] = $_POST['vermogen'];
    }
    if (isset($_POST['set_time'])) {
        $_SESSION['magnetron_tijd'] = $_POST['tijd'];
    }
}

// Load settings from the session
$magnetronStatus = $_SESSION['magnetron_status'] ?? 'off';
$huidigVermogen = $_SESSION['magnetron_vermogen'] ?? 5;
$huidigeTijd = $_SESSION['magnetron_tijd'] ?? 30;

$magnetron->setStatus($magnetronStatus);
$magnetron->stelVermogenIn($huidigVermogen);
$magnetron->stelTijdIn($huidigeTijd);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magnetron Besturing</title>
    <link rel="stylesheet" href="../css/appstyle.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Magnetron Besturing</h1>
        </header>

        <section class="device-control">
            <!-- Magnetron Icon -->
            <img src="../img/microwave-oven-svgrepo-com.svg" alt="Magnetron Icon" class="device-icon">

            <!-- Toggle Button (Power On/Off) -->
            <form method="post" class="control-form">
                <button type="submit" name="toggle_on_off" class="toggle-button">
                    <img src="../img/power-button-svgrepo-com.svg" alt="Power Button Icon" class="power-icon">
                    <?php echo $magnetronStatus === 'on' ? 'Zet Uit' : 'Zet Aan'; ?>
                </button>
            </form>

            <!-- Power Selection -->
            <form method="post" class="control-form">
                <div class="select-group">
                    <label for="vermogen" class="select-label">Kies Vermogen:</label>
                    <select name="vermogen" id="vermogen" class="select-dropdown">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php echo $huidigVermogen == $i ? 'selected' : ''; ?>>
                                <?php echo $i; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <button type="submit" name="set_power" class="set-button">
                    Set Vermogen
                </button>
            </form>

            <!-- Time Selection -->
            <form method="post" class="control-form">
                <div class="select-group">
                    <label for="tijd" class="select-label">Kies Tijd (seconden):</label>
                    <input type="number" name="tijd" id="tijd" value="<?php echo $huidigeTijd; ?>" class="input-field">
                </div>
                <button type="submit" name="set_time" class="set-button">
                    Set Tijd
                </button>
            </form>

            <!-- Current Status -->
            <div id="status" class="status <?php echo $magnetronStatus; ?>">
                <p><span class="status-icon"><?php echo $magnetronStatus === 'on' ? '🟢' : '🔴'; ?></span>
                <?php echo $magnetronStatus === 'on' ? 'Magnetron is AAN' : 'Magnetron is UIT'; ?></p>
                <strong>Huidig Vermogen:</strong> <?php echo $huidigVermogen; ?>
                <br>
                <strong>Huidige Tijd:</strong> <?php echo $huidigeTijd; ?> seconden
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
