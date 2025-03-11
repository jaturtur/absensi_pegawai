<?php

namespace App\Models;

use CodeIgniter\Model;

class LogbookModel extends Model
{
    protected $table = 'logbook';
    protected $primaryKey = 'id';
    protected $allowedFields = ['hari_tanggal', 'rencana_target', 'output', 'keterangan'];
}
