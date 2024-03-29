<nav class="navbar fixed-bottom bg-info rounded-pill py-3 mx-3 mb-4 z-3 animate__animated animate__fast"
  id="bottom-navbar" x-data="bottomNavbar">
  <div class="container-fluid d-flex justify-content-around align-items-center">
    <?php foreach($links as $link): ?>
    <a class="circle-button bg-primary text-white <?=$link['isActive']? 'active' : 'opacity-50' ;?>"
      href="<?=site_url($link['url'])?>">
      <i class="bi <?=$link['icon']?>"></i>
    </a>
    <?php endforeach; ?>
  </div>
</nav>