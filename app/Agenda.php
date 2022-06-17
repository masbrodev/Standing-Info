<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'nama',
        'dari',
        'status', //Disetujui / Diajukan
        'keterangan', // off/on/ofn
        'tempat',
        'waktu',
        'sampai'
    ];
}
