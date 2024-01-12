<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .acciones {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #4caf50;
        }

        a:hover {
            color: #45a049;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        $userName = "anonymous";
        if (isset($_SESSION['userName'])) {
            $userName = $_SESSION['userName'];
        }
    ?>
    <h1>Hola <?php echo $userName; ?></h1>
    <div class="acciones">
        <a href="registrar.php"> Registrar</a>
        <a href="cambiarPsw.php">Cambiar Contraseña</a>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>

