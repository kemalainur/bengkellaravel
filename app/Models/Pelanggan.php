<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'idpelanggan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    
    protected $fillable = ['idpelanggan', 'nama', 'alamat'];

    public function motors(): HasMany
    {
        return $this->hasMany(Motor::class, 'idpelanggan', 'idpelanggan');
    }
}
