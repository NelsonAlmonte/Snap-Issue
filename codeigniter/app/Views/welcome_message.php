
  <div x-data="initCamera" x-init="checkPermission">
    <video class="p-4" autoplay x-ref="video"></video>
    <canvas class="d-none" x-ref="canvas"></canvas>
    <div class="d-flex justify-content-center align-items-center">
      <!-- <button class="btn circle-button bg-accent text-white play">
        <i class="bi bi-play"></i>
      </button> -->
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
    x-data="{ picture: '', location: '' }"
    @issue.window="picture = $event.detail.picture; location = $event.detail.location"
  >
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
          <img class="picture" :src="picture">
          <button class="btn btn-block rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3"
            type="button">Continuar</button>
        </div>
      </div>
    </div>
  </div>
