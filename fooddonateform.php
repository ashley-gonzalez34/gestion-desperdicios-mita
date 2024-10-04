<?php
// Incluye el archivo de inicio de sesión
include("login.php");
// Redirige a la página de inicio de sesión si el nombre de usuario no está establecido en la sesión
if ($_SESSION['name'] == '') {
  header("location: signin.php");
}

// Obtiene el correo electrónico de la sesión
$emailid = $_SESSION['email'];

// Establece la conexión a la base de datos
$connection = mysqli_connect("localhost", "root", "elmaspro123");
// Selecciona la base de datos a utilizar
$db = mysqli_select_db($connection, 'demo');

// Verifica si se ha enviado el formulario
if (isset($_POST['submit'])) {
  // Escapa los datos del formulario para evitar inyección de SQL
  $foodname = mysqli_real_escape_string($connection, $_POST['foodname']);
  $meal = mysqli_real_escape_string($connection, $_POST['meal']);
  $category = $_POST['image-choice'];
  $quantity = mysqli_real_escape_string($connection, $_POST['quantity']);
  $phoneno = mysqli_real_escape_string($connection, $_POST['phoneno']);
  $district = mysqli_real_escape_string($connection, $_POST['district']);
  $address = mysqli_real_escape_string($connection, $_POST['address']);
  $name = mysqli_real_escape_string($connection, $_POST['name']);

  // Ejecuta la consulta de inserción
  $query = "insert into food_donations(email,food,type,category,phoneno,location,address,name,quantity) values('$emailid','$foodname','$meal','$category','$phoneno','$district','$address','$name','$quantity')";
  $query_run = mysqli_query($connection, $query);
  if ($query_run) {
    // Muestra un mensaje de éxito si los datos se guardaron correctamente
    echo '<script type="text/javascript">alert("Datos guardados")</script>';
    // Redirige a la página de entrega
    header("location:delivery.html");
  } else {
    // Muestra un mensaje de error si los datos no se guardaron
    echo '<script type="text/javascript">alert("Datos no guardados")</script>';
  }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donar Comida</title>
  <link rel="stylesheet" href="loginstyle.css">
</head>

<body style="    background-color: #06C167;">
  <div class="container">
    <div class="regformf">
      <form action="" method="post">
        <p class="logo">Donar <b style="color: #06C167; ">Comida</b></p>

        <div class="input">
          <label for="foodname"> Nombre de la comida:</label>
          <input type="text" id="foodname" name="foodname" required />
        </div>


        <div class="radio">
          <label for="meal">Tipo de comida:</label>
          <br><br>

          <input type="radio" name="meal" id="veg" value="veg" required />
          <label for="veg" style="padding-right: 40px;">Vegetariana</label>
          <input type="radio" name="meal" id="Non-veg" value="Non-veg">
          <label for="Non-veg">No vegetariana</label>

        </div>
        <br>
        <div class="input">
          <label for="food">Seleccione la categoría:</label>
          <br><br>
          <div class="image-radio-group">
            <input type="radio" id="raw-food" name="image-choice" value="raw-food">
            <label for="raw-food">
              <img src="img/raw-food.png" alt="Comida cruda">
            </label>
            <input type="radio" id="cooked-food" name="image-choice" value="cooked-food" checked>
            <label for="cooked-food">
              <img src="img/cooked-food.png" alt="Comida cocinada">
            </label>
            <input type="radio" id="packed-food" name="image-choice" value="packed-food">
            <label for="packed-food">
              <img src="img/packed-food.png" alt="Comida empaquetada">
            </label>
          </div>
          <br>
          <!-- <input type="text" id="food" name="food"> -->
        </div>
        <div class="input">
          <label for="quantity">Cantidad: (número de personas /kg)</label>
          <input type="text" id="quantity" name="quantity" required />
        </div>
        <b>
          <p style="text-align: center;">Detalles de contacto</p>
        </b>
        <div class="input">
          <!-- <div>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email">
          </div> -->
          <div>
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" value="<?php echo "" . $_SESSION['name']; ?>" required />
          </div>
          <div>
            <label for="phoneno">Teléfono:</label>
            <input type="text" id="phoneno" name="phoneno" maxlength="8" pattern="[0-9]{8}" required />
          </div>
        </div>
        <div class="input">
          <label for="location"></label>
          <label for="district">Departamento:</label>
          <select id="district" name="district" style="padding:10px;">
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

          <label for="address" style="padding-left: 10px;">Dirección:</label>
          <input type="text" id="address" name="address" required /><br>

        </div>
        <div class="btn">
          <button type="submit" name="submit">Enviar</button>
        </div>
      </form>
    </div>
  </div>


</body>

</html>