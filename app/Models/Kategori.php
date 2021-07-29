<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $fillable = ['nama' , 'deskripsi', 'parent_id' , 'slug'];

    public function scopeGetParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function parent()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function child()
    {
        return $this->hasMany(Kategori::class, 'parent_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
