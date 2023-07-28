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
    <div class="modal-content bg-light rounded-5 border-0">
      <div class="modal-body p-0">
        <template x-if="isLoading">
          <div class="d-flex justify-content-center py-4">
            <div class="text-center">
              <div class="spinner-grow text-primary mb-4" role="status" style="width: 5rem; height: 5rem;">
                <span class="visually-hidden">Loading...</span>
              </div>
              <h5 class="fw-bold">Cargando incidencia...</h5>
            </div>
          </div>
        </template>

        <div x-show="!isLoading">
          <div class="d-flex justify-content-between align-items-center position-absolute start-0 end-0 m-3">
            <a 
              class="circle-button text-white bg-translucent glightbox"
              :href="issue.pictureFullPath"
            >
              <i class="bi bi-fullscreen"></i>
            </a>
            <button
              class="circle-button text-white bg-translucent"
              @click="bootstrap.Modal.getInstance($refs.issueModal).hide()"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
          <div class="issue-info-image-wrapper">
            <div :style="`background-image: url('${issue.pictureFullPath}')`" class="issue-info-image cover"></div>
          </div>
          <div class="p-4">
            <h3 class="fw-bold mb-3" x-text="issue.category_name"></h3>
            <div class="d-flex justify-content-start align-items-center mt-4">
              <img class="issue-info-user-image rounded-circle" :src="reporter.profileImage" alt="foo">
              <div class="row ms-1">
                <span class="fw-bold" x-text="reporter.fullName"></span>
                <span class="fw-medium small text-black-50" x-text="issue.relativeDate"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>