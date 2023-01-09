<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    use HasFactory;

    protected $table = 'detalle_ingresos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [ 
        "det_ing_cantidad",
        "det_ing_lote"
    ]; 

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class,'medicamento_id');
    }

    public function ingreso() 
    {
        return $this->belongsTo(Ingreso::class,'ingreso_id');
    }
}
