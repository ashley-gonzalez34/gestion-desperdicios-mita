<?php
include "../connection.php";
include("connect.php");

if (empty($_SESSION['name'])) {
    header("location:signin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Admin</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <!--<img src="images/logo.png" alt="">-->
            </div>
            <span class="logo_name">ADMIN</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="admin.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Panel de Control</span>
                    </a></li>
                <li><a href="analytics.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Análisis</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-heart"></i>
                        <span class="link-name">Donaciones</span>
                    </a></li>
                <li><a href="feedback.php">
                        <i class="uil uil-comments"></i>
                        <span class="link-name">Comentarios</span>
                    </a></li>
                <li><a href="adminprofile.php">
                        <i class="uil uil-user"></i>
                        <span class="link-name">Perfil</span>
                    </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="../logout.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Cerrar Sesión</span>
                    </a></li>
                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Modo Oscuro</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <p class="logo">Donar <b style="color: #06C167;">Comida</b></p>
            <p class="user"></p>
        </div>
        <br><br><br>

        <div class="activity">
            <div class="location">
                <form method="post">
                    <label for="location" class="logo">Seleccionar Ubicación:</label>
                    <select id="location" name="location">
                        <option value="alta_verapaz">Alta Verapaz</option>
                        <option value="baja_verapaz">Baja Verapaz</option>
                        <option value="chimaltenango">Chimaltenango</option>
                        <option value="chiquimula">Chiquimula</option>
                        <option value="el_progreso">El Progreso</option>
                        <option value="escuintla">Escuintla</option>
                        <option value="guatemala" selected>Guatemala</option>
                        <option value="huehuetenango">Huehuetenango</option>
                        <option value="izabal">Izabal</option>
                        <option value="jalapa">Jalapa</option>
                        <option value="jutiapa">Jutiapa</option>
                        <option value="peten">Petén</option>
                        <option value="quetzaltenango">Quetzaltenango</option>
                        <option value="quiche">Quiché</option>
                        <option value="retalhuleu">Retalhuleu</option>
                        <option value="sacatepequez">Sacatepéquez</option>
                        <option value="san_marcos">San Marcos</option>
                        <option value="santa_rosa">Santa Rosa</option>
                        <option value="solola">Sololá</option>
                        <option value="suchitepequez">Suchitepéquez</option>
                        <option value="totonicapan">Totonicapán</option>
                        <option value="zacapa">Zacapa</option>
                    </select>
                    <input type="submit" value="Obtener Detalles">
                </form>
                <br>

                <?php
                if (isset($_POST['location'])) {
                    $location = $_POST['location'];
                    $sql = "SELECT * FROM food_donations WHERE location='$location'";
                    $result = mysqli_query($connection, $sql);

                    if ($result && $result->num_rows > 0) {
                        echo "<div class=\"table-container\">";
                        echo "<div class=\"table-wrapper\">";
                        echo "<table class=\"table\">";
                        echo "<thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Comida</th>
                                    <th>Categoría</th>
                                    <th>Teléfono</th>
                                    <th>Fecha/Hora</th>
                                    <th>Dirección</th>
                                    <th>Cantidad</th>
                                </tr>
                              </thead>
                              <tbody>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td data-label=\"nombre\">{$row['name']}</td>
                                    <td data-label=\"comida\">{$row['food']}</td>
                                    <td data-label=\"categoría\">{$row['category']}</td>
                                    <td data-label=\"teléfono\">{$row['phoneno']}</td>
                                    <td data-label=\"fecha\">{$row['date']}</td>
                                    <td data-label=\"dirección\">{$row['address']}</td>
                                    <td data-label=\"cantidad\">{$row['quantity']}</td>
                                  </tr>";
                        }
                        echo "</tbody></table></div></div>";
                    } else {
                        echo "<p style='font-size: 18px; color: white;'>No se encontraron resultados.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <script src="admin.js"></script>
</body>

</html>