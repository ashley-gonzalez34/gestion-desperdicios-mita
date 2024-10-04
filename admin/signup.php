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
    $address=$_POST['address'];

    $pass=password_hash($password,PASSWORD_DEFAULT);
    $sql="select * from admin where email='$email'" ;
    $result= mysqli_query($connection, $sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        // echo "<h1> already account is created </h1>";
        // echo '<script type="text/javascript">alert("already Account is created")</script>';
        echo "<h1><center>Account already exists</center></h1>";
    }
    else{
    
    $query="insert into admin(name,email,password,location,address) values('$username','$email','$pass','$location','$address')";
    $query_run= mysqli_query($connection, $query);
    if($query_run)
    {
        // $_SESSION['email']=$email;
        // $_SESSION['name']=$row['name'];
        // $_SESSION['gender']=$row['gender'];
       
        header("location:signin.php");
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
    <link rel="stylesheet" href="formstyle.css">
    <script src="signin.js" defer></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Registrarse</title>
</head>
<body>
    <div class="container">
        <form action=" " method="post" id="form">
            <span class="title">Registrarse</span>
            <br>
            <br>
            <div class="input-group">
                <label for="username">Nombre</label>
                <input type="text" id="username" name="username" required/>
                <div class="error"></div>
            </div>
            <div class="input-group">
                    <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" required/>
                        
                    </div>

            <label class="textlabel" for="password">Contraseña</label> 
             <div class="password">
              
                <input type="password" name="password" id="password"  required/>
                <i class="uil uil-eye-slash showHidePw" id="showpassword"></i>                
                <?php
                    if($msg==1){
                        echo ' <i class="bx bx-error-circle error-icon"></i>';
                        echo '<p class="error">Las contraseñas no coinciden.</p>';
                    }
                    ?> 
             </div>
            <div class="input-group">
                    <label for="address">Dirección</label>
                    <textarea id="address" name="address" id="address" required/></textarea>
                    </div>
            <div class="input-field">
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
                  
         
            <button type="submit" name="sign">Registrarse</button>
            <div class="login-signup" >
                    <span class="text">¿Ya eres miembro?
                        <a href="signin.php" class="text login-link">Inicia sesión ahora</a>
                    </span>
                </div>
        </form>
    </div>
    <br>
    <br>
    <script src="login.js" ></script>
</body>
</html>