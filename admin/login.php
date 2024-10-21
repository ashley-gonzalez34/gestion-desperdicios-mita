<?php
//  $connection=mysqli_connect("localhost:3307","root","");
// $db=mysqli_select_db($connection,'demo');
include '../connection.php';
$acc = 0;
$msg = 0;
if (isset($_POST['signup'])) {

    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $location = $_POST['district'];

    $pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = "select * from admin where email='$email'";
    $result = mysqli_query($connection, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $acc = 1;
        // echo "<h1> already account is created </h1>";
        // echo '<script type="text/javascript">alert("already Account is created")</script>';
        // echo "<h1><center>Account already exists</center></h1>";
    } else {

        $query = "insert into admin(name,email,password,location) values('$username','$email','$pass','$location')";
        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
            // $_SESSION['email']=$email;
            // $_SESSION['name']=$row['name'];
            // $_SESSION['gender']=$row['gender'];

            // header("location:#");
            // echo "<h1><center>La cuenta no existe. </center></h1>";
            //  echo '<script type="text/javascript">alert("Account created successfully")</script>'; -->
        } else {
            echo '<script type="text/javascript">alert("data not saved")</script>';

        }
    }



}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="login.css">

    <!--<title>Login & Registration Form</title>-->
</head>

<body>

    <div class="container">
        <div class="forms">
            <p style="color:"></p>
            <div class="form login">
                <?php
                if ($msg == 1) {
                    echo '<p ><center style=\"color:#06C167;\">Account created successfully</center></p>';
                }
                ?>
                <?php
                if ($acc == 1) {
                    echo ' <p ><center style=\"color:crimson;\">Account already exists</center></p>';
                }
                ?>
                <!-- <p style="color:aqua;">account</p> -->
                <span class="title">Login</span>

                <form action=" " method="post">
                    <div class="input-field">
                        <input type="text" placeholder="Enter your email" name="email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    <!-- 
                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>
                        
                        <a href="#" class="text">Forgot password?</a>
                    </div> -->

                    <div class="input-field button">
                        <button type="submit" name="Login">Login</button>
                        <!-- <input type="button" value="Login" name="Login"> -->
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Not a member?
                        <a href="#" class="text signup-link">Signup Now</a>
                    </span>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="form signup">
                <?php
                if ($msg == 1) {
                    echo '<p ><center style=\"color:crimson;\">Account already exists</center></p>';
                }
                ?>
                <span class="title">Registration</span>


                <form action=" " method="post">
                    <div class="input-field">
                        <input type="text" placeholder="Enter your name" name="name" required>
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" placeholder="Enter your email" name="email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <!-- <label for="district">District:</label> -->
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


                        <!-- <input type="password" class="password" placeholder="Create a password" required> -->
                        <i class="uil uil-map-marker icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" id="password" name="password" placeholder="Confirm a password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <!-- 
                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="termCon">
                            <label for="termCon" class="text">I accepted all terms and conditions</label>
                        </div>
                    </div> -->

                    <div class="input-field button">
                        <button type="submit" name="signup">Signup</button>
                        <!-- <input type="button" value="signup" name="signup"> -->
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Already a member?
                        <a href="#" class="text login-link">Login Now</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script src="login.js"></script>
</body>

</html>

<?php


$msg = 0;
if (isset($_POST['Login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sanitized_emailid = mysqli_real_escape_string($connection, $email);
    $sanitized_password = mysqli_real_escape_string($connection, $password);
    // $hash=password_hash($password,PASSWORD_DEFAULT);

    $sql = "select * from admin where email='$sanitized_emailid'";
    $result = mysqli_query($connection, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($sanitized_password, $row['password'])) {
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $row['name'];
                $_SESSION['location'] = $row['location'];
                header("location:admin.php");
            } else {
                $msg = 1;
                // echo "<h1><center> Login Failed incorrect password</center></h1>";
            }
        }
    } else {
        echo "<h1><center>La cuenta no existe. </center></h1>";
    }




    // $query="select * from login where email='$email'and password='$password'";
    // $qname="select name from login where email='$email'and password='$password'";


    // if(mysqli_num_rows($query_run)==1)
    // {
    // //   $_SESSION['name']=$name;

    //   // echo "<h1><center> Login Sucessful  </center></h1>". $name['gender'] ;

    //   $_SESSION['email']=$email;
    //   $_SESSION['name']=$name['name'];
    //   $_SESSION['gender']=$name['gender'];
    //   header("location:home.html");

    // }
    // else{
    //   echo "<h1><center> Login Failed</center></h1>";
    // }
}
?>