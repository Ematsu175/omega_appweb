
<!-- Login 8 - Bootstrap Brain Component -->
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/main.css">
<section class="bg-light p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xxl-11">
        <div class="card border-light-subtle shadow-sm">
          <div class="row g-0">
            <div class="col-12 col-md-6">
              <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="/omega_appweb/images/img_login.png" alt="Welcome back you've been missed!">
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
              <div class="col-12 col-lg-11 col-xl-10">
                <div class="card-body p-3 p-md-4 p-xl-5">
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-5">
                        <div class="text-center mb-4">
                          <a href="#!">
                            <img src="/omega_appweb/images/img_login2.png" alt="BootstrapBrain Logo" width="175" height="57">
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <form id="login" method="post" action="login.php?accion=login">
                    <div class="row gy-3 overflow-hidden">
                      <div class="col-12">
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control" name="data[correo]" id="email" placeholder="name@example.com" required>
                          <label for="email" class="form-label">Correo</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-floating mb-3">
                          <input type="password" class="form-control" name="data[contrasena]" id="password" value="" placeholder="Password" required>
                          <label for="password" class="form-label">Contraseña</label>
                        </div>
                      </div>
                      <div class="col-12">
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                            <input class="btn btn-dark btn-lg" type="submit" value="Iniciar Sesión" name="enviar" />
                        </div>
                      </div>
                    </div>
                  </form>
                  <div class="row">
                    <div class="col-12">
                      <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-5">
                        <a href="/omega_appweb/admin/registration.php" class="link-secondary text-decoration-none">Crear cuenta</a>
                        <a href="#!" class="link-secondary text-decoration-none">¿Olvidaste tu contraseña?</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
