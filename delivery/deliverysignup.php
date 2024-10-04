<?php
// session_start();
// $connection=mysqli_connect("localhost:3307","root","");
// $db=mysqli_select_db($connection,'demo');
include '../connection.php';
$msg=0;
if(isset($_POST['sign']))
{

    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $location=$_POST['district'];

    // $location=$_POST['district'];

    $pass=password_hash($password,PASSWORD_DEFAULT);
    $sql="select * from delivery_persons where email='$email'" ;
    $result= mysqli_query($connection, $sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        // echo "<h1> already account is created </h1>";
        // echo '<script type="text/javascript">alert("already Account is created")</script>';
        echo "<h1><center>Account already exists</center></h1>";
    }
    else{
    
    $query="insert into delivery_persons(name,email,password,city) values('$username','$email','$pass','$location')";
    $query_run= mysqli_query($connection, $query);
    if($query_run)
    {
        // $_SESSION['email']=$email;
        // $_SESSION['name']=$row['name'];
        // $_SESSION['gender']=$row['gender'];
       
        header("location:delivery.php");
        // echo "<h1><center>Account does not exists </center></h1>";
        //  echo '<script type="text/javascript">alert("Account created successfully")</script>'; -->
    }
    else{
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
          <input type="text" name="username" required/>
          <span></span>
          <label>Nombre de usuario</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required/>
          <span></span>
          <label>Contraseña</label>
        </div>
        <div class="txt_field">
            <input type="email" name="email" required/>
            <span></span>
            <label>Correo electrónico</label>
          </div>
          <div class="">
                           <!-- <label for="district">Departamento:</label> -->
                           <select id="district" name="district" style="padding:10px; padding-left: 20px;">
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
