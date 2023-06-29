<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Welcome to CodeIgniter 4!</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
video, .picture {
  width: 100%;
  height: 70vh;
  object-fit: cover;
}
.controls > button {
  width: 45px;
  height: 45px;
  text-align: center;
  border-radius: 100%;
  margin: 0 6px;
  background: transparent;
}

.controls > button {
  width: 45px;
  height: 45px;
  text-align: center;
  border-radius: 100%;
  margin: 0 6px;
  background: transparent;
}
  </style>
</head>

<body>
  <video class="p-4" autoplay></video>
  <div class="display-cover">
    <canvas class="d-none"></canvas>
    <h1 class="d-none">NO HAY PERMISO DE CAMARA</h1>

    <div class="controls d-flex justify-content-center align-items-center">
      <button class="btn btn-danger play" title="Play"><i data-feather="play-circle"></i></button>
      <button class="btn btn-outline-success take-picture"><i class="bi bi-camera"></i></button>
    </div>
    <img class="picture p-4">
    <h1 class="siu"></h1>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="/assets/js/app.js"></script>
</body>

</html>