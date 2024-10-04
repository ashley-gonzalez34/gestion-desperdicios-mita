<?php
// Iniciar sesión para mantener el estado del usuario
session_start();

// Incluir el archivo de conexión a la base de datos
include '../connection.php';

// Inicializar variable para mensajes de error o éxito
$msg=0;

// Verificar si se ha enviado el formulario de inicio de sesión
if (isset($_POST['sign'])) {
  // Recuperar email y contraseña del formulario
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Sanitizar las entradas para prevenir inyección SQL
  $sanitized_emailid =  mysqli_real_escape_string($connection, $email);
  $sanitized_password =  mysqli_real_escape_string($connection, $password);

  // Consulta SQL para buscar el administrador con el email proporcionado
  $sql = "select * from admin where email='$sanitized_emailid'";
  // Ejecutar la consulta
  $result = mysqli_query($connection, $sql);
  // Contar el número de filas devueltas
  $num = mysqli_num_rows($result);
 
  // Verificar si se encontró exactamente un administrador con ese email
  if ($num == 1) {
    // Iterar sobre los resultados de la consulta
    while ($row = mysqli_fetch_assoc($result)) {
      // Verificar si la contraseña proporcionada coincide con la almacenada
      if (password_verify($sanitized_password, $row['password'])) {
        // Establecer variables de sesión con los datos del usuario
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['name'];
        $_SESSION['location'] = $row['location'];
        $_SESSION['Aid'] = $row['Aid'];
        // Redirigir al panel de administración
        header("location:admin.php");
      } else {
        // Establecer mensaje de error si la contraseña no coincide
        $msg = 1;
      }
    }
  } else {
    // Mostrar mensaje si la cuenta no existe
    echo "<h1><center>La cuenta no existe</center></h1>";
  }
}
?>
