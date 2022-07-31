<?php

namespace Modules\Produk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

	protected $table = 'produk';

    protected $fillable = [
        'nama',
        'keterangan',
        'harga',
        'persediaan'
    ];
}
