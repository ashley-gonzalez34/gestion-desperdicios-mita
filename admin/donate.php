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
                        <option value="aguas_finas">Aguas Finas</option>
                        <option value="asuncion_mita" selected>Asunción Mita</option>
                        <option value="anguiatu">Anguiatú</option>
                        <option value="asuncion_grande">Asunción Grande</option>
                        <option value="asuncioncita">Asuncioncita</option>
                        <option value="buenos_aires_las_crucitas">Buenos Aires Las Crucitas</option>
                        <option value="cantiada">Cantiada</option>
                        <option value="cola_de_pava">Cola de Pava</option>
                        <option value="el_cerro_blanco">El Cerro Blanco</option>
                        <option value="el_cerron">El Cerrón</option>
                        <option value="el_cipres">El Ciprés</option>
                        <option value="el_guayabo">El Guayabo</option>
                        <option value="el_izote">El Izote</option>
                        <option value="el_jicaral">El Jicaral</option>
                        <option value="el_manguito">El Manguito</option>
                        <option value="el_nuevo_pajonal">El Nuevo Pajonal</option>
                        <option value="el_pito">El Pito</option>
                        <option value="el_platanar">El Platanar</option>
                        <option value="el_pretil">El Pretil</option>
                        <option value="el_rosario">El Rosario</option>
                        <option value="el_sauce">El Sauce</option>
                        <option value="el_sitio_de_las_flores">El Sitio de las Flores</option>
                        <option value="el_tablon_san_bartolo">El Tablón San Bartolo</option>
                        <option value="el_tamarindo">El Tamarindo</option>
                        <option value="el_trapiche_abajo">El Trapiche Abajo</option>
                        <option value="el_trapiche_vargas">El Trapiche Vargas</option>
                        <option value="el_tule">El Tule</option>
                        <option value="el_ujushte">El Ujushte</option>
                        <option value="estanzuela">Estanzuela</option>
                        <option value="girones">Girones</option>
                        <option value="guevara">Guevara</option>
                        <option value="la_lagunilla">La Lagunilla</option>
                        <option value="la_playa_del_coyol">La Playa del Coyol</option>
                        <option value="la_reforma">La Reforma</option>
                        <option value="las_animas">Las Animas</option>
                        <option value="las_ceibitas">Las Ceibitas</option>
                        <option value="las_crucitas">Las Crucitas</option>
                        <option value="las_fincas">Las Fincas</option>
                        <option value="las_moritas">Las Moritas</option>
                        <option value="las_posas">Las Posas</option>
                        <option value="loma_de_chavarria">Loma de Chavarría</option>
                        <option value="loma_larga">Loma Larga</option>
                        <option value="los_amates">Los Amates</option>
                        <option value="los_cerritos">Los Cerritos</option>
                        <option value="los_chavarria">Los Chavarría</option>
                        <option value="los_grijalva">Los Grijalva</option>
                        <option value="los_llanitos">Los Llanitos</option>
                        <option value="los_llanitos_el_tamarindo">Los Llanitos El Tamarindo</option>
                        <option value="los_umaña">Los Umaña</option>
                        <option value="nueva_estanzuela">Nueva Estanzuela</option>
                        <option value="paso_de_herrera">Paso de Herrera</option>
                        <option value="quebrada_honda">Quebrada Honda</option>
                        <option value="san_benito">San Benito</option>
                        <option value="san_francisco_el_tamarindo">San Francisco El Tamarindo</option>
                        <option value="san_jeronimo">San Jerónimo</option>
                        <option value="san_joaquin">San Joaquín</option>
                        <option value="san_jose_de_las_flores">San José de las Flores</option>
                        <option value="san_juan_la_isla">San Juan la Isla</option>
                        <option value="san_juan_las_minas">San Juan las Minas</option>
                        <option value="san_lorenzo">San Lorenzo</option>
                        <option value="san_matias">San Matías</option>
                        <option value="san_miguelito">San Miguelito</option>
                        <option value="san_rafael_cerro_blanco">San Rafael Cerro Blanco</option>
                        <option value="san_rafael_el_rosario">San Rafael El Rosario</option>
                        <option value="santa_cruz">Santa Cruz</option>
                        <option value="santa_elena">Santa Elena</option>
                        <option value="shanshuh">Shanshuh</option>
                        <option value="sitio_del_niño">Sitio del Niño</option>
                        <option value="tiucal_abajo">Tiucal Abajo</option>
                        <option value="tiucal_arriba">Tiucal Arriba</option>
                        <option value="trapichito">Trapichito</option>
                        <option value="valle_nuevo">Valle Nuevo</option>
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