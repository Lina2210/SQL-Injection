<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
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
    <h1>CAMBIAR CONTRASEÑA</h1>
    <form method="post">
        <input type="password" name="pwdNew" placeholder="Nueva contraseña"></input>
        <input type="password" name="pwdConf" placeholder="Confirmar contraseña"></input>
        <button type="submit">Enviar</button>
        <a href="dashBoard.php"> Regresar</a>
    </form>
    <?php
    session_start();
    if(isset($_POST['pwdNew']) && isset($_POST['pwdConf'])){
        
        if($_POST['pwdNew'] === $_POST['pwdConf']){
            try {
                $userName = $_SESSION['userName'];
                $pwd = $_POST['pwdNew'];
                $pwd_hash = hash('sha512', $pwd);
                
                
                $dsn = "mysql:host=localhost;dbname=world";
                $pdo = new PDO($dsn, 'super', 'thiago');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Utilizar consultas preparadas para evitar la inyección de SQL
                $query = $pdo->prepare("UPDATE users SET password = ? WHERE name = ?;");
                $query->execute([$pwd_hash, $userName]);

                echo "<h1>Contraseña cambiada</h1>";

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        }else{
            echo "Las contraseñas no coinciden";
        }
    
    }else{
        echo"Error de usuario";
    }
    
    ?>
</body>
</html>