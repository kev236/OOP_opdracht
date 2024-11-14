<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kies een Apparaat</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Kies een Apparaat om te Bedienen</h1>

        <!-- Appliance Cards Section -->
        <div class="appliance-cards">
            <!-- Wasmachine Card -->
            <div class="card" onclick="window.location.href='pages/wasmachine.php';">
                <img src="img/washing-machine-svgrepo-com.svg" alt="Wasmachine">
                <h2>Wasmachine</h2>
            </div>

            <!-- Magnetron Card -->
            <div class="card" onclick="window.location.href='pages/magnetron.php';">
                <img src="img/microwave-oven-svgrepo-com.svg" alt="Magnetron">
                <h2>Magnetron</h2>
            </div>

            <!-- Koffieapparaat Card -->
            <div class="card" onclick="window.location.href='pages/koffieapparaat.php';">
                <img src="img/coffee-machine-svgrepo-com.svg" alt="Koffieapparaat">
                <h2>Koffieapparaat</h2>

            </div>

            <!-- Blender Card -->
            <div class="card" onclick="window.location.href='pages/blender.php';">
                <img src="img/blender-2-svgrepo-com.svg" alt="Blender">
                <h2>Blender</h2>    
            </div>
        </div>
    </div>
</body>
</html>
