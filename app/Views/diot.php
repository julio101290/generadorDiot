<?= $this->include('julio101290\boilerplate\Views\load\select2') ?>
<?= $this->include('julio101290\boilerplate\Views\load\datatables') ?>
<?= $this->include('julio101290\boilerplate\Views\load\nestable') ?>
<!-- Extend from layout index -->
<?= $this->extend('julio101290\boilerplate\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>

<?= $this->include('modulesDiot/modalCaptureDiot') ?>
<?= $this->include('modulesDiot/modalUpLoadXLS') ?>


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

                <button class="btn btn-primary btnUpXLS" data-toggle="modal" data-target="#modalXLS"><i class="fa fa-plus"></i>

                    <?= lang('diot.addXLS') ?>

                </button>

            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="tableDiot" class="table table-striped table-hover va-middle tableDiot">
                        <thead>
                            <tr>

                                <th>#</th>
                                <th><?= lang('diot.fields.period') ?></th>
                                <th><?= lang('diot.fields.RFC') ?></th>
                                <th><?= lang('diot.fields.beneficiary') ?></th>
                                <th><?= lang('diot.fields.base16') ?></th>
                                <th><?= lang('diot.fields.IVA16') ?></th>
                                <th><?= lang('diot.fields.rate0') ?></th>
                                <th><?= lang('diot.fields.total') ?></th>
                                <th><?= lang('diot.fields.created_at') ?></th>
                                <th><?= lang('diot.fields.updated_at') ?></th>
                                <th><?= lang('diot.fields.deleted_at') ?></th>
                                <th><?= lang('diot.fields.uuidFile') ?></th>

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

    var tableDiot = $('#tableDiot').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        order: [
            [1, 'asc']
        ],

        ajax: {
            url: '<?= base_url(route_to('admin/diot')) ?>',
            method: 'GET',
            dataType: "json"
        },
        columnDefs: [{
            orderable: false,
            targets: [12],
            searchable: false,
            targets: [12]

        }],
        columns: [{
                'data': 'id'
            },


            {
                'data': 'period'
            },

            {
                'data': 'RFC'
            },

            {
                'data': 'beneficiary'
            },

            {
                'data': 'base16'
            },

            {
                'data': 'IVA16'
            },

            {
                'data': 'rate0'
            },

            {
                'data': 'total'
            },

            {
                'data': 'created_at'
            },

            {
                'data': 'updated_at'
            },

            {
                'data': 'deleted_at'
            },

            {
                'data': 'uuidFile'
            },

            {
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                         <div class="btn-group btn-group-sm">
                             <button class="btn btn-warning btnEditDiot" data-toggle="modal" idDiot="${data.id}" data-target="#modalAddDiot">  <i class=" fa fa-edit"></i></button>
                             <button class="btn btn-danger btn-delete" data-id="${data.id}"><i class="fas fa-trash"></i></button>
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

                url: "<?= route_to('admin/diot/save') ?>",
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


        $("#btnSaveDiot").attr("disabled", true);

        var datos = new FormData();
        datos.append("period", period);
        datos.append("fileXLS", fileXLS);



        $.ajax({

                url: "<?= route_to('admin/diot/saveXLS') ?>",
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



    /**
     * Carga datos actualizar
     */


    /*=============================================
     EDITAR Diot
     =============================================*/
    $(".tableDiot").on("click", ".btnEditDiot", function() {

        var idDiot = $(this).attr("idDiot");

        var datos = new FormData();
        datos.append("idDiot", idDiot);

        $.ajax({

            url: "<?= base_url(route_to('admin/diot/getDiot')) ?>",
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
    $(".tableDiot").on("click", ".btn-deleteUUID", function() {

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
                        url: "<?= base_url(route_to('admin/diot/deleteDiotUUID')) ?>",
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
    $(".tableDiot").on("click", ".btn-delete", function() {

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
                        url: `<?= base_url(route_to('admin/diot')) ?>/` + idDiot,
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
</script>
<?= $this->endSection() ?>