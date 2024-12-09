<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['id_usuario'])) {
        // Si no hay sesión, redirigir al login
        $_SESSION['mensaje'] = "Hay una sesión activa.";
        header("Location: /omega_appweb/admin/login.php");
        exit;
    }
    require_once('views/header_admin/header_admin.php');
    
?>

<h1>Admin</h1>

<?php
    //print_r($_SESSION);}+
    require_once('views/footer.php')
?>