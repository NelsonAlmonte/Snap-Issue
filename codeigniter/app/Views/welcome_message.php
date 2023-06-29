<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Welcome to CodeIgniter 4!</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/css/template.css">
</head>

<body>
  <video class="p-4" autoplay></video>
  <div class="display-cover">
    <canvas class="d-none"></canvas>
    <h1 class="d-none">NO HAY PERMISO DE CAMARA</h1>
    <div class="d-flex justify-content-center align-items-center">
      <button class="btn circle-button bg-accent text-white play" title="Play">
        <i class="bi bi-play"></i>
      </button>
      <button class="btn circle-button bg-accent text-white take-picture" data-bs-toggle="modal"
        data-bs-target="#exampleModal">
        <i class="bi bi-camera"></i>
      </button>
    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-dominant border-0">
        <div class="d-flex justify-content-between align-items-center p-3">
          <div class="modal-header-placeholder">
            <div class="modal-header-icon">
              <i class="bi bi-arrow-left-short"></i>
            </div>
          </div>
          <h1 class="modal-title fs-5">Foto del reporte</h1>
          <div class="modal-header-icon" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x"></i>
          </div>
        </div>
        <div class="modal-body">
          <img class="picture">
          <button 
            class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3" 
            type="button"
          >Continuar</button>
        </div>
      </div>
    </div>
  </div>

  <nav class="navbar fixed-bottom bg-complementary rounded-pill py-3 mx-4 mb-4">
    <div class="container-fluid d-flex justify-content-around align-items-center">
      <a class="circle-button bg-accent text-white active" href="#">
        <i class="bi bi-map-fill"></i>
      </a>
      <a class="circle-button bg-accent text-white opacity-75" href="#">
        <i class="bi bi-camera-fill"></i>
      </a>
      <a class="circle-button bg-accent text-white opacity-75" href="#">
        <i class="bi bi-gear-fill"></i>
      </a>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
  <script src="/assets/js/app.js"></script>
</body>

</html>