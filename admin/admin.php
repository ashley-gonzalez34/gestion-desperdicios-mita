<?php
ob_start(); 
// $connection = mysqli_connect("localhost:3307", "root", "");
// $db = mysqli_select_db($connection, 'demo');
 include("connect.php"); 
if($_SESSION['name']==''){
	header("location:signin.php");
}
?>
<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="admin.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Panel de Control del Administrador</title> 
    
<?php
 $connection=mysqli_connect("localhost","root","elmaspro123");
 $db=mysqli_select_db($connection,'demo');
 


?>
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
                <li><a href="#">
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
                <li><a href="adminprofile.php">
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
            <p  class ="logo" >Donar <b style="color: #06C167; ">Comida</b></p>
             <p class="user"></p>
            <!-- <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Buscar aquí...">
            </div> -->
            
            <!--<img src="images/profile.jpg" alt="">-->
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Panel de Control</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-user"></i>
                        <!-- <i class="fa-solid fa-user"></i> -->
                        <span class="text">Total de usuarios</span>
                        <?php
                           $query="SELECT count(*) as count FROM  login";
                           $result=mysqli_query($connection, $query);
                           $row=mysqli_fetch_assoc($result);
                         echo "<span class=\"number\">".$row['count']."</span>";
                        ?>
                        <!-- <span class="number">50,120</span> -->
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Comentarios</span>
                        <?php
                           $query="SELECT count(*) as count FROM  user_feedback";
                           $result=mysqli_query($connection, $query);
                           $row=mysqli_fetch_assoc($result);
                         echo "<span class=\"number\">".$row['count']."</span>";
                        ?>
                        <!-- <span class="number">20,120</span> -->
                    </div>
                    <div class="box box3">
                        <i class="uil uil-heart"></i>
                        <span class="text">Total de donaciones</span>
                        <?php
                           $query="SELECT count(*) as count FROM food_donations";
                           $result=mysqli_query($connection, $query);
                           $row=mysqli_fetch_assoc($result);
                         echo "<span class=\"number\">".$row['count']."</span>";
                        ?>
                        <!-- <span class="number">10,120</span> -->
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Donaciones Recientes</span>
                </div>
            <div class="get">
            <?php


// Definir la consulta SQL para obtener pedidos no asignados
$sql = "SELECT * FROM food_donations WHERE assigned_to IS NULL";

// Ejecutar la consulta
$result=mysqli_query($connection, $sql);
$id=$_SESSION['Aid'];

// Verificar errores
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
    $sql = "SELECT * FROM food_donations WHERE Fid = $order_id AND assigned_to IS NOT NULL";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        // El pedido ya ha sido asignado a otra persona
        die("Lo siento, este pedido ya ha sido asignado a otra persona.");
    }



    $sql = "UPDATE food_donations SET assigned_to = $delivery_person_id WHERE Fid = $order_id";
    // $result = mysqli_query($conn, $sql);
    $result=mysqli_query($connection, $sql);


    if (!$result) {
        die("Error al asignar el pedido: " . mysqli_error($conn));
    }

    // Recargar la página para evitar asignaciones duplicadas
    header('Location: ' . $_SERVER['REQUEST_URI']);
    // exit;
    ob_end_flush();
}
// mysqli_close($conn);


?>

