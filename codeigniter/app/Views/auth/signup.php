<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Snap Issue - Registro</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="/favicon.ico">
  <link rel="stylesheet" href="/assets/third-party/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/third-party/animate/animate.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/css/template.css">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-dominant">
  <main>
    <div class="container-fluid">
      <div class="d-flex justify-content-center align-items-center mx-auto" style="height: 100dvh">
        <div class="mx-2 w-100">
          <h3 class="fw-bold mb-5">Registra tu cuenta</h3>
          <p class="text-center text-danger"><?= session()->getFlashdata('message') ?></p>
          <form action="<?=site_url('auth/register')?>" method="post">
            <input class="csrf" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <div class="row">
              <div class="col-6">
                <div class="form-input-container mb-4">
                  <input type="text" class="form-input" name="name" placeholder="Nombres"
                    autocomplete="off">
                </div>
              </div>
              <div class="col-6">
                <div class="form-input-container mb-4">
                  <input type="text" class="form-input" name="last" placeholder="Apellidos"
                    autocomplete="off">
                </div>
              </div>
            </div>
            <div class="form-input-container mb-4">
              <input type="email" class="form-input" name="email" placeholder="Correo"
                autocomplete="off">
            </div>
            <div class="form-input-container mb-4">
              <input type="text" class="form-input" name="username" placeholder="Usuario"
                autocomplete="off">
            </div>
            <div class="form-input-container mb-4">
              <input type="password" class="form-input" id="password" name="password" placeholder="Contraseña"
                autocomplete="off">
            </div>
            <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3"
              type="submit">Registrate</button>
          </form>
          <div class="mt-5 text-center">
            <span class="text-secondary fw-bold">¿Ya tienes una cuenta?</span>
            <a class="text-accent fw-bold" href="<?=site_url('auth/login')?>">Inicia sesión</a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- <script src="/assets/js/components.js"></script> -->
  <script src="/assets/third-party/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!-- <div class="card mb-3">

  <div class="card-body">

    <div class="pt-4 pb-2">
      <h5 class="card-title text-center pb-0 fs-4">REGISTRO</h5>
      <p class="text-center small">Ingresa con tu usuario y contraseña</p>
      <p class="text-center text-danger"><?= session()->getFlashdata('message') ?></p>
    </div>
    <form class="row g-3 pb-4" action="<?=site_url('auth/register')?>" method="post">
      <?= csrf_field() ?>
      <div class="col-12">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="name" name="name" placeholder="Nombres"
            autocomplete="off">
          <label for="name">Nombres</label>
        </div>
      </div>

      <div class="col-12">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="last" name="last" placeholder="Apellidos"
            autocomplete="off">
          <label for="last">Apellidos</label>
        </div>
      </div>

      <div class="col-12">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="email" name="email" placeholder="Correo"
            autocomplete="off">
          <label for="email">Correo</label>
        </div>
      </div>
      <div class="col-12">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="username" name="username" placeholder="Usuario"
            autocomplete="off">
          <label for="username">Usuario</label>
        </div>
      </div>

      <div class="col-12">

        <div class="form-floating">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          <label for="password">Contraseña</label>
        </div>
      </div>

      <div class="col-12">
        <button class="btn btn-primary w-100" type="submit">REGISTRARME</button>
      </div>
    </form>

  </div>
</div> -->