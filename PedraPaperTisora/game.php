<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juega a Piedra, Papel o Tijera</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanta/0.5.21/vanta.net.min.js"></script>
    <link rel="stylesheet" href="stylesJuego.css">
</head>
<body>
    <div id="vanta-bg"></div>

    <div class="content">
        <h1>¡Empecemos con el juego!</h1>

        <?php

        session_start();

        if (!isset($_SESSION['jugador'])) {
            $_SESSION['jugador'] = 0;
            $_SESSION['ordenador'] = 0;
            $_SESSION['empates'] = 0;
        }

        if ($_SERVER ["REQUEST_METHOD"] == "POST") {
            $eleccionJug = $_POST ['elecciones'];

            $elecciones = ["piedra", "papel", "tijera","lagarto", "spock"];

            $eleccionMaq = $elecciones[array_rand($elecciones)];

            if ($eleccionJug == $eleccionMaq) {
                $resultado = 'Empate';
                $_SESSION ['empates'] += 1;
            }

            elseif (
                ($eleccionJug == "piedra" && ($eleccionMaq == "tijera" || $eleccionMaq == "lagarto")) ||
                ($eleccionJug == "tijera" && ($eleccionMaq == "papel" || $eleccionMaq == "lagarto")) ||
                ($eleccionJug == "papel" && ($eleccionMaq == "piedra" || $eleccionMaq == "spock")) ||
                ($eleccionJug == "lagarto" && ($eleccionMaq == "spock" || $eleccionMaq == "papel")) ||
                ($eleccionJug == "spock" && ($eleccionMaq == "tijera" || $eleccionMaq == "piedra"))
            ) {
                $resultado = "Has ganado!!";
                $_SESSION['jugador'] += 1;
            }

            else {
                $resultado = "Has perdido";
                $_SESSION['ordenador'] += 1;
            }

            echo "<p>Escogiste jugar con <strong>$eleccionJug</strong></p>";
            echo "<p>El ordenador eligió: <strong>$eleccionMaq</strong></p>";
            echo "<h2>Resultado: $resultado</h2>";
        }
        ?>

    <form method="post" action="game.php" class="game-options">
        <button type="submit" name="elecciones" value="piedra" class="game-image">
            <img src="./img/piedra.webp" alt="Piedra" class="game-image">
        </button>
        <button type="submit" name="elecciones" value="papel" class="game-image">
            <img src="./img/papel.webp" alt="Papel" class="game-image">
        </button>
        <button type="submit" name="elecciones" value="tijera" class="game-image">
            <img src="./img/tijeras.webp" alt="Tijera" class="game-image">
        </button>
        <button type="submit" name="elecciones" value="lagarto" class="game-image">
            <img src="./img/lagarto.webp" alt="Lagarto" class="game-image">
        </button>
        <button type="submit" name="elecciones" value="spock" class="game-image">
            <img src="./img/spock.webp" alt="Spock" class="game-image">
        </button>
    </form>
        <a href="index.html">Volver a inicio</a>
        <a href="data.php">Estadísticas</a>
    </div>

    <script>
        VANTA.NET({
            el: "#vanta-bg",
            color: 0xff6f61,
            backgroundColor: 0x000000,
            points: 10.0,
            maxDistance: 20.0,
            spacing: 15.0
        });
    </script>
</body>
</html>