<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['full_name', 'email', 'password', 'phone', 'latitude', 'longitude', 'altitude', 'speed', 'created', 'updated'];
    protected $useTimestamps = true;
    protected $createdField = 'created';
    protected $updatedField = 'updated';
    protected $deletedField = 'del_flag';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    private $fetchFields = ['id', 'full_name', 'email', 'phone', 'password', 'latitude', 'longitude', 'altitude', 'speed'];
    private $getColumns = ['id', 'full_name', 'email', 'phone', 'latitude', 'longitude', 'altitude', 'speed', 'updated'];

    public function get_row($where)
    {
        $user = new UsersModel();
        return $user->select($this->fetchFields)->where($where)->get()->getRowArray();
    }

    public function get_all($where = NULL)
    {
        $user = new UsersModel();
        $user->select($this->getColumns);
        if (!is_null($where)) {
            $user->where($where);
        }
        return $user->get()->getResultArray();
    }
}
