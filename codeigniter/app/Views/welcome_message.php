
  <div x-data="initCamera">
    <video class="p-4" autoplay x-ref="video"></video>
    <canvas class="d-none" x-ref="canvas"></canvas>
    <div class="d-flex justify-content-center align-items-center">
      <div x-data="captureIssue">
        <button 
          class="btn circle-button bg-accent text-white take-picture" 
          data-bs-toggle="modal"
          data-bs-target="#exampleModal" 
          @click="captureIssue"
        >
          <i class="bi bi-camera"></i>
        </button>
      </div>
    </div>
  </div>

  <div 
    class="modal fade" 
    id="exampleModal" 
    tabindex="-1" 
    aria-labelledby="exampleModalLabel" 
    aria-hidden="true"
    x-data="handleIssue"
    @issue.window="picture = $event.detail.picture; location = $event.detail.location"
  >
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
      <div class="modal-content bg-dominant border-0">
        <div class="d-flex justify-content-center align-items-center p-3">
          <h1 class="modal-title fs-5">Foto del reporte</h1>
        </div>
        <div class="modal-body">
          <div 
            x-show.important="step === 0"
            x-transition:enter="animate__animated animate__fadeIn animate__fast"
          >
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
            <img class="img-fluid h-auto rounded-2 mb-4" :src="picture">
            <div class="row g-4">
              <div class="col-6 bg-complementary p-4" @click="category = 'mosquitos'">
                <span>Mosquitos</span>
              </div>
              <div class="col-6 bg-complementary p-4" @click="category = 'sheira'">
                <span>Sheira</span>
              </div>
              <div class="col-6 bg-complementary p-4" @click="category = 'cloaca nomi'">
                <span>Cloaca nomi</span>
              </div>
              <div class="col-6 bg-complementary p-4" @click="category = 'inundacion sheira'">
                <span>Inundacion Sheira</span>
              </div>
              <div class="col-6 bg-complementary p-4" @click="category = 'calle rota nomi'">
                <span>Calle rota nomi</span>
              </div>
              <div class="col-6 bg-complementary p-4" @click="category = 'mosquitos shire'">
                <span>Mosquitos shire</span>
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
                @click="sendIssue"                
              >Enviar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
