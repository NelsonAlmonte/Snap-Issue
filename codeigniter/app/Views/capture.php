<div 
  class="d-flex flex-wrap flex-column justify-content-around align-items-center mx-auto" 
  style="height: 100dvh"
  x-data="initCamera"
>
  <div>
    <video class="rounded-bottom-5" autoplay x-ref="video"></video>
    <canvas class="d-none" x-ref="canvas"></canvas>
  </div>
  <div class="d-flex justify-content-between align-items-center flex-grow-1" x-data="captureIssue">
    <button 
      class="btn circle-button-lg bg-accent text-white take-picture" 
      data-bs-toggle="modal"
      data-bs-target="#issueModal" 
      @click="captureIssue"
    >
      <i class="bi bi-camera"></i>
    </button>
    <div x-data="bottomNavbar">
      <button 
        class="btn circle-button-lg bg-accent text-white take-picture" 
        @click="console.log(isShown); isShown = !isShown"
      >
        <i class="bi bi-list"></i>
      </button>
    </div>
  </div>
</div>

<div 
  class="modal fade" 
  id="issueModal" 
  tabindex="-1" 
  aria-labelledby="issueModalLabel" 
  aria-hidden="true"
  x-data="handleIssue"
  @issue.window="picture = $event.detail.picture; location = $event.detail.location"
  x-ref="issueModal"
>
  <div class="modal-dialog modal-dialog-centered modal-fullscreen">
    <div class="modal-content bg-dominant border-0">
      <div class="modal-body">
        <div 
          x-show.important="step === 0"
          x-transition:enter="animate__animated animate__fadeIn animate__fast"
        >
          <div class="text-center mb-2">
            <h1 class="fw-bold lh-lg">Fotografía de la incidencia</h1>
          </div>
          <img class="picture rounded-2" :src="picture">
          <div class="d-flex justify-content-center align-content-center w-100">
            <button 
              class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 me-2 py-3" 
              type="button"
              data-bs-dismiss="modal" 
              aria-label="Close"
            >Retomar</button>
            <button 
              class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3" 
              type="button"
              @click="step ++"                
            >Continuar</button>
          </div>
        </div>
        <div 
          x-show.important="step === 1"
          x-transition:enter="animate__animated animate__fadeIn animate__fast"
        >
          <div class="text-center mb-2">
            <h1 class="fw-bold lh-lg">Tipo de incidencia</h1>
          </div>
          <img class="img-fluid h-auto rounded-2 mb-4" :src="picture">
          <div class="row g-5">
            <div class="col-6" @click="category = 1">
              <div class="d-flex flex-column align-items-center justify-content-center bg-complementary p-5 rounded-4">
                <i class="fi fi-rr-users-alt" style="font-size: 30px;"></i>
                <h4 class="fw-bold">Vertederos</h4>
              </div>
            </div>
            <div class="col-6 bg-complementary p-4" @click="category = 1">
              <span>Calles en mal estado</span>
            </div>
            <div class="col-6 bg-complementary p-4" @click="category = 'inundación'">
              <span>Inundación</span>
            </div>
            <div class="col-6 bg-complementary p-4" @click="category = 'semaforo averiado'">
              <span>Semáforo averiado</span>
            </div>
            <div class="col-6 bg-complementary p-4" @click="category = 'señal averiada'">
              <span>Señal averiada</span>
            </div>
            <div class="col-6 bg-complementary p-4" @click="category = 'acera en mal estado'">
              <span>Acera en mal estado</span>
            </div>
          </div>
          <div class="d-flex justify-content-center align-content-center w-100">
            <button 
              class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 me-2 py-3" 
              type="button"
              @click="step --"
            >Regresar</button>
            <button 
              class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3" 
              type="button"
              @click="saveIssue"                
            >Enviar</button>
          </div>
        </div>
        <div 
          class="d-flex flex-wrap flex-column justify-content-around align-items-center mx-auto"
          style="height: 95dvh" 
          x-show.important="step === 2"
          x-transition:enter="animate__animated animate__fadeIn animate__fast"
        >
          <div class="text-center">
            <h1 class="fw-bold lh-lg">Su reporte <br>ha sido enviado!</h1>
            <h4 class="text-secondary lh-base">Su reporte ha sido recibido y esta siendo procesado por las autoridades de su comunidad.</h4>
          </div>
          <img class="img-fluid" src="<?=PATH_TO_VIEW_ASSETS_ONBOARDING?>ready.svg" alt="ready">
          <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3" type="button"
            @click="closeModal">Continuar</button>
        </div>
        <div 
          class="d-flex flex-wrap flex-column justify-content-around align-items-center mx-auto"
          style="height: 95dvh" 
          x-show.important="step === 3"
          x-transition:enter="animate__animated animate__fadeIn animate__fast"
        >
          <div class="text-center">
            <h1 class="fw-bold lh-lg">Uh oh <br>Algo ha salido mal!</h1>
            <h4 class="text-secondary lh-base">Algo ha salido mal al enviar el reporte, actualiza o cierra y abre la app nuevamente.</h4>
          </div>
          <img class="img-fluid" src="<?=PATH_TO_VIEW_ASSETS_SYSTEM?>error.svg" alt="error">
          <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3" type="button"
            @click="document.location.reload()">Continuar</button>
        </div>
      </div>
    </div>
  </div>
</div>
<input class="csrf" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
