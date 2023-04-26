<?php
namespace App\Models;
use CodeIgniter\Model;
class DiotModel extends Model{
    protected $table      = 'diot';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id','period','RFC','beneficiary','base16','IVA16','rate0','total','created_at','updated_at','deleted_at','uuidFile'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $deletedField  = 'deleted_at';
    protected $validationRules    =  [
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
        