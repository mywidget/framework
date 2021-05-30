<div class="container">
  <div class="row">
    <?php foreach($aakm as $aak) { ?>
    <div class="col m12 s12">
      <div class="card rounded preload-any">
        <div class="card-content ">
          <span class="card-title">[<?=$aak->code?>] <?=$aak->name?></span>
          <p><small><?=$aak->cdate?></small></p>
          <p><?=$aak->name.' ID: '.$aak->id?></p>
          <br>
          <div class="btn-group">
            &nbsp;
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
