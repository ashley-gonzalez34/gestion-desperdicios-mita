<?php
include 'connection.php';

// Verifica si se ha enviado el formulario de registro
if(isset($_POST['sign']))
{
    // Obtiene los datos del formulario
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $dpi = $_POST['dpi'];
    $phone = $_POST['phone'];

    // Encripta la contraseña
    $pass = password_hash($password, PASSWORD_DEFAULT);

    // Consulta si el correo electrónico ya está registrado
    $sql = "SELECT * FROM login WHERE email='$email'";
    $result = mysqli_query($connection, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        // Muestra un mensaje si la cuenta ya existe
        echo "<h1><center>La cuenta ya existe.</center></h1>";
    } else {
        // Inserta los datos del nuevo usuario en la base de datos
        $query = "INSERT INTO login(name, email, password, gender, dpi, phone) VALUES('$username', '$email', '$pass', '$gender', '$dpi', '$phone')";
        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
            // Redirige a la página de inicio de sesión si el registro es exitoso
            header("location:signin.php");
        } else {
            // Muestra un mensaje de error si los datos no se guardaron
            echo '<script type="text/javascript">alert("data not saved")</script>';
        }
    }
}
?>

<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginstyle.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>
    <div class="container">
        <div class="regform">
            <form action="" method="post">
                <p class="logo">Comida <b style="color: #06C167;">Donar</b></p>
                <p id="heading">Crea una cuenta</p>
                
                <div class="input">
                    <label class="textlabel" for="name">Nombre de usuario</label><br>
                    <input type="text" id="name" name="name" required/>
                </div>
                <div class="input">
                    <label class="textlabel" for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" required/>
                </div>
                <div class="input">
                    <label class="textlabel" for="dpi">DPI</label>
                    <input type="text" id="dpi" name="dpi" pattern="\d{13}" placeholder="2451789450101" required/>
                </div>
                <div class="input">
                    <label class="textlabel" for="phone">Número de Teléfono</label>
                    <input type="text" id="phone" name="phone" pattern="\d{8}" placeholder="12345678" required/>
                </div>
                <label class="textlabel" for="password">Contraseña</label>
                <div class="password">
                    <input type="password" name="password" id="password" required/>
                    <i class="uil uil-eye-slash showHidePw" id="showpassword"></i>                
                </div>
                <div class="radio">
                    <input type="radio" name="gender" id="male" value="male" required/>
                    <label for="male">Masculino</label>
                    <input type="radio" name="gender" id="female" value="female">
                    <label for="female">Femenino</label>
                </div>
                <div class="btn">
                    <button type="submit" name="sign">Continuar</button>
                </div>
                <div class="signin-up">
                    <p style="font-size: 20px; text-align: center;">¿Ya tienes una cuenta? <a href="signin.php">Iniciar sesión</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="admin/login.js"></script>
</body>
</html>
