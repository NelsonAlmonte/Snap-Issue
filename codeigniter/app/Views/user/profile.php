<div class="container-fluid">
  <div class="text-center mt-5">
    <img style="width: 160px; height: 160px" class="rounded-circle border border-4 border-white object-fit-cover"
      src="<?=PATH_TO_VIEW_PROFILE_IMAGE . $user['image']?>" alt="profile image">
    <h3 class="fw-bold mt-2"><?=$user['name'] . ' ' . $user['last']?></h3>
    <h5 class="text-secondary mt-2"><?=$user['username']?></h5>
  </div>
  <div 
    class="mt-5"
    x-data
  >
    <div 
      class="d-flex justify-content-between align-items-center bg-complementary rounded-4 p-4 mb-4"
      @click="bootstrap.Modal.getOrCreateInstance($refs.editProfile).show()"
    >
      <div class="d-flex justify-content-start align-items-baseline">
        <span class="circle-button bg-accent text-white">
          <i class="bi bi-person"></i>
        </span>
        <h6 style="font-size: 18px;" class="ms-3 fw-bold">Editar perfil</h6>
      </div>
      <i class="bi bi-chevron-right" style="font-size: 20px;"></i>
    </div>

    <div 
      class="d-flex justify-content-between align-items-center bg-complementary rounded-4 p-4 mb-4"
      @click="window.location.replace('/onboarding');"
    >
      <div class="d-flex justify-content-start align-items-baseline">
        <span class="circle-button bg-accent text-white">
          <i class="bi bi-gear"></i>
        </span>
        <h6 style="font-size: 18px;" class="ms-3 fw-bold">Onboarding</h6>
      </div>
      <i class="bi bi-chevron-right" style="font-size: 20px;"></i>
    </div>

    <div 
      class="d-flex justify-content-between align-items-center bg-complementary rounded-4 p-4 mb-4"
      @click="window.location.replace('/auth/logout');"
    >
      <div class="d-flex justify-content-start align-items-baseline">
        <span class="circle-button bg-accent text-white">
          <i class="bi bi-box-arrow-right"></i>
        </span>
        <h6 style="font-size: 18px;" class="ms-3 fw-bold">Cerrar sesión</h6>
      </div>
      <i class="bi bi-chevron-right" style="font-size: 20px;"></i>
    </div>
    <?=view_cell('EditProfileModal::render')?>
    <input class="csrf" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
  </div>
</div>