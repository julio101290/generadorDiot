<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\{DiotModel};
use App\Models\LogModel;
use CodeIgniter\API\ResponseTrait;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DiotController extends BaseController
{
    use ResponseTrait;
    protected $log;
    protected $diot;
    public function __construct()
    {
        $this->diot = new DiotModel();
        $this->log = new LogModel();
        helper('menu');
    }
    public function index()
    {
        if ($this->request->isAJAX()) {
            $datos = $this->diot->select('id,period,RFC,beneficiary,base16,IVA16,rate0,total,created_at,updated_at,deleted_at,uuidFile')->where('deleted_at', null);
            return \Hermawan\DataTables\DataTable::of($datos)->toJson(true);
        }
        $titulos["title"] = lang('diot.title');
        $titulos["subtitle"] = lang('diot.subtitle');
        return view('diot', $titulos);
    }
    /**
     * Read Diot
     */
    public function getDiot()
    {
        $idDiot = $this->request->getPost("idDiot");
        $datosDiot = $this->diot->find($idDiot);
        echo json_encode($datosDiot);
    }
    /**
     * Save or update Diot
     */
    public function save()
    {
        helper('auth');
        $userName = user()->username;
        $idUser = user()->id;
        $datos = $this->request->getPost();
        if ($datos["idDiot"] == 0) {
            try {
                if ($this->diot->save($datos) === false) {
                    $errores = $this->diot->errors();
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
            if ($this->diot->update($datos["idDiot"], $datos) == false) {
                $errores = $this->diot->errors();
                foreach ($errores as $field => $error) {
                    echo $error . " ";
                }
                return;
            } else {
                $dateLog["description"] = lang("diot.logUpdated") . json_encode($datos);
                $dateLog["user"] = $userName;
                $this->log->save($dateLog);
                echo "Actualizado Correctamente";
                return;
            }
        }
        return;
    }

    /**
     * Delete UUID
     */

     public function deleteUUID()
     {
         helper('auth');
         $userName = user()->username;
         $idUser = user()->id;
         $datos = $this->request->getPost("uuid");

       
         helper('auth');
         $userName = user()->username;
         if (!$found = $this->diot->where("uuidFile",$datos)->delete()) {
             return $this->failNotFound(lang('diot.msg.msg_get_fail'));
         }
         $this->diot->purgeDeleted();
  
         return $this->respondDeleted($found, lang('diot.msg_delete'));
        
     }


    public function ctrSubirExcel()
    {

        helper('auth');
        $userName = user()->username;
        $path = 'documents/users/';
        $json = [];
        $file_name = $this->request->getFile('fileXLS');
        $file_name = $this->uploadFile($path, $file_name);
        $arr_file = explode('.', $file_name);
        $extension = end($arr_file);
        if ('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }

        $spreadsheet = $reader->load($file_name);
        $sheet_data = $spreadsheet->getActiveSheet()->toArray();

        // var_dump($sheet_data);

        $list = [];

        $intContador = 0;
        $fechaRegistro = "";
        $uuid = service('uuid');
        $UUIDString = $uuid->uuid4();
        $UUIDString = $UUIDString->toString();

        $period = $this->request->getPost("period");

        foreach ($sheet_data as $key => $val) {


            if ($intContador > 0 && $val[0] != "") {

                // Cabecera 
                $renglon["RFC"] = $val[0];
                $renglon["beneficiary"] = $val[1];;
                $renglon["base16"] = $val[2];
                $renglon["IVA16"] = $val[3];
                $renglon["rate0"] = $val[4];
                $renglon["total"] = $val[5];
                $renglon["period"] = $period;

                $renglon["uuidFile"] = $UUIDString;


                if ($val[0] == "") {



                    return redirect()->back()->with('sweet-success', "Archivo Cargado Correctamente");
                }

                // $resultado = 0;

                // $resultado = $this->excel->select("*")->where($encabezado)->where('deleted_at', null)->countAllResults();



                try {
                    if ($this->diot->save($renglon) === false) {
                        $errores = $this->diot->errors();
                        foreach ($errores as $field => $error) {
                            echo $error . " ";
                        }
                        return;
                    }
                    $dateLog["description"] = "Upload File" . json_encode($renglon);
                    $dateLog["user"] = $userName;
                    $this->log->save($dateLog);
                    echo "Guardado Correctamente";
                } catch (\PHPUnit\Framework\Exception $ex) {
                    echo "Error al guardar " . $ex->getMessage();
                }
            }


            $intContador++;
        }
    }




    /**
     * Delete Diot
     * @param type $id
     * @return type
     */
    public function delete($id)
    {
        $infoDiot = $this->diot->find($id);
        helper('auth');
        $userName = user()->username;
        if (!$found = $this->diot->delete($id)) {
            return $this->failNotFound(lang('diot.msg.msg_get_fail'));
        }
        $this->diot->purgeDeleted();
        $logData["description"] = lang("diot.logDeleted") . json_encode($infoDiot);
        $logData["user"] = $userName;
        $this->log->save($logData);
        return $this->respondDeleted($found, lang('diot.msg_delete'));
    }


    public function uploadFile($path, $image)
    {
        if (!is_dir($path))
            mkdir($path, 0777, TRUE);
        if ($image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('./' . $path, $newName);
            return $path . $image->getName();
        }
        return "";
    }
}
