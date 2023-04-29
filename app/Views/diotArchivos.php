<?= $this->include('julio101290\boilerplate\Views\load\select2') ?>
<?= $this->include('julio101290\boilerplate\Views\load\datatables') ?>
<?= $this->include('julio101290\boilerplate\Views\load\nestable') ?>
<!-- Extend from layout index -->
<?= $this->extend('julio101290\boilerplate\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>

<?= $this->include('modulesDiot/modalCaptureDiot') ?>
<?= $this->include('modulesDiot/modalUpLoadXLS') ?>
<?= $this->include('modulesDiot/modalDownloadDIOT') ?>
<?= $this->include('modulesSettingsrfc/modalCaptureSettingsrfcDIOT') ?>

<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
    <div class="card-header">
        <div class="float-right">
            <div class="btn-group">

                <button class="btn btn-primary btnAddDiot" data-toggle="modal" data-target="#modalAddDiot"><i class="fa fa-plus"></i>

                    <?= lang('diot.add') ?>

                </button>

            </div>


            <div class="btn-group">

                <button class="btn btn-primary btnUpXLS" data-toggle="modal" data-target="#modalXLS"><i class="fa fa-upload"></i>

                    <?= lang('diot.addXLS') ?>

                </button>

            </div>


            <div class="btn-group">

                <button class="btn btn-primary btnDownloadDIOT" data-toggle="modal" data-target="#modalDownloadDIOT"><i class="fa fa-download"></i>

                    <?= lang('diot.download') ?>

                </button>

            </div>

            <div class="btn-group">

                <a class="btn btn-primary " href="/layout.xls" download="layout.xls"><i class="fa fa-download"></i>

                    Descargar Layout XLS

                </a>

            </div>

            <div class="btn-group">

                <a class="btn btn-primary " href="<?= base_url('admin/diot') ?>"><i class="fa fa-list"></i>

                    Lista Detallada por RFC

                </a>

            </div>

        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="tableDiotArchivo" class="table table-striped table-hover va-middle tableDiotArchivo">
                        <thead>
                            <tr>


                                <th><?= lang('diot.fields.uuidFile') ?></th>

                                <th><?= lang('diot.fields.period') ?></th>

                                <th>Archivo</th>

                                <th><?= lang('diot.fields.actions') ?> </th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->

<?= $this->endSection() ?>


<?= $this->section('js') ?>
<script>
    /**
     * Cargamos la tabla
     */

    var tableDiot = $('#tableDiotArchivo').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        order: [
            [1, 'asc']
        ],

        ajax: {
            url: '<?= base_url('admin/diot/diotArchivo') ?>',
            method: 'GET',
            dataType: "json"
        },
        columnDefs: [{
            orderable: false,
            targets: [3],
            searchable: false,
            targets: [3]

        }],
        columns: [

            {
                'data': 'uuidFile'
            },
            {
                'data': 'period'
            },

            {
                'data': 'nameFile'
            },

            {
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                         <div class="btn-group btn-group-sm">
                       
                             <button class="btn btn-danger btn-deleteUUID" uuid="${data.uuidFile}"><i class="fas fa-file-excel"></i></button>
                            
                         </div>
                         </td>`
                }
            }
        ]
    });






    $(document).on('click', '#btnSaveDiot', function(e) {


        var idDiot = $("#idDiot").val();
        var period = $("#period").val();
        var RFC = $("#RFC").val();
        var beneficiary = $("#beneficiary").val();
        var base16 = $("#base16").val();
        var IVA16 = $("#IVA16").val();
        var rate0 = $("#rate0").val();
        var total = $("#total").val();
        var uuidFile = $("#uuidFile").val();

        $("#btnSaveDiot").attr("disabled", true);

        var datos = new FormData();
        datos.append("idDiot", idDiot);
        datos.append("period", period);
        datos.append("RFC", RFC);
        datos.append("beneficiary", beneficiary);
        datos.append("base16", base16);
        datos.append("IVA16", IVA16);
        datos.append("rate0", rate0);
        datos.append("total", total);
        datos.append("uuidFile", uuidFile);


        $.ajax({

                url: "<?= base_url('admin/diot/save') ?>",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta) {
                    if (respuesta.match(/Correctamente.*/)) {

                        Toast.fire({
                            icon: 'success',
                            title: "Guardado Correctamente"
                        });

                        tableDiot.ajax.reload();
                        $("#btnSaveDiot").removeAttr("disabled");


                        $('#modalAddDiot').modal('hide');
                    } else {

                        Toast.fire({
                            icon: 'error',
                            title: respuesta
                        });

                        $("#btnSaveDiot").removeAttr("disabled");


                    }

                }

            }

        )

    });


    /**@abstract
     * 
     * 
     * UPLOAD XMLS
     * 
     */
    $(document).on('click', '#btnSaveDiotXLS', function(e) {


        var period = $("#periodXLS").val();
        var fileXLS = $("#fileXLS").prop("files")[0];


        $("#btnSaveDiotXLS").attr("disabled", true);

        var datos = new FormData();
        datos.append("period", period);
        datos.append("fileXLS", fileXLS);



        $.ajax({

                url: "<?= base_url('admin/diot/saveXLS') ?>",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta) {
                    if (respuesta.match(/Correctamente.*/)) {

                        Toast.fire({
                            icon: 'success',
                            title: "Guardado Correctamente"
                        });

                        tableDiot.ajax.reload();
                        $("#btnSaveDiotXLS").removeAttr("disabled");


                        $('#modalXLS').modal('hide');
                    } else {

                        Toast.fire({
                            icon: 'error',
                            title: respuesta
                        });

                        $("#btnSaveDiotXLS").removeAttr("disabled");


                    }

                }

            }

        )

    });






    /**@abstract
     * 
     * 
     * UPLOAD XMLS
     * 
     */
    $(document).on('click', '#btnSaveDiotTXT', function(e) {


        var period = $("#periodDownload").val();

        window.open("<?= base_url('admin/generaDIOT/') ?>" + period, "_blank");


    });



    /**
     * Carga datos actualizar
     */


    /*=============================================
     EDITAR Diot
     =============================================*/
    $(".tableDiotArchivo").on("click", ".btnEditDiot", function() {

        var idDiot = $(this).attr("idDiot");

        var datos = new FormData();
        datos.append("idDiot", idDiot);

        $.ajax({

            url: "<?= base_url('admin/diot/getDiot') ?>",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {
                $("#idDiot").val(respuesta["id"]);

                $("#period").val(respuesta["period"]);
                $("#RFC").val(respuesta["RFC"]);
                $("#beneficiary").val(respuesta["beneficiary"]);
                $("#base16").val(respuesta["base16"]);
                $("#IVA16").val(respuesta["IVA16"]);
                $("#rate0").val(respuesta["rate0"]);
                $("#total").val(respuesta["total"]);
                $("#uuidFile").val(respuesta["uuidFile"]);


            }

        })

    })


    /*=============================================
     ELIMINAR TODO EL ARCHIVO
     =============================================*/
    $(".tableDiotArchivo").on("click", ".btn-deleteUUID", function() {

        var uuid = $(this).attr("uuid");

        var datos = new FormData();
        datos.append("uuid", uuid);


        Swal.fire({
                title: '<?= lang('boilerplate.global.sweet.title') ?>',
                text: "<?= lang('boilerplate.global.sweet.text') ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?= lang('boilerplate.global.sweet.confirm_delete') ?>'
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?= base_url('admin/diot/deleteDiotUUID') ?>",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,


                    }).done((data, textStatus, jqXHR) => {
                        Toast.fire({
                            icon: 'success',
                            title: jqXHR.statusText,
                        });


                        tableDiot.ajax.reload();
                    }).fail((error) => {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.messages.error,
                        });
                    })
                }
            })



    })


    /*=============================================
     ELIMINAR diot
     =============================================*/
    $(".tableDiotArchivo").on("click", ".btn-delete", function() {

        var idDiot = $(this).attr("data-id");

        Swal.fire({
                title: '<?= lang('boilerplate.global.sweet.title') ?>',
                text: "<?= lang('boilerplate.global.sweet.text') ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?= lang('boilerplate.global.sweet.confirm_delete') ?>'
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: `<?= base_url('admin/diot') ?>/` + idDiot,
                        method: 'DELETE',
                    }).done((data, textStatus, jqXHR) => {
                        Toast.fire({
                            icon: 'success',
                            title: jqXHR.statusText,
                        });


                        tableDiot.ajax.reload();
                    }).fail((error) => {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.messages.error,
                        });
                    })
                }
            })
    })

    $(function() {
        $("#modalAddDiot").draggable();

    });





    $(document).on('click', '#btnSaveSettingsrfc', function(e) {


        var idSettingsrfc = $("#idSettingsrfc").val();
        var RFC = $("#RFCSettings").val();
        var thirdParty = $("#thirdParty").val();
        var typeOperation = $("#typeOperation").val();

        $("#btnSaveSettingsrfc").attr("disabled", true);

        var datos = new FormData();
        datos.append("idSettingsrfc", idSettingsrfc);
        datos.append("RFC", RFC);
        datos.append("thirdParty", thirdParty);
        datos.append("typeOperation", typeOperation);


        $.ajax({

                url: "<?= base_url('admin/settingsrfc/save') ?>",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta) {
                    if (respuesta.match(/Correctamente.*/)) {

                        Toast.fire({
                            icon: 'success',
                            title: "Guardado Correctamente"
                        });


                        $("#btnSaveSettingsrfc").removeAttr("disabled");

                        tableDiot.ajax.reload();

                        $('#modalAddSettingsrfc').modal('hide');
                    } else {

                        Toast.fire({
                            icon: 'error',
                            title: respuesta
                        });

                        $("#btnSaveSettingsrfc").removeAttr("disabled");


                    }

                }

            }

        )




    });


    /*=============================================
      EDITAR Settingsrfc
      =============================================*/
    $(".tableDiotArchivo").on("click", ".btnEditSettingsrfc", function() {

        var idSettingsrfc = $(this).attr("idSettingsrfc");
        var rfc = $(this).attr("rfc");
        var datos = new FormData();
        datos.append("idSettingsrfc", idSettingsrfc);

        $.ajax({

            url: "<?= base_url('admin/settingsrfc/getSettingsrfc') ?>",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {

                if (respuesta != null) {
                    $("#idSettingsrfc").val(respuesta["id"]);

                    $("#RFCSettings").val(rfc);
                    $("#thirdParty").val(respuesta["thirdParty"]);
                    $("#typeOperation").val(respuesta["typeOperation"]);
                } else {
                    $("#idSettingsrfc").val("0");
                    $("#RFCSettings").val(rfc);

                }



            }

        })



    })
</script>
<?= $this->endSection() ?>