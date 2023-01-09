<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $table = 'medicamentos';      
    protected $primaryKey = 'id';    
    public $timestamps = true;

    protected $fillable = [ 
        "med_nombre",
        "med_compuesto"
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class,'stock_id');
    }

    public function detalle_egreso() 
    {
        return $this->belongsTo(DetalleEgreso::class,'detalle_egreso_id');
    }

    public function detalle_ingreso() 
    {
        return $this->belongsTo(DetalleIngreso::class,'detalle_ingreso_id');
    }

    public function detalle_traspaso() 
    {
        return $this->belongsTo(DetalleTraspaso::class,'detalle_traspaso_id');
    }

}
