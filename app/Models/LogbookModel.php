<?php

namespace App\Models;

use CodeIgniter\Model;

class LogbookModel extends Model
{
<<<<<<< HEAD
    protected $table = 'logbook';
    protected $primaryKey = 'id';
    protected $allowedFields = ['hari_tanggal', 'rencana_target', 'output', 'keterangan'];
=======
    protected $table            = 'logbook';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'tanggal',
        'target',
        'file',
        'status',
        'keterangan'
    ];

   
>>>>>>> 4bcf2d23cb5aacf9c36cc4ac2dcfba60ea878756
}
