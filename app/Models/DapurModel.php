<?php

namespace App\Models;

use CodeIgniter\Model;

class DapurModel extends Model
{
    protected $table            = 'dapurs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];
}
