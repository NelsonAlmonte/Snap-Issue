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
  style="height: 100dvh"
  x-data="initMap"
>
  <div class="rounded-bottom-5 z-2" id="map" style="height: 80dvh; width: 100vw"></div>
</div>
<input class="csrf" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
