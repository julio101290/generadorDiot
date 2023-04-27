<?php
namespace App\Models;
use CodeIgniter\Model;
class SettingsrfcModel extends Model{
    protected $table      = 'settingsrfc';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','RFC','thirdParty','typeOperation','deleted_at','updated_at','created_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $deletedField  = 'deleted_at';
    protected $validationRules    =  [
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
        