<!-- Mostrar los pedidos en una tabla HTML -->
<div class="table-container">
         <!-- <p id="heading">donado</p> -->
         <div class="table-wrapper">
        <table class="table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Comida</th>
            <th>Categoría</th>
            <th>Teléfono</th>
            <th>Fecha de Vencimiento</th>
            <th>Dirección</th>
            <th>Cantidad</th>
            <!-- <th>Acción</th> -->
         
          
           
        </tr>
        </thead>
       <tbody>

        <?php foreach ($data as $row) { ?>
        <?php    echo "<tr><td data-label=\"nombre\">".$row['name']."</td><td data-label=\"comida\">".$row['food']."</td><td data-label=\"categoría\">".$row['category']."</td>";
    
        echo "</td><td data-label=\"teléfono\">".$row['phoneno']."</td><td data-label=\"fecha\">".date('d/m/Y', strtotime($row['expiration_date']))."</td><td data-label=\"Dirección\">".$row['address']."</td><td data-label=\"cantidad\">".$row['quantity']."</td>";
?>
        
            <!-- <td><?= $row['Fid'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['address'] ?></td> -->
            <td data-label="Acción" style="margin:auto">
                <?php if ($row['assigned_to'] == null) { ?>
                    <form method="post" action=" ">
                        <input type="hidden" name="order_id" value="<?= $row['Fid'] ?>">
                        <input type="hidden" name="delivery_person_id" value="<?= $id ?>">
                        <button type="submit" name="food">Obtener Comida</button>
                    </form>
                <?php } else if ($row['assigned_to'] == $id) { ?>
                    Pedido asignado a ti
                <?php } else { ?>
                    Pedido asignado a otro repartidor
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

            </div>

        

 
<!-- 
                <div class="table-container">
         <p id="heading">donado</p>
         <div class="table-wrapper">
        <table class="table">
        <thead>
        <tr>
            <th >Nombre</th>
            <th>Comida</th>
            <th>Categoría</th>
            <th>Teléfono</th>
            <th>Fecha/Hora</th>
            <th>Dirección</th>
            <th>Cantidad</th>
            <th>Estado</th>
          
           
        </tr>
        </thead>
       <tbody>
   
         <?php
        $loc=$_SESSION['location'];
        $query="select * from food_donations where location='$loc' ";
        $result=mysqli_query($connection, $query);
        if($result==true){
            while($row=mysqli_fetch_assoc($result)){
                echo "<tr><td data-label=\"nombre\">".$row['name']."</td><td data-label=\"comida\">".$row['food']."</td><td data-label=\"categoría\">".$row['category']."</td><td data-label=\"teléfono\">".$row['phoneno']."</td><td data-label=\"fecha\">".$row['date']."</td><td data-label=\"Dirección\">".$row['address']."</td><td data-label=\"cantidad\">".$row['quantity']."</td><td  data-label=\"Estado\" >".$row['quantity']."</td></tr>";

             }
            
          }
          else{
            echo "<p>No se encontraron resultados.</p>";
         }
    
       ?> 
    
        </tbody>
    </table>
         </div>
                </div>
                
          -->
            
        </div>
    </section>

    <script src="admin.js"></script>


    <?php
// Asumimos que ya tienes una conexión a la base de datos establecida

// Función para obtener productos próximos a vencer
function obtenerProductosPorVencer($connection) {
    $fecha_actual = date('Y-m-d');
    $fecha_limite = date('Y-m-d', strtotime('+2 days'));
    
    $query = "SELECT * FROM food_donations WHERE expiration_date BETWEEN '$fecha_actual' AND '$fecha_limite ' and assigned_to is NULL";
    $result = mysqli_query($connection, $query);
    
    $productos = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $productos[] = $row;
    }
    
    return $productos;
}

// Obtener productos próximos a vencer
$productos_por_vencer = obtenerProductosPorVencer($connection);

// Generar HTML para el pop-up
$popup_html = "";
if (!empty($productos_por_vencer)) {
    $popup_html .= "<div id='popup-productos-vencer' class='popup'>";
    $popup_html .= "<div class='popup-content'>";
    $popup_html .= "<h3>Productos próximos a vencer ⚠️</h3>";
    $popup_html .= "<ul>";
    foreach ($productos_por_vencer as $producto) {
        $popup_html .= "<li>ID {$producto['Fid']} | {$producto['food']} - Vence: {$producto['expiration_date']}</li>";
    }
    $popup_html .= "</ul>";
    $popup_html .= "<button onclick='cerrarPopup()'>Cerrar</button>";
    $popup_html .= "</div>";
    $popup_html .= "</div>";
}

// Insertar el HTML del pop-up al final del body
echo $popup_html;
?>

<script>
function cerrarPopup() {
    document.getElementById('popup-productos-vencer').style.display = 'none';
}

// Mostrar el pop-up automáticamente al cargar la página
window.onload = function() {
    var popup = document.getElementById('popup-productos-vencer');
    if (popup) {
        popup.style.display = 'block';
    }
}
</script>

<style>
.popup {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.4);
}

.popup-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    max-height: 400px;
    overflow-y: auto;
}

.popup-content h3 {
    margin-top: 0;
}

.popup-content ul {
    list-style-type: none;
    padding: 0;
}

.popup-content li {
    margin-bottom: 10px;
}

.popup-content button {
    display: block;
    margin-top: 20px;
}
</style>




</body>
</html>
