<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    protected $fillable = [
        'nama',
        'lokasi',
        'kondisi',
    ];
}
