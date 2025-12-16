<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detail extends Model
{
    protected $table = 'detail';
    
    protected $fillable = ['nostruk', 'iditem', 'banyaknya', 'hargatotal'];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'nostruk', 'nostruk');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'iditem', 'iditem');
    }
}
