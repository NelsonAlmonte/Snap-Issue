<div 
  class="modal fade" 
  id="editProfile" 
  tabindex="-1" 
  aria-labelledby="editProfileLabel" 
  aria-hidden="true"
  x-ref="editProfile"
>
  <div 
    class="modal-dialog modal-dialog-centered" 
    x-data="editProfile"
  >
    <div class="modal-content bg-light rounded-5 border-0">
      <div class="modal-body p-0">
        <div class="d-flex justify-content-between align-items-center p-4">
          <div class="modal-header-placeholder"></div>
          <h5 class="modal-title fw-bold">Edita tu perfil</h5>
          <button class="circle-button circle-button-sm text-white bg-translucent"
            @click="bootstrap.Modal.getInstance($refs.editProfile).hide()">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
        <div class="p-3">
          <div class="mb-4">
            <label class="fw-bold mb-2" for="name">Nombres</label>
            <div class="form-input-container bg-info">
              <input type="text" class="form-input bg-info" id="name" placeholder="Nombres" autocomplete="off" x-model="name">
            </div>
          </div>
          <div class="mb-4">
            <label class="fw-bold mb-2" for="last">Apellidos</label>
            <div class="form-input-container bg-info">
              <input type="text" class="form-input bg-info" id="last" placeholder="Apellidos" autocomplete="off" x-model="last">
            </div>
          </div>
          <div class="mb-4">
            <label class="fw-bold mb-2" for="password">Contraseña</label>
            <div class="form-input-container bg-info">
              <input type="password" class="form-input bg-info" id="password" placeholder="Contraseña" autocomplete="off" x-model="password">
            </div>
          </div>
          <div class="mb-4">
            <label class="fw-bold mb-2" for="confirmPassword">Confirmar contraseña</label>
            <div class="form-input-container bg-info">
              <input type="password" class="form-input bg-info" id="confirmPassword" placeholder="Confirmar contraseña" autocomplete="off" x-model="confirmPassword">
            </div>
          </div>
          <div 
            class="text-center"
            :class="(password === confirmPassword) ? 'd-none' : '' ;"
          >
            <small class="fw-bold">Ambas contraseñas deben ser iguales</small>
          </div>
          <button 
            class="btn btn-primary rounded-pill text-white fw-bold w-100 mt-4 py-3"
            :class="password !== confirmPassword ? 'disabled' : '' ;"
            type="button"
            @click="updateProfile"
          >Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>