<?php
// $connection = mysqli_connect("localhost:3307", "root", "");
// $db = mysqli_select_db($connection, 'demo');
include "connect.php";
if ($_SESSION["name"] == "") {
    header("location:signin.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Documento</title>
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
                <!-- <li><a href="#">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Contenido</span>
                </a></li> -->
                <li><a href="analytics.php">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Análisis</span>
                </a></li>
                <li><a href="donate.php">
                    <i class="uil uil-heart"></i>
                    <span class="link-name">Donaciones</span>
                </a></li>
                <li><a href="feedback.php">
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Comentarios</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-user"></i>
                    <span class="link-name">Perfil</span>
                </a></li>
                <!-- <li><a href="#">
                    <i class="uil uil-share"></i>
                    <span class="link-name">Compartir</span>
                </a></li> -->
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
            <!-- <p>Donar Comida</p> -->
            <p  class ="logo" >Tu <b style="color: #06C167; ">Historial</b></p>
             <p class="user"></p>
            <!-- <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Buscar aquí...">
            </div> -->
            
            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        <br>
        <br>
        <br>
        <div class="activity">
        <div class="table-container">
         
         <div class="table-wrapper">
         <table class="table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Comida</th>
            <th>Categoría</th>
            <th>Teléfono</th>
            <th>Fecha/Hora</th>
            <th>Dirección</th>
            <th>Cantidad</th>
            <!-- <th>Acción</th> -->
         
          
           
        </tr>
        </thead>
         <?php
         // Define the SQL query to fetch unassigned orders
         $id = $_SESSION["Aid"];
         $sql = "SELECT * FROM food_donations WHERE assigned_to =$id";

         // Execute the query
         $result = mysqli_query($connection, $sql);

         // Check for errors
         if (!$result) {
             die("Error al ejecutar la consulta: " . mysqli_error($conn));
         }

         // Fetch the data as an associative array
         $data = [];
         while ($row = mysqli_fetch_assoc($result)) {
             $data[] = $row;
         }
         ?> 
    
        </tbody>
        <?php foreach ($data as $row) { ?>
        <?php echo "<tr><td data-label=\"nombre\">" .
            $row["name"] .
            "</td><td data-label=\"comida\">" .
            $row["food"] .
            "</td><td data-label=\"categoría\">" .
            $row["category"] .
            "</td><td data-label=\"teléfono\">" .
            $row["phoneno"] .
            "</td><td data-label=\"fecha\">" .
            $row["date"] .
            "</td><td data-label=\"Dirección\">" .
            $row["address"] .
            "</td><td data-label=\"cantidad\">" .
            $row["quantity"] .
            "</td>"; ?>
  <?php } ?>
    </table>
         </div>
                </div>
                
         
            
        </div>
            <!-- <P>Tu historial</P> -->

        

    </section>
    <script src="admin.js"></script>
</body>
</html>