<div class="z-3 d-flex justify-content-between align-items-center position-absolute end-0 start-0 m-4">
  <a 
    class="circle-button text-white bg-transparent"
    href="<?=site_url('map')?>" 
  >
    <i class="bi-chevron-left"></i>
  </a>
  <div x-data="bottomNavbar">
    <button 
      class="circle-button text-white bg-transparent" 
      @click="toggle"
    >
      <i class="bi bi-list"></i>
    </button>
  </div>
</div>
<div 
  style="height: 100dvh"
  x-data="initCamera"
>
  <template x-if="!isCameraOn">
    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100dvh">
      <div class="text-center">
        <div class="spinner-grow text-accent" role="status" style="width: 5rem; height: 5rem;">
          <span class="visually-hidden">Loading...</span>
        </div>
        <h5 class="fw-bold">Iniciando cámara...</h5>
      </div>
    </div>
  </template>
  <div class="position-relative">
    <video class="rounded-bottom-5" autoplay x-ref="video"></video>
    <canvas class="d-none" x-ref="canvas"></canvas>
    <div
      class="z-3 d-flex justify-content-center align-items-center position-absolute end-0 start-0 bottom-0 mb-5" 
      x-cloak
      x-show="isCameraOn"
    >
      <button 
        class="circle-button-lg btn-action bg-accent text-white take-picture"
        data-bs-toggle="modal"
        data-bs-target="#issueModal" 
        x-data="captureIssue"
        @click="captureIssue"
      >
        <i class="bi bi-camera"></i>
      </button>
    </div>
  </div>
</div>
<?=view_cell('CaptureIssueModal::render')?>
<input class="csrf" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
