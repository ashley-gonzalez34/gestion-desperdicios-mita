<?php
// Iniciar el almacenamiento en búfer de salida
ob_start();
// Incluir archivos de conexión a la base de datos
include("connect.php");
include '../connection.php';
// Verificar si el nombre de usuario está en la sesión, si no, redirigir a la página de inicio de sesión
if ($_SESSION['name'] == '') {
    header("location:deliverylogin.php");
}
// Asignar nombre y ciudad de la sesión a variables locales
$name = $_SESSION['name'];
$city = $_SESSION['city'];
// Inicializar cURL para obtener información de geolocalización
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$result = json_decode($result);
// Descomentar para asignar la ciudad desde la respuesta de geolocalización y mostrarla
// $city= $result->city;
// echo $city;

// Asignar el ID del repartidor de la sesión a una variable local
$id = $_SESSION['Did'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento</title>
    <!-- Incluir JavaScript para geolocalización -->
    <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    <!-- Incluir hojas de estilo -->
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="delivery.css">
</head>

<body>
    <header>
        <!-- Logo y navegación -->
        <div class="logo">Comida <b style="color: #06C167;">Donar</b></div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="#home" class="active">Inicio</a></li>
                <li><a href="openmap.php">Mapa</a></li>
                <li><a href="deliverymyord.php">Mis pedidos</a></li>
                <!-- <li ><a href="../logout.php"  >Cerrar sesión</a></li> -->
            </ul>
        </nav>
    </header>
    <br>
    <script>
        // Funcionalidad para el menú hamburguesa
        hamburger = document.querySelector(".hamburger");
        hamburger.onclick = function () {
            navBar = document.querySelector(".nav-bar");
            navBar.classList.toggle("active");
        }
    </script>
    <!-- Estilos para la presentación de los elementos -->
    <style>
        .itm {
            background-color: white;
            display: grid;
        }

        .itm img {
            width: 400px;
            height: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        p {
            text-align: center;
            font-size: 30PX;
            color: black;
            margin-top: 50px;
        }

        a {
            /* text-decoration: underline; */
        }

        @media (max-width: 767px) {
            .itm {
                /* float: left; */
            }

            .itm img {
                width: 350px;
                height: 350px;
            }
        }
    </style>
    <!-- Mensaje de bienvenida con el nombre del usuario -->
    <h2>
        <center>Bienvenido <?php echo "$name"; ?></center>
    </h2>

    <!-- Imagen representativa -->
    <div class="itm">
        <img src="../img/delivery.gif" alt="" width="400" height="400">
    </div>
    <h2><center>Tu ubicación: <?php echo "$city" ?></center></h2>
    <div class="get">
        <?php
        // Definir la consulta SQL para obtener pedidos no asignados
        $sql = "SELECT fd.Fid AS Fid,fd.location as cure, fd.name,fd.phoneno,fd.date,fd.delivery_by, fd.address as From_address, 
ad.name AS delivery_person_name, ad.address AS To_address
FROM food_donations fd
LEFT JOIN admin ad ON fd.assigned_to = ad.Aid where assigned_to IS NOT NULL and   delivery_by IS NULL and fd.location='$city';
";

        // Ejecutar la consulta
        $result = mysqli_query($connection, $sql);

        // Verificar si hay errores en la ejecución
        if (!$result) {
            die("Error al ejecutar la consulta: " . mysqli_error($conn));
        }

        // Obtener los datos como un array asociativo
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        // Si el repartidor ha tomado un pedido, actualizar el campo assigned_to en la base de datos
        if (isset($_POST['food']) && isset($_POST['delivery_person_id'])) {
            $order_id = $_POST['order_id'];
            $delivery_person_id = $_POST['delivery_person_id'];
            $sql = "SELECT * FROM food_donations WHERE Fid = $order_id AND delivery_by IS NOT NULL";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                // El pedido ya ha sido asignado a otra persona
                die("Lo siento, este pedido ya ha sido asignado a otra persona.");
            }

            $sql = "UPDATE food_donations SET delivery_by = $delivery_person_id WHERE Fid = $order_id";
            $result = mysqli_query($connection, $sql);

            if (!$result) {
                die("Error al asignar el pedido: " . mysqli_error($conn));
            }

            // Recargar la página para prevenir asignaciones duplicadas
            header('Location: ' . $_SERVER['REQUEST_URI']);
            // exit;
            ob_end_flush();
        }
        ?>
        <!-- Botón para ver pedidos asignados -->
        <div class="log">
            <!-- <button type="submit" name="food" onclick="">Mis pedidos</button> -->
            <a href="deliverymyord.php">Mis pedidos</a>
        </div>

        <!-- Mostrar los pedidos en una tabla HTML -->
        <div class="table-container">
            <!-- <p id="heading">donado</p> -->
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <!-- <th>comida</th> -->
                            <!-- <th>Categoría</th> -->
                            <th>Teléfono</th>
                            <th>Fecha/Hora</th>
                            <th>Dirección de recogida</th>
                            <th>Dirección de entrega</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Iterar sobre los datos para mostrar cada pedido -->
                        <?php foreach ($data as $row) { ?>
                            <?php echo "<tr><td data-label=\"name\">" . $row['name'] . "</td><td data-label=\"phoneno\">" . $row['phoneno'] . "</td><td data-label=\"date\">" . $row['date'] . "</td><td data-label=\"Pickup Address\">" . $row['From_address'] . "</td><td data-label=\"Delivery Address\">" . $row['To_address'] . "</td>";
                            ?>
                            <td data-label="Action" style="margin:auto">
                                <!-- Mostrar botón para tomar pedido si aún no ha sido asignado -->
                                <?php if ($row['delivery_by'] == null) { ?>
                                    <form method="post" action=" ">
                                        <input type="hidden" name="order_id" value="<?= $row['Fid'] ?>">
                                        <input type="hidden" name="delivery_person_id" value="<?= $id ?>">
                                        <button type="submit" name="food">Tomar pedido</button>
                                    </form>
                                <!-- Indicar si el pedido ya ha sido asignado al repartidor actual -->
                                <?php } else if ($row['delivery_by'] == $id) { ?>
                                        Pedido asignado a ti
                                <!-- Indicar si el pedido ha sido asignado a otro repartidor -->
                                <?php } else { ?>
                                        Pedido asignado a otra persona de entrega
                                <?php } ?>
                            </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <br>
            <br>
</body>

</html>