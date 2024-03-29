<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
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
    <h1>Registrar Usuario</h1>
    <form method="post">
        <input type="text" name="userName" placeholder="Usuario"></input>
        <input type="password" name="pwd" placeholder="Contraseña"></input>
        <input type="password" name="pwd2" placeholder="Confirmar contraseña"></input>
        <button type="submit">Enviar</button>
        <a href="dashBoard.php"> Regresar</a>
    </form>
    <?php
    session_start();
    if(isset($_POST['userName']) && isset($_POST['pwd']) && isset($_POST['pwd2'])){
        if($_POST['pwd'] === $_POST['pwd2']){
            try {
                $userName = $_POST['userName'];
                $pwd = $_POST['pwd'];
                $pwd_hash = hash('sha512', $pwd);
                
                
                $dsn = "mysql:host=localhost;dbname=world";
                $pdo = new PDO($dsn, 'super', 'thiago');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Utilizar consultas preparadas para evitar la inyección de SQL
                $query = $pdo->prepare("INSERT INTO users (name, password) VALUES (?, ?);");
                $query->execute([$userName, $pwd_hash]);

                echo "<h1>Usuario agregado</h1>";

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }else{
            echo "Las contraseñas no coinciden";
        }
        
    }
    ?>
</body>
</html>