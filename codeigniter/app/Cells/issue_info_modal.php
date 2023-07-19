<div class="modal fade" id="issueInfo" tabindex="-1" aria-labelledby="issueInfoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dominant rounded-5">
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

        <template x-if="!isLoading">
          <div>
            <img class="img-fluid rounded-top-5"
              src="https://wallpapers.com/images/featured/minimalist-7xpryajznty61ra3.jpg" alt="foo">
            <div class="p-3">
              Foo
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>
</div>