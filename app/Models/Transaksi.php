<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'nostruk';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = ['nostruk', 'nopolisi', 'tanggal', 'totalbiaya', 'terbilang', 'status'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function motor(): BelongsTo
    {
        return $this->belongsTo(Motor::class, 'nopolisi', 'nopolisi');
    }

    public function details(): HasMany
    {
        return $this->hasMany(Detail::class, 'nostruk', 'nostruk');
    }
}
