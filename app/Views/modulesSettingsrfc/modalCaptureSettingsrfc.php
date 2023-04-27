<!-- Modal Settingsrfc -->
<div class="modal fade" id="modalAddSettingsrfc" tabindex="-1" role="dialog" aria-labelledby="modalAddSettingsrfc" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= lang('settingsrfc.createEdit') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-settingsrfc" class="form-horizontal">
                    <input type="hidden" id="idSettingsrfc" name="idSettingsrfc" value="0">

                    <div class="form-group row">
                        <label for="RFC" class="col-sm-2 col-form-label"><?= lang('settingsrfc.fields.RFC') ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                                <input type="text" name="RFC" id="RFC" class="form-control <?= session('error.RFC') ? 'is-invalid' : '' ?>" value="<?= old('RFC') ?>" placeholder="<?= lang('settingsrfc.fields.RFC') ?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="thirdParty" class="col-sm-2 col-form-label"><?= lang('settingsrfc.fields.thirdParty') ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                                <input type="text" name="thirdParty" id="thirdParty" class="form-control <?= session('error.thirdParty') ? 'is-invalid' : '' ?>" value="<?= old('thirdParty') ?>" placeholder="<?= lang('settingsrfc.fields.thirdParty') ?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="typeOperation" class="col-sm-2 col-form-label"><?= lang('settingsrfc.fields.typeOperation') ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                                <select type="text" name="typeOperation" id="typeOperation" class="form-control <?= session('error.typeOperation') ? 'is-invalid' : '' ?>" value="<?= old('typeOperation') ?>" placeholder="<?= lang('settingsrfc.fields.typeOperation') ?>" autocomplete="off">
                               <option value="04" >Nacional </option> 
                               <option value="15" >Global </option> 
                               <option value="05" >Extranjero </option> 
                            </select>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?= lang('boilerplate.global.close') ?></button>
                <button type="button" class="btn btn-primary btn-sm" id="btnSaveSettingsrfc"><?= lang('boilerplate.global.save') ?></button>
            </div>
        </div>
    </div>
</div>

<?= $this->section('js') ?>


<script>
    $(document).on('click', '.btnAddSettingsrfc', function(e) {


        $(".form-control").val("");

        $("#idSettingsrfc").val("0");

        $("#btnSaveSettingsrfc").removeAttr("disabled");

    });

    /* 
     * AL hacer click al editar
     */



    $(document).on('click', '.btnEditSettingsrfc', function(e) {


        var idSettingsrfc = $(this).attr("idSettingsrfc");

        //LIMPIAMOS CONTROLES
        $(".form-control").val("");

        $("#idSettingsrfc").val(idSettingsrfc);
        $("#btnGuardarSettingsrfc").removeAttr("disabled");

    });
</script>


<?= $this->endSection() ?>