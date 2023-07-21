<div
  class="modal fade" 
  id="issueInfo" 
  tabindex="-1" 
  aria-labelledby="issueInfoLabel" 
  aria-hidden="true"
  data-picture-path="<?=PATH_TO_VIEW_UPLOAD_PICTURE?>"
  data-profile-image-path="<?=PATH_TO_VIEW_PROFILE_IMAGE?>"
  x-ref="issueModal"
>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dominant rounded-5 border-0">
      <div class="modal-body p-0">
        <template x-if="isLoading">
          <div class="d-flex justify-content-center py-4">
            <div class="text-center">
              <div class="spinner-grow text-accent" role="status" style="width: 5rem; height: 5rem;">
                <span class="visually-hidden">Loading...</span>
              </div>
              <h5 class="fw-bold">Cargando incidencia...</h5>
            </div>
          </div>
        </template>

        <div x-show="!isLoading">
          <div class="d-flex justify-content-between align-items-center position-absolute start-0 end-0 m-3">
            <button
              class="circle-button text-white bg-transparent"
              @click="bootstrap.Modal.getInstance($refs.issueModal).hide()"
            >
              <i class="bi bi-x-lg"></i>
            </button>
            <a 
              class="circle-button text-white bg-transparent glightbox"
              :href="issue.pictureFullPath"
            >
              <i class="bi bi-fullscreen"></i>
            </a>
          </div>
          <img class="img-fluid rounded-top-5"
            :src="issue.pictureFullPath" alt="foo">
          <div class="p-4">
            <h3 class="fw-bold mb-3" x-text="issue.category_name"></h3>
            <span class="fw-medium text-secondary" x-text="issue.address"></span>
            <div class="d-flex justify-content-start align-items-center mt-4">
              <img style="width: 50px; height: 50px" class="rounded-circle" :src="reporter.profileImage" alt="foo">
              <div class="row ms-1">
                <span class="fw-bold" x-text="reporter.fullName"></span>
                <span class="fw-medium small text-secondary" x-text="issue.relativeDate"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>