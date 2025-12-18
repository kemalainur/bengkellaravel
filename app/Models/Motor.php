<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Motor extends Model
{
    protected $table = 'motor';
    protected $primaryKey = 'nopolisi';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    
    protected $fillable = ['nopolisi', 'idpelanggan', 'nomesin', 'tipe', 'tahun', 'norangka'];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'idpelanggan', 'idpelanggan');
    }

    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'nopolisi', 'nopolisi');
    }
}
