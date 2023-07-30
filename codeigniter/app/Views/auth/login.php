<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Snap Issue - Inicio de sesion</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="/favicon.ico">
  <link rel="stylesheet" href="/assets/third-party/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/third-party/animate/animate.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/css/template.css">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-light">
  <main>
    <div class="container-fluid">
      <div class="d-flex justify-content-center align-items-center mx-auto" style="height: 100dvh">
        <div class="mx-2 w-100">
          <h2 class="fw-bold mb-5">Snap Issue</h2>
          <h3 class="fw-bold mb-5">Bienvenido de nuevo</h3>
          <p class="text-center text-danger"><?= session()->getFlashdata('message') ?></p>
          <form action="<?=site_url('auth/authenticate')?>" method="post">
            <input class="csrf" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <div class="form-input-container bg-info mb-4">
              <input type="text" class="form-input bg-info" id="username" name="username" placeholder="Usuario"
                autocomplete="off">
            </div>
            <div class="form-input-container bg-info mb-4">
              <input type="password" class="form-input bg-info" id="password" name="password" placeholder="Contraseña"
                autocomplete="off">
            </div>
            <button class="btn btn-primary rounded-pill text-white fw-bold w-100 mt-4 py-3" type="submit">Iniciar sesión</button>
          </form>
          <div class="mt-5 text-center">
            <span class="text-secondary fw-bold">¿Aún no estas registrado?</span>
            <a class="text-primary fw-bold" href="<?=site_url('auth/signup')?>">Registrate</a> 
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- <script src="/assets/js/components.js"></script> -->
  <script src="/assets/third-party/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
