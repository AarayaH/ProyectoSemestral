<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [ 
        "scd_cantidad",
        "scd_lote"
    ];

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class,'medicamento_id');
    }

    public function centro_distrubucion()
    {
        return $this->belongsTo(CentroDistrubucion::class,'centro_distrubucion_id');
    }

}
