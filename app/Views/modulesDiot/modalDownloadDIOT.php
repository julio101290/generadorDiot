<!-- Modal Diot -->
<div class="modal fade" id="modalDownloadDIOT" tabindex="-1" role="dialog" aria-labelledby="modalXLS" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Descarga DIOT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-diotXLS" class="form-horizontal">
                    <input type="hidden" id="idDiot" name="idDiot" value="0">

                    <div class="form-group row">
                        <label for="period" class="col-sm-2 col-form-label"><?= lang('diot.fields.period') ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                                <input type="text" name="periodDownload" id="periodDownload" class="form-control <?= session('error.period') ? 'is-invalid' : '' ?>" value="<?= old('period') ?>" placeholder="<?= lang('diot.fields.period') ?>" autocomplete="off">
                            </div>
                        </div>
                    </div>



                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?= lang('boilerplate.global.close') ?></button>
                <button type="button" class="btn btn-primary btn-sm" id="btnSaveDiotTXT"><?= lang('boilerplate.global.save') ?></button>
            </div>
        </div>
    </div>
</div>

<?= $this->section('js') ?>


<script>
    $(document).on('click', '.btnAddDiot', function(e) {


        $(".form-control").val("");

        $("#idDiot").val("0");

        $("#btnSaveDiot").removeAttr("disabled");

    });

    /* 
     * AL hacer click al editar
     */



    $(document).on('click', '.btnEditDiot', function(e) {


        var idDiot = $(this).attr("idDiot");

        //LIMPIAMOS CONTROLES
        $(".form-control").val("");

        $("#idDiot").val(idDiot);
        $("#btnGuardarDiot").removeAttr("disabled");

    });
</script>


<?= $this->endSection() ?>