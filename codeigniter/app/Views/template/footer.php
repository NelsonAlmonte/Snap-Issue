<nav 
  class="navbar fixed-bottom bg-complementary rounded-pill py-3 mx-4 mb-4 animate__animated" 
  x-data="bottomNavbar"
  x-show="isShown"
  x-transition:enter="animate__slideInUp animate__fast"
  x-transition:leave="animate__slideOutDown animate__fast"
>
  <div class="container-fluid d-flex justify-content-around align-items-center">
    <a class="circle-button bg-accent text-white active" href="#" @click="isShown = !isShown">
      <i class="bi bi-map-fill"></i>
    </a>
    <a class="circle-button bg-accent text-white opacity-75" href="#">
      <i class="bi bi-camera-fill"></i>
    </a>
    <a class="circle-button bg-accent text-white opacity-75" href="<?=site_url('onboarding')?>">
      <i class="bi bi-gear-fill"></i>
    </a>
  </div>
</nav>

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>
<!-- <script src="/assets/js/app.js"></script> -->
<script src="/assets/js/components.js"></script>
</body>

</html>