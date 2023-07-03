<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Welcome to CodeIgniter 4!</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="/favicon.ico">
  <link rel="stylesheet" href="/assets/third-party/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/css/template.css">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
  <main>
    <div class="container-fluid" x-data="permissions">
      <div x-data="{ step: 0 }">
        <div class="d-flex flex-wrap flex-column justify-content-around align-items-center mx-auto"
          style="width: 300px; height: 100dvh" :class="step === 0 ? '' : 'd-none'">
          <div class="text-center">
            <h1 class="fw-bold lh-lg">Bienvenido a Snap Issue</h1>
            <h4 class="text-secondary lh-base">Snap Issue es la app que le da una voz a tu comunidad.</h4>
          </div>
          <img class="img-fluid" src="/assets/img/onboarding/welcome.svg" alt="welcome">
          <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3" type="button"
            @click="step ++">Continuar</button>
        </div>
        <div class="d-flex flex-wrap flex-column justify-content-around align-items-center mx-auto"
          style="width: 300px; height: 100dvh" :class="step === 1 ? '' : 'd-none'">
          <div class="text-center">
            <h1 class="fw-bold lh-lg">Antes de empezar</h1>
            <h4 class="text-secondary lh-base">Antes de que empieces a utilizar la app necesitamos unos cuantos
              permisos.</h4>
          </div>
          <img class="img-fluid" src="/assets/img/onboarding/welcome.svg" alt="welcome">
          <div class="d-flex justify-content-center align-content-center w-100">
            <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 me-2 py-3" type="button"
              @click="step --">Regresar</button>
            <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3" type="button"
              @click="step ++">Continuar</button>
          </div>
        </div>
        <!-- <h1>Permiso para la camara</h1>
        <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3"
        type="button" @click="checkPermission('camera')">Dar permiso de camara</button>
        <h1>Permiso para la geolocalizacion</h1>
        <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3"
          type="button" @click="checkPermission('geolocation')">Dar permiso de geolocalizacion</button>
        <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3"
          type="button" @click="validatePermissions()">validate</button> -->
      </div>

    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
  <script src="/assets/js/components.js"></script>
  <script src="/assets/third-party/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>