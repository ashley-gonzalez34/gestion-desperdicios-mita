<?php
include "login.php";
// if($_SESSION['loggedin']==true){
//     header("location:loginindex.html");
// }

if ($_SESSION["name"] == "") {
    header("location: signup.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Added style to increase horizontal space between datatable columns */
        .table th,
        .table td {
            padding: 15px;
            /* Adjust padding as needed */
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">Donar <b style="color: #06C167;">Comida</b></div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="home.html">Inicio</a></li>
                <li><a href="about.html">Acerca de</a></li>
                <li><a href="contact.html">Contacto</a></li>
                <li><a href="profile.php" class="active">Perfil</a></li>
                <li><a href="education.html">Educación</a></li>
            </ul>
        </nav>
    </header>
    <script>
        hamburger = document.querySelector(".hamburger");
        hamburger.onclick = function () {
            navBar = document.querySelector(".nav-bar");
            navBar.classList.toggle("active");
        }
    </script>

    <div class="profile">
        <div class="profilebox" style="">

            <p class="headingline" style="text-align: center;font-size:30px;"> <img src="" alt=""
                    style="width:40px; height:  height: 25px;; padding-right: 10px; position: relative;">Perfil</p>

            <br>
            <div class="info" style="padding-left:10px;">
                <p style="">Nombre: <?php echo "" . $_SESSION["name"]; ?> </p><br>
                <p style="">Correo: <?php echo "" .
                    $_SESSION["email"]; ?> </p><br>
                <p style="">Género: <?php if ($_SESSION["gender"] == "male") {
                    echo "Masculino";
                } elseif ($_SESSION["gender"] == "female") {
                    echo "Femenino";
                } else {
                    echo $_SESSION["gender"];
                } ?> </p><br>

                <a href="logout.php"
                    style="float: left;margin-top: 6px ;border-radius:5px; background-color: #06C167; color: white;padding: ;padding-left: 10px;padding-right: 10px;">Cerrar
                    sesión</a>
            </div>
            <br>
            <br>

            <hr>
            <br>
            <p class="heading">Tus donaciones</p>
            <div class="table-container">
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Comida</th>
                                <th>Tipo</th>
                                <th>Categoría</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $email = $_SESSION["email"];
                            $query = "select * from food_donations where email='$email'";
                            $result = mysqli_query($connection, $query);
                            if ($result == true) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $category = $row["category"] == "packed-food" ? "Comida Empacada" :
                                        ($row["category"] == "raw-food" ? "Comida Cruda" :
                                            ($row["category"] == "cooked-food" ? "Comida Cocida" : $row["category"]));
                                    $type = $row["type"] == "Non-veg" ? "No Vegana" : "Vegana";

                                    // Convert the date to 12-hour format
                                    $date = new DateTime($row["date"]);
                                    $formatted_date = $date->format('d-m-Y h:i A');

                                    echo "<tr><td>" .
                                        $row["food"] .
                                        "</td><td>" .
                                        $type .
                                        "</td><td>" .
                                        $category .
                                        "</td><td>" .
                                        $formatted_date .
                                        "</td></tr>";
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


    <footer style="text-align: center;">
        <p>&copy; 2024 Donación de Alimentos. Todos los derechos reservados.</p>
    </footer>

</body>

</html>