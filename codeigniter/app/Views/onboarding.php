<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Welcome to CodeIgniter 4!</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="/favicon.ico">
  <link rel="stylesheet" href="/assets/third-party/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/third-party/animate/animate.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/css/template.css">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
  <main>
    <div class="container-fluid" x-data="permissions">
      <div 
        class="d-flex flex-wrap flex-column justify-content-around align-items-center mx-auto"
        style="width: 300px; height: 100dvh" 
        x-show.important="step === 0"
        x-transition:enter="animate__animated animate__fadeIn animate__fast"
      >
        <div class="text-center">
          <h1 class="fw-bold lh-lg">Bienvenido a <br>Snap Issue</h1>
          <h4 class="text-secondary lh-base">Snap Issue es la app que le da una voz a ti y a tu comunidad.</h4>
        </div>
        <img class="img-fluid" src="/assets/img/onboarding/welcome.svg" alt="welcome">
        <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3" type="button"
          @click="step ++">Continuar</button>
      </div>

      <div 
        class="d-flex flex-wrap flex-column justify-content-around align-items-center mx-auto"
        style="width: 300px; height: 100dvh" 
        x-show.important="step === 1"
        x-transition:enter="animate__animated animate__fadeIn animate__fast"
      >
        <div class="text-center">
          <h1 class="fw-bold lh-lg">Antes de <br>empezar</h1>
          <h4 class="text-secondary lh-base">Antes de que empieces a utilizar la app necesitamos unos cuantos
            permisos.</h4>
        </div>
        <img class="img-fluid" src="/assets/img/onboarding/ask.svg" alt="ask">
        <div class="d-flex justify-content-center align-content-center w-100">
          <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 me-2 py-3" type="button"
            @click="step --">Regresar</button>
          <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3" type="button"
            @click="step ++">Continuar</button>
        </div>
      </div>

      <div 
        class="d-flex flex-wrap flex-column justify-content-around align-items-center mx-auto"
        style="width: 300px; height: 100dvh" 
        x-show.important="step === 2"
        x-transition:enter="animate__animated animate__fadeIn animate__fast"
      >
        <div class="text-center">
          <h1 class="fw-bold lh-lg">Necesitamos tu cámara</h1>
          <h4 class="text-secondary lh-base">Tu cámara es vital para que puedas empezar a ser escuchado.</h4>
        </div>
        <img class="img-fluid" src="/assets/img/onboarding/camera.svg" alt="camera">
        <div class="d-flex justify-content-center align-content-center w-100">
          <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 me-2 py-3" type="button"
            @click="step --">Regresar</button>
          <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3" type="button"
            @click="checkPermission('camera');">Continuar</button>
        </div>
      </div>

      <div 
        class="d-flex flex-wrap flex-column justify-content-around align-items-center mx-auto"
        style="width: 300px; height: 100dvh" 
        x-show.important="step === 3"
        x-transition:enter="animate__animated animate__fadeIn animate__fast"
      >
        <div class="text-center">
          <h1 class="fw-bold lh-lg">Necesitamos tu localización</h1>
          <h4 class="text-secondary lh-base">Tú localización es primodial para saber el lugar de tu problemática.</h4>
        </div>
        <img class="img-fluid" src="/assets/img/onboarding/location.svg" alt="location">
        <div class="d-flex justify-content-center align-content-center w-100">
          <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 me-2 py-3" type="button"
            @click="step --">Regresar</button>
          <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3" type="button"
            @click="checkPermission('geolocation');">Continuar</button>
        </div>
      </div>
    </div>
  </main>
  <script src="/assets/js/components.js"></script>
  <script src="/assets/third-party/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>