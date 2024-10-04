<?php
// session_start();
// $connection=mysqli_connect("localhost:3307","root","");
// $db=mysqli_select_db($connection,'demo');
include '../connection.php';
$msg = 0;
if (isset($_POST['sign'])) {

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $location = $_POST['district'];

  // $location=$_POST['district'];

  $pass = password_hash($password, PASSWORD_DEFAULT);
  $sql = "select * from delivery_persons where email='$email'";
  $result = mysqli_query($connection, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    // echo "<h1> already account is created </h1>";
    // echo '<script type="text/javascript">alert("already Account is created")</script>';
    echo "<h1><center>Account already exists</center></h1>";
  } else {

    $query = "insert into delivery_persons(name,email,password,city) values('$username','$email','$pass','$location')";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
      // $_SESSION['email']=$email;
      // $_SESSION['name']=$row['name'];
      // $_SESSION['gender']=$row['gender'];

      header("location:delivery.php");
      // echo "<h1><center>Account does not exists </center></h1>";
      //  echo '<script type="text/javascript">alert("Account created successfully")</script>'; -->
    } else {
      echo '<script type="text/javascript">alert("data not saved")</script>';

    }
  }



}
?>





<!DOCTYPE html>
<html lang="es">


<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Formulario de Registro</title>
  <link rel="stylesheet" href="deliverycss.css">
</head>

<body>
  <div class="center">
    <h1>Registrarse</h1>
    <form method="post" action=" ">
      <div class="txt_field">
        <input type="text" name="username" required />
        <span></span>
        <label>Nombre de usuario</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" required />
        <span></span>
        <label>Contraseña</label>
      </div>
      <div class="txt_field">
        <input type="email" name="email" required />
        <span></span>
        <label>Correo electrónico</label>
      </div>
      <div class="">
        <!-- <label for="district">Departamento:</label> -->
        <select id="district" name="district" style="padding:10px; padding-left: 20px;">
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
      </div>
      <br>
      <!-- <div class="pass">¿Olvidaste tu contraseña?</div> -->
      <input type="submit" name="sign" value="Registrarse">
      <div class="signup_link">
        ¿Ya eres miembro? <a href="deliverylogin.php">Iniciar sesión</a>
      </div>
    </form>
  </div>

</body>

</html>