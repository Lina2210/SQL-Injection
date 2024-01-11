<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>LOGIN</h1>
    <form method="POST" action="login.php">
        <input type="text" name="userName" placeholder="Usuario"></input>
        <input type="password" name="pwd" placeholder="Contraseña"></input>
        <button type="submit">Enviar</button>
        <a href="registrar.php"> Registrar</a>
    </form>
    <?php
    if(isset($_POST['userName']) && isset($_POST['pwd'])){
        try {
            $userName = $_POST['userName'];
            $pwd = $_POST['pwd'];
            
            $dsn = "mysql:host=localhost;dbname=world";
            $pdo = new PDO($dsn, 'super', 'thiago');

            // Utilizar consultas preparadas para evitar la inyección de SQL
            $query = $pdo->prepare("SELECT name FROM users WHERE password = SHA2(?, 512) AND name = ?");
            $query->execute([$pwd, $userName]);

            $row = $query->fetch();

            if ($row) {
                echo "<h1>Bienvenido " . $row['nom'] . "</h1>";
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