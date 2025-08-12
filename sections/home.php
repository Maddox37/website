<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /sections/login.php');
    exit;
}
include_once "../includes/database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "../includes/head.php" ?>
    <title>Inventario</title>
</head>
<body>
    <?php include_once "../includes/main.php" ?>
    <div style="border-radius:20px" id="normalBox">
        <div style="background-image:url(https://i.pinimg.com/originals/0d/c1/84/0dc184d841099325533c19fcff9ee067.gif)" id="bgImage"></div>
        <h1 style="color: white; margin-bottom: 30px;">Inventario</h1>
        <div id="inventario" style="margin: 30px;">
            <table style="width:90%;margin:auto;background:#222;color:white;border-radius:10px;">
                <tr style="background:#333;">
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad disponible</th>
                    <th>Seleccionar</th>
                </tr>
                <?php
                $sql = "SELECT * FROM productos";
                $res = $conn->query($sql);
                if ($res && $res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='".htmlspecialchars($row['imagen'])."' style='width:60px;height:60px;object-fit:cover;border-radius:10px;'></td>";
                        echo "<td>".htmlspecialchars($row['nombre'])."</td>";
                        echo "<td>".htmlspecialchars($row['descripcion'])."</td>";
                        echo "<td>$".htmlspecialchars($row['precio'])."</td>";
                        echo "<td>".htmlspecialchars($row['cantidad'])."</td>";
                        echo "<td><button class='stylisher pedidoBtn' data-id='".$row['id']."' style='border-radius:8px;'>Pedir</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>No hay productos en inventario.</td></tr>";
                }
                ?>
            </table>
        </div>
        <div id="pedidoMsg" style="text-align:center;color:lime;margin-top:20px;"></div>
    </div>
</body>
</html>