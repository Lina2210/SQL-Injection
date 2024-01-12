<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    </style>
</head>
<body>
    <h1>LOGIN</h1>
    <form method="POST" action="dashBoard.php">
        <input type="text" name="userName" placeholder="Usuario"></input>
        <input type="password" name="pwd" placeholder="Contraseña"></input>
        <button type="submit">Enviar</button>
    </form>
    <?php
    session_start();
    if(isset($_POST['userName']) && isset($_POST['pwd'])){
        try {
            $userName = $_POST['userName'];
            $pwd = $_POST['pwd'];
            
            $dsn = "mysql:host=localhost;dbname=world";
            $pdo = new PDO($dsn, 'super', 'thiago');

            $query = $pdo->prepare("SELECT name FROM users WHERE password = SHA2(?, 512) AND name = ? LIMIT 1");
            $query->execute([$pwd, $userName]);

            $row = $query->fetch();

            if ($row) {
                $_SESSION['userName'] = $userName;
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Usuario o contraseña incorrectos";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    ?>
</body>
</html>