
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
        echo "?php?php";
    }
    ?>
</table>