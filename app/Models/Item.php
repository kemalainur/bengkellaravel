<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    protected $table = 'item';
    protected $primaryKey = 'iditem';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    
    protected $fillable = ['iditem', 'namaitem', 'harga', 'jenis', 'qty'];

    public function details(): HasMany
    {
        return $this->hasMany(Detail::class, 'iditem', 'iditem');
    }
}
