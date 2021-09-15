<?php

namespace App\Models;

use CodeIgniter\Model;

class PhoneModel extends Model
{

    protected $table = 'phone_register';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['phone_no', 'created', 'updated'];
    protected $useTimestamps = true;
    protected $createdField = 'created';
    protected $updatedField = 'updated';
    protected $deletedField = 'del_flag';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    private $fetchFields = ['id', 'phone_no'];

    public function get_row($where)
    {
        $phone = new PhoneModel();
        return $phone->select($this->fetchFields)->where($where)->get()->getRowArray();
    }


}
