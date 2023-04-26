<!-- Modal Diot -->
  <div class="modal fade" id="modalAddDiot" tabindex="-1" role="dialog" aria-labelledby="modalAddDiot" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title"><?= lang('diot.createEdit') ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form id="form-diot" class="form-horizontal">
                      <input type="hidden" id="idDiot" name="idDiot" value="0">

                      <div class="form-group row">
    <label for="period" class="col-sm-2 col-form-label"><?= lang('diot.fields.period') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="period" id="period" class="form-control <?= session('error.period') ? 'is-invalid' : '' ?>" value="<?= old('period') ?>" placeholder="<?= lang('diot.fields.period') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="RFC" class="col-sm-2 col-form-label"><?= lang('diot.fields.RFC') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="RFC" id="RFC" class="form-control <?= session('error.RFC') ? 'is-invalid' : '' ?>" value="<?= old('RFC') ?>" placeholder="<?= lang('diot.fields.RFC') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="beneficiary" class="col-sm-2 col-form-label"><?= lang('diot.fields.beneficiary') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="beneficiary" id="beneficiary" class="form-control <?= session('error.beneficiary') ? 'is-invalid' : '' ?>" value="<?= old('beneficiary') ?>" placeholder="<?= lang('diot.fields.beneficiary') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="base16" class="col-sm-2 col-form-label"><?= lang('diot.fields.base16') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="base16" id="base16" class="form-control <?= session('error.base16') ? 'is-invalid' : '' ?>" value="<?= old('base16') ?>" placeholder="<?= lang('diot.fields.base16') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="IVA16" class="col-sm-2 col-form-label"><?= lang('diot.fields.IVA16') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="IVA16" id="IVA16" class="form-control <?= session('error.IVA16') ? 'is-invalid' : '' ?>" value="<?= old('IVA16') ?>" placeholder="<?= lang('diot.fields.IVA16') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="rate0" class="col-sm-2 col-form-label"><?= lang('diot.fields.rate0') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="rate0" id="rate0" class="form-control <?= session('error.rate0') ? 'is-invalid' : '' ?>" value="<?= old('rate0') ?>" placeholder="<?= lang('diot.fields.rate0') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="total" class="col-sm-2 col-form-label"><?= lang('diot.fields.total') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="total" id="total" class="form-control <?= session('error.total') ? 'is-invalid' : '' ?>" value="<?= old('total') ?>" placeholder="<?= lang('diot.fields.total') ?>" autocomplete="off">
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="uuidFile" class="col-sm-2 col-form-label"><?= lang('diot.fields.uuidFile') ?></label>
    <div class="col-sm-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
            </div>
            <input type="text" name="uuidFile" id="uuidFile" class="form-control <?= session('error.uuidFile') ? 'is-invalid' : '' ?>" value="<?= old('uuidFile') ?>" placeholder="<?= lang('diot.fields.uuidFile') ?>" autocomplete="off">
        </div>
    </div>
</div>

        
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?= lang('boilerplate.global.close') ?></button>
                  <button type="button" class="btn btn-primary btn-sm" id="btnSaveDiot"><?= lang('boilerplate.global.save') ?></button>
              </div>
          </div>
      </div>
  </div>

  <?= $this->section('js') ?>


  <script>

      $(document).on('click', '.btnAddDiot', function (e) {


          $(".form-control").val("");

          $("#idDiot").val("0");

          $("#btnSaveDiot").removeAttr("disabled");

      });

      /* 
       * AL hacer click al editar
       */



      $(document).on('click', '.btnEditDiot', function (e) {


          var idDiot = $(this).attr("idDiot");

          //LIMPIAMOS CONTROLES
          $(".form-control").val("");

          $("#idDiot").val(idDiot);
          $("#btnGuardarDiot").removeAttr("disabled");

      });




  </script>


  <?= $this->endSection() ?>
        