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

<div class="full-width-banner">
    <img src="/omega_appweb/images/1430772363db5f8f75e57312dc268e61a841d655d7a3dc871173a82dadab1f2ccd5f160e5b6473d2bfc523b90dc782da48931f803b6c2c7be45ec2_1280.jpg"
        alt="">
</div>
<section style="background-color: #f5f5f5;">
    <div class="container text-center">
        <div class="container text-center">
            <h3>ESTO ES LO QUE PUEDES HACER COMO ADMINISTRADOR</h3>
        </div>
        <div id="centered-card" class="container text-center"> 
            <div id="card" class="card mb-3" style="max-width: 800px;">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Conoce el sistema</h5>
                            <p class="card-text">
                                <ul>
                                    <li>
                                        <strong>Figuras Fiscales:</strong> 
                                        para figuras fiscales ya tenemos cargadas las que se debe utilizar, puede revisar en el apartado 
                                        en la parte de arriba y si falta una puedes añadirla.
                                    </li>
                                    <li>
                                        <strong>Empresas:</strong> 
                                        para el apartado de empresas lo que puedes es administrarlas, esto gracias a la vista en la tabla, y si 
                                        necesitaras actualizar algo de estas empresas, como puede ser el nombre, la figura fiscal, etc., mediante
                                        las diferentes opciones puedes realizarlo.
                                    </li>
                                    <li>
                                        <strong>Citas:</strong> 
                                        En el apartado de citas que es el mas importante tenemos acomodados de manera descendente por fecha las
                                        diferentes citas programadas para su respectivo día, usted puede agendar las citas mediante el boton de 
                                        de "Nuevo" y además puede realizar actualizaciones o eliminar la cita.
                                    </li>
                                    <li>
                                        <strong>Usuarios:</strong> 
                                        Mediante este apartado usted podrá ver los usuarios que han sido registrados y además si se llegara a 
                                        requerir usted mismo puede agregarlos, actualizar su informacion o eliminarlos.
                                    </li>
                                    <li>
                                        <strong>Informe:</strong> 
                                        Este apartado lo que hace es descargar un archivo .csv para que el administrador pueda realizar el 
                                        control de citas en cualquier aplicación como lo puede ser excel.
                                    </li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
<section class="contact-section">
    <div class="container text-center">
        <h3>CONTÁCTANOS</h3>
    </div>

    <div id="centered-card" class="container text-center">
        <div id="card" class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="/omega_appweb/images/" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Ing. Raul Silverio Vázquez Castillo</h5>
                        <p class="card-text">Número de teléfono <br> 4611780098</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="card" class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="/omega_appweb/images/" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Ing. Juan Carlos Nuñez Servin</h5>
                        <p class="card-text">Número de teléfono <br> 4610987265</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="card" class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="/omega_appweb/images/" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Ing. Gabriela Arias Reina</h5>
                        <p class="card-text">Número de teléfono <br> 4611780098</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
//print_r($_SESSION);
require_once('views/footer.php');
?>