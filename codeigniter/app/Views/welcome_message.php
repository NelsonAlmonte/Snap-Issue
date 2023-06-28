<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Welcome to CodeIgniter 4!</title>
  <meta name="description" content="The small framework with powerful features">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <style>

.screenshot-image {
  width: 150px;
  height: 90px;
  border-radius: 4px;
  border: 2px solid whitesmoke;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
  position: absolute;
  bottom: 5px;
  left: 10px;
  background: white;
}

.display-cover {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 70%;
  margin: 5% auto;
  position: relative;
}

video {
  /* margin: 5% auto; */
  width: 100%;
  height: 100vh;
  background: rgba(0,0,0,0.2);
  object-fit: cover;
}

.video-options {
  position: absolute;
  left: 20px;
  top: 30px;
}

.controls {
  position: absolute;
  right: 20px;
  top: 20px;
  display: flex;

}

.controls > button {
  width: 45px;
  height: 45px;
  text-align: center;
  border-radius: 100%;
  margin: 0 6px;
  background: transparent;
}


@media (min-width: 300px) and (max-width: 400px) {
  .controls {
    flex-direction: column;
  }
}

.controls > button > svg {
  height: 20px;
  width: 18px;
  text-align: center;
  margin: 0 auto;
  padding: 0;
}

.controls button:nth-child(1) {
  border: 2px solid #D2002E;
}

.controls button:nth-child(2) {
  border: 2px solid #008496;
}

.controls button:nth-child(3) {
  border: 2px solid #00B541;
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

  <video autoplay></video>
  <div class="display-cover">
    <canvas class="d-none"></canvas>
    <h1 class="d-none">NO HAY PERMISO DE CAMARA</h1>
<!-- 
    <div class="video-options">
      <select name="" id="" class="custom-select">
        <option value="">Select camera</option>
      </select>
    </div> -->

    <img class="screenshot-image d-none" alt="">

    <div class="controls">
      <button class="btn btn-danger play" title="Play"><i data-feather="play-circle"></i></button>
      <button class="btn btn-outline-success screenshot d-none" title="ScreenShot"><i data-feather="image"></i></button>
      <!-- <button class="btn btn-info pause d-none" title="Pause"><i data-feather="pause"></i></button> -->
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <!-- <script src="/assets/js/app_foo.js"></script> -->
  <script src="/assets/js/app.js"></script>
</body>

</html>