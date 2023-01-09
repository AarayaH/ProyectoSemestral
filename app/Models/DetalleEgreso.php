<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleEgreso extends Model
{
    use HasFactory;

    protected $table = 'detalle_egresos';
    protected $primaryKey = 'id';
    public $timestamps = true;  

    protected $fillable = [ 
        "det_egr_cantidad",
        "det_egr_lote"
    ]; 

    public function medicamento()
    {
        return $this->belongsTo(medicamento::class,'medicamento_id');
    }

    public function egreso()
    {
        return $this->belongsTo(egreso::class,'egreso_id');
    }
}
