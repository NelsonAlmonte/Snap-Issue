<div 
  style="height: 100dvh"
  x-data="initMap"
>
  <div class="rounded-bottom-5 z-2" id="map" style="height: 85dvh; width: 100vw"></div>
  <?=view_cell('IssueInfoModal::render')?>
</div>
<input class="csrf" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
