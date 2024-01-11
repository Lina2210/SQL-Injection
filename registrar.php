<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>LOGIN</h1>
    <form method="post">
        <input type="text" name="userName" placeholder="Usuario"></input>
        <input type="password" name="pwd" placeholder="Contraseña"></input>
        <input type="password" name="pwd2" placeholder="Confirmar contraseña"></input>
        <button type="submit">Enviar</button>
    </form>
    <?php
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