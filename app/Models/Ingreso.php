<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $table = 'ingresos';
    protected $primaryKey = 'id';
    public $timestamps = true; 

    protected $fillable = [ 
        "egre_fecha"
    ];

    public function detalle_ingreso()
    {
        return $this->belongsTo(DetalleIngreso::class,'detalle_ingreso_id');
    }

    public function centro_distrubucion()
    {
        return $this->belongsTo(CentroDistrubucion::class,'centro_distrubucion_id');
    }


}
