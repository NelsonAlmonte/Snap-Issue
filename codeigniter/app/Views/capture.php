<div class="z-3 d-flex justify-content-between align-items-center position-absolute end-0 start-0 m-4">
  <a 
    class="circle-button text-white bg-transparent"
    href="<?=site_url('onboarding')?>" 
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
      class="circle-button-lg bg-accent text-white take-picture" 
      data-bs-toggle="modal"
      data-bs-target="#issueModal" 
      @click="captureIssue"
    >
      <i class="bi bi-camera"></i>
    </button>
  </div>
</div>
<?=view_cell('CaptureIssueModal::render')?>
<input class="csrf" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
