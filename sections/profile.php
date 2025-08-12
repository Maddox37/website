<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "../includes/head.php" ?>
    <title>Perfil de Usuario</title>
</head>
<body>
    <?php include_once "../includes/main.php" ?>
    <div style="border-radius: 20px" id="normalBox">
        <div id="bgImage"></div>
        <div id="profileContent" style="display: flex; flex-direction: column; align-items: center;">
            <h1>Perfil de Usuario</h1>
            <img id="profilePic" src="" alt="Foto de perfil" style="width:120px;height:120px;border-radius:50%;margin:20px 0;object-fit:cover;">
            <input  class="pipi" id="profilePicInput" type="text" placeholder="URL de imagen de perfil" style="width: 80%; max-width: 300px; margin-bottom: 10px; display:none;">
            <button class="pipi" id="changePicBtn" style="margin-bottom: 20px; border-radius: 10px; width: 120px; cursor: pointer;">Cambiar foto</button>
            <button class="pipi"id="savePicBtn" style="margin-bottom: 20px; border-radius: 10px; width: 120px; cursor: pointer; display:none;">Guardar foto</button>
            <h2 id="profileName" style="margin: 20px 0;"></h2>
            <button  id="logoutBtn" class="pipi" style="margin-top: 20px; border-radius: 10px; width: 120px; cursor: pointer;">Cerrar sesión</button>
        </div>
    </div>
    <?php
    include_once "../includes/database.php";
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM productos WHERE usuario_id = $user_id";
    $res = $conn->query($sql);
    ?>
    <h2 style="margin-top:30px;">Tus productos agregados</h2>
    <table style="width:90%;margin:auto;background:#222;color:white;border-radius:10px;">
        <tr style="background:#333;">
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
        </tr>
        <?php
        if ($res && $res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='".htmlspecialchars($row['imagen'])."' style='width:60px;height:60px;object-fit:cover;border-radius:10px;'></td>";
                echo "<td>".htmlspecialchars($row['nombre'])."</td>";
                echo "<td>".htmlspecialchars($row['descripcion'])."</td>";
                echo "<td>$".htmlspecialchars($row['precio'])."</td>";
                echo "<td>".htmlspecialchars($row['cantidad'])."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align:center;'>No has agregado productos.</td></tr>";
        }
        ?>
    </table>
</body>
</html>