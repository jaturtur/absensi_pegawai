<?php

namespace App\Models;

use CodeIgniter\Model;

class LogbookModel extends Model
{
    protected $table            = 'logbook';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'tanggal',
        'target',
        'file',
        'status',
        'keterangan'
    ];

   
}
