<?= $this->include('julio101290\boilerplate\Views\load\select2') ?>
<?= $this->include('julio101290\boilerplate\Views\load\datatables') ?>
<?= $this->include('julio101290\boilerplate\Views\load\nestable') ?>
<!-- Extend from layout index -->
<?= $this->extend('julio101290\boilerplate\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>

<?= $this->include('modulesSettingsrfc/modalCaptureSettingsrfc') ?>

<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
 <div class="card-header">
     <div class="float-right">
         <div class="btn-group">

             <button class="btn btn-primary btnAddSettingsrfc" data-toggle="modal" data-target="#modalAddSettingsrfc"><i class="fa fa-plus"></i>

                 <?= lang('settingsrfc.add') ?>

             </button>

         </div>
     </div>
 </div>
 <div class="card-body">
     <div class="row">
         <div class="col-md-12">
             <div class="table-responsive">
                 <table id="tableSettingsrfc" class="table table-striped table-hover va-middle tableSettingsrfc">
                     <thead>
                         <tr>

                             <th>#</th>
                             <th><?= lang('settingsrfc.fields.RFC') ?></th>
<th><?= lang('settingsrfc.fields.thirdParty') ?></th>
<th><?= lang('settingsrfc.fields.typeOperation') ?></th>
<th><?= lang('settingsrfc.fields.deleted_at') ?></th>
<th><?= lang('settingsrfc.fields.updated_at') ?></th>
<th><?= lang('settingsrfc.fields.created_at') ?></th>

                             <th><?= lang('settingsrfc.fields.actions') ?> </th>

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

 var tableSettingsrfc = $('#tableSettingsrfc').DataTable({
     processing: true,
     serverSide: true,
     responsive: true,
     autoWidth: false,
     order: [[1, 'asc']],

     ajax: {
         url: '<?= base_url(route_to('admin/settingsrfc')) ?>',
         method: 'GET',
         dataType: "json"
     },
     columnDefs: [{
             orderable: false,
             targets: [7],
             searchable: false,
             targets: [7]

         }],
     columns: [{
             'data': 'id'
         },
        
          
{
    'data': 'RFC'
},
 
{
    'data': 'thirdParty'
},
 
{
    'data': 'typeOperation'
},
 
{
    'data': 'deleted_at'
},
 
{
    'data': 'updated_at'
},
 
{
    'data': 'created_at'
},

         {
             "data": function (data) {
                 return `<td class="text-right py-0 align-middle">
                         <div class="btn-group btn-group-sm">
                             <button class="btn btn-warning btnEditSettingsrfc" data-toggle="modal" idSettingsrfc="${data.id}" data-target="#modalAddSettingsrfc">  <i class=" fa fa-edit"></i></button>
                             <button class="btn btn-danger btn-delete" data-id="${data.id}"><i class="fas fa-trash"></i></button>
                         </div>
                         </td>`
             }
         }
     ]
 });



 $(document).on('click', '#btnSaveSettingsrfc', function (e) {

     
var idSettingsrfc = $("#idSettingsrfc").val();
var RFC = $("#RFC").val();
var thirdParty = $("#thirdParty").val();
var typeOperation = $("#typeOperation").val();

     $("#btnSaveSettingsrfc").attr("disabled", true);

     var datos = new FormData();
datos.append("idSettingsrfc", idSettingsrfc);
datos.append("RFC", RFC);
datos.append("thirdParty", thirdParty);
datos.append("typeOperation", typeOperation);


     $.ajax({

         url: "<?= route_to('admin/settingsrfc/save') ?>",
         method: "POST",
         data: datos,
         cache: false,
         contentType: false,
         processData: false,
         success: function (respuesta) {
             if (respuesta.match(/Correctamente.*/)) {
        
                 Toast.fire({
                     icon: 'success',
                     title: "Guardado Correctamente"
                 });

                 tableSettingsrfc.ajax.reload();
                 $("#btnSaveSettingsrfc").removeAttr("disabled");


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



 /**
  * Carga datos actualizar
  */


 /*=============================================
  EDITAR Settingsrfc
  =============================================*/
 $(".tableSettingsrfc").on("click", ".btnEditSettingsrfc", function () {

     var idSettingsrfc = $(this).attr("idSettingsrfc");
        
     var datos = new FormData();
     datos.append("idSettingsrfc", idSettingsrfc);

     $.ajax({

         url: "<?= base_url(route_to('admin/settingsrfc/getSettingsrfc')) ?>",
         method: "POST",
         data: datos,
         cache: false,
         contentType: false,
         processData: false,
         dataType: "json",
         success: function (respuesta) {
             $("#idSettingsrfc").val(respuesta["id"]);
             
             $("#RFC").val(respuesta["RFC"]);
$("#thirdParty").val(respuesta["thirdParty"]);
$("#typeOperation").val(respuesta["typeOperation"]);


         }

     })

 })


 /*=============================================
  ELIMINAR settingsrfc
  =============================================*/
 $(".tableSettingsrfc").on("click", ".btn-delete", function () {

     var idSettingsrfc = $(this).attr("data-id");

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
                         url: `<?= base_url(route_to('admin/settingsrfc')) ?>/` + idSettingsrfc,
                         method: 'DELETE',
                     }).done((data, textStatus, jqXHR) => {
                         Toast.fire({
                             icon: 'success',
                             title: jqXHR.statusText,
                         });


                         tableSettingsrfc.ajax.reload();
                     }).fail((error) => {
                         Toast.fire({
                             icon: 'error',
                             title: error.responseJSON.messages.error,
                         });
                     })
                 }
             })
 })

 $(function () {
    $("#modalAddSettingsrfc").draggable();
    
});


</script>
<?= $this->endSection() ?>
        