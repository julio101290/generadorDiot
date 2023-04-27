<?php
 namespace App\Controllers;
 use App\Controllers\BaseController;
 use \App\Models\{SettingsrfcModel};
 use App\Models\LogModel;
 use CodeIgniter\API\ResponseTrait;
 class SettingsrfcController extends BaseController {
     use ResponseTrait;
     protected $log;
     protected $settingsrfc;
     public function __construct() {
         $this->settingsrfc = new SettingsrfcModel();
         $this->log = new LogModel();
         helper('menu');
     }
     public function index() {
         if ($this->request->isAJAX()) {
             $datos = $this->settingsrfc->select('id,RFC,thirdParty,typeOperation,deleted_at,updated_at,created_at')->where('deleted_at', null);
             return \Hermawan\DataTables\DataTable::of($datos)->toJson(true);
         }
         $titulos["title"] = lang('settingsrfc.title');
         $titulos["subtitle"] = lang('settingsrfc.subtitle');
         return view('settingsrfc', $titulos);
     }
     /**
      * Read Settingsrfc
      */
     public function getSettingsrfc() {
         $idSettingsrfc = $this->request->getPost("idSettingsrfc");
         $datosSettingsrfc = $this->settingsrfc->find($idSettingsrfc);
         echo json_encode($datosSettingsrfc);
     }
     /**
      * Save or update Settingsrfc
      */
     public function save() {
         helper('auth');
         $userName = user()->username;
         $idUser = user()->id;
         $datos = $this->request->getPost();
         if ($datos["idSettingsrfc"] == 0) {
             try {
                 if ($this->settingsrfc->save($datos) === false) {
                     $errores = $this->settingsrfc->errors();
                     foreach ($errores as $field => $error) {
                         echo $error . " ";
                     }
                     return;
                 }
                 $dateLog["description"] = lang("vehicles.logDescription") . json_encode($datos);
                 $dateLog["user"] = $userName;
                 $this->log->save($dateLog);
                 echo "Guardado Correctamente";
             } catch (\PHPUnit\Framework\Exception $ex) {
                 echo "Error al guardar " . $ex->getMessage();
             }
         } else {
             if ($this->settingsrfc->update($datos["idSettingsrfc"], $datos) == false) {
                 $errores = $this->settingsrfc->errors();
                 foreach ($errores as $field => $error) {
                     echo $error . " ";
                 }
                 return;
             } else {
                 $dateLog["description"] = lang("settingsrfc.logUpdated") . json_encode($datos);
                 $dateLog["user"] = $userName;
                 $this->log->save($dateLog);
                 echo "Actualizado Correctamente";
                 return;
             }
         }
         return;
     }
     /**
      * Delete Settingsrfc
      * @param type $id
      * @return type
      */
     public function delete($id) {
         $infoSettingsrfc = $this->settingsrfc->find($id);
         helper('auth');
         $userName = user()->username;
         if (!$found = $this->settingsrfc->delete($id)) {
             return $this->failNotFound(lang('settingsrfc.msg.msg_get_fail'));
         }
         $this->settingsrfc->purgeDeleted();
         $logData["description"] = lang("settingsrfc.logDeleted") . json_encode($infoSettingsrfc);
         $logData["user"] = $userName;
         $this->log->save($logData);
         return $this->respondDeleted($found, lang('settingsrfc.msg_delete'));
     }
 }
        