<?php

namespace App\Models;

use CodeIgniter\Model;

class SuperadminModel extends Model
{

    protected $table = 'super_admin';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['fname', 'email', 'password', 'reset_token'];
    protected $useTimestamps = false;
    protected $createdField = 'created';
    protected $updatedField = 'updated';
    protected $deletedField = 'del_flag';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
