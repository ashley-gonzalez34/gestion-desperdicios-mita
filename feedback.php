<?php
// Start the session
session_start();

// Database connection
$connection = mysqli_connect("localhost", "root", "Ashley123456.", "demo");

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['send'])) {
    // Escape user inputs for security
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $message = mysqli_real_escape_string($connection, $_POST['message']);

    // Attempt insert query execution
    $sql = "INSERT INTO user_feedback (name, email, message) VALUES ('$name', '$email', '$message')";
    
    if(mysqli_query($connection, $sql)){
        echo "¡Comentarios enviados con éxito!";
    } else{
        echo "ERROR: No se pudo ejecutar la consulta. $sql. " . mysqli_error($connection);
    }
}

// Close connection
mysqli_close($connection);
