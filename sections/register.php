<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once "../includes/head.php" ?>
    <title>EnterInto</title>
    <style>
        body{
            height: 90vh;
        }
    </style>
</head>
<body>
    <?php include_once "../includes/main.php" ?>
    <div style="border-radius:20px" id="normalBox">
        <div id="bgImage"></div>
        <form id="registerForm" method="POST">
            <h1>Registrarse</h1>
            <span><i class="fa fa-address-book" style="font-size:24px"></i> <input type="text" placeholder="Usuario" name="f1" required></span>
            <span><i class="fa fa-commenting-o" style="font-size:24px"></i> <input type="password" placeholder="Contraseña" name="f2" required></span>
            <span><i class="fa fa-at" style="font-size:24px"></i> <input type="email" placeholder="Correo" name="f3" required></span>
            <span><input style="margin-top:20px;cursor:pointer;border-radius:10px;width: 100px;" type="submit" value="Terminar"></span>
            <span><a href="/sections/login.php" style="text-shadow:0 0 20px;">Ya tengo cuenta</a></span>
        </form>
    </div>
</body>
</html>