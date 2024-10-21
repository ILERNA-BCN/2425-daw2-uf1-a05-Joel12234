<?php
session_start(); 

if (!isset($_SESSION['jugador'])) {
    $_SESSION['jugador'] = 0;
    $_SESSION['ordenador'] = 0;
    $_SESSION['empates'] = 0;
}

$totalPartidas = $_SESSION['jugador'] + $_SESSION['ordenador'] + $_SESSION['empates'];

$victoriasJug = $totalPartidas > 0 ? round(($_SESSION['jugador'] / $totalPartidas) * 100, 2) : 0;
$victoriasMaq = $totalPartidas > 0 ? round(($_SESSION['ordenador'] / $totalPartidas) * 100, 2) : 0;
$partEmpate = $totalPartidas > 0 ? round(($_SESSION['empates'] / $totalPartidas) * 100, 2) : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas del Juego</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanta/0.5.21/vanta.net.min.js"></script>
    <link rel="stylesheet" href="estadisticas.css">
</head>
<body>
    <div id="vanta-bg"></div>

    <div class="stats-container">
        <h1>Estadísticas de Piedra, Papel o Tijera</h1>
        <p>Total de partidas jugadas: <strong><?php echo $totalPartidas; ?></strong></p>
        <p>Porcentaje de partidas ganadas por el jugador: <strong><?php echo $victoriasJug; ?>%</strong></p>
        <p>Porcentaje de partidas ganadas por el ordenador: <strong><?php echo $victoriasMaq; ?>%</strong></p>
        <p>Porcentaje de partidas empatadas: <strong><?php echo $partEmpate; ?>%</strong></p>
        <a href="game.php">Volver al juego</a>
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