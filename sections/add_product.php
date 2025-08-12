<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /sections/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "../includes/head.php" ?>
    <title>Agregar Producto</title>
</head>
<body>
    <?php include_once "../includes/main.php" ?>
    <div  style="border-radius:20px" id="normalBox">
        <div style ="background-image:url(https://es.picmix.com/pic/download?picId=10899763&key=3adae)" id="bgImage"></div>
        <h1 style="margin-bottom: 30px;">Agregar Producto</h1>
        <form id="addProductForm" method="POST">
            <span><input class="stylisher" type="text" name="nombre" placeholder="Nombre del producto" required></span>
            <span><input class="stylisher" type="text" name="descripcion" placeholder="Descripción" required></span>
            <span><input class="stylisher" type="text" name="imagen" placeholder="URL de imagen" required></span>
            <span><input class="stylisher" type="number" step="0.01" name="precio" placeholder="Precio" required></span>
            <span><input class="stylisher" type="text" name="empresa" placeholder="Empresa" required></span>
            <span><input class="stylisher" type="number" name="cantidad" placeholder="Cantidad" required></span>
            <span><input class="stylisher" style="margin-top:20px;cursor:pointer;border-radius:10px;width: 120px;" type="submit" value="Agregar"></span>
        </form>
        <div id="addProductMsg" style="color:lime;margin-top:10px;"></div>
    </div>
</body>
</html>

