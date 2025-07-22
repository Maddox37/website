<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "../includes/head.php" ?>
    <title>Iniciar Sesión</title>
    <style>
        body{
            height: 90vh;
        }
    </style>
</head>
<body>
    <?php include_once "../includes/main.php" ?>
    <div style="border-radius: 20px" id="normalBox">
        
        <div id="bgImage"></div>
        <form id="loginForm" method="POST">
            <h1>Iniciar Sesión</h1>
            <span>
                <i class="fa fa-address-book" style="font-size:24px"></i>
                <input type="text" placeholder="Usuario" name="f1" required>
            </span>
            <span>
                <i class="fa fa-commenting-o" style="font-size:24px"></i>
                <input type="password" placeholder="Contraseña" name="f2" required>
            </span>
            <span>
                <input style="margin-top:20px;cursor:pointer;border-radius:10px;width: 100px;" type="submit" value="Ingresar">
            </span>
            <span><a href="/sections/register.php" style="text-shadow:0 0 20px;">Crear cuenta</a></span>
        </form>
    </div>

    <script src="../resources/scripts/handosme.js"></script>
</body>
</html>