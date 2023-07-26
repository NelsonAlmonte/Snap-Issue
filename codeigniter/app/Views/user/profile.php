<div class="container-fluid">
  <div class="text-center mt-5">
    <img style="width: 170px; height: 170px" class="rounded-circle border border-4 border-white object-fit-cover"
      src="https://wallpapers.com/images/featured/minimalist-7xpryajznty61ra3.jpg" alt="siuu">
    <h3 class="fw-bold mt-2"><?=$user['name'] . ' ' . $user['last']?></h3>
    <h5 class="text-secondary mt-2"><?=$user['username']?></h5>
  </div>
  <div class="mt-5">
      <div class="d-flex justify-content-between align-items-center bg-complementary rounded-4 p-4 mb-4">
        <div class="d-flex justify-content-start align-items-baseline">
          <a class="circle-button bg-accent text-white" href="<?=site_url('profile/' . $user['id'] . '/edit')?>">
            <i class="bi bi-person"></i>
          </a>
          <h6 style="font-size: 18px;" class="ms-3 fw-bold">Editar perfil</h6>
        </div>
        <i class="bi bi-chevron-right" style="font-size: 20px;"></i>
      </div>

    <div class="d-flex justify-content-between align-items-center bg-complementary rounded-4 p-4 mb-4">
      <div class="d-flex justify-content-start align-items-baseline">
        <a class="circle-button bg-accent text-white" href="<?=site_url('onboarding')?>">
          <i class="bi bi-gear-fill"></i>
        </a>
        <h6 style="font-size: 18px;" class="ms-3 fw-bold">Onboarding</h6>
      </div>
      <i class="bi bi-chevron-right" style="font-size: 20px;"></i>
    </div>

    <div class="d-flex justify-content-between align-items-center bg-complementary rounded-4 p-4 mb-4">
      <div class="d-flex justify-content-start align-items-baseline">
        <a class="circle-button bg-accent text-white" href="<?=site_url('auth/logout')?>">
          <i class="bi bi-box-arrow-right"></i>
        </a>
        <h6 style="font-size: 18px;" class="ms-3 fw-bold">Cerrar sesión</h6>
      </div>
      <i class="bi bi-chevron-right" style="font-size: 20px;"></i>
    </div>
  </div>
</div>