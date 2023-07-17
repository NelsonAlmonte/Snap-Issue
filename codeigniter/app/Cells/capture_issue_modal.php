<div 
  class="modal fade" 
  id="issueModal" 
  tabindex="-1" 
  aria-labelledby="issueModalLabel" 
  aria-hidden="true"
  x-data="handleIssue"
  @issue.window="picture = $event.detail.picture; location = $event.detail.location"
  x-ref="issueModal"
>
  <div class="modal-dialog modal-dialog-centered modal-fullscreen">
    <div class="modal-content bg-dominant border-0">
      <div class="modal-body">
        <div 
          x-show.important="step === 0"
          x-transition:enter="animate__animated animate__fadeIn animate__fast"
        >
          <div class="text-center mb-2">
            <h1 class="fw-bold lh-lg">Fotografía de la incidencia</h1>
          </div>
          <img class="picture rounded-2" :src="picture">
          <div class="d-flex justify-content-center align-content-center w-100">
            <button 
              class="btn rounded-pill bg-accent text-white fw-bold w-100 mt-4 me-2 py-3" 
              type="button"
              data-bs-dismiss="modal" 
              aria-label="Close"
            >Retomar</button>
            <button 
              class="btn rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3" 
              type="button"
              @click="
                step ++
                getCategories()
              "                
            >Continuar</button>
          </div>
        </div>
        <div 
          x-show.important="step === 1"
          x-transition:enter="animate__animated animate__fadeIn animate__fast"
        >
          <div class="text-center mb-2">
            <h1 class="fw-bold lh-lg">Tipo de incidencia</h1>
          </div>
          <img class="img-fluid h-auto rounded-2 mb-4" :src="picture">
          <div class="row g-4">
            <template x-if="!categories.length">
              <div class="d-flex justify-content-center">
                <div class="text-center">
                  <div class="spinner-grow text-accent" role="status" style="width: 5rem; height: 5rem;">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                  <h5 class="fw-bold">Cargando categorias...</h5>
                </div>
              </div>
            </template>
            <template x-for="category in categories" :key="category.id">
              <div class="col-6" x-id="['text-input']">
                <label 
                  class="category d-flex flex-column justify-content-center bg-complementary w-100 h-100 rounded-5 text-center" 
                  @click="categoryId = category.id" 
                  :for="$id('text-input')"
                >
                  <input 
                    class="btn-check" 
                    type="radio" 
                    name="btnradio" 
                    autocomplete="off" 
                    :id="$id('text-input')" 
                    @click.stop
                  >
                  <div class="selected h-100 w-100 rounded-5 p-4">
                    <i :class="category.icon" style="font-size: 30px;"></i>
                    <div class="fs-6 fw-medium" x-text="category.name"></div>
                  </div>
                </label>
              </div>
            </template>
          </div>
          <div class="d-flex justify-content-center align-content-center w-100">
            <button 
              class="btn action-button rounded-pill bg-accent text-white fw-bold w-100 mt-4 me-2 py-3" 
              type="button"
              @click="step --"
            >Regresar</button>
            <button 
              class="btn action-button rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3"
              :class="categoryId === '' ? 'disabled' : ''"
              type="button"
              @click="saveIssue"                
            >Enviar</button>
          </div>
        </div>
        <div 
          class="d-flex flex-wrap flex-column justify-content-around align-items-center mx-auto"
          style="height: 95dvh" 
          x-show.important="step === 2"
          x-transition:enter="animate__animated animate__fadeIn animate__fast"
        >
          <div class="text-center">
            <h1 class="fw-bold lh-lg">Su reporte <br>ha sido enviado!</h1>
            <h4 class="text-secondary lh-base">Su reporte ha sido recibido y esta siendo procesado por las autoridades de su comunidad.</h4>
          </div>
          <img class="img-fluid" src="<?=PATH_TO_VIEW_ASSETS_ONBOARDING?>ready.svg" alt="ready">
          <button class="btn rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3" type="button"
            @click="closeModal">Continuar</button>
        </div>
        <div 
          class="d-flex flex-wrap flex-column justify-content-around align-items-center mx-auto"
          style="height: 95dvh" 
          x-show.important="step === 3"
          x-transition:enter="animate__animated animate__fadeIn animate__fast"
        >
          <div class="text-center">
            <h1 class="fw-bold lh-lg">Uh oh <br>Algo ha salido mal!</h1>
            <h4 class="text-secondary lh-base">Algo ha salido mal al enviar el reporte, actualiza o cierra y abre la app nuevamente.</h4>
          </div>
          <img class="img-fluid" src="<?=PATH_TO_VIEW_ASSETS_SYSTEM?>error.svg" alt="error">
          <button class="btn rounded-pill bg-accent text-white fw-bold w-100 mt-4 py-3" type="button"
            @click="document.location.reload()">Continuar</button>
        </div>
      </div>
    </div>
  </div>
</div>