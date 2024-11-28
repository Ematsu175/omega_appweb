<?php 
    session_start();
    require_once('views/header_user/header_user.php');
?>

<div class="full-width-banner">
    <img src="/omega_appweb/images/1430772363db5f8f75e57312dc268e61a841d655d7a3dc871173a82dadab1f2ccd5f160e5b6473d2bfc523b90dc782da48931f803b6c2c7be45ec2_1280.jpg"
        alt="">
</div>
<section>
    <div class="container text-center">
        <h3>LO QUE DEBES DE SABER PARA AGENDAR UNA CITA</h3>
    </div>
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                Accordion Item #1
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to
                                demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion
                                body.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                aria-controls="flush-collapseTwo">
                                Accordion Item #2
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to
                                demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion
                                body. Let's imagine this being filled with some actual content.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                aria-controls="flush-collapseThree">
                                Accordion Item #3
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Placeholder content for this accordion, which is intended to
                                demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                                body. Nothing more exciting happening here in terms of content, but just filling up the
                                space to make it look, at least at first glance, a bit more representative of how this
                                would look in a real-world application.</div>
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
    print_r($_SESSION);
    require_once('views/footer.php'); 
?>