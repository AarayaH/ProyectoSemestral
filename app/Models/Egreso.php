<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;

    protected $table = 'egresos'; 
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [ 
        "egre_fecha"
    ];

    public function farmacia() 
    {
        return $this->hasMany(Farmacia::class);
    }

    public function centro_distrubucion()
    {
        return $this->hasMany(CentroDistribucion::class);
    }

    public function detalle_egreso()
    {
        return $this->belongsTo(DetalleEgreso::class,'detalle_egreso_id');
    }
}
